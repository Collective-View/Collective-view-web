<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\ReferenciaController;
use App\Http\Controllers\MedioController;

require __DIR__.'/auth.php';

Route::view('/', 'collective-view.index')->name('home');
Route::view('/datos', 'collective-view.datos')->name('datos');
Route::view('/videos', 'collective-view.videos')->name('videos');
Route::view('/propiedad', 'collective-view.propiedad')->name('propiedad');
Route::view('/contactos', 'collective-view.contactos')->name('contactos');
Route::view('/referencias', 'collective-view.referencias')->name('referencias');
Route::view('/monitoreo', 'collective-view.monitoreo')->name('monitoreo');
Route::view('/investigacion', 'collective-view.investigacion')->name('investigacion');

Route::get('/publicaciones', [PublicacionController::class, 'publicas'])
    ->name('publicaciones.index');

Route::get('/publicaciones/{slug}', [PublicacionController::class, 'showPublic'])
    ->name('publicaciones.show');

Route::get('/medios', [MedioController::class, 'publicos'])
    ->name('medios');

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard', [
                'totalPublicaciones' => \App\Models\Publicacion::count(),
                'totalEtiquetas'     => \App\Models\Etiqueta::count(),
                'totalCategorias'    => \App\Models\Categoria::count(),
                'totalMedios'        => \App\Models\Medio::count(),
                'recientes'          => \App\Models\Publicacion::with('categoria')
                                            ->latest()
                                            ->take(5)
                                            ->get(),
            ]);
        })->name('dashboard');

        Route::resource('publicaciones', PublicacionController::class);

        Route::get('/clasificacion', [ClasificacionController::class, 'index'])
            ->name('clasificacion.index');

        Route::resource('etiquetas', EtiquetaController::class)->except('index');
        Route::resource('categorias', CategoriaController::class)->except('index');

        Route::resource('referencias', ReferenciaController::class)->except(['show']);
        Route::post('/referencias/importar', [ReferenciaController::class, 'importarRis'])
            ->name('referencias.importar');

        Route::resource('medios', MedioController::class);
    });

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');