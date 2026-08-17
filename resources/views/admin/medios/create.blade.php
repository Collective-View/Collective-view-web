@extends('admin.layout')
@section('title', 'Nueva sección de medios')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Inicio</a>
    <span>/</span>
    <a href="{{ route('admin.medios.index') }}">Medios</a>
    <span>/</span> Nueva
@endsection

@section('content')

<div style="margin-bottom:24px;">
    <h1 style="font-size:22px; font-weight:600; color:var(--gray-800); margin:0 0 4px;">Nueva sección de medios</h1>
    <p style="font-size:13px; color:var(--gray-400); margin:0;">
        Cada sección corresponde a un tipo: Distinciones, Conferencias, Podcasts o Prensa.
    </p>
</div>

<form method="POST"
      action="{{ route('admin.medios.store') }}"
      enctype="multipart/form-data">
    @csrf

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header">
            <h2>Información general</h2>
        </div>
        <div class="card-body">
            <div class="form-grid">

                <div class="form-group">
                    <label>Tipo <span style="color:var(--red)">*</span></label>
                    <select name="tipo"
                            class="form-control @error('tipo') is-invalid @enderror"
                            required>
                        <option value="">— Selecciona un tipo —</option>
                        @foreach($tipos as $key => $label)
                            <option value="{{ $key }}" {{ old('tipo') === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group full">
                    <label>Texto descriptivo <span style="color:var(--red)">*</span></label>
                    <textarea name="texto"
                              class="form-control @error('texto') is-invalid @enderror"
                              placeholder="Párrafo introductorio que aparecerá en la sección…">{{ old('texto') }}</textarea>
                    @error('texto')<span class="form-error">{{ $message }}</span>@enderror
                </div>

            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header">
            <h2>Imágenes</h2>
        </div>
        <div class="card-body">
            <div class="file-input-wrap" onclick="document.getElementById('imagenes-input').click()">
                <input type="file"
                       id="imagenes-input"
                       name="imagenes[]"
                       accept="image/*"
                       multiple
                       onchange="previewImagenes(event)">
                <div id="preview-placeholder">
                    <div style="font-size:32px; margin-bottom:8px;">🖼️</div>
                    <div class="file-input-label">
                        <span>Haz clic para seleccionar</span> una o varias imágenes
                    </div>
                    <div style="font-size:11px; color:var(--gray-400); margin-top:4px;">
                        PNG, JPG, WEBP — máx. 3 MB c/u
                    </div>
                </div>
                <div id="imagenes-preview" style="display:none; flex-wrap:wrap; gap:8px; margin-top:10px;"></div>
            </div>
            @error('imagenes.*')<span class="form-error" style="display:block; margin-top:6px;">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="card" style="margin-bottom:24px;">
        <div class="card-header">
            <h2>Tabla de enlaces</h2>
            <button type="button" id="btn-add-enlace" class="btn-secondary"
                    style="font-size:12px; padding:6px 14px;">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Añadir fila
            </button>
        </div>
        <div class="card-body">
            <p style="font-size:12px; color:var(--gray-400); margin:0 0 14px;">
                Cada fila es un nombre en negrita con su URL. Se mostrarán en la tabla de la sección.
            </p>

            <div style="display:grid; grid-template-columns:1fr 1fr 36px; gap:8px;
                        margin-bottom:6px; padding:0 2px;">
                <span style="font-size:11px; font-weight:600; color:var(--gray-500); text-transform:uppercase; letter-spacing:.04em;">
                    Nombre / Titular
                </span>
                <span style="font-size:11px; font-weight:600; color:var(--gray-500); text-transform:uppercase; letter-spacing:.04em;">
                    URL (opcional)
                </span>
                <span></span>
            </div>

            <div id="enlaces-container">
                @if(old('enlaces'))
                    @foreach(old('enlaces') as $i => $enlace)
                        <div class="enlace-row"
                             style="display:grid; grid-template-columns:1fr 1fr 36px;
                                    gap:8px; margin-bottom:8px; align-items:center;">
                            <input type="text"
                                   name="enlaces[{{ $i }}][nombre]"
                                   value="{{ $enlace['nombre'] ?? '' }}"
                                   placeholder="Ej. Best Paper Award 2023"
                                   class="form-control" style="margin-bottom:0;">
                            <input type="url"
                                   name="enlaces[{{ $i }}][url]"
                                   value="{{ $enlace['url'] ?? '' }}"
                                   placeholder="https://..."
                                   class="form-control" style="margin-bottom:0;">
                            <button type="button" class="btn-danger btn-remove"
                                    style="padding:8px; display:flex; align-items:center; justify-content:center;">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="enlace-row"
                         style="display:grid; grid-template-columns:1fr 1fr 36px;
                                gap:8px; margin-bottom:8px; align-items:center;">
                        <input type="text"  name="enlaces[0][nombre]"
                               placeholder="Ej. Best Paper Award 2023"
                               class="form-control" style="margin-bottom:0;">
                        <input type="url"   name="enlaces[0][url]"
                               placeholder="https://..."
                               class="form-control" style="margin-bottom:0;">
                        <button type="button" class="btn-danger btn-remove"
                                style="padding:8px; display:flex; align-items:center; justify-content:center;">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            @error('enlaces.*.nombre')
                <span class="form-error" style="display:block; margin-top:4px;">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Guardar sección
        </button>
        <a href="{{ route('admin.medios.index') }}" class="btn-secondary">Cancelar</a>
    </div>

</form>

<script>
function previewImagenes(event) {
    const files   = Array.from(event.target.files);
    const wrap    = document.getElementById('imagenes-preview');
    const holder  = document.getElementById('preview-placeholder');

    wrap.innerHTML = '';

    if (!files.length) {
        wrap.style.display  = 'none';
        holder.style.display = 'block';
        return;
    }

    holder.style.display = 'none';
    wrap.style.display   = 'flex';

    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src   = e.target.result;
            img.style.cssText = 'height:80px; border-radius:6px; object-fit:cover; border:1px solid var(--gray-200);';
            wrap.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

(function () {
    let idx = {{ old('enlaces') ? count(old('enlaces')) : 1 }};

    function makeRow(i) {
        const div = document.createElement('div');
        div.className  = 'enlace-row';
        div.style.cssText = 'display:grid; grid-template-columns:1fr 1fr 36px; gap:8px; margin-bottom:8px; align-items:center;';
        div.innerHTML = `
            <input type="text" name="enlaces[${i}][nombre]"
                   placeholder="Ej. Best Paper Award 2023"
                   class="form-control" style="margin-bottom:0;">
            <input type="url" name="enlaces[${i}][url]"
                   placeholder="https://..."
                   class="form-control" style="margin-bottom:0;">
            <button type="button" class="btn-danger btn-remove"
                    style="padding:8px; display:flex; align-items:center; justify-content:center;">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>`;
        return div;
    }

    function attachRemove(row) {
        row.querySelector('.btn-remove').addEventListener('click', () => row.remove());
    }

    document.getElementById('btn-add-enlace').addEventListener('click', function () {
        const row = makeRow(idx++);
        document.getElementById('enlaces-container').appendChild(row);
        attachRemove(row);
    });

    document.querySelectorAll('.enlace-row').forEach(attachRemove);
})();
</script>

@endsection