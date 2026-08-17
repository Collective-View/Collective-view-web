@extends('layouts.web')

@section('title', 'Medios - Collective View')

@section('content')

<section class="page-section videos-page">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <div class="section-title">MEDIOS</div>
                <h2>Distinciones, conferencias, podcasts y prensa</h2>
                <p class="p-heading">
                    Conoce el impacto y la difusión del proyecto Collective View
                    en medios académicos, científicos y de comunicación.
                </p>
            </div>
        </div>

        <div class="pub-tabs-wrap" data-aos="fade-up" data-aos-delay="100">
            <div class="pub-tabs-scroll">

                <button class="pub-tab pub-tab--active" data-tipo="">
                    <span class="pub-tab__icon"><i class="fas fa-layer-group"></i></span>
                    <span class="pub-tab__label">Todos</span>
                    <span class="pub-tab__count" id="count-all">0</span>
                </button>

                <button class="pub-tab" data-tipo="distincion">
                    <span class="pub-tab__icon"><i class="fas fa-trophy"></i></span>
                    <span class="pub-tab__label">Distinciones</span>
                    <span class="pub-tab__count" id="count-distincion">0</span>
                </button>

                <button class="pub-tab" data-tipo="conferencia">
                    <span class="pub-tab__icon"><i class="fas fa-chalkboard-teacher"></i></span>
                    <span class="pub-tab__label">Conferencias</span>
                    <span class="pub-tab__count" id="count-conferencia">0</span>
                </button>

                <button class="pub-tab" data-tipo="podcast">
                    <span class="pub-tab__icon"><i class="fas fa-podcast"></i></span>
                    <span class="pub-tab__label">Podcasts</span>
                    <span class="pub-tab__count" id="count-podcast">0</span>
                </button>

                <button class="pub-tab" data-tipo="prensa">
                    <span class="pub-tab__icon"><i class="fas fa-newspaper"></i></span>
                    <span class="pub-tab__label">Prensa</span>
                    <span class="pub-tab__count" id="count-prensa">0</span>
                </button>

            </div>
        </div>

        <div id="medios-container" style="margin-top:40px;"></div>

        <div id="medios-empty" style="display:none; text-align:center; padding:70px 0;">
            <div class="pub-empty__icon">
                <i class="fas fa-photo-video"></i>
            </div>
            <h4 class="pub-empty__title">Sin resultados</h4>
            <p class="pub-empty__text">Intenta con otra categoría.</p>
            <button id="medios-empty-reset" class="btn-solid-reg pub-empty__btn">
                Ver todos
            </button>
        </div>

    </div>
</section>

<script>
    window.__MEDIOS__ = {!! $mediosJson !!};
</script>

<script>
(function () {
    const todos = window.__MEDIOS__ || [];

    let tipoActivo = '';
    let filtrados  = [...todos];

    const container  = document.getElementById('medios-container');
    const emptyState = document.getElementById('medios-empty');
    const emptyReset = document.getElementById('medios-empty-reset');
    const tabs       = document.querySelectorAll('.pub-tab');

    const LABELS = {
        distincion:  'Distinción',
        conferencia: 'Conferencia',
        podcast:     'Podcast',
        prensa:      'Prensa',
    };

    const ICONS = {
        distincion:  'fas fa-trophy',
        conferencia: 'fas fa-chalkboard-teacher',
        podcast:     'fas fa-podcast',
        prensa:      'fas fa-newspaper',
    };

    function aplicarFiltros() {
        filtrados = tipoActivo === ''
            ? [...todos]
            : todos.filter(m => m.tipo === tipoActivo);

        actualizarContadores();
        renderizar();
    }

    function actualizarContadores() {
        const elAll = document.getElementById('count-all');
        if (elAll) elAll.textContent = todos.length;

        ['distincion', 'conferencia', 'podcast', 'prensa'].forEach(tipo => {
            const el = document.getElementById('count-' + tipo);
            if (el) el.textContent = todos.filter(m => m.tipo === tipo).length;
        });
    }

    function renderizar() {
        container.innerHTML = '';

        if (filtrados.length === 0) {
            emptyState.style.display = 'block';
            return;
        }
        emptyState.style.display = 'none';

        filtrados.forEach(medio => {
            const section = document.createElement('div');
            section.className = 'medio-section';
            section.setAttribute('data-aos', 'fade-up');

            let imagenesHTML = '';
            if (Array.isArray(medio.imagenes) && medio.imagenes.length > 0) {
                const imgs = medio.imagenes.map(src =>
                    `<div class="medio-img-item">
                         <img src="${esc(src)}" alt="${esc(LABELS[medio.tipo] || medio.tipo)}" loading="lazy">
                     </div>`
                ).join('');
                imagenesHTML = `<div class="medio-img-grid">${imgs}</div>`;
            }

            let tablaHTML = '';
            if (Array.isArray(medio.enlaces) && medio.enlaces.length > 0) {
                const filas = medio.enlaces.map(e => {
                    const nombreFila = `<tr><td><strong>${esc(e.nombre)}</strong></td></tr>`;
                    const urlFila = e.url
                        ? `<tr><td><a href="${esc(e.url)}" target="_blank" rel="noopener noreferrer">${esc(e.url)}</a></td></tr>`
                        : '';
                    return nombreFila + urlFila;
                }).join('');

                tablaHTML = `
                    <div class="medio-table-wrap">
                        <table class="medio-table">
                            <tbody>${filas}</tbody>
                        </table>
                    </div>`;
            }

            section.innerHTML = `
                <div class="medio-header">
                    <div class="medio-header__icon">
                        <i class="${ICONS[medio.tipo] || 'fas fa-photo-video'}"></i>
                    </div>
                    <div>
                        <span class="medio-header__tipo">${esc(LABELS[medio.tipo] || medio.tipo)}</span>
                        <p class="medio-header__texto">${esc(medio.texto)}</p>
                    </div>
                </div>
                ${imagenesHTML}
                ${tablaHTML}`;

            container.appendChild(section);
        });

        if (window.AOS) AOS.refresh();
    }

    function esc(str) {
        if (str == null) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('pub-tab--active'));
            this.classList.add('pub-tab--active');
            tipoActivo = this.dataset.tipo;
            aplicarFiltros();
        });
    });

    emptyReset.addEventListener('click', function () {
        tipoActivo = '';
        tabs.forEach(t => t.classList.remove('pub-tab--active'));
        tabs[0].classList.add('pub-tab--active');
        aplicarFiltros();
    });

    aplicarFiltros();
})();
</script>



@endsection