<?php

namespace App\Console\Commands;

use App\Models\Referencia;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerarReferenciasJson extends Command
{
    protected $signature = 'referencias:generar-json';

    protected $description = 'Genera el JSON estático con el listado de referencias bibliográficas';

    public function handle(): int
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

        return self::SUCCESS;
    }
}