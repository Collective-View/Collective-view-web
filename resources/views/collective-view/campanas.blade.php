<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Contacto de investigadores y colaboradores del proyecto Collective View">
    <meta name="author" content="Collective View - ECOSUR">

    <title>Campañas - Collective View</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext"
        rel="stylesheet">
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
    

    <!-- Anti-flicker script para Modo Oscuro -->
    <script>
        (function() {
            var savedTheme = localStorage.getItem('cv_theme');
            var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
            if (savedTheme === 'light' || (!savedTheme && prefersLight)) {
                document.documentElement.classList.remove('cv-dark-mode');
            }
        })();
    </script>

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
                            <label class="cv-filter-label" for="filter-city">
                                <i class="fas fa-map-marker-alt mr-1"></i> Localidad
                            </label>
                            <select id="filter-city" class="form-control cv-filter-input">
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
                        <li class="nav-item">
                            <a class="nav-link" id="tab-suelo-link" data-toggle="pill" href="#tab-suelo" role="tab"
                                aria-controls="tab-suelo" aria-selected="false">
                                <i class="fas fa-seedling"></i> Suelo
                            </a>
                        </li>
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
                                <div class="col-12 col-md-6 col-xl-4">
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
                                <div class="col-12 col-md-6 col-xl-4">
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
                                                    <span class="cv-wind-deg-num" id="wind_dir_10_mean-value">?</span>
                                                    <span class="cv-wind-deg-sym">°</span>
                                                </div>
                                                <div class="cv-wind-cardinal-badge">
                                                    <span id="cv-wind-cardinal">NNW</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="wind_dir_10_mean-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="wind_dir_10_mean-min"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Temperatura -->
                                <div class="col-12 col-md-6 col-xl-4">
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
                                <div class="col-12 col-md-6 col-xl-4">
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
                                
                                <!-- Card : Sensación térmica -->
                                <div class="col-12 col-md-6 col-xl-4">
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

                                <!-- Card 5: Presion barometrica -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-tachometer-alt cv-card-icon"></i>
                                                Presion barometrica
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="pres_rel_hpa-value">?</span>
                                            <span class="cv-card-unit">hPa</span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="pres_rel_hpa-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="pres_rel_hpa-min"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 6: Radiación Solar -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-lightbulb cv-card-icon"></i>
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

                                <!-- Card 7: Indice UV -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-sun cv-card-icon"></i>
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

                                <!-- Card 8: Lluvia -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <i class="fas fa-cloud-rain cv-card-icon"></i>
                                                Lluvia
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="rain_rate_mmhr-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="rain_rate_mmhr-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="rain_rate_mmhr-min"></i>
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
                                        <div id="chart-ambiente-viento" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-ambiente-direccion" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-ambiente-temperatura" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-ambiente-humedad" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-ambiente-sensacion" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-ambiente-presion" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-lightbulb mr-2"></i>Luz
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: W/m²</span>
                                        </div>
                                        <div id="chart-ambiente-luz" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-ambiente-uv" class="cv-chart-canvas cv-chart-canvas--single"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6" data-aos="fade-up">
                                    <div class="cv-chart-card cv-chart-card--single">
                                        <div class="cv-chart-header">
                                            <h4 class="cv-chart-title">
                                                <i class="fas fa-cloud-rain mr-2"></i>Lluvia
                                            </h4>
                                            <span class="cv-chart-badge">Unidad: %</span>
                                        </div>
                                        <div id="chart-ambiente-lluvia" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                            <span class="cv-card-value" id="nh3-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="nh3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="nh3-min"></i>
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
                                            <span class="cv-card-value" id="temp_nh3-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="temp_nh3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="temp_nh3-min"></i>
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
                                            <span class="cv-card-value" id="hum_nh3-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="hum_nh3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="hum_nh3-min"></i>
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
                                        <div id="chart-gases-h2s" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-gases-nh3" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-gases-temp_nh3" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-gases-hum_nh3" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-gases-co" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-gases-o2" class="cv-chart-canvas cv-chart-canvas--single"></div>
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
                                        <div id="chart-gases-lel" class="cv-chart-canvas cv-chart-canvas--single"></div>
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

    /* ============================================================
       Helper global: dirección del viento dinámica
       ============================================================ */
    window.setWindDirection = function(degrees, cardinalName) {
        degrees = parseFloat(degrees) || 0;
        const normalized = ((degrees % 360) + 360) % 360;
        const CARDINALS = ['N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSO','SO','OSO','O','ONO','NO','NNO']
        const cardinalIndex = Math.round(normalized / 22.5) % 16;
        const cardinal = cardinalName || CARDINALS[cardinalIndex];

        const wheel = document.getElementById('cv-wind-wheel');
        if (wheel) wheel.style.setProperty('--cv-wind-deg', normalized + 'deg');

        const degEl = document.getElementById('cv-wind-deg');
        if (degEl) degEl.innerText = Math.round(normalized);

        const cardEl = document.getElementById('cv-wind-cardinal');
        if (cardEl) cardEl.innerText = cardinal;
    };

    /* ============================================================
       INICIALIZACIÓN: ApexCharts, sidebar, filtros, tema
       ============================================================ */
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ApexCharts === 'undefined') {
            console.warn('ApexCharts no está disponible.');
            return;
        }

        const defaultHours = ['06:00','08:00','10:00','12:00','14:00','16:00','18:00','20:00'];
        const isCurrentlyDark = document.documentElement.classList.contains('cv-dark-mode');

        // ---------------------------------------------------------
        // Configuración de cada gráfica individual
        // (mismo orden que las cards de cada pestaña)
        // ---------------------------------------------------------
        const chartConfigs = {
            ambiente: [
                { id: 'chart-ambiente-viento',      name: 'Velocidad del viento', unit: 'mph',  color: '#0B7A5C', data: [], decimals: 1 },
                { id: 'chart-ambiente-direccion',   name: 'Dirección del viento', unit: '°',    color: '#78909C', data: [], min: 0, max: 360, tickAmount: 4, decimals: 0 },
                { id: 'chart-ambiente-temperatura', name: 'Temperatura',          unit: '°C',   color: '#FF7043', data: [], decimals: 1 },
                { id: 'chart-ambiente-humedad',     name: 'Humedad',              unit: '%',    color: '#29B6F6', data: [], min: 0, max: 100, decimals: 0 },
                { id: 'chart-ambiente-sensacion',   name: 'Sensación Térmica',    unit: '°C',   color: '#af3009', data: [], decimals: 1 },
                { id: 'chart-ambiente-presion',     name: 'Presión barométrica',  unit: 'hPa',  color: '#7E57C2', data: [], decimals: 1 },
                { id: 'chart-ambiente-luz',         name: 'Luz',                  unit: 'W/m²', color: '#FFA726', data: [], decimals: 0 },
                { id: 'chart-ambiente-uv',          name: 'Índice UV',            unit: 'UV',   color: '#EC407A', data: [], min: 0, max: 12, decimals: 1 },
                { id: 'chart-ambiente-lluvia',      name: 'Lluvia',               unit: '%',    color: '#26A69A', data: [], min: 0, max: 100, decimals: 0 }
            ],
            suelo: [
                { id: 'chart-suelo-humedad',     name: 'Humedad del suelo',     unit: '%',  color: '#0B7A5C', data: [], min: 0,  max: 100, decimals: 0 },
                { id: 'chart-suelo-temperatura', name: 'Temperatura del suelo', unit: '°C', color: '#FF7043', data: [], min: 15, max: 35,  decimals: 1 }
            ],
            gases: [
                { id: 'chart-gases-h2s',      name: 'Sulfuro de hidrógeno (H2S)', unit: 'ppm', color: '#26A69A', data: [], decimals: 1 },
                { id: 'chart-gases-nh3',      name: 'Amoniaco (NH3)',             unit: 'ppm', color: '#FFA726', data: [], decimals: 1 },
                { id: 'chart-gases-co',       name: 'Monóxido de carbono (CO)',   unit: 'ppm', color: '#EF5350', data: [], decimals: 0 },
                { id: 'chart-gases-o2',       name: 'Oxígeno (O)',                unit: 'ppm', color: '#42A5F5', data: [], decimals: 1 },
                { id: 'chart-gases-lel',      name: 'LEL',                        unit: 'ppb', color: '#AB47BC', data: [], decimals: 0 },
                { id: 'chart-gases-temp_nh3', name: 'Temperatura NH3',            unit: '°C',  color: '#FF7043', data: [], decimals: 1 },
                { id: 'chart-gases-hum_nh3',  name: 'Humedad NH3',                unit: '%',   color: '#29B6F6', data: [], min: 0, max: 100, decimals: 0 }
            ]
        };

        function buildChartOptions(cfg, dark) {
            const fmt = (v) => (v === undefined || v === null) ? '--' : Number(v).toFixed(cfg.decimals);
            return {
                chart: {
                    height: 280,
                    type: 'line',
                    toolbar: {
                        show: true,
                        tools: { download: true, selection: false, zoom: true, zoomin: true, zoomout: true, pan: true, reset: true }
                    },
                    animations: { enabled: true, easing: 'easeinout', speed: 700 }
                },
                theme: { mode: dark ? 'dark' : 'light' },
                colors: [cfg.color],
                series: [{ name: cfg.name, data: cfg.data }],
                stroke: { curve: 'smooth', width: 2.5 },
                markers: { size: 3.5, strokeWidth: 1.5, hover: { size: 6 } },
                grid: {
                    borderColor: dark ? '#23334D' : '#EEF4F2',
                    strokeDashArray: 4,
                    padding: { left: 15, right: 15 }
                },
                legend: { show: false },
                xaxis: {
                    type: 'datetime',
                    labels: {
                        datetimeUTC: false,
                        style: {
                            fontFamily: 'Open Sans, sans-serif',
                            fontSize: '11px',
                            colors: dark ? '#94A3B8' : '#627D98'
                        },
                        formatter: function (value) {
                            const d = new Date(value);
                            const hh = String(d.getHours()).padStart(2, '0');
                            const mm = String(d.getMinutes()).padStart(2, '0');
                            return `${hh}:${mm}`;
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: function (value) {
                            const d = new Date(value);
                            const hh = String(d.getHours()).padStart(2, '0');
                            const mm = String(d.getMinutes()).padStart(2, '0');
                            return `${hh}:${mm}`;
                        }
                    }
                },
                yaxis: {
                    title: { text: cfg.name + ' (' + cfg.unit + ')', style: { color: cfg.color, fontSize: '11px' } },
                    min: cfg.min,
                    max: cfg.max,
                    tickAmount: cfg.tickAmount,
                    labels: { style: { colors: cfg.color }, formatter: fmt }
                },
                tooltip: {
                    theme: dark ? 'dark' : 'light',
                    style: { fontSize: '12px', fontFamily: 'Open Sans, sans-serif' },
                    y: { formatter: (v) => (v === undefined || v === null) ? '--' : fmt(v) + ' ' + cfg.unit }
                }
            };
        }

        // Crear gráficas
        const dashboardCharts = { ambiente: [], suelo: [], gases: [] };
        window.chartById = {}; 
        
        Object.keys(chartConfigs).forEach(function(group) {
            chartConfigs[group].forEach(function(cfg) {
                const el = document.getElementById(cfg.id);
                if (!el) return;
                const chart = new ApexCharts(el, buildChartOptions(cfg, isCurrentlyDark));
                chart.render();
                dashboardCharts[group].push(chart);
                window.chartById[cfg.id] = chart;
            });
        });
        const allCharts = [].concat(dashboardCharts.ambiente, dashboardCharts.suelo, dashboardCharts.gases);
        window.dashboardCharts = dashboardCharts;

        // Actualización dinámica (API legacy por si se necesita)
        function updateGroup(group, categories, seriesData) {
            dashboardCharts[group].forEach(function(chart, i) {
                if (categories) chart.updateOptions({ xaxis: { categories: categories } }, false, true);
                if (seriesData && seriesData[i] !== undefined) {
                    const s = seriesData[i];
                    chart.updateSeries([Array.isArray(s) ? { data: s } : s]);
                }
            });
        }
        window.updateAmbienteChart = function(c, s) { updateGroup('ambiente', c, s); };
        window.updateSueloChart   = function(c, s) { updateGroup('suelo',    c, s); };
        window.updateGasesChart   = function(c, s) { updateGroup('gases',    c, s); };

        // Redimensionar al cambiar de pestaña
        if (typeof $ !== 'undefined') {
            $('a[data-toggle="pill"]').on('shown.bs.tab', function() {
                setTimeout(function() {
                    allCharts.forEach(function(chart) { chart.windowResizeHandler(); });
                    window.dispatchEvent(new Event('resize'));
                }, 60);
            });
        }

        // ---------------------------------------------------------
        // SIDEBAR
        // ---------------------------------------------------------
        const dashContainer  = document.querySelector('.cv-dashboard');
        const sidebarToggle  = document.getElementById('cvSidebarToggle');
        const sidebarBackdrop = document.getElementById('cvSidebarBackdrop');

        function triggerChartResize() {
            setTimeout(function() {
                allCharts.forEach(chart => chart.windowResizeHandler());
                window.dispatchEvent(new Event('resize'));
            }, 360);
        }

        function toggleSidebar() {
            if (window.innerWidth < 992) {
                dashContainer.classList.toggle('cv-sidebar-open-mobile');
                if (dashContainer.classList.contains('cv-sidebar-open-mobile')) {
                    document.body.classList.add('cv-sidebar-is-open');
                } else {
                    document.body.classList.remove('cv-sidebar-is-open');
                }
            } else {
                dashContainer.classList.toggle('cv-sidebar-collapsed');
                const isCollapsed = dashContainer.classList.contains('cv-sidebar-collapsed');
                localStorage.setItem('cv_sidebar_collapsed', isCollapsed ? '1' : '0');
            }
            triggerChartResize();
        }

        function closeSidebar() {
            if (window.innerWidth < 992) {
                dashContainer.classList.remove('cv-sidebar-open-mobile');
                document.body.classList.remove('cv-sidebar-is-open');
            } else {
                dashContainer.classList.add('cv-sidebar-collapsed');
                localStorage.setItem('cv_sidebar_collapsed', '1');
            }
            triggerChartResize();
        }

        if (sidebarToggle)   sidebarToggle.addEventListener('click', toggleSidebar);
        if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebar);

        dashContainer.classList.remove('cv-sidebar-collapsed');

        // ---------------------------------------------------------
        // FILTROS (UI + disparo de eventos; lógica en campañas.js)
        // ---------------------------------------------------------
        const filterBtn       = document.getElementById('cvSidebarFilterBtn');
        const filterPanel     = document.getElementById('cvSidebarFiltersPanel');
        const filterCloseBtn  = document.getElementById('cvFiltersCloseBtn');
        const btnApplyFilters = document.getElementById('btn-apply-filters');
        const btnResetFilters = document.getElementById('btn-reset-filters');
        const filterDateFrom  = document.getElementById('filter-date-from');
        const filterDateTo    = document.getElementById('filter-date-to');
        const filterStation   = document.getElementById('filter-station');
        const filterCity      = document.getElementById('filter-city');
        const filterDot       = document.getElementById('cvFilterDot');
        const filterFeedback  = document.getElementById('cvFiltersFeedback');
        const filterSummary   = document.getElementById('cvFiltersSummary');

        function toggleFilterPanel() {
            if (!filterPanel) return;
            const isOpen = filterPanel.classList.toggle('cv-panel-open');
            if (filterBtn) filterBtn.classList.toggle('active', isOpen);
        }

        function closeFilterPanel() {
            if (!filterPanel) return;
            filterPanel.classList.remove('cv-panel-open');
            if (filterBtn) filterBtn.classList.remove('active');
        }

        if (filterBtn)      filterBtn.addEventListener('click', toggleFilterPanel);
        if (filterCloseBtn) filterCloseBtn.addEventListener('click', closeFilterPanel);

        function updateFilterSummary() {
            const hasDateFrom = filterDateFrom && filterDateFrom.value.trim() !== '';
            const hasDateTo   = filterDateTo   && filterDateTo.value.trim() !== '';
            const hasStation  = filterStation  && filterStation.value.trim() !== '';
            const hasCity     = filterCity     && filterCity.value.trim() !== '';

            const isActive = hasDateFrom || hasDateTo || hasStation || hasCity;

            if (filterDot) filterDot.style.display = isActive ? 'block' : 'none';

            if (filterFeedback && filterSummary) {
                if (isActive) {
                    let tags = [];
                    if (hasDateFrom && hasDateTo)      tags.push(`${filterDateFrom.value} al ${filterDateTo.value}`);
                    else if (hasDateFrom)              tags.push(`Desde ${filterDateFrom.value}`);
                    else if (hasDateTo)                tags.push(`Hasta ${filterDateTo.value}`);
                    if (hasStation) tags.push(`Estación ${filterStation.value}`);
                    if (hasCity)    tags.push(filterCity.value);

                    filterSummary.innerHTML = `<i class="fas fa-filter mr-1 text-primary"></i> ${tags.join(' • ')}`;
                    filterFeedback.style.display = 'block';
                } else {
                    filterFeedback.style.display = 'none';
                }
            }

            return {
                dateFrom: filterDateFrom ? filterDateFrom.value : '',
                dateTo:   filterDateTo   ? filterDateTo.value   : '',
                station:  filterStation  ? filterStation.value  : '',
                city:     filterCity     ? filterCity.value     : ''
            };
        }

        if (btnApplyFilters) {
            btnApplyFilters.addEventListener('click', function() {
                updateFilterSummary();
                const filters = {
                    dateFrom: filterDateFrom ? filterDateFrom.value : '',
                    dateTo:   filterDateTo   ? filterDateTo.value   : '',
                    station:  filterStation  ? filterStation.value  : '',
                    city:     filterCity     ? filterCity.value     : ''
                };
                // campañas.js escucha este evento y aplica los filtros
                window.dispatchEvent(new CustomEvent('cv:filters-applied', { detail: filters }));
            });
        }

        if (btnResetFilters) {
            btnResetFilters.addEventListener('click', function() {
                if (filterDateFrom) filterDateFrom.value = '';
                if (filterDateTo)   filterDateTo.value   = '';
                if (filterStation)  filterStation.value  = '';
                if (filterCity)     filterCity.value     = '';
                updateFilterSummary();
                window.dispatchEvent(new CustomEvent('cv:filters-cleared'));
            });
        }

        // ---------------------------------------------------------
        // TEMA OSCURO / CLARO
        // ---------------------------------------------------------
        const themeBtn   = document.getElementById('cvThemeToggle');
        const themeIcon  = document.getElementById('cvThemeIcon');
        const themeLabel = document.getElementById('cvThemeModeLabel');
        const themeSub   = document.getElementById('cvThemeModeSub');

        function setDarkMode(isDark) {
            const dash = document.querySelector('.cv-dashboard');

            if (isDark) {
                document.documentElement.classList.add('cv-dark-mode');
                document.body.classList.add('cv-dark-mode');
                if (dash) dash.classList.add('cv-dark');
                localStorage.setItem('cv_theme', 'dark');

                if (themeIcon)  themeIcon.className = 'fas fa-sun';
                if (themeLabel) themeLabel.innerText = 'Modo';
                if (themeSub)   themeSub.innerText   = 'Claro';

                if (window.dashboardCharts) {
                    allCharts.forEach(chart => {
                        if (chart) {
                            chart.updateOptions({
                                theme: { mode: 'dark' },
                                grid: { borderColor: '#23334D' },
                                xaxis: { labels: { style: { colors: '#94A3B8' } } }
                            }, false, false);
                        }
                    });
                }
            } else {
                document.documentElement.classList.remove('cv-dark-mode');
                document.body.classList.remove('cv-dark-mode');
                if (dash) dash.classList.remove('cv-dark');
                localStorage.setItem('cv_theme', 'light');

                if (themeIcon)  themeIcon.className = 'fas fa-moon';
                if (themeLabel) themeLabel.innerText = 'Modo';
                if (themeSub)   themeSub.innerText   = 'Oscuro';

                if (window.dashboardCharts) {
                    allCharts.forEach(chart => {
                        if (chart) {
                            chart.updateOptions({
                                theme: { mode: 'light' },
                                grid: { borderColor: '#EEF4F2' },
                                xaxis: { labels: { style: { colors: '#627D98' } } }
                            }, false, false);
                        }
                    });
                }
            }
        }

        const currentSavedTheme = localStorage.getItem('cv_theme');
        const sysPrefersDark    = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const initialIsDark     = (currentSavedTheme === 'dark') || (!currentSavedTheme && sysPrefersDark);
        setDarkMode(initialIsDark);

        if (themeBtn) {
            themeBtn.addEventListener('click', function() {
                setDarkMode(!document.body.classList.contains('cv-dark-mode'));
            });
        }
    });
    </script>

</body>

</html>