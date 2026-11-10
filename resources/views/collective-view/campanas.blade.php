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
                <!-- SIDEBAR RETRÁCTIL ("Campañas") FIJO AL HACER SCROLL -->
                <aside class="cv-sidebar" id="cvSidebar">
                    <div class="cv-sidebar-top-header">
                        <div class="cv-sidebar-heading">
                            <i class="fas fa-folder-open text-muted mr-1"></i>
                            <span>Campañas</span>
                        </div>
                        <!-- Botón de filtros de búsqueda -->
                        <button class="cv-sidebar-filter-btn" id="cvSidebarFilterBtn" type="button" title="Filtros de búsqueda" aria-label="Abrir filtros de búsqueda">
                            <i class="fas fa-filter"></i>
                            <span class="cv-filter-indicator-dot" id="cvFilterDot" style="display: none;"></span>
                        </button>
                    </div>

                    <!-- PANEL DESPLEGABLE DE FILTROS DE BÚSQUEDA -->
                    <div class="cv-sidebar-filters-panel" id="cvSidebarFiltersPanel">
                        <div class="cv-filters-panel-header">
                            <span class="cv-filters-panel-title">
                                <i class="fas fa-sliders-h mr-1 text-primary"></i> Filtros
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
                        <div class="d-flex align-items-center justify-content-between pt-1">
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
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start mb-4">
                        <div class="d-flex align-items-center">
                            <button class="cv-sidebar-toggle-btn mr-3" id="cvSidebarToggle" type="button" title="Ocultar / Mostrar Campañas" aria-label="Toggle campañas">
                                <i class="fas fa-bars" id="cvSidebarToggleIcon"></i>
                            </button>
                            <div>
                                <h1 class="cv-title">MONITOREO AMBIENTAL</h1>
                            </div>
                        </div>

                        <div class="cv-header-actions mt-3 mt-md-0 d-flex flex-wrap align-items-center">
                            <!-- Botón Modo Oscuro / Claro -->
                            <button class="cv-btn-download cv-btn-theme-toggle mr-2" id="cvThemeToggle" type="button" title="Alternar Modo Oscuro / Modo Claro">
                                <i class="fas fa-moon" id="cvThemeIcon"></i>
                                <div>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="wind_ms-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="wind_ms-min"></i>
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="wind_dir_10min_deg-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="wind_dir_10min_deg-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="out_temp_c-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="out_temp_c-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="out_hum-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="out_hum-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="out_feels_like_c-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="out_feels_like_c-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="rel_pres_hpa-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="rel_pres_hpa-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="solar_rad_wm2-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="solar_rad_wm2-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="uv_index-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="uv_index-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_temp_c-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_temp_c-min"></i>
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_hum-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_hum-min"></i>
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_co2_ppm-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_co2_ppm-min"></i>
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_pm2_5_ugm3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_pm2_5_ugm3-min"></i>
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_pm10_ugm3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_pm10_ugm3-min"></i>
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_pm1_ugm3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_pm1_ugm3-min"></i>
                                            </span>
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

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_pm4_ugm3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_pm4_ugm3-min"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>


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
                                
                            </div>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="placeholder-max">0.00</i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="placeholder-min">0.00</i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="placeholder-max">0.00</i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="placeholder-min">0.00</i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="amon-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="amon-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="temp_f-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="temp_f-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="hum-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="hum-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="h2s-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="h2s-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="o2-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="o2-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="co-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="co-min"></i>
                                            </span>
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
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="lel-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="lel-min"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            </div>
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