@extends('admin.layout')
@section('title', 'Publicaciones')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Inicio</a>
    <span>/</span> Publicaciones
@endsection

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; color:var(--gray-800); margin:0 0 4px;">Publicaciones</h1>
        <p style="font-size:13px; color:var(--gray-400); margin:0;">
            {{ $publicaciones->total() }} publicaciones registradas
        </p>
    </div>
    <a href="{{ route('admin.publicaciones.create') }}" class="btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Nueva publicación
    </a>
</div>

<form method="GET" action="{{ route('admin.publicaciones.index') }}" style="margin-bottom:16px;">
    <div style="display:flex; gap:8px; align-items:center;">
        <div style="position:relative; flex:1; max-width:360px;">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                 style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--gray-400); pointer-events:none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <input type="text"
                name="buscar"
                value="{{ request('buscar') }}"
                placeholder="Buscar por título..."
                style="width:100%; padding:8px 12px 8px 32px; font-size:13px;
                       border:1px solid var(--gray-200); border-radius:6px;
                       color:var(--gray-800); background:#fff; outline:none;
                       transition:border-color .15s;"
                onfocus="this.style.borderColor='var(--ecosur)'"
                onblur="this.style.borderColor='var(--gray-200)'"
            >
        </div>
        <button type="submit" class="btn-primary" style="padding:8px 16px;">Buscar</button>
        @if(request('buscar'))
            <a href="{{ route('admin.publicaciones.index') }}"
               style="font-size:13px; color:var(--gray-400); text-decoration:none; white-space:nowrap;">
                ✕ Limpiar
            </a>
        @endif
    </div>
</form>

@if(request('buscar'))
    <p style="font-size:12px; color:var(--gray-400); margin-bottom:12px;">
        Resultados para: <strong style="color:var(--gray-800);">{{ request('buscar') }}</strong>
        — {{ $publicaciones->total() }} encontradas
    </p>
@endif

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:52px;"></th>
                    <th>Título</th>
                    <th>Abstract</th>
                    <th>Categoría</th>
                    <th>Etiquetas</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($publicaciones as $pub)
                <tr>
                    <td>
                        @if($pub->imagen)
                            <img src="{{ Storage::url($pub->imagen) }}" alt="{{ $pub->titulo }}" class="thumb">
                        @else
                            <div class="thumb-placeholder">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                        @endif
                    </td>
                    <td class="td-title" style="max-width:200px;">
                        {{ Str::limit($pub->titulo, 55) }}
                        @if($pub->url)
                            <a href="{{ $pub->url }}" target="_blank"
                               style="display:inline-block;margin-left:4px;color:var(--ecosur);font-size:11px;">↗</a>
                        @endif
                    </td>
                    <td style="max-width:220px; color:var(--gray-400); font-size:12px;">
                        {{ Str::limit($pub->abstract, 70) }}
                    </td>
                    <td>
                        <span class="badge badge-green">{{ $pub->categoria->nombre }}</span>
                    </td>
                    <td style="max-width:160px;">
                        @foreach($pub->etiquetas->take(3) as $et)
                            <span class="badge badge-gray">{{ $et->nombre }}</span>
                        @endforeach
                        @if($pub->etiquetas->count() > 3)
                            <span class="badge badge-gray">+{{ $pub->etiquetas->count() - 3 }}</span>
                        @endif
                    </td>
                    <td style="color:var(--gray-400); font-size:12px; white-space:nowrap;">
                        {{ $pub->fecha_publicacion->format('d/m/Y') }}
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; align-items:center;">
                            <a href="{{ route('admin.publicaciones.edit', $pub) }}" class="btn-edit">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.publicaciones.destroy', $pub) }}"
                                  onsubmit="return confirm('¿Eliminar esta publicación? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:48px; color:var(--gray-400);">
                        <div style="font-size:32px; margin-bottom:8px;"><i class="fa-solid fa-file-lines"></i></div>
                        @if(request('buscar'))
                            <div style="font-size:14px; margin-bottom:4px;">
                                No se encontraron publicaciones con ese título
                            </div>
                            <a href="{{ route('admin.publicaciones.index') }}" style="color:var(--ecosur); font-size:13px;">
                                Ver todas las publicaciones →
                            </a>
                        @else
                            <div style="font-size:14px; margin-bottom:4px;">Sin publicaciones aún</div>
                            <a href="{{ route('admin.publicaciones.create') }}" style="color:var(--ecosur); font-size:13px;">
                                Crear la primera publicación →
                            </a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-pagination :paginator="$publicaciones" />
</div>

@endsection