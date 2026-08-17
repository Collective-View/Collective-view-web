<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:100|unique:categorias']);
        Categoria::create($request->only('nombre'));
        return redirect()->route('admin.clasificacion.index')->with('success', 'Categoría creada.');
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $request->validate(['nombre' => 'required|string|max:100|unique:categorias,nombre,' . $id]);
        $categoria->update($request->only('nombre'));
        return redirect()->route('admin.clasificacion.index')->with('success', 'Categoría actualizada.');
    }

    public function destroy($id)
    {
        Categoria::findOrFail($id)->delete();
        return redirect()->route('admin.clasificacion.index')->with('success', 'Categoría eliminada.');
    }
}