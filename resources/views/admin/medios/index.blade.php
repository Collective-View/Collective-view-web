@extends('admin.layout')
@section('title', 'Medios')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Inicio</a>
    <span>/</span> Medios
@endsection

@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <div>
        <h1 style="font-size:22px; font-weight:600; color:var(--gray-800); margin:0 0 4px;">Medios</h1>
        <p style="font-size:13px; color:var(--gray-400); margin:0;">
            {{ $medios->count() }} secciones registradas
        </p>
    </div>
    <a href="{{ route('admin.medios.create') }}" class="btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nueva sección
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Texto descriptivo</th>
                    <th style="text-align:center;">Imágenes</th>
                    <th style="text-align:center;">Enlaces</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medios as $medio)
                <tr>
                    <td>
                        @php
                            $badgeClass = match($medio->tipo) {
                                'premio'      => 'badge-gold',
                                'conferencia' => 'badge-blue',
                                'podcast'     => 'badge-purple',
                                'prensa'      => 'badge-green',
                                default       => 'badge-gray',
                            };
                            $icon = match($medio->tipo) {
                                'premio'      => 'fa-trophy',
                                'conferencia' => 'fa-chalkboard-user',
                                'podcast'     => 'fa-podcast',
                                'prensa'      => 'fa-newspaper',
                                default       => 'fa-photo-film',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}"
                              style="display:inline-flex; gap:5px; align-items:center;">
                            <i class="fa-solid {{ $icon }}" style="font-size:10px;"></i>
                            {{ $medio->tipoLabel() }}
                        </span>
                    </td>

                    <td style="max-width:340px; color:var(--gray-400); font-size:12px;">
                        {{ Str::limit($medio->texto, 90) }}
                    </td>

                    <td style="text-align:center;">
                        <span style="font-size:13px; font-weight:500; color:var(--gray-800);">
                            {{ $medio->imagenes_count }}
                        </span>
                        <span style="font-size:11px; color:var(--gray-400);"> img</span>
                    </td>

                    <td style="text-align:center;">
                        <span style="font-size:13px; font-weight:500; color:var(--gray-800);">
                            {{ $medio->enlaces_count }}
                        </span>
                        <span style="font-size:11px; color:var(--gray-400);"> enlaces</span>
                    </td>

                    <td>
                        <div style="display:flex; gap:6px; align-items:center;">
                            <a href="{{ route('admin.medios.edit', $medio) }}" class="btn-edit">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.medios.destroy', $medio) }}"
                                  onsubmit="return confirm('¿Eliminar esta sección y todo su contenido? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:48px; color:var(--gray-400);">
                        <div style="font-size:32px; margin-bottom:8px;">
                            <i class="fa-solid fa-photo-film"></i>
                        </div>
                        <div style="font-size:14px; margin-bottom:4px;">Sin secciones aún</div>
                        <a href="{{ route('admin.medios.create') }}" style="color:var(--ecosur); font-size:13px;">
                            Crear la primera sección →
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.badge-gold   { background:#fef3c7; color:#92400e; }
.badge-blue   { background:#dbeafe; color:#1e40af; }
.badge-purple { background:#ede9fe; color:#5b21b6; }
</style>

@endsection