@extends('admin.layout')
@section('title', 'Referencias')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Inicio</a>
    <span>/</span> Referencias
@endsection

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; color:var(--gray-800); margin:0 0 4px;">Referencias</h1>
        <p style="font-size:13px; color:var(--gray-400); margin:0;">
            {{ $referencias->total() }} referencias registradas
        </p>
    </div>
</div>

<div style="display:grid; grid-template-columns:380px 1fr; gap:20px; align-items:start;">

    <div>
        {{-- Importar RIS --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header">
                <h2>Importar desde RIS</h2>
            </div>
            <div class="card-body">
                <p style="font-size:12px; color:var(--gray-400); margin:0 0 14px;">
                    Sube el archivo .ris exportado de Zotero. Las referencias con el
                    mismo título que ya exista se omiten automáticamente.
                </p>
                <form method="POST" action="{{ route('admin.referencias.importar') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-bottom:14px;">
                        <input type="file" name="archivo_ris" accept=".ris" required class="form-control">
                        @error('archivo_ris')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
                            Importar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Formulario manual (crear / editar) --}}
        <div class="card" id="form-card">
            <div class="card-header">
                <h2 id="form-title">Nueva referencia</h2>
            </div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.referencias.store') }}" id="form-create">
                    @csrf
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="titulo-create">Título <span style="color:var(--red)">*</span></label>
                        <input type="text" id="titulo-create" name="titulo" value="{{ old('titulo') }}" class="form-control @error('titulo') is-invalid @enderror" required>
                        @error('titulo')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="autores-create">Autores</label>
                        <input type="text" id="autores-create" name="autores" value="{{ old('autores') }}" class="form-control" placeholder="Apellido, Nombre; Apellido2, Nombre2">
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                        <div class="form-group" style="margin-bottom:14px;">
                            <label for="anio-create">Año</label>
                            <input type="number" id="anio-create" name="anio" value="{{ old('anio') }}" class="form-control">
                        </div>
                        <div class="form-group" style="margin-bottom:14px;">
                            <label for="revista-create">Revista</label>
                            <input type="text" id="revista-create" name="revista" value="{{ old('revista') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="resumen-create">Abstract</label>
                        <textarea id="resumen-create" name="resumen" class="form-control" rows="4">{{ old('resumen') }}</textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="url-create">Link</label>
                        <input type="url" id="url-create" name="url" value="{{ old('url') }}" class="form-control" placeholder="https://...">
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="doi-create">DOI</label>
                        <input type="text" id="doi-create" name="doi" value="{{ old('doi') }}" class="form-control">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Agregar referencia
                        </button>
                    </div>
                </form>

                <form method="POST" id="form-edit" style="display:none;">
                    @csrf
                    @method('PUT')
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="titulo-edit">Título <span style="color:var(--red)">*</span></label>
                        <input type="text" id="titulo-edit" name="titulo" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="autores-edit">Autores</label>
                        <input type="text" id="autores-edit" name="autores" class="form-control">
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                        <div class="form-group" style="margin-bottom:14px;">
                            <label for="anio-edit">Año</label>
                            <input type="number" id="anio-edit" name="anio" class="form-control">
                        </div>
                        <div class="form-group" style="margin-bottom:14px;">
                            <label for="revista-edit">Revista</label>
                            <input type="text" id="revista-edit" name="revista" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="resumen-edit">Abstract</label>
                        <textarea id="resumen-edit" name="resumen" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="url-edit">Link</label>
                        <input type="url" id="url-edit" name="url" class="form-control">
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <label for="doi-edit">DOI</label>
                        <input type="text" id="doi-edit" name="doi" class="form-control">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Guardar cambios</button>
                        <button type="button" class="btn-secondary" onclick="cancelEdit()">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="padding-bottom:0;">
            <form method="GET" action="{{ route('admin.referencias.index') }}" style="margin-bottom:16px;">
                <input type="text" name="q" value="{{ $busqueda }}" class="form-control" placeholder="Buscar por título o autor...">
            </form>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autores</th>
                        <th>Año</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referencias as $ref)
                    <tr id="row-{{ $ref->id }}">
                        <td class="td-title" style="max-width:320px;">{{ $ref->titulo }}</td>
                        <td style="color:var(--gray-400); font-size:12px; max-width:220px;">{{ \Illuminate\Support\Str::limit($ref->autores, 60) }}</td>
                        <td style="color:var(--gray-400);">{{ $ref->anio }}</td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <button type="button" class="btn-edit"
                                    onclick='startEdit(@json($ref))'>
                                    Editar
                                </button>
                                <form method="POST" action="{{ route('admin.referencias.destroy', $ref) }}"
                                      onsubmit="return confirm('¿Eliminar esta referencia?')">
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
                            <div style="font-size:32px; margin-bottom:8px;">📚</div>
                            <div>Sin referencias aún. Impórtalas desde un RIS o agrega la primera a mano.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-pagination :paginator="$referencias" />
    </div>

</div>

<script>
const baseUrl = "{{ url('admin/referencias') }}";

function startEdit(ref) {
    document.getElementById('form-create').style.display = 'none';
    document.getElementById('form-edit').style.display   = 'block';
    document.getElementById('form-title').textContent    = 'Editar referencia';

    document.getElementById('titulo-edit').value  = ref.titulo || '';
    document.getElementById('autores-edit').value = ref.autores || '';
    document.getElementById('anio-edit').value    = ref.anio || '';
    document.getElementById('revista-edit').value = ref.revista || '';
    document.getElementById('resumen-edit').value = ref.resumen || '';
    document.getElementById('url-edit').value     = ref.url || '';
    document.getElementById('doi-edit').value     = ref.doi || '';

    document.getElementById('form-edit').action = baseUrl + '/' + ref.id;

    document.querySelectorAll('tr').forEach(r => r.style.background = '');
    const row = document.getElementById('row-' + ref.id);
    if (row) row.style.background = 'var(--ecosur-light)';

    document.getElementById('form-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function cancelEdit() {
    document.getElementById('form-edit').style.display   = 'none';
    document.getElementById('form-create').style.display = 'block';
    document.getElementById('form-title').textContent    = 'Nueva referencia';
    document.querySelectorAll('tr').forEach(r => r.style.background = '');
}
</script>

@endsection