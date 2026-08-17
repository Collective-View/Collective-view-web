<?php

namespace App\Http\Controllers;

use App\Models\Medio;
use App\Models\MedioImagen;
use App\Models\MedioEnlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedioController extends Controller
{
    private array $tipos = [
        'distincion'  => 'Distinciones',
        'conferencia' => 'Conferencias',
        'podcast'     => 'Podcasts',
        'prensa'      => 'Prensa',
    ];

    public function index()
    {
        $medios = Medio::withCount(['imagenes', 'enlaces'])->latest()->get();
        $tipos  = $this->tipos;

        return view('admin.medios.index', compact('medios', 'tipos'));
    }

    public function create()
    {
        $tipos = $this->tipos;
        return view('admin.medios.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'tipo'             => 'required|in:distincion,conferencia,podcast,prensa',
                'texto'            => 'required|string',
                'imagenes.*'       => 'nullable|image|max:3072',
                'enlaces.*.nombre' => 'required|string|max:255',
                'enlaces.*.url'    => 'nullable|url|max:500',
            ],
            [
                'tipo.required'            => 'El tipo de sección es obligatorio.',
                'tipo.in'                  => 'El tipo seleccionado no es válido. Opciones: distinción, conferencia, podcast o prensa.',
                'texto.required'           => 'El texto de la sección es obligatorio.',
                'texto.string'             => 'El texto debe ser una cadena de caracteres válida.',
                'imagenes.*.image'         => 'El archivo :position no es una imagen válida.',
                'imagenes.*.max'           => 'Cada imagen no puede superar los 3 MB.',
                'enlaces.*.nombre.required'=> 'El nombre o titular es obligatorio.',
                'enlaces.*.nombre.string'  => 'El nombre o titular debe ser texto.',
                'enlaces.*.nombre.max'     => 'El nombre o titular no puede superar los 255 caracteres.',
                'enlaces.*.url.url'        => 'La URL del enlace no tiene un formato válido.',
                'enlaces.*.url.max'        => 'La URL del enlace no puede superar los 500 caracteres.',
            ]
        );

        $medio = Medio::create($request->only('tipo', 'texto'));

        foreach ($request->file('imagenes', []) as $i => $file) {
            $medio->imagenes()->create([
                'ruta'  => $file->store('medios', 'public'),
                'orden' => $i,
            ]);
        }

        foreach ($request->input('enlaces', []) as $i => $enlace) {
            if (filled($enlace['nombre'])) {
                $medio->enlaces()->create([
                    'nombre' => $enlace['nombre'],
                    'url'    => $enlace['url'] ?? null,
                    'orden'  => $i,
                ]);
            }
        }

        return redirect()->route('admin.medios.index')
                         ->with('success', 'Sección de medios creada correctamente.');
    }

    public function edit($id)
    {
        $medio = Medio::with(['imagenes', 'enlaces'])->findOrFail($id);
        $tipos  = $this->tipos;

        return view('admin.medios.edit', compact('medio', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $medio = Medio::findOrFail($id);

        $request->validate(
            [
                'tipo'             => 'required|in:distincion,conferencia,podcast,prensa',
                'texto'            => 'required|string',
                'imagenes.*'       => 'nullable|image|max:3072',
                'enlaces.*.nombre' => 'required|string|max:255',
                'enlaces.*.url'    => 'nullable|url|max:500',
            ],
            [
                'tipo.required'            => 'El tipo de sección es obligatorio.',
                'tipo.in'                  => 'El tipo seleccionado no es válido. Opciones: distinción, conferencia, podcast o prensa.',
                'texto.required'           => 'El texto de la sección es obligatorio.',
                'texto.string'             => 'El texto debe ser una cadena de caracteres válida.',
                'imagenes.*.image'         => 'El archivo :position no es una imagen válida.',
                'imagenes.*.max'           => 'Cada imagen no puede superar los 3 MB.',
                'enlaces.*.nombre.required'=> 'El nombre o titular es obligatorio.',
                'enlaces.*.nombre.string'  => 'El nombre o titular debe ser texto.',
                'enlaces.*.nombre.max'     => 'El nombre o titular no puede superar los 255 caracteres.',
                'enlaces.*.url.url'        => 'La URL del enlace no tiene un formato válido.',
                'enlaces.*.url.max'        => 'La URL del enlace no puede superar los 500 caracteres.',
            ]
        );

        $medio->update($request->only('tipo', 'texto'));

        foreach ($request->file('imagenes', []) as $i => $file) {
            $medio->imagenes()->create([
                'ruta'  => $file->store('medios', 'public'),
                'orden' => $medio->imagenes()->max('orden') + $i + 1,
            ]);
        }

        foreach ($request->input('eliminar_imagenes', []) as $imgId) {
            $img = MedioImagen::where('medio_id', $medio->id)->find($imgId);
            if ($img) {
                Storage::disk('public')->delete($img->ruta);
                $img->delete();
            }
        }

        $medio->enlaces()->delete();
        foreach ($request->input('enlaces', []) as $i => $enlace) {
            if (filled($enlace['nombre'])) {
                $medio->enlaces()->create([
                    'nombre' => $enlace['nombre'],
                    'url'    => $enlace['url'] ?? null,
                    'orden'  => $i,
                ]);
            }
        }

        return redirect()->route('admin.medios.index')
                         ->with('success', 'Sección actualizada correctamente.');
    }

    public function destroy($id)
    {
        $medio = Medio::with('imagenes')->findOrFail($id);

        foreach ($medio->imagenes as $img) {
            Storage::disk('public')->delete($img->ruta);
        }

        $medio->delete();

        return redirect()->route('admin.medios.index')
                         ->with('success', 'Sección eliminada.');
    }

    public function publicos()
    {
        $medios = Medio::with(['imagenes', 'enlaces'])
            ->get()
            ->map(fn($m) => [
                'id'       => $m->id,
                'tipo'     => $m->tipo,
                'label'    => $m->tipoLabel(),
                'texto'    => $m->texto,
                'imagenes' => $m->imagenes->map(fn($i) => asset('storage/' . $i->ruta)),
                'enlaces'  => $m->enlaces->map(fn($e) => [
                    'nombre' => $e->nombre,
                    'url'    => $e->url,
                ]),
            ]);

        $mediosJson = json_encode($medios, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

        return view('collective-view.medios', compact('mediosJson'));
    }
}