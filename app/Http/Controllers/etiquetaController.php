<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:100|unique:etiquetas']);
        Etiqueta::create($request->only('nombre'));
        return redirect()->route('admin.clasificacion.index')->with('success', 'Etiqueta creada.');
    }

    public function update(Request $request, $id)
    {
        $etiqueta = Etiqueta::findOrFail($id);
        $request->validate(['nombre' => 'required|string|max:100|unique:etiquetas,nombre,' . $id]);
        $etiqueta->update($request->only('nombre'));
        return redirect()->route('admin.clasificacion.index')->with('success', 'Etiqueta actualizada.');
    }

    public function destroy($id)
    {
        Etiqueta::findOrFail($id)->delete();
        return redirect()->route('admin.clasificacion.index')->with('success', 'Etiqueta eliminada.');
    }
}