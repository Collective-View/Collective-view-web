@extends('admin.layout')
@section('title', 'Dashboard')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Inicio</a>
    <span>/</span> Dashboard
@endsection

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; color:var(--gray-800); margin:0 0 4px;">
            Bienvenido, {{ Auth::user()->name }}
        </h1>
        <p style="font-size:13px; color:var(--gray-400); margin:0;">
            {{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
        </p>
    </div>
    <a href="{{ route('admin.publicaciones.create') }}" class="btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Nueva publicación
    </a>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-file-lines"></i>
        </div>

        <div>
            <div class="stat-label">Total publicaciones</div>
            <div class="stat-value">{{ $totalPublicaciones }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon amber">
            <i class="fa-solid fa-tags"></i>
        </div>

        <div>
            <div class="stat-label">Etiquetas</div>
            <div class="stat-value">{{ $totalEtiquetas }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-folder"></i>
        </div>

        <div>
            <div class="stat-label">Categorías</div>
            <div class="stat-value">{{ $totalCategorias }}</div>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h2>Publicaciones recientes</h2>
        <a href="{{ route('admin.publicaciones.index') }}" style="font-size:13px; color:var(--ecosur); text-decoration:none;">
            Ver todas →
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recientes as $pub)
                <tr>
                    <td class="td-title">{{ $pub->titulo }}</td>
                    <td>
                        <span class="badge badge-green">{{ $pub->categoria->nombre }}</span>
                    </td>
                    <td style="color:var(--gray-400)">{{ $pub->fecha_publicacion->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.publicaciones.edit', $pub) }}" class="btn-edit">Editar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:32px; color:var(--gray-400);">
                        Sin publicaciones aún.
                        <a href="{{ route('admin.publicaciones.create') }}" style="color:var(--ecosur);">Crear una</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection