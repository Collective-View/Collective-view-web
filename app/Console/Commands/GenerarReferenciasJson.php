<?php

namespace App\Console\Commands;

use App\Models\Referencia;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerarReferenciasJson extends Command
{
    protected $signature = 'referencias:generar-json';

    protected $description = 'Genera referencias.json y calcula la red de co-autoría (red-referencias.json)';

    public function handle(): int
    {
        $this->generarReferencias();
        $this->generarRedReferencias();

        return self::SUCCESS;
    }

    /**
     * Genera public/data/referencias.json a partir de la tabla `referencias`.
     */
    protected function generarReferencias(): void
    {
        $referencias = Referencia::orderByDesc('anio')
            ->get()
            ->map(function ($ref) {
                return [
                    'id'      => $ref->id,
                    'titulo'  => $ref->titulo,
                    'autores' => $ref->autores,
                    'anio'    => $ref->anio,
                    'revista' => $ref->revista,
                    'resumen' => $ref->resumen,
                    'url'     => $ref->url,
                    'doi'     => $ref->doi,
                ];
            });

        $json = json_encode($referencias, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $rutaSalida = public_path('data/referencias.json');
        File::ensureDirectoryExists(dirname($rutaSalida));
        File::put($rutaSalida, $json);

        $this->info("Archivo generado en: {$rutaSalida} ({$referencias->count()} referencias)");
    }

    /**
     * Genera public/data/red-referencias.json: red de co-autoría calculada
     * a partir del campo `autores` (separado por "; ", tal como lo guarda RisParser).
     *
     * Nota: x/y y cluster son una aproximación propia (layout por fuerzas +
     * detección de comunidades simplificada), no una réplica exacta del
     * algoritmo VOS de VOSviewer. Los weights y Avg. pub. year sí son cálculos
     * exactos sobre los datos reales.
     */
    protected function generarRedReferencias(): void
    {
        $referencias = Referencia::whereNotNull('autores')
            ->where('autores', '!=', '')
            ->get(['id', 'autores', 'anio']);

        $indicePorAutor = [];
        $labelPorIndice = [];
        $aniosPorIndice = [];
        $docsPorIndice  = [];
        $listaAutoresPorReferencia = [];

        foreach ($referencias as $ref) {
            $nombres = array_filter(array_map('trim', explode(';', $ref->autores)));
            $indices = [];

            foreach ($nombres as $nombre) {
                $normalizado = mb_strtolower($nombre, 'UTF-8');
                if ($normalizado === '') {
                    continue;
                }

                if (! isset($indicePorAutor[$normalizado])) {
                    $nuevoIndice = count($indicePorAutor);
                    $indicePorAutor[$normalizado] = $nuevoIndice;
                    $labelPorIndice[$nuevoIndice] = $normalizado;
                    $aniosPorIndice[$nuevoIndice] = [];
                    $docsPorIndice[$nuevoIndice] = 0;
                }

                $idx = $indicePorAutor[$normalizado];
                $docsPorIndice[$idx]++;
                if ($ref->anio) {
                    $aniosPorIndice[$idx][] = (int) $ref->anio;
                }
                $indices[] = $idx;
            }

            $indices = array_values(array_unique($indices));
            if (count($indices) > 1) {
                $listaAutoresPorReferencia[] = $indices;
            }
        }

        $n = count($indicePorAutor);

        if ($n === 0) {
            $this->warn('No hay autores suficientes para construir la red (revisa el campo "autores").');
            return;
        }

        // Fuerza de co-ocurrencia por pareja de autores (cuántas referencias comparten)
        $pares = [];
        foreach ($listaAutoresPorReferencia as $indices) {
            sort($indices);
            $total = count($indices);
            for ($a = 0; $a < $total; $a++) {
                for ($b = $a + 1; $b < $total; $b++) {
                    $clave = $indices[$a] . '-' . $indices[$b];
                    $pares[$clave] = ($pares[$clave] ?? 0) + 1;
                }
            }
        }

        // Adyacencia y pesos por nodo
        $adyacencia = array_fill(0, $n, []);
        foreach ($pares as $clave => $fuerza) {
            [$i, $j] = array_map('intval', explode('-', $clave));
            $adyacencia[$i][$j] = $fuerza;
            $adyacencia[$j][$i] = $fuerza;
        }

        $enlacesPorNodo = array_fill(0, $n, 0);
        $fuerzaTotalPorNodo = array_fill(0, $n, 0);
        foreach ($adyacencia as $i => $vecinos) {
            $enlacesPorNodo[$i] = count($vecinos);
            $fuerzaTotalPorNodo[$i] = array_sum($vecinos);
        }

        $clusters = $this->detectarClusters($n, $adyacencia);
        $posiciones = $this->calcularLayout($n, $pares);

        // IDs asignados alfabéticamente (como hace VOSviewer con su thesaurus)
        $ordenAlfabetico = range(0, $n - 1);
        usort($ordenAlfabetico, fn ($a, $b) => $labelPorIndice[$a] <=> $labelPorIndice[$b]);

        $idPorIndice = [];
        foreach ($ordenAlfabetico as $posicion => $indiceOriginal) {
            $idPorIndice[$indiceOriginal] = $posicion + 1;
        }

        $items = [];
        foreach (range(0, $n - 1) as $idx) {
            $anios = $aniosPorIndice[$idx];
            $promedioAnio = count($anios) > 0
                ? round(array_sum($anios) / count($anios), 4)
                : null;

            $items[] = [
                'id'      => $idPorIndice[$idx],
                'label'   => $labelPorIndice[$idx],
                'x'       => round($posiciones[$idx]['x'], 4),
                'y'       => round($posiciones[$idx]['y'], 4),
                'cluster' => $clusters[$idx],
                'weights' => [
                    'Links'               => (float) $enlacesPorNodo[$idx],
                    'Total link strength' => (float) $fuerzaTotalPorNodo[$idx],
                    'Documents'           => (float) $docsPorIndice[$idx],
                ],
                'scores' => [
                    'Avg. pub. year' => $promedioAnio,
                ],
            ];
        }
        usort($items, fn ($a, $b) => $a['id'] <=> $b['id']);

        $links = [];
        foreach ($pares as $clave => $fuerza) {
            [$i, $j] = array_map('intval', explode('-', $clave));
            $links[] = [
                'source_id' => $idPorIndice[$i],
                'target_id' => $idPorIndice[$j],
                'strength'  => (float) $fuerza,
            ];
        }
        usort($links, fn ($a, $b) => $a['source_id'] <=> $b['source_id']);

        $salida = [
            'network' => [
                'items' => $items,
                'links' => $links,
            ],
        ];

        $json = json_encode($salida, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $rutaSalida = public_path('data/red-referencias.json');
        File::ensureDirectoryExists(dirname($rutaSalida));
        File::put($rutaSalida, $json);

        $this->info("Archivo generado en: {$rutaSalida} ({$n} autores, " . count($links) . " enlaces)");
    }

    /**
     * Detección de comunidades simplificada (una sola pasada, estilo Louvain):
     * cada autor empieza en su propio cluster y se mueve iterativamente al
     * cluster vecino con el que comparte más peso de enlace, hasta estabilizar.
     *
     * @param array<int, array<int, int>> $adyacencia índice => [vecino => fuerza]
     * @return array<int, int> índice => número de cluster (empezando en 1)
     */
    protected function detectarClusters(int $n, array $adyacencia): array
    {
        $comunidad = range(0, $n - 1);

        $mejorado = true;
        $iteraciones = 0;

        while ($mejorado && $iteraciones < 30) {
            $mejorado = false;
            $iteraciones++;

            foreach (range(0, $n - 1) as $nodo) {
                $vecinos = $adyacencia[$nodo] ?? [];
                if (empty($vecinos)) {
                    continue;
                }

                $comunidadActual = $comunidad[$nodo];
                $pesoPorComunidad = [];
                foreach ($vecinos as $vecino => $peso) {
                    $com = $comunidad[$vecino];
                    $pesoPorComunidad[$com] = ($pesoPorComunidad[$com] ?? 0) + $peso;
                }

                $mejorComunidad = $comunidadActual;
                $mejorPeso = $pesoPorComunidad[$comunidadActual] ?? 0;

                foreach ($pesoPorComunidad as $com => $peso) {
                    if ($peso > $mejorPeso) {
                        $mejorPeso = $peso;
                        $mejorComunidad = $com;
                    }
                }

                if ($mejorComunidad !== $comunidadActual) {
                    $comunidad[$nodo] = $mejorComunidad;
                    $mejorado = true;
                }
            }
        }

        // Renumerar clusters consecutivamente (1, 2, 3...) de mayor a menor tamaño
        $tamanos = [];
        foreach ($comunidad as $com) {
            $tamanos[$com] = ($tamanos[$com] ?? 0) + 1;
        }
        arsort($tamanos);

        $mapa = [];
        $siguiente = 1;
        foreach (array_keys($tamanos) as $com) {
            $mapa[$com] = $siguiente++;
        }

        return array_map(fn ($com) => $mapa[$com], $comunidad);
    }

    /**
     * Layout por fuerzas (estilo Fruchterman-Reingold): nodos conectados se
     * atraen, todos los nodos se repelen entre sí. Aproxima visualmente el
     * tipo de mapa que produce VOSviewer, normalizado a un rango similar.
     *
     * @param array<string, int> $pares "i-j" => fuerza de co-ocurrencia
     * @return array<int, array{x: float, y: float}>
     */
    protected function calcularLayout(int $n, array $pares): array
    {
        if ($n === 1) {
            return [0 => ['x' => 0.0, 'y' => 0.0]];
        }

        $k = sqrt(4.0 / $n);

        $pos = [];
        foreach (range(0, $n - 1) as $i) {
            $angulo = (2 * M_PI * $i) / $n;
            $pos[$i] = ['x' => cos($angulo) * 0.5, 'y' => sin($angulo) * 0.5];
        }

        $enlaces = [];
        foreach ($pares as $clave => $fuerza) {
            [$i, $j] = array_map('intval', explode('-', $clave));
            $enlaces[] = [$i, $j, $fuerza];
        }

        $temperatura = 0.1;

        for ($iter = 0; $iter < 200; $iter++) {
            $desplazamiento = array_fill(0, $n, ['x' => 0.0, 'y' => 0.0]);

            for ($i = 0; $i < $n; $i++) {
                for ($j = $i + 1; $j < $n; $j++) {
                    $dx = $pos[$i]['x'] - $pos[$j]['x'];
                    $dy = $pos[$i]['y'] - $pos[$j]['y'];
                    $dist = sqrt($dx * $dx + $dy * $dy) ?: 0.01;
                    $fuerza = ($k * $k) / $dist;
                    $ux = $dx / $dist;
                    $uy = $dy / $dist;

                    $desplazamiento[$i]['x'] += $ux * $fuerza;
                    $desplazamiento[$i]['y'] += $uy * $fuerza;
                    $desplazamiento[$j]['x'] -= $ux * $fuerza;
                    $desplazamiento[$j]['y'] -= $uy * $fuerza;
                }
            }

            foreach ($enlaces as [$i, $j, $peso]) {
                $dx = $pos[$i]['x'] - $pos[$j]['x'];
                $dy = $pos[$i]['y'] - $pos[$j]['y'];
                $dist = sqrt($dx * $dx + $dy * $dy) ?: 0.01;
                $factorPeso = 0.3 + 0.7 * (min($peso, 5) / 5);
                $fuerza = (($dist * $dist) / $k) * $factorPeso;
                $ux = $dx / $dist;
                $uy = $dy / $dist;

                $desplazamiento[$i]['x'] -= $ux * $fuerza;
                $desplazamiento[$i]['y'] -= $uy * $fuerza;
                $desplazamiento[$j]['x'] += $ux * $fuerza;
                $desplazamiento[$j]['y'] += $uy * $fuerza;
            }

            for ($i = 0; $i < $n; $i++) {
                $dx = $desplazamiento[$i]['x'];
                $dy = $desplazamiento[$i]['y'];
                $dist = sqrt($dx * $dx + $dy * $dy) ?: 0.01;
                $limite = min($dist, $temperatura);
                $pos[$i]['x'] += ($dx / $dist) * $limite;
                $pos[$i]['y'] += ($dy / $dist) * $limite;
            }

            $temperatura *= 0.97;
        }

        $xs = array_column($pos, 'x');
        $ys = array_column($pos, 'y');
        $minX = min($xs);
        $maxX = max($xs);
        $minY = min($ys);
        $maxY = max($ys);
        $rangoX = ($maxX - $minX) ?: 1;
        $rangoY = ($maxY - $minY) ?: 1;

        foreach ($pos as $i => $p) {
            $pos[$i]['x'] = (($p['x'] - $minX) / $rangoX) * 3 - 1.5;
            $pos[$i]['y'] = (($p['y'] - $minY) / $rangoY) * 3 - 1.5;
        }

        return $pos;
    }
}