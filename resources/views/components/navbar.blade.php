<nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top navbar-solid">
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
                <a class="nav-link" href="{{ route('home', [], false) }}">
                    INICIO
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('publicaciones*') ? 'active' : '' }}"
                   href="../publicaciones">
                    PUBLICACIONES
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../datos">
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
                <a class="nav-link dropdown-toggle {{ request()->is('medios*') ? 'active' : '' }}"
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
                    <a class="dropdown-item {{ request()->is('medios*') ? 'active' : '' }}"
                       href="../medios">
                        MEDIOS
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>