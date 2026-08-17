@extends('admin.layout')
@section('title', 'Clasificación')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Inicio</a>
    <span>/</span> Clasificación
@endsection

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; color:var(--gray-800); margin:0 0 4px;">Clasificación</h1>
        <p style="font-size:13px; color:var(--gray-400); margin:0;">
            Etiquetas y categorías usadas para organizar las publicaciones
        </p>
    </div>
</div>

{{-- Pestañas --}}
<div style="display:flex; gap:8px; border-bottom:1px solid var(--gray-200, #e5e7eb); margin-bottom:20px;">
    <button type="button" class="tab-btn tab-btn--active" data-tab="etiquetas" onclick="switchTab('etiquetas')">
        Etiquetas
        <span class="badge badge-gray">{{ $etiquetas->total() }}</span>
    </button>
    <button type="button" class="tab-btn" data-tab="categorias" onclick="switchTab('categorias')">
        Categorías
        <span class="badge badge-gray">{{ $categorias->total() }}</span>
    </button>
</div>

<div id="tab-etiquetas" class="tab-panel">
    <div style="display:grid; grid-template-columns:380px 1fr; gap:20px; align-items:start;">
        <div class="card" id="form-card-etiqueta">
            <div class="card-header">
                <h2 id="form-title-etiqueta">Nueva etiqueta</h2>
            </div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.etiquetas.store') }}" id="form-create-etiqueta">
                    @csrf
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="nombre-create-etiqueta">Nombre <span style="color:var(--red)">*</span></label>
                        <input type="text" id="nombre-create-etiqueta" name="nombre"
                               value="{{ old('nombre') }}"
                               class="form-control @error('nombre') is-invalid @enderror"
                               placeholder="Ej. Biodiversidad, Cambio climático...">
                        @error('nombre')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Agregar etiqueta
                        </button>
                    </div>
                </form>

                <form method="POST" id="form-edit-etiqueta" style="display:none;">
                    @csrf
                    @method('PUT')
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="nombre-edit-etiqueta">Nombre <span style="color:var(--red)">*</span></label>
                        <input type="text" id="nombre-edit-etiqueta" name="nombre"
                               class="form-control"
                               placeholder="Nombre de la etiqueta">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Guardar cambios
                        </button>
                        <button type="button" class="btn-secondary" onclick="cancelEdit('etiqueta')">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Publicaciones</th>
                            <th>Creada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($etiquetas as $et)
                        <tr id="row-etiqueta-{{ $et->id }}">
                            <td class="td-title">
                                <span class="badge badge-gray">{{ $et->nombre }}</span>
                            </td>
                            <td style="color:var(--gray-400);">
                                {{ $et->publicaciones_count }}
                                {{ $et->publicaciones_count === 1 ? 'publicación' : 'publicaciones' }}
                            </td>
                            <td style="color:var(--gray-400); font-size:12px;">
                                {{ $et->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <div style="display:flex; gap:6px;">
                                    <button type="button" class="btn-edit"
                                        onclick="startEdit('etiqueta', {{ $et->id }}, '{{ addslashes($et->nombre) }}')">
                                        Editar
                                    </button>
                                    <form method="POST"
                                          action="{{ route('admin.etiquetas.destroy', $et) }}"
                                          onsubmit="return confirm('¿Eliminar la etiqueta «{{ $et->nombre }}»? Se desvinculará de todas las publicaciones.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding:48px; color:var(--gray-400);">
                                <div style="font-size:32px; margin-bottom:8px;">🏷️</div>
                                <div>Sin etiquetas aún. Crea la primera desde el formulario.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <x-pagination :paginator="$etiquetas" />
        </div>
    </div>
</div>

<div id="tab-categorias" class="tab-panel" style="display:none;">
    <div style="display:grid; grid-template-columns:380px 1fr; gap:20px; align-items:start;">
        <div class="card" id="form-card-categoria">
            <div class="card-header">
                <h2 id="form-title-categoria">Nueva categoría</h2>
            </div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.categorias.store') }}" id="form-create-categoria">
                    @csrf
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="nombre-create-categoria">Nombre <span style="color:var(--red)">*</span></label>
                        <input type="text" id="nombre-create-categoria" name="nombre"
                               value="{{ old('nombre') }}"
                               class="form-control @error('nombre') is-invalid @enderror"
                               placeholder="Ej. Artículo científico, Divulgación...">
                        @error('nombre')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Agregar categoría
                        </button>
                    </div>
                </form>

                <form method="POST" id="form-edit-categoria" style="display:none;">
                    @csrf
                    @method('PUT')
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="nombre-edit-categoria">Nombre <span style="color:var(--red)">*</span></label>
                        <input type="text" id="nombre-edit-categoria" name="nombre"
                               class="form-control"
                               placeholder="Nombre de la categoría">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Guardar cambios
                        </button>
                        <button type="button" class="btn-secondary" onclick="cancelEdit('categoria')">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Publicaciones</th>
                            <th>Creada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $cat)
                        <tr id="row-categoria-{{ $cat->id }}">
                            <td class="td-title">
                                <span class="badge badge-gray">{{ $cat->nombre }}</span>
                            </td>
                            <td style="color:var(--gray-400);">
                                {{ $cat->publicaciones_count }}
                                {{ $cat->publicaciones_count === 1 ? 'publicación' : 'publicaciones' }}
                            </td>
                            <td style="color:var(--gray-400); font-size:12px;">
                                {{ $cat->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <div style="display:flex; gap:6px;">
                                    <button type="button" class="btn-edit"
                                        onclick="startEdit('categoria', {{ $cat->id }}, '{{ addslashes($cat->nombre) }}')">
                                        Editar
                                    </button>
                                    <form method="POST"
                                          action="{{ route('admin.categorias.destroy', $cat) }}"
                                          onsubmit="return confirm('¿Eliminar la categoría «{{ $cat->nombre }}»? Las publicaciones asociadas quedarán sin categoría.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding:48px; color:var(--gray-400);">
                                <div style="font-size:32px; margin-bottom:8px;">📂</div>
                                <div>Sin categorías aún. Crea la primera desde el formulario.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <x-pagination :paginator="$categorias" />
        </div>
    </div>
</div>

<style>
    .tab-btn {
        background: none;
        border: none;
        padding: 10px 18px;
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-400);
        cursor: pointer;
        border-bottom: 2px solid transparent;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .tab-btn:hover { color: var(--gray-800); }
    .tab-btn--active {
        color: var(--ecosur-teal, #14bf98);
        border-bottom-color: var(--ecosur-teal, #14bf98);
    }
</style>

<script>
const baseUrlEtiquetas  = "{{ url('admin/etiquetas') }}";
const baseUrlCategorias = "{{ url('admin/categorias') }}";

function switchTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.style.display = 'none');
    document.getElementById('tab-' + tab).style.display = 'block';

    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('tab-btn--active'));
    document.querySelector('.tab-btn[data-tab="' + tab + '"]').classList.add('tab-btn--active');
}

function startEdit(tipo, id, nombre) {
    const baseUrl = tipo === 'etiqueta' ? baseUrlEtiquetas : baseUrlCategorias;

    document.getElementById('form-create-' + tipo).style.display = 'none';
    document.getElementById('form-edit-' + tipo).style.display   = 'block';
    document.getElementById('form-title-' + tipo).textContent    = tipo === 'etiqueta' ? 'Editar etiqueta' : 'Editar categoría';
    document.getElementById('nombre-edit-' + tipo).value         = nombre;
    document.getElementById('form-edit-' + tipo).action          = baseUrl + '/' + id;

    document.querySelectorAll('tr').forEach(r => r.style.background = '');
    const row = document.getElementById('row-' + tipo + '-' + id);
    if (row) row.style.background = 'var(--ecosur-light)';

    document.getElementById('form-card-' + tipo).scrollIntoView({ behavior: 'smooth', block: 'start' });
    document.getElementById('nombre-edit-' + tipo).focus();
}

function cancelEdit(tipo) {
    document.getElementById('form-edit-' + tipo).style.display   = 'none';
    document.getElementById('form-create-' + tipo).style.display = 'block';
    document.getElementById('form-title-' + tipo).textContent    = tipo === 'etiqueta' ? 'Nueva etiqueta' : 'Nueva categoría';
    document.querySelectorAll('tr').forEach(r => r.style.background = '');
}
</script>

@endsection