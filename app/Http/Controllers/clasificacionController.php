<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Etiqueta;

class ClasificacionController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::withCount('publicaciones')
            ->paginate(10, ['*'], 'etiquetas_page');

        $categorias = Categoria::withCount('publicaciones')
            ->paginate(10, ['*'], 'categorias_page');

        return view('admin.clasificacion.index', compact('etiquetas', 'categorias'));
    }
}