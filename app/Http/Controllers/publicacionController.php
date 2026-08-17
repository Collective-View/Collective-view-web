<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Categoria;
use App\Models\Etiqueta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Publicacion::with(['categoria', 'etiquetas']);

        if ($request->filled('buscar')) {
            $query->where('titulo', 'like', '%' . $request->buscar . '%');
        }

        $publicaciones = $query->latest('fecha_publicacion')->paginate(10)->withQueryString();

        return view('admin.publicaciones.index', compact('publicaciones'));
    }

    public function publicas()
    {
        $publicaciones = Publicacion::with(['categoria', 'etiquetas'])
            ->latest('fecha_publicacion')
            ->get()
            ->map(function ($pub) {
                return [
                    'id'                => $pub->id,
                    'titulo'            => $pub->titulo,
                    'abstract'          => $pub->abstract,
                    'fecha_publicacion' => optional($pub->fecha_publicacion)->format('d/m/Y'),
                    'url'               => $pub->url,
                    'imagen'            => $pub->imagen
                                            ? asset('storage/' . $pub->imagen)
                                            : null,
                    'categoria_id'      => $pub->categoria_id,
                    'categoria_nombre'  => optional($pub->categoria)->nombre,
                    'etiquetas'         => $pub->etiquetas->pluck('nombre')->toArray(),
                ];
            });

        $categorias = Categoria::withCount('publicaciones')->get();

        $publicacionesJson = json_encode($publicaciones, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

        return view('collective-view.publicaciones', compact('categorias', 'publicacionesJson'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $etiquetas  = Etiqueta::all();
        return view('admin.publicaciones.create', compact('categorias', 'etiquetas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'            => 'required|string|max:255',
            'abstract'          => 'required|string',
            'fecha_publicacion' => 'required|date',
            'url'               => 'nullable|url',
            'imagen'            => 'nullable|image|max:2048',
            'categoria_id'      => 'required|exists:categorias,id',
            'etiquetas'         => 'nullable|array',
            'etiquetas.*'       => 'exists:etiquetas,id',
        ],
        [
            'titulo.required'            => 'El título de la publicación es obligatorio.',
            'titulo.string'              => 'El título debe ser una cadena de caracteres válida.',
            'titulo.max'                 => 'El título no puede superar los 255 caracteres.',
            'abstract.required'          => 'El resumen (abstract) es obligatorio.',
            'abstract.string'            => 'El resumen debe ser una cadena de caracteres válida.',
            'fecha_publicacion.required' => 'La fecha de publicación es obligatoria.',
            'fecha_publicacion.date'     => 'La fecha de publicación no tiene un formato válido.',
            'url.url'                    => 'La URL no tiene un formato válido (debe incluir http:// o https://).',
            'imagen.image'               => 'El archivo seleccionado no es una imagen válida.',
            'imagen.max'                 => 'La imagen no puede superar los 2 MB.',
            'categoria_id.required'      => 'Debes seleccionar una categoría.',
            'categoria_id.exists'        => 'La categoría seleccionada no existe.',
            'etiquetas.array'            => 'Las etiquetas deben enviarse en formato de lista.',
            'etiquetas.*.exists'         => 'Una o más etiquetas seleccionadas no existen.',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        $publicacion = Publicacion::create($validated);
        $publicacion->etiquetas()->sync($request->etiquetas ?? []);

        return redirect()->route('admin.publicaciones.index')
                         ->with('success', 'Publicación creada correctamente.');
    }

    public function edit($id)
    {
        $publicacion = Publicacion::with('etiquetas')->findOrFail($id);
        $categorias  = Categoria::all();
        $etiquetas   = Etiqueta::all();
        return view('admin.publicaciones.edit', compact('publicacion', 'categorias', 'etiquetas'));
    }

    public function update(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        $validated = $request->validate([
            'titulo'            => 'required|string|max:255',
            'abstract'          => 'required|string',
            'fecha_publicacion' => 'required|date',
            'url'               => 'nullable|url',
            'imagen'            => 'nullable|image|max:2048',
            'categoria_id'      => 'required|exists:categorias,id',
            'etiquetas'         => 'nullable|array',
            'etiquetas.*'       => 'exists:etiquetas,id',
        ],
        [
            'titulo.required'            => 'El título de la publicación es obligatorio.',
            'titulo.string'              => 'El título debe ser una cadena de caracteres válida.',
            'titulo.max'                 => 'El título no puede superar los 255 caracteres.',
            'abstract.required'          => 'El resumen (abstract) es obligatorio.',
            'abstract.string'            => 'El resumen debe ser una cadena de caracteres válida.',
            'fecha_publicacion.required' => 'La fecha de publicación es obligatoria.',
            'fecha_publicacion.date'     => 'La fecha de publicación no tiene un formato válido.',
            'url.url'                    => 'La URL no tiene un formato válido (debe incluir http:// o https://).',
            'imagen.image'               => 'El archivo seleccionado no es una imagen válida.',
            'imagen.max'                 => 'La imagen no puede superar los 2 MB.',
            'categoria_id.required'      => 'Debes seleccionar una categoría.',
            'categoria_id.exists'        => 'La categoría seleccionada no existe.',
            'etiquetas.array'            => 'Las etiquetas deben enviarse en formato de lista.',
            'etiquetas.*.exists'         => 'Una o más etiquetas seleccionadas no existen.',
        ]);

        if ($request->hasFile('imagen')) {
            if ($publicacion->imagen) Storage::disk('public')->delete($publicacion->imagen);
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        $publicacion->update($validated);
        $publicacion->etiquetas()->sync($request->etiquetas ?? []);

        return redirect()->route('admin.publicaciones.index')
                         ->with('success', 'Publicación actualizada correctamente.');
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        if ($publicacion->imagen) Storage::disk('public')->delete($publicacion->imagen);
        $publicacion->etiquetas()->detach();
        $publicacion->delete();

        return redirect()->route('admin.publicaciones.index')
                         ->with('success', 'Publicación eliminada.');
    }
}