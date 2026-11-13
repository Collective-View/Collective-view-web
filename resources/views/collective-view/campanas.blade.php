<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Información de campañas de monitoreo">
    <meta name="author" content="Collective View - ECOSUR">

    <title>Campañas - Collective View</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/fontawesome-all.css" rel="stylesheet">
    <link href="../css/swiper.css" rel="stylesheet">
    <link href="../css/magnific-popup.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/collective-view.css" rel="stylesheet">
    <link href="../css/campañas.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="../js/campañas.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark navbar-custom navbar-solid fixed-top">
        <a class="navbar-brand logo-container" href="../">
            <img src="../images/logo.png" alt="Collective View" class="navbar-logo">
            <span class="navbar-logo-text">
                Collective View
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../">
                        INICIO
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../publicaciones">
                        PUBLICACIONES
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../datos">
                        DATOS ABIERTOS
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="calidadDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        CALIDAD DEL AIRE
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown-custom"
                        aria-labelledby="calidadDropdown">
                        <a class="dropdown-item" href="../monitoreo">INFORMACIÓN</a>
                        <a class="dropdown-item" href="../campanas">CAMPAÑAS DE MONITOREO</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../investigacion">
                        LÍNEAS DE INVESTIGACIÓN
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../contactos">
                        EQUIPO
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="recursosDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        RECURSOS
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown-custom"
                        aria-labelledby="recursosDropdown">
                        <a class="dropdown-item" href="../referencias">REFERENCIAS</a>
                        <a class="dropdown-item" href="../videos">VIDEOS</a>
                        <a class="dropdown-item" href="../propiedad">PROPIEDAD INTELECTUAL</a>
                        <a class="dropdown-item" href="../medios">MEDIOS</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="cv-dashboard">
        <div class="container-fluid px-0">
            <div class="cv-layout-wrapper">
                <!-- BOTÓN MOSTRAR / OCULTAR CAMPAÑAS: fijo en pantalla, siempre visible al hacer scroll -->
                <button class="cv-sidebar-toggle-btn" id="cvSidebarToggle" type="button"
                    title="Mostrar / ocultar campañas" aria-label="Mostrar u ocultar la lista de campañas" aria-controls="cvSidebar">
                    <i class="fas fa-chevron-left cv-toggle-icon-desktop" aria-hidden="true"></i>
                    <i class="fas fa-folder-open cv-toggle-icon-mobile" aria-hidden="true"></i>
                    <span class="cv-sidebar-toggle-label">Campañas</span>
                </button>

                <!-- SIDEBAR RETRÁCTIL ("Campañas") FIJO AL HACER SCROLL -->
                <aside class="cv-sidebar" id="cvSidebar">
                    <div class="cv-sidebar-top-header">
                        <div class="cv-sidebar-heading">
                            <i class="fas fa-folder-open text-muted mr-1"></i>
                            <span>Campañas</span>
                        </div>
                        <div class="cv-sidebar-header-actions">
                            <!-- Botón de filtros de búsqueda -->
                            <button class="cv-sidebar-filter-btn" id="cvSidebarFilterBtn" type="button" title="Filtros de búsqueda" aria-label="Abrir filtros de búsqueda">
                                <i class="fas fa-filter"></i>
                                <span class="cv-filter-indicator-dot" id="cvFilterDot" style="display: none;"></span>
                            </button>
                            <!-- Cerrar la lista (solo tablet / celular) -->
                            <button class="cv-sidebar-filter-btn cv-sidebar-close-btn" id="cvSidebarClose" type="button" title="Cerrar" aria-label="Cerrar la lista de campañas">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- PANEL DESPLEGABLE DE FILTROS DE BÚSQUEDA -->
                    <div class="cv-sidebar-filters-panel" id="cvSidebarFiltersPanel">
                        <div class="cv-filters-panel-header">
                            <span class="cv-filters-panel-title">
                                <i class="fas fa-sliders-h mr-1 cv-filters-panel-icon"></i> Filtros
                            </span>
                            <button type="button" class="cv-filters-close-btn" id="cvFiltersCloseBtn" title="Cerrar filtros">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Filtro 1: Fecha (De X fecha a Y fecha) -->
                        <div class="cv-filter-group mb-2">
                            <label class="cv-filter-label" for="filter-date-from">
                                <i class="far fa-calendar-alt mr-1"></i> Fecha inicio
                            </label>
                            <input type="date" id="filter-date-from" class="form-control cv-filter-input">
                        </div>
                        <div class="cv-filter-group mb-2">
                            <label class="cv-filter-label" for="filter-date-to">
                                <i class="far fa-calendar-alt mr-1"></i> Fecha fin
                            </label>
                            <input type="date" id="filter-date-to" class="form-control cv-filter-input">
                        </div>

                        <!-- Filtro 2: Estación (Estación 1, 2 y 3) -->
                        <div class="cv-filter-group mb-2">
                            <label class="cv-filter-label" for="filter-station">
                                <i class="fas fa-satellite-dish mr-1"></i> Estación
                            </label>
                            <select id="filter-station" class="form-control cv-filter-input">
                                <option value="">Todas las estaciones</option>
                            </select>
                        </div>

                        <!-- Filtro 3: Ciudad (Chetumal, Mahahual) -->
                        <div class="cv-filter-group mb-3">
                            <label class="cv-filter-label" for="filter-location">
                                <i class="fas fa-map-marker-alt mr-1"></i> Localidad
                            </label>
                            <select id="filter-location" class="form-control cv-filter-input">
                                <option value="">Todas las localidades</option>
                            </select>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="cv-filter-actions">
                            <button type="button" class="btn btn-sm cv-btn-filter-apply" id="btn-apply-filters">
                                <i class="fas fa-check mr-1"></i> Aplicar
                            </button>
                            <button type="button" class="btn btn-sm cv-btn-filter-reset" id="btn-reset-filters">
                                <i class="fas fa-undo mr-1"></i> Limpiar
                            </button>
                        </div>

                        <!-- Resumen / Indicador de filtros aplicados -->
                        <div class="cv-filters-active-feedback mt-2" id="cvFiltersFeedback" style="display: none;">
                            <span class="badge" id="cvFiltersSummary">Filtros aplicados</span>
                        </div>
                    </div>

                    <div class="cv-sidebar-nav nav flex-column" role="tablist" id="file-container">
                    </div>
                </aside>

                <!-- Backdrop de fondo en dispositivos móviles -->
                <div class="cv-sidebar-backdrop" id="cvSidebarBackdrop"></div>

                <!-- MAIN CONTENT -->
                <main class="cv-main" id="cvMain">
                    <!-- HEADER -->
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start mb-4">
                        <div class="d-flex align-items-center">
                            <div>
                                <h1 class="cv-title">MONITOREO AMBIENTAL</h1>
                            </div>
                        </div>

                        <div class="cv-header-actions mt-3 mt-lg-0">
                            <!-- Botón Modo Oscuro / Claro -->
                            <button class="cv-btn-download cv-btn-theme-toggle mr-2" id="cvThemeToggle" type="button" title="Alternar Modo Oscuro / Modo Claro">
                                <i class="fas fa-moon" id="cvThemeIcon"></i>
                                <div class="cv-btn-label">
                                    <div id="cvThemeModeLabel">Modo</div>
                                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase;" id="cvThemeModeSub">Oscuro</div>
                                </div>
                            </button>

                            <button class="cv-btn-download mr-2" type="button" id="btn-download-zip">
                                <i class="fas fa-file-archive"></i>
                                <div>
                                    <div>Descargar</div>
                                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase;">DATOS</div>
                                </div>
                            </button>
                            <button class="cv-btn-download" type="button" id="btn-download-bulletin" onclick="alert('En espera el boletín')">
                                <i class="fas fa-download"></i>
                                <div>
                                    <div>Descargar</div>
                                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase;">Boletín
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- TABS NAV -->
                    <ul class="nav cv-tab-nav" id="cvDashboardTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-ambiente-link" data-toggle="pill" href="#tab-ambiente"
                                role="tab" aria-controls="tab-ambiente" aria-selected="true">
                                <i class="fas fa-sun"></i> Ambiente
                            </a>
                        </li>
                    <!--
                        <li class="nav-item">
                            <a class="nav-link" id="tab-suelo-link" data-toggle="pill" href="#tab-suelo" role="tab"
                                aria-controls="tab-suelo" aria-selected="false">
                                <i class="fas fa-seedling"></i> Suelo
                            </a>
                        </li>
                    -->
                        <li class="nav-item">
                            <a class="nav-link" id="tab-gases-link" data-toggle="pill" href="#tab-gases" role="tab"
                                aria-controls="tab-gases" aria-selected="false">
                                <i class="fas fa-smog"></i> Gases
                            </a>
                        </li>
                    </ul>

                    <!-- BARRA DESLIZADORA: recorrer las lecturas de la campaña (solo diseño).
                         Para conectarla (backend):
                           #cvTimeSlider          -> min = 1, max = total de lecturas, value = lectura mostrada
                           #cvTimeSliderStart/End -> hora de la primera / última lectura
                           #cvTimeSliderCurrent   -> hora de la lectura seleccionada (va bajo el punto)
                           #cvTimeSliderDate      -> fecha de la campaña
                           "Lectura X de Y" se calcula solo desde min/max/value.
                           Si cambian min/max/value o los textos por código, llamar window.cvUpdateTimeSliderUI().
                         Los valores escritos abajo son de EJEMPLO. -->
                    <div class="cv-time-slider" id="cvTimeSliderWrap">
                        <div class="cv-time-slider-row">
                            <span class="cv-time-slider-edge" id="cvTimeSliderStart">10:15</span>
                            <div class="cv-time-slider-track" id="cvTimeSliderTrack" style="--cv-slider-p: 0.4035;">
                                <input type="range" class="cv-time-slider-input" id="cvTimeSlider"
                                    min="1" max="58" step="1" value="24"
                                    aria-label="Recorrer las lecturas de la campaña" aria-describedby="cvTimeSliderCaption">
                                <output class="cv-time-slider-current" id="cvTimeSliderCurrent" for="cvTimeSlider">11:21</output>
                            </div>
                            <span class="cv-time-slider-edge" id="cvTimeSliderEnd">12:58</span>
                        </div>
                        <p class="cv-time-slider-caption" id="cvTimeSliderCaption">
                            Lectura <strong id="cvTimeSliderIndex">24</strong> de <span id="cvTimeSliderTotal">58</span> - <span id="cvTimeSliderDate">03/Nov/26</span>
                        </p>
                    </div>

                    <!-- TABS CONTENT -->
                    <div class="tab-content" id="cvDashboardContent">

                        <!-- ============================================================= -->
                        <!-- TAB 1: AMBIENTE                                               -->
                        <!-- ============================================================= -->
                        <div class="tab-pane fade show active" id="tab-ambiente" role="tabpanel"
                            aria-labelledby="tab-ambiente-link">
                            <div class="row">
                                <!-- Card 1: Velocidad del viento -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-wind cv-card-icon"></i>
                                                Velocidad del viento
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="wind_ms-value">?</span>
                                            <span class="cv-card-unit">mph</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Direccion del viento -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-compass cv-card-icon"></i>
                                                Direccion del viento
                                            </span>
                                        </div>

                                        <div class="cv-wind-dial-wrap" id="cv-wind-wheel" style="--cv-wind-deg: 330deg;">
                                            <svg class="cv-wind-dial-svg" viewBox="0 0 160 160">
                                                <circle cx="80" cy="80" r="70" class="cv-compass-ring" />
                                                <g class="cv-compass-ticks">
                                                    <line x1="80" y1="10" x2="80" y2="15" />
                                                    <line x1="115" y1="19.4" x2="112.5" y2="23.7" />
                                                    <line x1="140.6" y1="45" x2="136.3" y2="47.5" />
                                                    <line x1="150" y1="80" x2="145" y2="80" />
                                                    <line x1="140.6" y1="115" x2="136.3" y2="112.5" />
                                                    <line x1="115" y1="140.6" x2="112.5" y2="136.3" />
                                                    <line x1="80" y1="150" x2="80" y2="145" />
                                                    <line x1="45" y1="140.6" x2="47.5" y2="136.3" />
                                                    <line x1="19.4" y1="115" x2="23.7" y2="112.5" />
                                                    <line x1="10" y1="80" x2="15" y2="80" />
                                                    <line x1="19.4" y1="45" x2="23.7" y2="47.5" />
                                                    <line x1="45" y1="19.4" x2="47.5" y2="23.7" />
                                                </g>
                                                <g class="cv-compass-labels">
                                                    <text class="cv-compass-deg-text" x="80" y="24">0</text>
                                                    <text class="cv-compass-deg-text" x="108" y="31.5">30</text>
                                                    <text class="cv-compass-deg-text" x="128.5" y="52">60</text>
                                                    <text class="cv-compass-deg-text" x="136" y="80">90</text>
                                                    <text class="cv-compass-deg-text" x="128.5" y="108">120</text>
                                                    <text class="cv-compass-deg-text" x="108" y="128.5">150</text>
                                                    <text class="cv-compass-deg-text" x="80" y="136">180</text>
                                                    <text class="cv-compass-deg-text" x="52" y="128.5">210</text>
                                                    <text class="cv-compass-deg-text" x="31.5" y="108">240</text>
                                                    <text class="cv-compass-deg-text" x="24" y="80">270</text>
                                                    <text class="cv-compass-deg-text" x="31.5" y="52">300</text>
                                                    <text class="cv-compass-deg-text" x="52" y="31.5">330</text>
                                                </g>
                                                <g class="cv-wind-pointer-group" id="cv-wind-pointer" style="transform: rotate(var(--cv-wind-deg, 330deg));">
                                                    <polygon points="80,14 74,3 80,6 86,3" class="cv-pointer-primary" />
                                                    <polygon points="80,14 74,3 80,6 86,3" class="cv-pointer-ghost" transform="rotate(-15 80 80)" />
                                                </g>
                                            </svg>

                                            <div class="cv-wind-dial-center">
                                                <span class="cv-wind-realtime-label">Real-Time</span>
                                                <div class="cv-wind-main-val">
                                                    <span class="cv-wind-deg-num" id="wind_dir_10min_deg-value">?</span>
                                                    <span class="cv-wind-deg-sym">°</span>
                                                </div>
                                                <div class="cv-wind-cardinal-badge">
                                                    <span id="cv-wind-cardinal">NNW</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Temperatura -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-thermometer-half cv-card-icon"></i>
                                                Temperatura
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="out_temp_c-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 4: Humedad -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-tint cv-card-icon"></i>
                                                Humedad
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="out_hum-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 5: Sensación térmica -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-fire cv-card-icon"></i>
                                                Sensación Térmica
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="out_feels_like_c-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 6: Presion barometrica -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-tachometer-alt cv-card-icon"></i>
                                                Presion barometrica
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="rel_pres_hpa-value">?</span>
                                            <span class="cv-card-unit">hPa</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 7: Radiación Solar -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-sun cv-card-icon"></i>
                                                Radiación Solar
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="solar_rad_wm2-value">?</span>
                                            <span class="cv-card-unit">W/m²</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 8: Indice UV -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-lightbulb cv-card-icon"></i>
                                                Indice UV
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="uv_index-value">?</span>
                                            <span class="cv-card-unit">UV</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 9: Lluvia -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-cloud-rain cv-card-icon"></i>
                                                Lluvia
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="event_rain_mm-value">?</span>
                                            <span class="cv-card-unit">mm</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 10: Temperatura (AQIN) -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-thermometer-half cv-card-icon"></i>
                                                Temperatura (AQIN)
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="a_temp_c-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 11: Humedad (AQIN) -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-tint cv-card-icon"></i>
                                                Humedad (AQIN)
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="a_hum-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 12: Dióxido de carbono (AQIN) -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-smog cv-card-icon"></i>
                                                Dióxido de carbono (AQIN)
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="a_co2_ppm-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 13: PM2.5 (AQIN) -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-smog cv-card-icon"></i>
                                                PM2.5 (AQIN)
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="a_pm2_5_ugm3-value">?</span>
                                            <span class="cv-card-unit">μm/m³</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 14: PM10 (AQIN) -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-smog cv-card-icon"></i>
                                                PM10 (AQIN)
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="a_pm10_ugm3-value">?</span>
                                            <span class="cv-card-unit">μm/m³</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 15: PM1.0 (AQIN) -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-smog cv-card-icon"></i>
                                                PM1.0 (AQIN)
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="a_pm1_ugm3-value">?</span>
                                            <span class="cv-card-unit">μm/m³</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 16: PM4.0 (AQIN) -->
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-smog cv-card-icon"></i>
                                                PM4.0 (AQIN)
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="a_pm4_ugm3-value">?</span>
                                            <span class="cv-card-unit">μm/m³</span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /row tarjetas -->

                            <!-- PESTAÑAS DE VISTA: Gráficos / Datos -->
                            <ul class="nav cv-tab-nav cv-view-nav" id="cvViewTabsAmbiente" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="view-ambiente-graficos-link" data-toggle="pill" data-view="graficos"
                                        href="#view-ambiente-graficos" role="tab" aria-controls="view-ambiente-graficos" aria-selected="true">
                                        <i class="fas fa-chart-line"></i> Gráficos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="view-ambiente-datos-link" data-toggle="pill" data-view="datos"
                                        href="#view-ambiente-datos" role="tab" aria-controls="view-ambiente-datos" aria-selected="false">
                                        <i class="fas fa-table"></i> Datos
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content cv-view-content">
                            <!-- VISTA: GRÁFICOS (lo que ya existía) -->
                            <div class="tab-pane fade show active" id="view-ambiente-graficos" role="tabpanel" aria-labelledby="view-ambiente-graficos-link">
                            <div class="row">

                                <!-- Gráficas individuales: Ambiente -->
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-wind mr-2"></i>Velocidad del viento
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: mph</span>
                                        </div>
                                        <div id="chart-wind_ms" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-compass mr-2"></i>Dirección del viento
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: °</span>
                                        </div>
                                        <div id="chart-wind_dir_10min_deg" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-thermometer-half mr-2"></i>Temperatura
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: °C</span>
                                        </div>
                                        <div id="chart-out_temp_c" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-tint mr-2"></i>Humedad
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: %</span>
                                        </div>
                                        <div id="chart-out_hum" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-tint mr-2"></i>Sensación Térmica
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: °C</span>
                                        </div>
                                        <div id="chart-out_feels_like_c" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-tachometer-alt mr-2"></i>Presión barométrica
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: hPa</span>
                                        </div>
                                        <div id="chart-rel_pres_hpa" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-lightbulb mr-2"></i>Radiación Solar
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: W/m²</span>
                                        </div>
                                        <div id="chart-solar_rad_wm2" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-sun mr-2"></i>Índice UV
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: UV</span>
                                        </div>
                                        <div id="chart-uv_index" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-cloud-rain mr-2"></i>Lluvia
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: mm</span>
                                        </div>
                                        <div id="chart-event_rain_mm" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                
                                <!-- Calidad del aire -->
                                
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-thermometer-half mr-2"></i>Temperatura (AQIN)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: °C</span>
                                        </div>
                                        <div id="chart-a_temp_c" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-tint mr-2"></i>Humedad (AQIN)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: %</span>
                                        </div>
                                        <div id="chart-a_hum" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-smog mr-2"></i>Dioxido de carbono (AQIN)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: ppm</span>
                                        </div>
                                        <div id="chart-a_co2_ppm" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-smog mr-2"></i>PM2.5 (AQIN)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: μm/m³</span>
                                        </div>
                                        <div id="chart-a_pm2_5_ugm3" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-smog mr-2"></i>PM10 (AQIN)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: μm/m³</span>
                                        </div>
                                        <div id="chart-a_pm10_ugm3" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-smog mr-2"></i>PM1.0 (AQIN)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: μm/m³</span>
                                        </div>
                                        <div id="chart-a_pm1_ugm3" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-smog mr-2"></i>PM4.0 (AQIN)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: μm/m³</span>
                                        </div>
                                        <div id="chart-a_pm4_ugm3" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                            </div><!-- /row gráficas -->
                            </div><!-- /vista gráficos -->

                            <!-- VISTA: DATOS (tabla con todas las lecturas del CSV) — solo diseño.
                                 Para conectarla (backend):
                                   #cvDataBodyAmbiente  -> un <tr> por lectura; primera celda = hora, luego un <td> por cada
                                                         <th data-field="..."> en el mismo orden (data-field = columna del CSV)
                                   #cvDataCountAmbiente -> "N lecturas"
                                   .is-current          -> clase para la fila de la lectura seleccionada en la barra deslizadora
                                   Valor vacío          -> <td class="cv-data-empty">—</td>
                                 Las filas de abajo son de EJEMPLO (lecturas 19 a 30). -->
                            <div class="tab-pane fade" id="view-ambiente-datos" role="tabpanel" aria-labelledby="view-ambiente-datos-link">
                                <div class="cv-chart-card cv-data-card">
                                    <div class="cv-chart-header">
                                        <h4 class="cv-chart-title">
                                            <i class="fas fa-table mr-2"></i>Datos de la campaña
                                        </h4>
                                        <span class="cv-chart-badge" id="cvDataCountAmbiente">58 lecturas</span>
                                    </div>
                                    <p class="cv-data-hint">
                                        <i class="fas fa-arrows-alt-h" aria-hidden="true"></i> Desliza la tabla para ver todas las mediciones
                                    </p>
                                    <div class="cv-data-table-wrap" tabindex="0" role="region" aria-label="Tabla de datos de ambiente">
                                        <table class="cv-data-table">
                                            <caption class="sr-only">Lecturas de ambiente de la campaña seleccionada</caption>
                                            <thead>
                                                <tr>
                                                <th scope="col" data-field="time">Hora</th>
                                                <th scope="col" data-field="wind_ms">Velocidad del viento<span class="cv-th-unit">mph</span></th>
                                                <th scope="col" data-field="wind_dir_10min_deg">Dirección del viento<span class="cv-th-unit">°</span></th>
                                                <th scope="col" data-field="out_temp_c">Temperatura<span class="cv-th-unit">°C</span></th>
                                                <th scope="col" data-field="out_hum">Humedad<span class="cv-th-unit">%</span></th>
                                                <th scope="col" data-field="out_feels_like_c">Sensación térmica<span class="cv-th-unit">°C</span></th>
                                                <th scope="col" data-field="rel_pres_hpa">Presión barométrica<span class="cv-th-unit">hPa</span></th>
                                                <th scope="col" data-field="solar_rad_wm2">Radiación solar<span class="cv-th-unit">W/m²</span></th>
                                                <th scope="col" data-field="uv_index">Índice UV<span class="cv-th-unit">UV</span></th>
                                                <th scope="col" data-field="event_rain_mm">Lluvia<span class="cv-th-unit">mm</span></th>
                                                <th scope="col" data-field="a_temp_c">Temperatura (AQIN)<span class="cv-th-unit">°C</span></th>
                                                <th scope="col" data-field="a_hum">Humedad (AQIN)<span class="cv-th-unit">%</span></th>
                                                <th scope="col" data-field="a_co2_ppm">Dióxido de carbono (AQIN)<span class="cv-th-unit">ppm</span></th>
                                                <th scope="col" data-field="a_pm2_5_ugm3">PM2.5 (AQIN)<span class="cv-th-unit">μm/m³</span></th>
                                                <th scope="col" data-field="a_pm10_ugm3">PM10 (AQIN)<span class="cv-th-unit">μm/m³</span></th>
                                                <th scope="col" data-field="a_pm1_ugm3">PM1.0 (AQIN)<span class="cv-th-unit">μm/m³</span></th>
                                                <th scope="col" data-field="a_pm4_ugm3">PM4.0 (AQIN)<span class="cv-th-unit">μm/m³</span></th>
                                                </tr>
                                            </thead>
                                            <tbody id="cvDataBodyAmbiente">
                                                <tr data-index="19"><td>11:06</td><td>3.8</td><td>158</td><td>29.4</td><td>77</td><td>34.4</td><td>1012.5</td><td>842.0</td><td>7</td><td>0.0</td><td>30.8</td><td>71.2</td><td>475</td><td>1.6</td><td>2.5</td><td>1.4</td><td>1.5</td></tr>
                                                <tr data-index="20"><td>11:09</td><td>4.3</td><td>154</td><td>29.5</td><td>76</td><td>34.3</td><td>1012.5</td><td>857.0</td><td>7</td><td>0.0</td><td>30.9</td><td>71.4</td><td>474</td><td>1.8</td><td>2.6</td><td>1.3</td><td>1.5</td></tr>
                                                <tr data-index="21"><td>11:12</td><td>3.9</td><td>146</td><td>29.5</td><td>76</td><td>34.5</td><td>1012.4</td><td>857.2</td><td>7</td><td>0.0</td><td>30.9</td><td>71.4</td><td>472</td><td>1.8</td><td>2.5</td><td>1.3</td><td>1.6</td></tr>
                                                <tr data-index="22"><td>11:15</td><td>3.7</td><td>153</td><td>29.5</td><td>76</td><td>34.6</td><td>1012.3</td><td>842.0</td><td>7</td><td>0.0</td><td>30.9</td><td>71.7</td><td>470</td><td>1.8</td><td>2.3</td><td>1.3</td><td>1.5</td></tr>
                                                <tr data-index="23"><td>11:18</td><td>3.7</td><td>158</td><td>29.3</td><td>77</td><td>34.7</td><td>1012.4</td><td>843.9</td><td>7</td><td>0.0</td><td>30.9</td><td>71.6</td><td>468</td><td>1.7</td><td>2.2</td><td>1.3</td><td>1.6</td></tr>
                                                <tr class="is-current" data-index="24"><td>11:21</td><td>4.1</td><td>158</td><td>29.1</td><td>76</td><td>34.8</td><td>1012.5</td><td>842.0</td><td>7</td><td>0.0</td><td>30.9</td><td>71.5</td><td>468</td><td>1.8</td><td>2.1</td><td>1.3</td><td>1.6</td></tr>
                                                <tr data-index="25"><td>11:24</td><td>3.4</td><td>157</td><td>29.1</td><td>77</td><td>34.9</td><td>1012.5</td><td>862.0</td><td>7</td><td>0.0</td><td>30.9</td><td>71.3</td><td>464</td><td>1.9</td><td>1.9</td><td>1.4</td><td>1.6</td></tr>
                                                <tr data-index="26"><td>11:26</td><td>3.7</td><td>147</td><td>29.2</td><td>77</td><td>34.7</td><td>1012.4</td><td>844.0</td><td>7</td><td>0.0</td><td>30.8</td><td>71.4</td><td>464</td><td>2.0</td><td>1.8</td><td>1.4</td><td>1.6</td></tr>
                                                <tr data-index="27"><td>11:29</td><td>3.9</td><td>145</td><td>29.4</td><td>77</td><td>34.9</td><td>1012.4</td><td>842.0</td><td>7</td><td>0.0</td><td>30.7</td><td>71.7</td><td>463</td><td>2.2</td><td>1.7</td><td>1.4</td><td>1.5</td></tr>
                                                <tr data-index="28"><td>11:32</td><td>3.6</td><td>151</td><td>29.5</td><td>77</td><td>34.8</td><td>1012.3</td><td>842.0</td><td>6</td><td>0.0</td><td>30.8</td><td>71.8</td><td>463</td><td>2.1</td><td>1.8</td><td>1.4</td><td>1.4</td></tr>
                                                <tr data-index="29"><td>11:35</td><td>3.1</td><td>143</td><td>29.6</td><td>77</td><td>34.6</td><td>1012.2</td><td>842.0</td><td>6</td><td>0.0</td><td>30.9</td><td>71.6</td><td>462</td><td>2.0</td><td>2.0</td><td>1.4</td><td>1.6</td></tr>
                                                <tr data-index="30"><td>11:38</td><td>2.7</td><td>146</td><td>29.6</td><td>77</td><td>34.6</td><td>1012.1</td><td>857.9</td><td>7</td><td>0.0</td><td>30.9</td><td>71.5</td><td>462</td><td>2.0</td><td>2.2</td><td>1.4</td><td>1.6</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div><!-- /tab-content vistas -->
                        </div>

                        <!-- ============================================================= -->
                        <!-- TAB 2: SUELO                                                  -->
                        <!-- ============================================================= -->
                        <div class="tab-pane fade" id="tab-suelo" role="tabpanel" aria-labelledby="tab-suelo-link">
                            <div class="row">
                                <!-- Card 1: Temperatura del suelo -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-thermometer-half cv-card-icon"></i>
                                                Temperatura del suelo
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="placeholder-value">0.00</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Humedad del suelo -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-tint cv-card-icon"></i>
                                                Humedad del suelo
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="placeholder-value">0.00</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gráficas individuales: Suelo -->
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-tint mr-2"></i>Humedad del suelo
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: %</span>
                                        </div>
                                        <div id="chart-suelo-humedad" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-thermometer-half mr-2"></i>Temperatura del suelo
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: °C</span>
                                        </div>
                                        <div id="chart-suelo-temperatura" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ============================================================= -->
                        <!-- TAB 3: GASES                                                  -->
                        <!-- ============================================================= -->
                        <div class="tab-pane fade" id="tab-gases" role="tabpanel" aria-labelledby="tab-gases-link">
                            <div class="row">
                                <!-- Card 1: Amoniaco -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-flask cv-card-icon"></i>
                                                Amoniaco
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="amon-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Temperatura NH3 -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-thermometer-half cv-card-icon"></i>
                                                Temperatura
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="temp_f-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Humedad NH3 -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-tint cv-card-icon"></i>
                                                Humedad
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="hum-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 4: Ácido sulfhídrico -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-droplet cv-card-icon"></i>
                                                Ácido sulfhídrico
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="h2s-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 5: Oxígeno -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-atom cv-card-icon"></i>
                                                Oxígeno
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="o2-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 6: Monóxido de carbono -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-triangle-exclamation cv-card-icon"></i>
                                                Monóxido de carbono
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="co-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 7: LEL -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-fire cv-card-icon"></i>
                                                Limite inferior de explosividad
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="lel-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PESTAÑAS DE VISTA: Gráficos / Datos -->
                            <ul class="nav cv-tab-nav cv-view-nav" id="cvViewTabsGases" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="view-gases-graficos-link" data-toggle="pill" data-view="graficos"
                                        href="#view-gases-graficos" role="tab" aria-controls="view-gases-graficos" aria-selected="true">
                                        <i class="fas fa-chart-line"></i> Gráficos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="view-gases-datos-link" data-toggle="pill" data-view="datos"
                                        href="#view-gases-datos" role="tab" aria-controls="view-gases-datos" aria-selected="false">
                                        <i class="fas fa-table"></i> Datos
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content cv-view-content">
                            <!-- VISTA: GRÁFICOS (lo que ya existía) -->
                            <div class="tab-pane fade show active" id="view-gases-graficos" role="tabpanel" aria-labelledby="view-gases-graficos-link">
                            <div class="row">

                                <!-- Gráficas individuales: Concentración de gases -->
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-smog mr-2"></i>Sulfuro de hidrógeno (H2S)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: ppm</span>
                                        </div>
                                        <div id="chart-h2s" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-flask mr-2"></i>Amoniaco (NH3)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: ppm</span>
                                        </div>
                                        <div id="chart-amon" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-thermometer-half mr-2"></i>Temperatura (NH3)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: °C</span>
                                        </div>
                                        <div id="chart-temp_f" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-tint mr-2"></i>Humedad (NH3)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: %</span>
                                        </div>
                                        <div id="chart-hum" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-cloud mr-2"></i>Monóxido de carbono (CO)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: ppm</span>
                                        </div>
                                        <div id="chart-co" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-fire mr-2"></i>Oxígeno (O)
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: ppm</span>
                                        </div>
                                        <div id="chart-o2" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-vial mr-2"></i>LEL
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: ppb</span>
                                        </div>
                                        <div id="chart-lel" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>
                            </div><!-- /row gráficas -->
                            </div><!-- /vista gráficos -->

                            <!-- VISTA: DATOS (tabla con todas las lecturas del CSV) — solo diseño.
                                 Para conectarla (backend):
                                   #cvDataBodyGases  -> un <tr> por lectura; primera celda = hora, luego un <td> por cada
                                                         <th data-field="..."> en el mismo orden (data-field = columna del CSV)
                                   #cvDataCountGases -> "N lecturas"
                                   .is-current          -> clase para la fila de la lectura seleccionada en la barra deslizadora
                                   Valor vacío          -> <td class="cv-data-empty">—</td>
                                 Las filas de abajo son de EJEMPLO (lecturas 19 a 30). -->
                            <div class="tab-pane fade" id="view-gases-datos" role="tabpanel" aria-labelledby="view-gases-datos-link">
                                <div class="cv-chart-card cv-data-card">
                                    <div class="cv-chart-header">
                                        <h4 class="cv-chart-title">
                                            <i class="fas fa-table mr-2"></i>Datos de la campaña
                                        </h4>
                                        <span class="cv-chart-badge" id="cvDataCountGases">58 lecturas</span>
                                    </div>
                                    <p class="cv-data-hint">
                                        <i class="fas fa-arrows-alt-h" aria-hidden="true"></i> Desliza la tabla para ver todas las mediciones
                                    </p>
                                    <div class="cv-data-table-wrap" tabindex="0" role="region" aria-label="Tabla de datos de gases">
                                        <table class="cv-data-table">
                                            <caption class="sr-only">Lecturas de gases de la campaña seleccionada</caption>
                                            <thead>
                                                <tr>
                                                <th scope="col" data-field="time">Hora</th>
                                                <th scope="col" data-field="amon">Amoniaco<span class="cv-th-unit">ppm</span></th>
                                                <th scope="col" data-field="temp_f">Temperatura<span class="cv-th-unit">°C</span></th>
                                                <th scope="col" data-field="hum">Humedad<span class="cv-th-unit">%</span></th>
                                                <th scope="col" data-field="h2s">Ácido sulfhídrico<span class="cv-th-unit">ppm</span></th>
                                                <th scope="col" data-field="o2">Oxígeno<span class="cv-th-unit">%</span></th>
                                                <th scope="col" data-field="co">Monóxido de carbono<span class="cv-th-unit">ppm</span></th>
                                                <th scope="col" data-field="lel">Límite inferior de explosividad<span class="cv-th-unit">%</span></th>
                                                </tr>
                                            </thead>
                                            <tbody id="cvDataBodyGases">
                                                <tr data-index="19"><td>11:06</td><td>0.61</td><td>94.8</td><td>59.3</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="20"><td>11:09</td><td>0.61</td><td>94.7</td><td>59.3</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="21"><td>11:12</td><td>0.62</td><td>94.7</td><td>59.2</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="22"><td>11:15</td><td>0.60</td><td>94.8</td><td>59.3</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="23"><td>11:18</td><td>0.60</td><td>94.8</td><td>59.4</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr class="is-current" data-index="24"><td>11:21</td><td>0.58</td><td>94.8</td><td>59.4</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="25"><td>11:24</td><td>0.60</td><td>94.7</td><td>59.4</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="26"><td>11:26</td><td>0.58</td><td>94.7</td><td>59.5</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="27"><td>11:29</td><td>0.56</td><td>94.7</td><td>59.4</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="28"><td>11:32</td><td>0.56</td><td>94.7</td><td>59.5</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="29"><td>11:35</td><td>0.56</td><td>94.8</td><td>59.6</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                                <tr data-index="30"><td>11:38</td><td>0.58</td><td>94.8</td><td>59.5</td><td>0.00</td><td>20.9</td><td>0</td><td>0</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div><!-- /tab-content vistas -->
                        </div>

                    </div>
                </main>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/swiper.min.js"></script>
    <script src="../js/jquery.magnific-popup.js"></script>
    <script src="../js/morphext.min.js"></script>
    <script src="../js/isotope.pkgd.min.js"></script>
    <script src="../js/validator.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1200,
            once: true,
            offset: 120
        });
    </script>
</body>

</html>