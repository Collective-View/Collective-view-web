<?php

namespace App\Http\Controllers;

use App\Models\Referencia;
use App\Support\RisParser;
use Illuminate\Http\Request;

class ReferenciaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->query('q');

        $referencias = Referencia::when($busqueda, function ($query, $busqueda) {
                $query->where(function ($q) use ($busqueda) {
                    $q->where('titulo', 'like', "%{$busqueda}%")
                      ->orWhere('autores', 'like', "%{$busqueda}%");
                });
            })
            ->orderByDesc('anio')
            ->paginate(15)
            ->withQueryString();

        return view('admin.referencias.index', compact('referencias', 'busqueda'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'         => 'required|string|max:500',
            'autores'        => 'nullable|string|max:1000',
            'anio'           => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'revista'        => 'nullable|string|max:255',
            'resumen'        => 'nullable|string',
            'url'            => 'nullable|url|max:500',
            'doi'            => 'nullable|string|max:255',
            'palabras_clave' => 'nullable|string|max:500',
        ]);

        Referencia::create($data);

        return redirect()->route('admin.referencias.index')->with('success', 'Referencia agregada.');
    }

    public function update(Request $request, $id)
    {
        $referencia = Referencia::findOrFail($id);

        $data = $request->validate([
            'titulo'         => 'required|string|max:500',
            'autores'        => 'nullable|string|max:1000',
            'anio'           => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'revista'        => 'nullable|string|max:255',
            'resumen'        => 'nullable|string',
            'url'            => 'nullable|url|max:500',
            'doi'            => 'nullable|string|max:255',
            'palabras_clave' => 'nullable|string|max:500',
        ]);

        $referencia->update($data);

        return redirect()->route('admin.referencias.index')->with('success', 'Referencia actualizada.');
    }

    public function destroy($id)
    {
        Referencia::findOrFail($id)->delete();

        return redirect()->route('admin.referencias.index')->with('success', 'Referencia eliminada.');
    }

    public function importarRis(Request $request)
    {
        $request->validate([
            'archivo_ris' => 'required|file|max:10240', // 10MB
        ]);

        $contenido = file_get_contents($request->file('archivo_ris')->getRealPath());
        $registros = RisParser::parse($contenido);

        $creadas = 0;
        $omitidas = 0;

        foreach ($registros as $registro) {
            $existe = Referencia::where('titulo', $registro['titulo'])->exists();

            if ($existe) {
                $omitidas++;
                continue;
            }

            Referencia::create($registro);
            $creadas++;
        }

        return redirect()->route('admin.referencias.index')
            ->with('success', "Importación completa: {$creadas} referencias nuevas, {$omitidas} ya existían y se omitieron.");
    }
}