<?php

namespace App\Support;

class RisParser
{
    /**
     * @return array<int, array{
     *   titulo: string,
     *   autores: string,
     *   anio: int|null,
     *   revista: string|null,
     *   resumen: string|null,
     *   url: string|null,
     *   doi: string|null,
     *   palabras_clave: string|null,
     * }>
     */
    public static function parse(string $contenido): array
    {
        $contenido = str_replace(["\r\n", "\r"], "\n", $contenido);
        $bloques = preg_split('/^ER\s*-.*$/m', $contenido);

        $referencias = [];

        foreach ($bloques as $bloque) {
            $bloque = trim($bloque);
            if ($bloque === '') {
                continue;
            }

            $autores = [];
            $keywords = [];
            $campo = [
                'titulo'   => null,
                'anio'     => null,
                'revista'  => null,
                'resumen'  => null,
                'url'      => null,
                'doi'      => null,
            ];

            foreach (explode("\n", $bloque) as $linea) {
                $linea = rtrim($linea);
                if ($linea === '' || strlen($linea) < 6) {
                    continue;
                }

                if (!preg_match('/^([A-Z0-9]{2})\s{0,2}-\s?(.*)$/', $linea, $m)) {
                    continue;
                }

                $tag   = $m[1];
                $valor = trim($m[2]);

                switch ($tag) {
                    case 'AU':
                    case 'A1':
                        $autores[] = $valor;
                        break;
                    case 'TI':
                    case 'T1':
                        $campo['titulo'] = $valor;
                        break;
                    case 'PY':
                    case 'Y1':
                        // A veces viene como "2021/05/10", tomamos solo el año
                        if (preg_match('/(\d{4})/', $valor, $y)) {
                            $campo['anio'] = (int) $y[1];
                        }
                        break;
                    case 'AB':
                    case 'N2':
                        $campo['resumen'] = $valor;
                        break;
                    case 'UR':
                        $campo['url'] = $valor;
                        break;
                    case 'DO':
                        $campo['doi'] = $valor;
                        break;
                    case 'JO':
                    case 'JF':
                    case 'T2':
                        $campo['revista'] = $campo['revista'] ?? $valor;
                        break;
                    case 'KW':
                        $keywords[] = $valor;
                        break;
                }
            }

            if (empty($campo['titulo'])) {
                continue;
            }

            $referencias[] = [
                'titulo'         => $campo['titulo'],
                'autores'        => implode('; ', $autores),
                'anio'           => $campo['anio'],
                'revista'        => $campo['revista'],
                'resumen'        => $campo['resumen'],
                'url'            => $campo['url'] ?: ($campo['doi'] ? 'https://doi.org/' . $campo['doi'] : null),
                'doi'            => $campo['doi'],
                'palabras_clave' => implode('; ', $keywords),
            ];
        }

        return $referencias;
    }
}