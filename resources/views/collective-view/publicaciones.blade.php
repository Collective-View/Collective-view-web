@extends('layouts.web')

@section('title', 'Publicaciones - Collective View')

@section('content')

<section class="page-section videos-page">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <div class="section-title">PUBLICACIONES</div>
                <h2>Artículos y publicaciones académicas</h2>
                <p class="p-heading">
                    Consulta investigaciones, artículos científicos y documentos
                    relacionados con el proyecto Collective View y ECOSUR.
                </p>
            </div>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                <div class="publication-search-wrapper">
                    <div class="publication-search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" id="pub-search-input"
                           class="publication-search-input"
                           placeholder="Buscar por título, abstract o etiqueta..."
                           autocomplete="off">
                    <button id="pub-search-clear" class="publication-search-clear"
                            title="Limpiar" style="display:none;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="pub-tabs-wrap" data-aos="fade-up" data-aos-delay="150">
            <div class="pub-tabs-scroll">

                <button class="pub-tab pub-tab--active" data-categoria="">
                    <span class="pub-tab__icon"><i class="fas fa-layer-group"></i></span>
                    <span class="pub-tab__label">Todas</span>
                    <span class="pub-tab__count" id="count-all">0</span>
                </button>

                @foreach($categorias as $cat)
                <button class="pub-tab" data-categoria="{{ $cat->id }}">
                    <span class="pub-tab__icon"><i class="fas fa-file-alt"></i></span>
                    <span class="pub-tab__label">{{ $cat->nombre }}</span>
                    <span class="pub-tab__count" id="count-{{ $cat->id }}">0</span>
                </button>
                @endforeach

            </div>
        </div>

        <div class="row pub-grid" id="pub-grid" style="margin-top:28px;"></div>

        <div id="pub-empty" style="display:none; text-align:center; padding:70px 0;">
            <div class="pub-empty__icon">
                <i class="fas fa-search"></i>
            </div>
            <h4 class="pub-empty__title">Sin resultados</h4>
            <p class="pub-empty__text">Intenta con otro término o categoría.</p>
            <button id="pub-empty-reset" class="btn-solid-reg pub-empty__btn">
                Limpiar filtros
            </button>
        </div>

        <div id="pub-pagination" style="display:none; margin-top:40px; text-align:center;"></div>

    </div>

    <div id="pub-modal-overlay" class="pub-modal-overlay" style="display:none;"
         role="dialog" aria-modal="true" aria-labelledby="pub-modal-title">
        <div class="pub-modal">
            <button class="pub-modal-close" aria-label="Cerrar">
                <i class="fas fa-times"></i>
            </button>

            <div class="pub-modal-inner">

                <div class="pub-modal-img-wrap" id="pub-modal-img-wrap"></div>

                <div class="pub-modal-right">
                    <div class="pub-modal-body">
                        <div class="pub-modal-meta">
                            <span class="pub-modal-badge" id="pub-modal-badge"></span>
                            <div class="pub-modal-date" id="pub-modal-date">
                                <i class="fas fa-calendar-alt"></i>
                                <span></span>
                            </div>
                        </div>
                        <h3 class="pub-modal-title" id="pub-modal-title"></h3>
                        <div class="pub-modal-divider"></div>
                        <p class="pub-modal-abstract" id="pub-modal-abstract"></p>
                        <div class="pub-modal-tags" id="pub-modal-tags"></div>
                    </div>
                    <div class="pub-modal-footer">
                        <a id="pub-modal-link" href="#" target="_blank"
                           rel="noopener noreferrer" class="pub-modal-btn">
                            Ver publicación <i class="fas fa-arrow-right"></i>
                        </a>
                        <span id="pub-modal-no-link" class="pub-modal-no-link"
                              style="display:none;">Sin enlace disponible</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

<script>
    window.__PUBLICACIONES__ = {!! $publicacionesJson !!};
</script>

<script>
(function () {
    const PER_PAGE = 9;
    const todas    = window.__PUBLICACIONES__ || [];

    let filtradas       = [...todas];
    let paginaActual    = 1;
    let categoriaActiva = '';
    let terminoBusqueda = '';

    const grid        = document.getElementById('pub-grid');
    const emptyState  = document.getElementById('pub-empty');
    const pagination  = document.getElementById('pub-pagination');
    const searchInput = document.getElementById('pub-search-input');
    const searchClear = document.getElementById('pub-search-clear');
    const tabs        = document.querySelectorAll('.pub-tab');
    const emptyReset  = document.getElementById('pub-empty-reset');

    function coincideBusqueda(pub, term) {
        if (term === '') return true;
        if (pub.titulo.toLowerCase().includes(term)) return true;
        if (pub.abstract && pub.abstract.toLowerCase().includes(term)) return true;
        if (Array.isArray(pub.etiquetas) && pub.etiquetas.some(e => e.toLowerCase().includes(term))) return true;
        return false;
    }

    function aplicarFiltros() {
        const term = terminoBusqueda.toLowerCase().trim();
        filtradas = todas.filter(pub => {
            const matchCat    = categoriaActiva === '' || String(pub.categoria_id) === String(categoriaActiva);
            const matchSearch = coincideBusqueda(pub, term);
            return matchCat && matchSearch;
        });
        paginaActual = 1;
        actualizarContadores();
        renderizar();
    }

    function actualizarContadores() {
        const term = terminoBusqueda.toLowerCase().trim();

        const countAll = todas.filter(p => coincideBusqueda(p, term)).length;
        const elAll = document.getElementById('count-all');
        if (elAll) elAll.textContent = countAll;

        tabs.forEach(tab => {
            const catId = tab.dataset.categoria;
            if (catId === '') return;
            const el = document.getElementById('count-' + catId);
            if (!el) return;
            el.textContent = todas.filter(p =>
                String(p.categoria_id) === String(catId) && coincideBusqueda(p, term)
            ).length;
        });
    }

    function renderizar() {
        grid.innerHTML = '';
        const total  = filtradas.length;
        const inicio = (paginaActual - 1) * PER_PAGE;
        const pagina = filtradas.slice(inicio, inicio + PER_PAGE);

        if (total === 0) {
            emptyState.style.display = 'block';
            pagination.style.display = 'none';
            return;
        }
        emptyState.style.display = 'none';

        pagina.forEach(pub => {
            const col = document.createElement('div');
            col.className = 'col-lg-4 col-md-6 mb-4';

            const imagenHTML = pub.imagen
                ? `<div class="pub-card__img">
                       <img src="${esc(pub.imagen)}" alt="${esc(pub.titulo)}" loading="lazy">
                   </div>`
                : `<div class="pub-card__img">
                       <div class="pub-card__placeholder">
                           <i class="fas fa-file-alt"></i>
                           <span>Publicación</span>
                       </div>
                       ${pub.categoria_nombre
                           ? `<span class="pub-card__cat-badge">${esc(pub.categoria_nombre)}</span>`
                           : ''}
                   </div>`;

            const etiquetasStr = Array.isArray(pub.etiquetas)
                ? pub.etiquetas.join(',')
                : (pub.etiquetas || '');

            col.innerHTML = `
                <div class="pub-card pub-card--clickable"
                     data-titulo="${esc(pub.titulo)}"
                     data-abstract="${esc(pub.abstract || '')}"
                     data-fecha="${esc(pub.fecha_publicacion || '')}"
                     data-url="${esc(pub.url || '')}"
                     data-imagen="${esc(pub.imagen || '')}"
                     data-categoria="${esc(pub.categoria_nombre || '')}"
                     data-etiquetas="${esc(etiquetasStr)}">
                    ${imagenHTML}
                    <div class="pub-card__body">
                        <div class="pub-card__date">
                            <span class="pub-card__date-dot"></span>
                            ${esc(pub.fecha_publicacion || '')}
                        </div>
                        <h3 class="pub-card__title">${esc(pub.titulo)}</h3>
                        <p class="pub-card__abstract">${esc(truncar(pub.abstract, 155))}</p>
                        <div class="pub-card__footer">
                            <span class="pub-card__hint">
                                <i class="fas fa-expand-alt"></i> Ver detalles
                            </span>
                        </div>
                    </div>
                </div>`;
            grid.appendChild(col);
        });

        renderPaginacion(total);
    }

    function renderPaginacion(total) {
        const totalPags = Math.ceil(total / PER_PAGE);
        if (totalPags <= 1) { pagination.style.display = 'none'; return; }

        pagination.style.display = 'block';
        pagination.innerHTML = '';

        const ul = document.createElement('ul');
        ul.className = 'pub-pag-list';

        ul.appendChild(crearItem('←', paginaActual === 1, () => ir(paginaActual - 1)));

        for (let i = 1; i <= totalPags; i++) {
            const li = crearItem(i, false, () => ir(i));
            if (i === paginaActual) li.querySelector('button').classList.add('pub-pag-btn--active');
            ul.appendChild(li);
        }

        ul.appendChild(crearItem('→', paginaActual === totalPags, () => ir(paginaActual + 1)));
        pagination.appendChild(ul);
    }

    function crearItem(label, disabled, onClick) {
        const li  = document.createElement('li');
        const btn = document.createElement('button');
        btn.className = 'pub-pag-btn' + (disabled ? ' pub-pag-btn--disabled' : '');
        btn.innerHTML = label;
        btn.disabled  = disabled;
        if (!disabled) btn.addEventListener('click', onClick);
        li.appendChild(btn);
        return li;
    }

    function ir(num) {
        paginaActual = num;
        renderizar();
        grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function esc(str) {
        if (str == null) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    function truncar(str, max) {
        if (!str) return '';
        return str.length > max ? str.slice(0, max).trimEnd() + '…' : str;
    }

    searchInput.addEventListener('input', function () {
        terminoBusqueda = this.value;
        searchClear.style.display = terminoBusqueda.length > 0 ? 'inline-flex' : 'none';
        aplicarFiltros();
    });

    searchClear.addEventListener('click', function () {
        searchInput.value = terminoBusqueda = '';
        this.style.display = 'none';
        aplicarFiltros();
    });

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('pub-tab--active'));
            this.classList.add('pub-tab--active');
            categoriaActiva = this.dataset.categoria;
            aplicarFiltros();
        });
    });

    emptyReset.addEventListener('click', function () {
        searchInput.value = terminoBusqueda = categoriaActiva = '';
        searchClear.style.display = 'none';
        tabs.forEach(t => t.classList.remove('pub-tab--active'));
        tabs[0].classList.add('pub-tab--active');
        aplicarFiltros();
    });

    const overlay    = document.getElementById('pub-modal-overlay');
    const modalClose = overlay.querySelector('.pub-modal-close');

    function abrirModal(data) {
        const imgWrap = document.getElementById('pub-modal-img-wrap');
        if (data.imagen) {
            imgWrap.innerHTML = `<img src="${data.imagen}" alt="${escText(data.titulo)}">`;
        } else {
            imgWrap.innerHTML = `<div class="pub-modal-placeholder">
                                     <i class="fas fa-file-alt"></i>
                                     <span>Publicación</span>
                                 </div>`;
        }

        const badge = document.getElementById('pub-modal-badge');
        if (data.categoria) {
            badge.textContent   = data.categoria;
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }

        document.getElementById('pub-modal-title').textContent = data.titulo;

        const dateEl = document.getElementById('pub-modal-date');
        if (data.fecha) {
            dateEl.querySelector('span').textContent = data.fecha;
            dateEl.style.display = 'flex';
        } else {
            dateEl.style.display = 'none';
        }

        document.getElementById('pub-modal-abstract').textContent =
            data.abstract || 'Sin resumen disponible.';

        const tagsWrap  = document.getElementById('pub-modal-tags');
        const etiquetas = data.etiquetas
            ? data.etiquetas.split(',').map(e => e.trim()).filter(Boolean)
            : [];
        tagsWrap.innerHTML = etiquetas
            .map(e => `<span class="pub-modal-tag">${escText(e)}</span>`)
            .join('');

        const link   = document.getElementById('pub-modal-link');
        const noLink = document.getElementById('pub-modal-no-link');
        if (data.url) {
            link.href            = data.url;
            link.style.display   = 'inline-flex';
            noLink.style.display = 'none';
        } else {
            link.style.display   = 'none';
            noLink.style.display = 'flex';
        }

        overlay.style.display        = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function cerrarModal() {
        overlay.style.display        = 'none';
        document.body.style.overflow = '';
    }

    function escText(str) {
        if (str == null) return '';
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    grid.addEventListener('click', function (e) {
        const card = e.target.closest('.pub-card--clickable');
        if (!card) return;
        abrirModal({
            titulo:    card.dataset.titulo,
            abstract:  card.dataset.abstract,
            fecha:     card.dataset.fecha,
            url:       card.dataset.url,
            imagen:    card.dataset.imagen,
            categoria: card.dataset.categoria,
            etiquetas: card.dataset.etiquetas,
        });
    });

    modalClose.addEventListener('click', cerrarModal);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) cerrarModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.style.display !== 'none') cerrarModal();
    });

    aplicarFiltros();
})();
</script>

@endsection