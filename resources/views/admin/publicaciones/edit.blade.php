@extends('admin.layout')
@section('title', 'Editar Publicación')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Inicio</a>
    <span>/</span>
    <a href="{{ route('admin.publicaciones.index') }}">Publicaciones</a>
    <span>/</span> Editar
@endsection

@section('content')

<div style="margin-bottom:24px;">
    <h1 style="font-size:22px; font-weight:600; color:var(--gray-800); margin:0 0 4px;">Editar publicación</h1>
    <p style="font-size:13px; color:var(--gray-400); margin:0;">Modificando: <strong>{{ Str::limit($publicacion->titulo, 70) }}</strong></p>
</div>

<form method="POST" action="{{ route('admin.publicaciones.update', $publicacion) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- INFO GENERAL --}}
    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><h2>Información general</h2></div>
        <div class="card-body">
            <div class="form-grid">

                <div class="form-group full">
                    <label>Título <span style="color:var(--red)">*</span></label>
                    <input type="text" name="titulo"
                           value="{{ old('titulo', $publicacion->titulo) }}"
                           class="form-control @error('titulo') is-invalid @enderror"
                           placeholder="Título completo de la publicación">
                    @error('titulo')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group full">
                    <label>Abstract <span style="color:var(--red)">*</span></label>
                    <textarea name="abstract"
                              class="form-control @error('abstract') is-invalid @enderror"
                              placeholder="Resumen de la publicación...">{{ old('abstract', $publicacion->abstract) }}</textarea>
                    @error('abstract')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="fecha_publicacion">Fecha de publicación <span style="color:var(--red)">*</span></label>

                    <input type="date"
                        id="fecha_publicacion"
                        name="fecha_publicacion"
                        value="{{ old('fecha_publicacion', optional($publicacion->fecha_publicacion)->format('Y-m-d')) }}"
                        class="form-control @error('fecha_publicacion') is-invalid @enderror">
                    @error('fecha_publicacion')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label>URL de la publicación</label>
                    <input type="url" name="url"
                           value="{{ old('url', $publicacion->url) }}"
                           class="form-control @error('url') is-invalid @enderror"
                           placeholder="https://ejemplo.com/publicacion">
                    @error('url')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label>Categoría <span style="color:var(--red)">*</span></label>
                    <select name="categoria_id"
                            class="form-control @error('categoria_id') is-invalid @enderror">
                        <option value="">— Seleccionar categoría —</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('categoria_id', $publicacion->categoria_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><h2>Imagen de portada</h2></div>
        <div class="card-body">
            @if($publicacion->imagen)
                <div style="margin-bottom:14px; display:flex; align-items:center; gap:14px;">
                    <img src="{{ Storage::url($publicacion->imagen) }}" alt="Imagen actual"
                         style="height:80px; border-radius:8px; object-fit:cover; border:1px solid var(--gray-200);">
                    <div>
                        <div style="font-size:12px; color:var(--gray-500); margin-bottom:4px;">Imagen actual</div>
                        <div style="font-size:11px; color:var(--gray-400);">Sube una nueva imagen para reemplazarla.</div>
                    </div>
                </div>
            @endif
            <div class="file-input-wrap" onclick="document.getElementById('imagen').click()">
                <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImage(event)">
                <div id="preview-wrap">
                    <div style="font-size:28px;margin-bottom:6px;">🖼️</div>
                    <div class="file-input-label"><span>Haz clic para seleccionar</span> una nueva imagen</div>
                    <div style="font-size:11px;color:var(--gray-400);margin-top:4px;">PNG, JPG, WEBP — máx. 2MB</div>
                </div>
                <img id="imagen-preview" src="" alt="Preview"
                     style="display:none;max-height:160px;border-radius:8px;margin-top:10px;">
            </div>
            @error('imagen')<span class="form-error" style="display:block;margin-top:6px;">{{ $message }}</span>@enderror
        </div>
    </div>

    @php $etiquetasActivas = $publicacion->etiquetas->pluck('id')->toArray(); @endphp
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header">
            <h2>Etiquetas</h2>
            <button type="button" class="btn-secondary" onclick="abrirModal()" style="font-size:12px;padding:6px 14px;">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nueva etiqueta
            </button>
        </div>
        <div class="card-body">
            <div class="tags-grid" id="tags-grid">
                @forelse($etiquetas as $et)
                    <label class="tag-label" id="tag-label-{{ $et->id }}">
                        <input type="checkbox" name="etiquetas[]" value="{{ $et->id }}"
                            {{ in_array($et->id, old('etiquetas', $etiquetasActivas)) ? 'checked' : '' }}>
                        {{ $et->nombre }}
                    </label>
                @empty
                    <p style="font-size:13px;color:var(--gray-400);" id="empty-tags">
                        Sin etiquetas. Crea una con el botón de arriba.
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Guardar cambios
        </button>
        <a href="{{ route('admin.publicaciones.index') }}" class="btn-secondary">Cancelar</a>
    </div>

</form>

<div id="modal-overlay" onclick="cerrarModal()"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:900; backdrop-filter:blur(2px);">
</div>

<div id="modal-etiqueta"
     style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%) scale(.95);
            background:white; border-radius:14px; width:100%; max-width:420px; z-index:901;
            box-shadow:0 20px 60px rgba(0,0,0,.2); transition:transform .15s, opacity .15s; opacity:0;">
    <div style="background:var(--ecosur); padding:18px 22px; border-radius:14px 14px 0 0; display:flex; justify-content:space-between; align-items:center;">
        <div>
            <div style="color:white; font-size:15px; font-weight:600;">Nueva etiqueta</div>
            <div style="color:rgba(255,255,255,.65); font-size:12px;">Se agregará automáticamente al formulario</div>
        </div>
        <button onclick="cerrarModal()" style="background:rgba(255,255,255,.15); border:none; color:white; width:28px; height:28px; border-radius:50%; cursor:pointer; font-size:16px; display:flex; align-items:center; justify-content:center;">×</button>
    </div>
    <div style="padding:22px;">
        <div class="form-group" style="margin-bottom:18px;">
            <label>Nombre de la etiqueta <span style="color:var(--red)">*</span></label>
            <input type="text" id="modal-nombre" class="form-control"
                   placeholder="Ej. Biodiversidad, Sustentabilidad..."
                   onkeydown="if(event.key==='Enter'){event.preventDefault();guardarEtiqueta();}">
            <span class="form-error" id="modal-error" style="display:none;"></span>
        </div>
        <div style="display:flex; gap:10px;">
            <button type="button" class="btn-primary" onclick="guardarEtiqueta()" id="modal-btn">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Crear etiqueta
            </button>
            <button type="button" class="btn-secondary" onclick="cerrarModal()">Cancelar</button>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('imagen-preview');
        preview.src = e.target.result;
        preview.style.display = 'block';
        document.getElementById('preview-wrap').style.display = 'none';
    };
    reader.readAsDataURL(file);
}

function abrirModal() {
    document.getElementById('modal-overlay').style.display = 'block';
    const modal = document.getElementById('modal-etiqueta');
    modal.style.display = 'block';
    setTimeout(() => {
        modal.style.transform = 'translate(-50%,-50%) scale(1)';
        modal.style.opacity   = '1';
    }, 10);
    setTimeout(() => document.getElementById('modal-nombre').focus(), 120);
    document.getElementById('modal-error').style.display = 'none';
    document.getElementById('modal-nombre').value = '';
}

function cerrarModal() {
    const modal = document.getElementById('modal-etiqueta');
    modal.style.transform = 'translate(-50%,-50%) scale(.95)';
    modal.style.opacity   = '0';
    setTimeout(() => {
        modal.style.display = 'none';
        document.getElementById('modal-overlay').style.display = 'none';
    }, 150);
}

async function guardarEtiqueta() {
    const nombre  = document.getElementById('modal-nombre').value.trim();
    const errorEl = document.getElementById('modal-error');
    const btn     = document.getElementById('modal-btn');

    if (!nombre) {
        errorEl.textContent = 'El nombre es obligatorio.';
        errorEl.style.display = 'block';
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Guardando...';
    errorEl.style.display = 'none';

    try {
        const res = await fetch("{{ route('admin.etiquetas.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ nombre })
        });

        const data = await res.json();

        if (!res.ok) {
            errorEl.textContent = data.errors?.nombre?.[0] ?? 'Error al crear la etiqueta.';
            errorEl.style.display = 'block';
            return;
        }

        const empty = document.getElementById('empty-tags');
        if (empty) empty.remove();

        const label = document.createElement('label');
        label.className = 'tag-label';
        label.id        = 'tag-label-' + data.id;
        label.innerHTML = `<input type="checkbox" name="etiquetas[]" value="${data.id}" checked> ${data.nombre}`;
        document.getElementById('tags-grid').appendChild(label);

        cerrarModal();

    } catch(e) {
        errorEl.textContent = 'Error de conexión. Intenta de nuevo.';
        errorEl.style.display = 'block';
    } finally {
        btn.disabled = false;
        btn.innerHTML = `<svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Crear etiqueta`;
    }
}
</script>

@endsection