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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/campañas.js"></script>
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
                        <a class="dropdown-item" href="../campañas">CAMPAÑAS DE MONITOREO</a>
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
            <div class="row no-gutters">
                <!-- SIDEBAR -->
                <aside class="col-12 col-md-3 col-lg-2 cv-sidebar">
                    <div class="cv-sidebar-heading">
                        <i class="fas fa-folder-open text-muted mr-1"></i>
                        <span>Campañas</span>
                    </div>
                    <div class="cv-sidebar-nav nav flex-column" role="tablist" id="file-container">
                        
                    </div>
                </aside>

                <!-- MAIN CONTENT -->
                <main class="col-12 col-md-9 col-lg-10 cv-main">
                    <!-- HEADER -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start mb-4">
                        <div>
                            <h1 class="cv-title">DASHBOARD</h1>
                            <p class="cv-subtitle mb-0">Monitoreo ambiental de proyecto Ecosur</p>
                        </div>
                        <div class="cv-header-actions mt-3 mt-md-0 d-flex flex-wrap gap-2">
                            <button class="cv-btn-download mr-2" type="button">
                                <i class="fas fa-download"></i>
                                <div>
                                    <div>Descargar</div>
                                    <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase;">CSV</div>
                                </div>
                            </button>
                            <button class="cv-btn-download" type="button">
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
                                <i class="fas fa-wind"></i> Gases
                            </a>
                        </li>
                    </ul>

                    <!-- TABS CONTENT -->
                    <div class="tab-content" id="cvDashboardContent">

                        <!-- TAB 1: AMBIENTE (8 Cards) -->
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
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>3%
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="wind_ms-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="wind_ms-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Óptimo</span>
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

                                        <!-- Rueda / Dial de Dirección del Viento (Soporta datos dinámicos) -->
                                        <div class="cv-wind-dial-wrap" id="cv-wind-wheel" style="--cv-wind-deg: 330deg;">
                                            <svg class="cv-wind-dial-svg" viewBox="0 0 160 160">
                                                <!-- Anillo Circular Exterior -->
                                                <circle cx="80" cy="80" r="70" class="cv-compass-ring" />
                                                
                                                <!-- Ticks de división cada 30 grados -->
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

                                                <!-- Números de los grados (0° a 330°) -->
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

                                                <!-- Grupo de Agujas / Punteros Giratorios (Dinámico) -->
                                                <g class="cv-wind-pointer-group" id="cv-wind-pointer" style="transform: rotate(var(--cv-wind-deg, 330deg));">
                                                    <!-- Flecha principal sólida -->
                                                    <polygon points="80,14 74,3 80,6 86,3" class="cv-pointer-primary" />
                                                    <!-- Flecha secundaria / racha de viento -->
                                                    <polygon points="80,14 74,3 80,6 86,3" class="cv-pointer-ghost" transform="rotate(-15 80 80)" />
                                                </g>
                                            </svg>

                                            <!-- Información Central (Dinámica) -->
                                            <div class="cv-wind-dial-center">
                                                <span class="cv-wind-realtime-label">Real-Time</span>
                                                <div class="cv-wind-main-val">
                                                    <span class="cv-wind-deg-num" id="wind_dir_10_mean-value">?</span>
                                                    <span class="cv-wind-deg-sym">°</span>
                                                </div>
                                                <div class="cv-wind-cardinal-badge">
                                                    <span id="cv-wind-cardinal">NNW</span>
                                                    <i class="fas fa-info-circle"></i>
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
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-neutral">Estable</span>
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
                                            <span class="cv-card-value" id="out_feels_like_c-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>1.2°
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="out_feels_like_c-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="out_feels_like_c-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Normal</span>
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
                                            <span class="cv-card-value" id="a_hum-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-down">
                                                <i class="fas fa-chart-line mr-1"></i>2%
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="a_hum-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="a_hum-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Normal</span>
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
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>4 hPa
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="pres_rel_hpa-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="pres_rel_hpa-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-neutral">Estable</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 6: Luz -->
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
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-down">
                                                <i class="fas fa-chart-line mr-1"></i>12%
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="solar_rad_wm2-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="solar_rad_wm2-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Normal</span>
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
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>Moderado
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="uv_index-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="uv_index-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-warning">Moderado</span>
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
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>5%
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="rain_rate_mmhr-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="rain_rate_mmhr-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Normal</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gráfica Multivariable: Ambiente (Opción 2) -->
                                <div class="col-12 mt-4" data-aos="fade-up" data-aos-delay="100">
                                    <div class="cv-chart-card">
                                        <div class="cv-chart-header">
                                            <div>
                                                <h4 class="cv-chart-title">
                                                    <i class="fas fa-chart-line mr-2"></i>Gráfica de variables - Ambiente
                                                </h4>
                                                <p class="cv-chart-subtitle">
                                                    Haz clic en las etiquetas de abajo para activar u ocultar variables.
                                                </p>
                                            </div>
                                            <span class="cv-chart-badge">
                                                <i class="fas fa-sliders-h mr-1"></i>Series interactivas
                                            </span>
                                        </div>
                                        <div id="chart-ambiente" class="cv-chart-canvas"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: SUELO (2 Cards) -->
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
                                            <span class="cv-card-value" id="out_temp_c-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-neutral">
                                                <i class="fas fa-minus mr-1"></i>Estable
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="out_temp_c-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="out_temp_c-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-neutral">Estable</span>
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
                                            <span class="cv-card-value" id="out_hum-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>4%
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="out_hum-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="out_hum-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Óptimo</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Gráfica Multivariable: Suelo (Opción 2) -->
                                <div class="col-12 mt-4" data-aos="fade-up" data-aos-delay="100">
                                    <div class="cv-chart-card">
                                        <div class="cv-chart-header">
                                            <div>
                                                <h4 class="cv-chart-title">
                                                    <i class="fas fa-chart-area mr-2"></i>Gráfica de variables - Suelo
                                                </h4>
                                                <p class="cv-chart-subtitle">
                                                    Haz clic en las etiquetas de abajo para activar u ocultar variables.
                                                </p>
                                            </div>
                                            <span class="cv-chart-badge">
                                                <i class="fas fa-sliders-h mr-1"></i>Series interactivas
                                            </span>
                                        </div>
                                        <div id="chart-suelo" class="cv-chart-canvas"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: GASES (6 Cards with Status Dots) -->
                        <div class="tab-pane fade" id="tab-gases" role="tabpanel" aria-labelledby="tab-gases-link">
                            <div class="row">
                                <!-- Card 1: Amoniaco -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <span class="cv-status-dot cv-status-safe" title="Nivel seguro"></span>
                                                <i class="fas fa-flask cv-card-icon"></i>
                                                Amoniaco
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="nh3-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-safe">
                                                <i class="fas fa-shield-alt mr-1"></i>Seguro
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="nh3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="nh3-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Nivel seguro</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Temperatura -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <span class="cv-status-dot cv-status-warning" title="Precaución leve"></span>
                                                <i class="fas fa-thermometer-half cv-card-icon"></i>
                                                Temperatura
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="temp_nh3-value">?</span>
                                            <span class="cv-card-unit">°C</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>0.3
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="temp_nh3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="temp_nh3-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-warning">Precaución leve</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Humedad -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <span class="cv-status-dot cv-status-safe" title="Nivel normal"></span>
                                                <i class="fas fa-tint cv-card-icon"></i>
                                                Humedad
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="hum_nh3-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-down">
                                                <i class="fas fa-chart-line mr-1"></i>8 %
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="hum_nh3-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="hum_nh3-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Nivel normal</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 4: acido sulfhídrico -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <span class="cv-status-dot cv-status-safe" title="Nivel seguro"></span>
                                                <i class="fas fa-droplet cv-card-icon"></i>
                                                Ácido sulfhídrico
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="h2s-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-neutral">
                                                <i class="fas fa-minus mr-1"></i>Estable
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="h2s-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="h2s-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value">Nivel seguro</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 5: oxigeno -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <span class="cv-status-dot cv-status-warning" title="Precaución"></span>
                                                <i class="fas fa-atom cv-card-icon"></i>
                                                Oxígeno
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="o2-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>15%
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="o2-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="o2-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-warning">Precaución</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card 6: Monoxido carbono -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <span class="cv-status-dot cv-status-warning" title="Precaución"></span>
                                                <i class="fas fa-triangle-exclamation cv-card-icon"></i>
                                                Monóxido de carbono
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="co-value">?</span>
                                            <span class="cv-card-unit">ppm</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>15 ppm
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="co-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="co-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-warning">Precaución</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 7: LEL -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="cv-metric-card">
                                        <div class="cv-card-header">
                                            <span class="cv-card-title">
                                                <span class="cv-status-dot cv-status-warning" title="Precaución"></span>
                                                <i class="fas fa-fire cv-card-icon"></i>
                                                Limite inferior de explosividad
                                            </span>
                                        </div>
                                        <div class="cv-card-main-val">
                                            <span class="cv-card-value" id="lel-value">?</span>
                                            <span class="cv-card-unit">%</span>
                                        </div>
                                        <div class="cv-card-trend">
                                            <span class="cv-trend-val cv-trend-up">
                                                <i class="fas fa-chart-line mr-1"></i>15 %
                                            </span>
                                        </div>
                                        <div class="cv-card-range">
                                            <span class="cv-range-item cv-range-high">
                                                <i class="fas fa-arrow-up mr-1" id="lel-max"></i>
                                            </span>
                                            <span class="cv-range-item cv-range-low">
                                                <i class="fas fa-arrow-down mr-1" id="lel-min"></i>
                                            </span>
                                        </div>
                                        <div class="cv-card-footer-info">
                                            <span class="cv-footer-label">Estado <i class="fas fa-info-circle"></i></span>
                                            <span class="cv-footer-value cv-status-warning">Precaución</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gráfica Multivariable: Gases (Opción 2) -->
                                <div class="col-12 mt-4" data-aos="fade-up" data-aos-delay="100">
                                    <div class="cv-chart-card">
                                        <div class="cv-chart-header">
                                            <div>
                                                <h4 class="cv-chart-title">
                                                    <i class="fas fa-chart-bar mr-2"></i>Gráfica de variables - Concentración de Gases
                                                </h4>
                                                <p class="cv-chart-subtitle">
                                                    Haz clic en las etiquetas de abajo para activar u ocultar variables.
                                                </p>
                                            </div>
                                            <span class="cv-chart-badge">
                                                <i class="fas fa-sliders-h mr-1"></i>Series interactivas
                                            </span>
                                        </div>
                                        <div id="chart-gases" class="cv-chart-canvas"></div>
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

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/morphext.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/validator.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1200,
        once: true,
        offset: 120
    });

    /**
     * Helper global para actualizar la dirección del viento de forma dinámica.
     * Ejemplo de uso:
     *   setWindDirection(330);        // Rota la aguja y calcula automáticamente "NNW"
     *   setWindDirection(90, 'E');    // O pasando el punto cardinal directamente
     */
    window.setWindDirection = function(degrees, cardinalName) {
        degrees = parseFloat(degrees) || 0;
        const normalized = ((degrees % 360) + 360) % 360;
        const CARDINALS = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'];
        const cardinalIndex = Math.round(normalized / 22.5) % 16;
        const cardinal = cardinalName || CARDINALS[cardinalIndex];

        const wheel = document.getElementById('cv-wind-wheel');
        if (wheel) {
            wheel.style.setProperty('--cv-wind-deg', normalized + 'deg');
        }
        const degEl = document.getElementById('wind_dir_10_mean-value');
        if (degEl) {
            degEl.innerText = Math.round(normalized);
        }
        const cardEl = document.getElementById('cv-wind-cardinal');
        if (cardEl) {
            cardEl.innerText = cardinal;
        }
    };

    /**
     * =========================================================================
     * INICIALIZACIÓN DE GRÁFICAS MULTIVARIABLES (Opción 2)
     * ApexCharts con toggle interactivo desde la leyenda.
     * =========================================================================
     */
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ApexCharts === 'undefined') {
            console.warn('ApexCharts no está disponible.');
            return;
        }

        const defaultHours = ['06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00'];

        // Configuración común
        const baseOptions = {
            chart: {
                height: 380,
                type: 'line',
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        selection: false,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true
                    }
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 700
                }
            },
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            markers: {
                size: 3.5,
                strokeWidth: 1.5,
                hover: {
                    size: 6
                }
            },
            grid: {
                borderColor: '#EEF4F2',
                strokeDashArray: 4,
                padding: {
                    left: 15,
                    right: 15
                }
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '12px',
                fontFamily: 'Montserrat, sans-serif',
                fontWeight: 600,
                itemMargin: { horizontal: 8, vertical: 6 },
                markers: { radius: 12, width: 10, height: 10 },
                onItemClick: {
                    toggleDataSeries: true
                }
            }
        };

        // -------------------------------------------------------------
        // 1. Gráfica Multivariable: AMBIENTE (8 Series)
        // -------------------------------------------------------------
        const ambienteEl = document.getElementById('chart-ambiente');
        let chartAmbiente = null;
        if (ambienteEl) {
            const ambienteUnits = [' mph', '°', '°C', '%', ' hPa', ' W/m²', ' UV', '%'];
            const optionsAmbiente = {
                ...baseOptions,
                colors: [
                    '#0B7A5C', // Viento
                    '#78909C', // Dirección viento
                    '#FF7043', // Temperatura
                    '#29B6F6', // Humedad
                    '#7E57C2', // Presión
                    '#FFA726', // Luz
                    '#EC407A', // UV
                    '#26A69A'  // Lluvia
                ],
                series: [
                    { name: 'Velocidad del viento', data: [4.2, 5.0, 6.8, 7.0, 7.5, 6.2, 5.1, 3.8] },
                    { name: 'Dirección del viento', data: [310, 315, 325, 330, 335, 320, 310, 300] },
                    { name: 'Temperatura', data: [19.5, 21.2, 24.0, 26.8, 26.0, 24.5, 22.1, 20.4] },
                    { name: 'Humedad', data: [88, 85, 78, 70, 72, 79, 82, 86] },
                    { name: 'Presión barométrica', data: [1014, 1013.8, 1013.2, 1012.5, 1012.8, 1013.0, 1013.5, 1014.0] },
                    { name: 'Radiación Solar', data: [45, 150, 280, 320, 305, 180, 40, 5] },
                    { name: 'Índice UV', data: [0.5, 2.0, 4.8, 6.0, 5.4, 3.1, 0.8, 0.0] },
                    { name: 'Lluvia', data: [0, 0, 5, 20, 30, 15, 0, 0] }
                ],
                xaxis: {
                    categories: defaultHours,
                    labels: { style: { fontFamily: 'Open Sans, sans-serif', fontSize: '11px', colors: '#627D98' } }
                },
                yaxis: [
                    {
                        seriesName: 'Velocidad del viento',
                        title: { text: 'Viento (mph)', style: { color: '#0B7A5C', fontSize: '11px' } },
                        labels: { style: { colors: '#0B7A5C' }, formatter: (v) => v ? v.toFixed(1) : '' }
                    },
                    { seriesName: 'Dirección del viento', show: false, min: 0, max: 360 },
                    {
                        seriesName: 'Temperatura',
                        opposite: true,
                        title: { text: 'Temp (°C)', style: { color: '#FF7043', fontSize: '11px' } },
                        labels: { style: { colors: '#FF7043' }, formatter: (v) => v ? v.toFixed(1) + '°C' : '' }
                    },
                    { seriesName: 'Humedad', show: false, min: 0, max: 100 },
                    { seriesName: 'Presión barométrica', show: false },
                    { seriesName: 'Radiación Solar', show: false },
                    { seriesName: 'Índice UV', show: false, min: 0, max: 12 },
                    { seriesName: 'Lluvia', show: false, min: 0, max: 100 }
                ],
                tooltip: {
                    shared: true,
                    intersect: false,
                    theme: 'light',
                    style: { fontSize: '12px', fontFamily: 'Open Sans, sans-serif' },
                    y: {
                        formatter: function(val, { seriesIndex }) {
                            if (val === undefined || val === null) return '--';
                            return val + (ambienteUnits[seriesIndex] || '');
                        }
                    }
                }
            };
            chartAmbiente = new ApexCharts(ambienteEl, optionsAmbiente);
            chartAmbiente.render();
        }

        // -------------------------------------------------------------
        // 2. Gráfica Multivariable: SUELO (2 Series)
        // -------------------------------------------------------------
        const sueloEl = document.getElementById('chart-suelo');
        let chartSuelo = null;
        if (sueloEl) {
            const sueloUnits = ['%', '°C'];
            const optionsSuelo = {
                ...baseOptions,
                colors: ['#0B7A5C', '#FF7043'],
                series: [
                    { name: 'Humedad del suelo', data: [42, 40, 39, 38, 38, 37, 38, 39] },
                    { name: 'Temperatura del suelo', data: [23, 24, 25.5, 27, 27.2, 26.5, 25, 24] }
                ],
                xaxis: {
                    categories: defaultHours,
                    labels: { style: { fontFamily: 'Open Sans, sans-serif', fontSize: '11px', colors: '#627D98' } }
                },
                yaxis: [
                    {
                        seriesName: 'Humedad del suelo',
                        title: { text: 'Humedad (%)', style: { color: '#0B7A5C', fontSize: '11px' } },
                        min: 0,
                        max: 100,
                        labels: { style: { colors: '#0B7A5C' }, formatter: (v) => v ? v + '%' : '' }
                    },
                    {
                        seriesName: 'Temperatura del suelo',
                        opposite: true,
                        title: { text: 'Temperatura (°C)', style: { color: '#FF7043', fontSize: '11px' } },
                        min: 15,
                        max: 35,
                        labels: { style: { colors: '#FF7043' }, formatter: (v) => v ? v + '°C' : '' }
                    }
                ],
                tooltip: {
                    shared: true,
                    intersect: false,
                    theme: 'light',
                    style: { fontSize: '12px', fontFamily: 'Open Sans, sans-serif' },
                    y: {
                        formatter: function(val, { seriesIndex }) {
                            if (val === undefined || val === null) return '--';
                            return val + (sueloUnits[seriesIndex] || '');
                        }
                    }
                }
            };
            chartSuelo = new ApexCharts(sueloEl, optionsSuelo);
            chartSuelo.render();
        }

        // -------------------------------------------------------------
        // 3. Gráfica Multivariable: GASES (5 Series)
        // -------------------------------------------------------------
        const gasesEl = document.getElementById('chart-gases');
        let chartGases = null;
        if (gasesEl) {
            const gasesUnits = [' ppm', ' ppm', ' ppm', ' ppm', ' ppb'];
            const optionsGases = {
                ...baseOptions,
                colors: [
                    '#26A69A', // H2S
                    '#FFA726', // NH3
                    '#EF5350', // CO
                    '#42A5F5', // O2
                    '#AB47BC'  // LEL
                ],
                series: [
                    { name: 'Sulfuro de hidrógeno (H2S)', data: [0.4, 0.5, 0.7, 0.8, 0.8, 0.7, 0.6, 0.5] },
                    { name: 'Amoniaco (NH3)', data: [1.4, 1.6, 1.9, 2.1, 2.0, 1.8, 1.7, 1.5] },
                    { name: 'Monóxido de carbono (CO)', data: [390, 405, 415, 420, 418, 410, 400, 395] },
                    { name: 'Oxígeno (O)', data: [1.7, 1.8, 1.8, 1.9, 1.9, 1.8, 1.8, 1.7] },
                    { name: 'LEL', data: [95, 105, 115, 120, 118, 110, 100, 95] }
                ],
                xaxis: {
                    categories: defaultHours,
                    labels: { style: { fontFamily: 'Open Sans, sans-serif', fontSize: '11px', colors: '#627D98' } }
                },
                yaxis: [
                    {
                        seriesName: 'Sulfuro de hidrógeno (H2S)',
                        title: { text: 'H2S / NH3 / O (ppm)', style: { color: '#26A69A', fontSize: '11px' } },
                        labels: { style: { colors: '#26A69A' }, formatter: (v) => v ? v.toFixed(1) + ' ppm' : '' }
                    },
                    { seriesName: 'Amoniaco (NH3)', show: false },
                    {
                        seriesName: 'Monóxido de carbono (CO)',
                        opposite: true,
                        title: { text: 'CO (ppm) / LEL (ppb)', style: { color: '#EF5350', fontSize: '11px' } },
                        labels: { style: { colors: '#EF5350' }, formatter: (v) => v ? Math.round(v) : '' }
                    },
                    { seriesName: 'Oxígeno (O)', show: false },
                    { seriesName: 'LEL', show: false }
                ],
                tooltip: {
                    shared: true,
                    intersect: false,
                    theme: 'light',
                    style: { fontSize: '12px', fontFamily: 'Open Sans, sans-serif' },
                    y: {
                        formatter: function(val, { seriesIndex }) {
                            if (val === undefined || val === null) return '--';
                            return val + (gasesUnits[seriesIndex] || '');
                        }
                    }
                }
            };
            chartGases = new ApexCharts(gasesEl, optionsGases);
            chartGases.render();
        }

        // Almacenar referencias globales para interactividad o carga de CSV dinámico
        window.dashboardCharts = {
            ambiente: chartAmbiente,
            suelo: chartSuelo,
            gases: chartGases
        };

        // Métodos globales de actualización dinámica
        window.updateAmbienteChart = function(categories, seriesData) {
            if (chartAmbiente) {
                if (categories) chartAmbiente.updateOptions({ xaxis: { categories } }, false, true);
                if (seriesData) chartAmbiente.updateSeries(seriesData);
            }
        };

        window.updateSueloChart = function(categories, seriesData) {
            if (chartSuelo) {
                if (categories) chartSuelo.updateOptions({ xaxis: { categories } }, false, true);
                if (seriesData) chartSuelo.updateSeries(seriesData);
            }
        };

        window.updateGasesChart = function(categories, seriesData) {
            if (chartGases) {
                if (categories) chartGases.updateOptions({ xaxis: { categories } }, false, true);
                if (seriesData) chartGases.updateSeries(seriesData);
            }
        };

        // Redimensionar automáticamente las gráficas cuando el usuario cambia de pestaña en Bootstrap
        if (typeof $ !== 'undefined') {
            $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
                setTimeout(function() {
                    if (chartAmbiente) chartAmbiente.windowResizeHandler();
                    if (chartSuelo) chartSuelo.windowResizeHandler();
                    if (chartGases) chartGases.windowResizeHandler();
                    window.dispatchEvent(new Event('resize'));
                }, 60);
            });
        }
    });
    </script>

</body>

</html>