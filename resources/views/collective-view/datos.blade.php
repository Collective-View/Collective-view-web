<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Collective View - ECOSUR">
    <meta name="description"
        content="Conjuntos de datos abiertos sobre sargazo utilizados por el proyecto Collective View para investigación, segmentación y clasificación mediante inteligencia artificial">

    <title>Datos Abiertos - Collective View</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/fontawesome-all.css" rel="stylesheet">
    <link href="../css/swiper.css" rel="stylesheet">
    <link href="../css/magnific-popup.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/collective-view.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="icon" href="../images/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark navbar-custom navbar-solid fixed-top">
        <a class="navbar-brand logo-container" href="../">
            <img src="../images/logo.png" alt="Collective View" class="navbar-logo">
            <span class="navbar-logo-text">
                Collective View
            </span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault"
            aria-expanded="false"
            aria-label="Toggle navigation">

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
                    <a class="nav-link active" href="../datos">
                        DATOS ABIERTOS
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../monitoreo">
                        CALIDAD DEL AIRE
                    </a>
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
                    <a class="nav-link dropdown-toggle"
                    href="#"
                    id="recursosDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                        RECURSOS
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown-custom" aria-labelledby="recursosDropdown">
                        <a class="dropdown-item" href="../referencias">REFERENCIAS</a>
                        <a class="dropdown-item" href="../videos">VIDEOS</a>
                        <a class="dropdown-item" href="../propiedad">PROPIEDAD INTELECTUAL</a>
                        <a class="dropdown-item" href="../medios">MEDIOS</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center" data-aos="fade-up">
                    <div class="section-title">
                        DATOS ABIERTOS
                    </div>

                    <h2>
                        Conjuntos de datos del proyecto
                    </h2>

                    <p class="p-heading">
                        Repositorios utilizados para investigación,
                        clasificación, segmentación y monitoreo del
                        sargazo en el Caribe mexicano mediante visión
                        computacional e inteligencia artificial.
                    </p>
                </div>
            </div>

            <div class="dataset-card" data-aos="fade-up">
                <div class="dataset-header">
                    <div class="dataset-icon">
                        <i class="fas fa-satellite"></i>
                    </div>

                    <div>

                        <h3 class="dataset-title">
                            Conjunto de datos de Aqua-MODIS
                        </h3>

                        <span class="dataset-subtitle">
                            Datos satelitales de reflectancia superficial
                        </span>
                    </div>
                </div>

                <p class="dataset-description">

                    Se generó una lista de píxeles de la zona costera
                    de Quintana Roo utilizando imágenes Aqua-MODIS
                    a resolución espacial de 1 km para detectar
                    presencia de sargazo.

                </p>

                <div class="dataset-table table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Fecha</th>
                                <td>2015 y 2018</td>
                            </tr>

                            <tr>
                                <th>Resolución</th>
                                <td>948 px a 1 KM</td>
                            </tr>

                            <tr>
                                <th>Archivos</th>
                                <td>
                                    80 PDS<br>
                                    42 con sargazo<br>
                                    38 sin sargazo
                                </td>
                            </tr>

                            <tr>
                                <th>Instancias</th>
                                <td>4515</td>
                            </tr>

                            <tr>
                                <th>Clases</th>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="dataset-carousel">
                    <button class="carousel-btn prev-btn" title="preview">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="carousel-track-container">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/Aqua-MODIS/a.png" alt="Aqua-MODIS">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/Aqua-MODIS/b.png" alt="Aqua-MODIS">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/Aqua-MODIS/c.png" alt="Aqua-MODIS">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/Aqua-MODIS/d.png" alt="Aqua-MODIS">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/Aqua-MODIS/e.png" alt="Aqua-MODIS">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/Aqua-MODIS/f.png" alt="Aqua-MODIS">
                            </div>
                        </div>
                    </div>

                    <button class="carousel-btn next-btn" title="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="collapse dataset-collapse" id="modisDetails">
                    <div class="dataset-expand">
                        <p class="dataset-description">
                            Para la selección de imágenes de franja Aqua-MODIS,
                            se utilizaron imágenes correspondientes a eventos
                            de llegada de sargazo a la zona costera del Caribe mexicano.

                            Se descargaron y procesaron 80 archivos PDS,
                            de los cuales 42 correspondieron a eventos con
                            presencia de sargazo y 38 a condiciones sin sargazo.

                            A partir de estos datos se generó un conjunto
                            de instancias basado en valores de reflectancia
                            superficial (rhos) obtenidos en diferentes
                            longitudes de onda espectrales.
                        </p>

                        <div class="dataset-table table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Número de instancias</th>
                                        <td>4515</td>
                                    </tr>

                                    <tr>
                                        <th>Número de clases</th>
                                        <td>2</td>
                                    </tr>

                                    <tr>
                                        <th>Instancias con sargazo</th>
                                        <td>2306</td>
                                    </tr>

                                    <tr>
                                        <th>Instancias sin sargazo</th>
                                        <td>2209</td>
                                    </tr>

                                    <tr>
                                        <th>Resolución espacial</th>
                                        <td>1 KM</td>
                                    </tr>

                                    <tr>
                                        <th>Periodo analizado</th>
                                        <td>2015 y 2018</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="spectral-box">

                            <h5>
                                Media de reflectancia superficial (rhos)
                            </h5>

                            <p>
                                Valores promedio de reflectancia superficial
                                utilizados para el análisis espectral del sargazo.
                                Las longitudes de onda están expresadas en nanómetros (nm).
                            </p>

                            <div class="table-responsive">
                                <table class="table spectral-table">

                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>412</th>
                                            <th>469</th>
                                            <th>555</th>
                                            <th>645</th>
                                            <th>859</th>
                                            <th>1240</th>
                                            <th>2130</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>
                                                Sin sargazo
                                            </td>

                                            <td>0.131517</td>
                                            <td>0.134890</td>
                                            <td>0.141123</td>
                                            <td>0.124477</td>
                                            <td>0.227052</td>
                                            <td>0.207291</td>
                                            <td>0.085164</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                Con sargazo
                                            </td>

                                            <td>0.114489</td>
                                            <td>0.120900</td>
                                            <td>0.133097</td>
                                            <td>0.116607</td>
                                            <td>0.247237</td>
                                            <td>0.233480</td>
                                            <td>0.084166</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dataset-buttons">
                    <button class="btn-outline-reg" type="button" data-toggle="collapse" data-target="#modisDetails"
                        aria-expanded="false">
                        Ver detalles
                    </button>
                    <a class="btn-solid-reg" href="https://peerj.com/articles/6842/" target="_blank"
                        rel="noopener noreferrer">
                        Leer artículo
                    </a>
                </div>
            </div>

            <div class="dataset-card" data-aos="fade-up">
                <div class="dataset-header">
                    <div class="dataset-icon">
                        <i class="fas fa-images"></i>
                    </div>

                    <div>
                        <h3 class="dataset-title">
                            Conjunto de imágenes geoetiquetadas
                        </h3>

                        <span class="dataset-subtitle">
                            Clasificación de imágenes con sargazo
                        </span>
                    </div>
                </div>

                <p class="dataset-description">
                    Conjunto de imágenes recopiladas para entrenar
                    redes neuronales enfocadas en clasificación de
                    playas con y sin presencia de sargazo.
                </p>

                <ul class="dataset-list">
                    <li>
                        1,720 imágenes geoetiquetadas de Collective View
                    </li>

                    <li>
                        600 imágenes históricas de Google
                    </li>

                    <li>
                        80 imágenes tomadas con cámara digital
                    </li>
                </ul>

                <div class="dataset-table table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Imágenes con sargazo</th>
                                <td>1200</td>
                            </tr>

                            <tr>
                                <th>Imágenes sin sargazo</th>
                                <td>1200</td>
                            </tr>

                            <tr>
                                <th>Formato</th>
                                <td>PNG y JPG</td>
                            </tr>

                            <tr>
                                <th>Fecha</th>
                                <td>2019 y 2020</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="dataset-carousel">
                    <button class="carousel-btn prev-btn" title="preview">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="carousel-track-container">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/geoetiquetados/1.png" alt="geoetiquetadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/geoetiquetados/2.png" alt="geoetiquetadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/geoetiquetados/3.png" alt="geoetiquetadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/geoetiquetados/4.png" alt="geoetiquetadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/geoetiquetados/5.png" alt="geoetiquetadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/geoetiquetados/6.png" alt="geoetiquetadas">
                            </div>
                        </div>
                    </div>

                    <button class="carousel-btn next-btn" title="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="dataset-buttons">
                    <a class="btn-solid-reg" href="https://peerj.com/articles/13537/" target="_blank"
                        rel="noopener noreferrer">
                        Leer artículo
                    </a>
                    <a class="btn-outline-reg" href="https://figshare.com/articles/dataset/sargassum_dataset_zip/13256174/5" target="_blank"
                        rel="noopener noreferrer">
                        Descargar dataset
                    </a>
                </div>
            </div>

            <div class="dataset-card" data-aos="fade-up">
                <div class="dataset-header">
                    <div class="dataset-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                    <div>
                        <h3 class="dataset-title">
                            Conjunto de imágenes de sargazo segmentadas en playa
                        </h3>

                        <span class="dataset-subtitle">
                            Segmentación semántica de sargazo
                        </span>
                    </div>
                </div>

                <p class="dataset-description">
                    Dataset creado para entrenar algoritmos de
                    segmentación semántica debido a la ausencia
                    de conjuntos de datos similares en literatura.
                </p>

                <div class="dataset-table table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Imágenes</th>
                                <td>1000</td>
                            </tr>

                            <tr>
                                <th>Clasificación</th>
                                <td>Sargazo, arena y otros</td>
                            </tr>

                            <tr>
                                <th>Formato</th>
                                <td>PNG y JPG</td>
                            </tr>

                            <tr>
                                <th>Fecha</th>
                                <td>2020</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="dataset-carousel">
                    <button class="carousel-btn prev-btn" title="preview">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="carousel-track-container">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/sargazo-segmentados/a-1.png" alt="sargazo-segmentados">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/sargazo-segmentados/b-1.png" alt="sargazo-segmentados">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/sargazo-segmentados/c-1.png" alt="sargazo-segmentados">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/sargazo-segmentados/a-2.png" alt="sargazo-segmentados">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/sargazo-segmentados/b-2.png" alt="sargazo-segmentados">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/sargazo-segmentados/c-2.png" alt="sargazo-segmentados">
                            </div>
                        </div>
                    </div>

                    <button class="carousel-btn next-btn" title="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="dataset-buttons">
                    <a class="btn-solid-reg" href="https://peerj.com/articles/13537/" target="_blank"
                        rel="noopener noreferrer">
                        Leer artículo
                    </a>
                    <a class="btn-outline-reg" href="https://doi.org/10.6084/m9.figshare.16550166" target="_blank"
                        rel="noopener noreferrer">
                        Descargar dataset
                    </a>
                </div>
            </div>

            <div class="dataset-card" data-aos="fade-up">
                <div class="dataset-header">
                    <div class="dataset-icon">
                        <i class="fas fa-camera"></i>
                    </div>

                    <div>

                        <h3 class="dataset-title">
                            Dataset Perspective
                        </h3>

                        <span class="dataset-subtitle">
                            Imágenes para cálculo de longitud de sargazo
                        </span>
                    </div>
                </div>

                <p class="dataset-description">
                    Imágenes utilizadas para calcular longitud
                    y extensión del sargazo mediante técnicas
                    de perspectiva y análisis visual.
                </p>

                <div class="dataset-table table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total de imágenes</th>
                                <td>5,100</td>
                            </tr>

                            <tr>
                                <th>Imágenes con perspectiva</th>
                                <td>2,500</td>
                            </tr>

                            <tr>
                                <th>Imágenes sin perspectiva</th>
                                <td>2,500</td>
                            </tr>

                            <tr>
                                <th>Formato</th>
                                <td>JPG</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="dataset-carousel">
                    <button class="carousel-btn prev-btn" title="preview">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="carousel-track-container">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/perspective/1.jpg" alt="perspective">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/perspective/2.jpg" alt="perspective">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/perspective/3.jpg" alt="perspective">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/perspective/4.jpg" alt="perspective">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/perspective/5.jpg" alt="perspective">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/perspective/6.jpg" alt="perspective">
                            </div>
                        </div>
                    </div>

                    <button class="carousel-btn next-btn" title="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="dataset-buttons">
                    <a class="btn-solid-reg" href="https://ieeexplore.ieee.org/document/9882952" target="_blank"
                        rel="noopener noreferrer">
                        Leer artículo
                    </a>

                    <a class="btn-outline-reg"
                        href="https://figshare.com/articles/dataset/Images_of_sargassum_with_and_without_beach_perspective/26496640/1?file=48189325"
                        target="_blank" rel="noopener noreferrer">
                        Descargar dataset
                    </a>
                </div>
            </div>

            <div class="dataset-card" data-aos="fade-up">
                <div class="dataset-header">
                    <div class="dataset-icon">
                        <i class="fas fa-helicopter"></i>
                    </div>

                    <div>
                        <h3 class="dataset-title">
                            Imágenes de aéreas segmentadas
                        </h3>

                        <span class="dataset-subtitle">
                            Segmentación aérea mediante drones
                        </span>
                    </div>
                </div>

                <p class="dataset-description">
                    Conjunto de imágenes aéreas cuidadosamente
                    procesadas para detección y segmentación
                    semántica de sargazo en playas del Caribe.
                </p>

                <div class="dataset-table table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total de imágenes</th>
                                <td>15,268</td>
                            </tr>

                            <tr>
                                <th>Clasificación</th>
                                <td>Sargazo, arena y otros</td>
                            </tr>

                            <tr>
                                <th>Formato</th>
                                <td>JPG</td>
                            </tr>

                            <tr>
                                <th>Ubicación</th>
                                <td>
                                    Puerto Morelos y Mahahual,
                                    Quintana Roo
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="dataset-carousel">
                    <button class="carousel-btn prev-btn" title="preview">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="carousel-track-container">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/areas-segmentadas/1.jpg" alt="areas-segmentadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/areas-segmentadas/2.jpg" alt="areas-segmentadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/areas-segmentadas/3.jpg" alt="areas-segmentadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/areas-segmentadas/4.jpg" alt="areas-segmentadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/areas-segmentadas/5.jpg" alt="areas-segmentadas">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/areas-segmentadas/6.jpg" alt="areas-segmentadas">
                            </div>
                        </div>
                    </div>

                    <button class="carousel-btn next-btn" title="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="dataset-buttons">
                    <a class="btn-solid-reg" href="https://peerj.com/articles/18192/#" target="_blank"
                        rel="noopener noreferrer">
                        Leer artículo
                    </a>

                    <a class="btn-outline-reg"
                        href="https://figshare.com/articles/dataset/Aerial_Segmented_i_i_i_Sargassum_i_Dataset/25320148/4?file=44832523"
                        target="_blank" rel="noopener noreferrer">
                        Descargar dataset
                    </a>
                </div>
            </div>

            <div class="dataset-card" data-aos="fade-up">
                <div class="dataset-header">
                    <div class="dataset-icon">
                        <i class="fas fa-draw-polygon"></i>
                    </div>

                    <div>
                        <h3 class="dataset-title">
                            Conjunto de imágenes de playa con anotaciones COCO
                        </h3>

                        <span class="dataset-subtitle">
                            Segmentación de alta resolución para aprendizaje profundo
                        </span>
                    </div>
                </div>

                <p class="dataset-description">
                    Dataset de imágenes de playa de alta resolución con máscaras
                    de segmentación semántica a nivel de píxel y anotaciones
                    poligonales en formato COCO, pensado para entrenar y comparar
                    modelos de segmentación semántica e instanciada (p. ej. U-Net,
                    Mask R-CNN) enfocados en el monitoreo del sargazo.
                </p>

                <ul class="dataset-list">
                    <li>
                        Imágenes RGB originales en formato JPG
                    </li>

                    <li>
                        Máscaras de segmentación semántica en formato PNG
                    </li>

                    <li>
                        Archivo unificado de anotaciones poligonales en formato
                        JSON compatible con el estándar COCO
                    </li>
                </ul>

                <div class="dataset-table table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Imágenes</th>
                                <td>1000</td>
                            </tr>

                            <tr>
                                <th>Tamaño total</th>
                                <td>282.60 MB</td>
                            </tr>

                            <tr>
                                <th>Clasificación</th>
                                <td>Sargazo, arena y otros</td>
                            </tr>

                            <tr>
                                <th>Instancias poligonales (sargazo)</th>
                                <td>12,308</td>
                            </tr>

                            <tr>
                                <th>Formato</th>
                                <td>JPG, PNG y JSON (COCO)</td>
                            </tr>

                            <tr>
                                <th>Ubicación</th>
                                <td>Península de Yucatán, principalmente Quintana Roo</td>
                            </tr>

                            <tr>
                                <th>Fecha de publicación</th>
                                <td>2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="dataset-carousel">
                    <button class="carousel-btn prev-btn" title="preview">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="carousel-track-container">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/COCO/image_95.jpg" alt="COCO">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/COCO/image_96.jpg" alt="COCO">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/COCO/image_97.jpg" alt="COCO">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/COCO/image_95.png" alt="COCO">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/COCO/image_96.png" alt="COCO">
                            </div>

                            <div class="carousel-slide">
                                <img src="../images/datos-abiertos/COCO/image_97.png" alt="COCO">
                            </div>
                        </div>
                    </div>

                    <button class="carousel-btn next-btn" title="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="collapse dataset-collapse" id="cocoDetails">
                    <div class="dataset-expand">
                        <p class="dataset-description">
                            La segmentación clasifica el ambiente costero en tres
                            categorías: sargazo, arena y otros elementos ambientales
                            y objetos costeros (agua, vegetación, cielo, nubes,
                            embarcaciones y personas, entre otros). Las máscaras a
                            nivel de píxel fueron convertidas sistemáticamente a
                            anotaciones poligonales mediante un script en Python
                            basado en OpenCV, utilizando el algoritmo de
                            Douglas-Peucker para simplificar la geometría y
                            garantizar la viabilidad computacional.
                        </p>

                        <div class="spectral-box">
                            <h5>
                                Diccionario de clases y especificaciones técnicas
                            </h5>

                            <p>
                                Correspondencia entre las categorías ambientales
                                definidas, su color y valor RGB dentro de las
                                máscaras de segmentación, y el identificador de
                                categoría utilizado en las anotaciones COCO.
                            </p>

                            <div class="table-responsive">
                                <table class="table spectral-table">
                                    <thead>
                                        <tr>
                                            <th>Clase</th>
                                            <th>Color</th>
                                            <th>Valor RGB</th>
                                            <th>ID de categoría COCO</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Sargazo</td>
                                            <td>Rojo oscuro</td>
                                            <td>[139, 0, 0]</td>
                                            <td>1</td>
                                        </tr>

                                        <tr>
                                            <td>Arena</td>
                                            <td>Amarillo</td>
                                            <td>[255, 255, 0]</td>
                                            <td>2</td>
                                        </tr>

                                        <tr>
                                            <td>Otros</td>
                                            <td>Gris</td>
                                            <td>[192, 192, 192]</td>
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dataset-buttons">
                    <button class="btn-outline-reg" type="button" data-toggle="collapse" data-target="#cocoDetails"
                        aria-expanded="false">
                        Ver detalles
                    </button>
                    <a class="btn-solid-reg" href="https://doi.org/10.1016/j.dib.2026.112910" target="_blank"
                        rel="noopener noreferrer">
                        Leer artículo
                    </a>
                    <a class="btn-outline-reg" href="https://doi.org/10.6084/m9.figshare.32125996" target="_blank"
                        rel="noopener noreferrer">
                        Descargar dataset
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/swiper.min.js"></script>
    <script src="../js/jquery.magnific-popup.js"></script>
    <script src="../js/morphext.min.js"></script>
    <script src="../js/isotope.pkgd.min.js"></script>
    <script src="../js/validator.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script>
        const carousels = document.querySelectorAll('.dataset-carousel');

        carousels.forEach((carousel) => {
            const track = carousel.querySelector('.carousel-track');

            const slides =
                Array.from(
                    carousel.querySelectorAll('.carousel-slide')
                );

            const nextBtn = carousel.querySelector('.next-btn');
            const prevBtn = carousel.querySelector('.prev-btn');
            let currentIndex = 0;

            function getVisibleSlides(){
                if(window.innerWidth <= 768){
                    return 1;
                }

                if(window.innerWidth <= 992){
                    return 2;
                }

                return 3;
            }

            function updateCarousel(){
                const slideWidth = slides[0].getBoundingClientRect().width;

                track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            }

            nextBtn.addEventListener('click', () => {
                const visibleSlides = getVisibleSlides();
                const maxIndex = slides.length - visibleSlides;

                if(currentIndex < maxIndex){
                    currentIndex++;
                    updateCarousel();
                }

            });

            prevBtn.addEventListener('click', () => {
                if(currentIndex > 0){
                    currentIndex--;
                    updateCarousel();
                }

            });

            window.addEventListener('resize', () => {
                const visibleSlides = getVisibleSlides();
                const maxIndex = slides.length - visibleSlides;

                if(currentIndex > maxIndex){
                    currentIndex = maxIndex;
                }

                updateCarousel();
            });

            updateCarousel();

        });

    </script>
    <script>
        AOS.init({
            duration: 1200,
            once: true,
            offset: 120
        });
    </script>
</body>
</html>