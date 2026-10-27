const OWNER = "Collective-View";
const REPO = "Sargassum_Air_Quality";
const PATH = "data";


// Mapeo: campo del CSV -> id del elemento de la card (value/max/min)
const CAMPOS = [
    "wind_ms", // Velocidad del viento
    "wind_dir_10_mean", // Dirección del viento
    "out_temp_c", // Temperatura (Ambiente)
    "out_hum", // Humedad (Ambiente)
    "out_feels_like_c", // Sensación Térmica
    "pres_rel_hpa", // Presión barométrica
    "solar_rad_wm2", // Radiación Solar
    "uv_index", // Índice UV
    "rain_rate_mmhr", // Lluvia
    "nh3", // Amoniaco
    "temp_nh3", // Temperatura (Amoniaco)
    "hum_nh3", // Humedad (Amoniaco)
    "h2s", // Ácido sulfhídrico
    "o2", // Oxígeno
    "co", // Monóxido de carbono
    "lel" // Límite Inferior de Explosividad
];

// Diccionario para nombres legibles en las gráficas
const NOMBRES_VARIABLES = {
    wind_ms: "Velocidad del viento",
    wind_dir_10_mean: "Dirección del viento",
    out_temp_c: "Temperatura",
    out_hum: "Humedad",
    out_feels_like_c: "Sensación Térmica",
    pres_rel_hpa: "Presión barométrica",
    solar_rad_wm2: "Radiación solar",
    uv_index: "Índice UV",
    rain_rate_mmhr: "Lluvia",
    nh3: "Amoniaco (NH3)",
    temp_nh3: "Temperatura (NH3)",
    hum_nh3: "Humedad (NH3)",
    h2s: "Sulfuro de hidrógeno (H2S)",
    o2: "Oxígeno (O)",
    co: "Monóxido de carbono (CO)",
    lel: "Límite inferior de explosividad (LEL)"
};

// Mapeo: campo del CSV -> id de la gráfica individual
const CHART_MAP = {
    ambiente: [
        { campo: "wind_ms",chartId: "chart-ambiente-viento" },
        { campo: "wind_dir_10_mean",chartId: "chart-ambiente-direccion" },
        { campo: "out_temp_c",chartId: "chart-ambiente-temperatura" },
        { campo: "out_hum",chartId: "chart-ambiente-humedad" },
        { campo: "out_feels_like_c",chartId: "chart-ambiente-sensacion" },
        { campo: "pres_rel_hpa",chartId: "chart-ambiente-presion" },
        { campo: "solar_rad_wm2",chartId: "chart-ambiente-luz" },
        { campo: "uv_index",chartId: "chart-ambiente-uv" },
        { campo: "rain_rate_mmhr",chartId: "chart-ambiente-lluvia" }
    ],
    suelo: [
        { campo: "Humedad del suelo",chartId: "chart-suelo-humedad" },
        { campo: "Temperatura del suelo",chartId: "chart-suelo-temperatura" }
    ],
    gases: [
        { campo: "h2s",chartId: "chart-gases-h2s" },
        { campo: "nh3",chartId: "chart-gases-nh3" },
        { campo: "co",chartId: "chart-gases-co" },
        { campo: "o2",chartId: "chart-gases-o2" },
        { campo: "lel",chartId: "chart-gases-lel" },
        { campo: "temp_nh3",chartId: "chart-gases-temp_nh3" },
        { campo: "hum_nh3",chartId: "chart-gases-hum_nh3" }
    ]
};

/* ============================================================
   DESCARGA DE LA CAMPAÑA ACTIVA EN .ZIP
   ============================================================ */
function setupZipDownload() {
    const btn = document.getElementById('btn-download-zip');
    if (!btn) return;

    btn.addEventListener('click',async () => {
        if (!state.activePath) {
            alert('Primero selecciona una campaña.');
            return;
        }
        if (typeof JSZip === 'undefined') {
            alert('JSZip no está disponible.');
            return;
        }

        // Estado visual del botón
        const originalHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `
            <i class="fas fa-spinner fa-spin"></i>
            <div>
                <div>Empaquetando</div>
                <div style="font-size: 0.75rem; opacity: 0.9; text-transform: uppercase;">...</div>
            </div>`;

        try {
            // 1) Listar contenido de la carpeta activa
            const items = await getContents(state.activePath);
            const files = items.filter(i => i.type === 'file');

            if (!files.length) {
                alert('La carpeta no contiene archivos para descargar.');
                return;
            }

            // 2) Descargar cada archivo y agregarlo al zip
            const zip = new JSZip();
            const folderName = state.activePath.split('/').pop();
            const root = zip.folder(folderName);

            // Descargamos en paralelo (más rápido)
            await Promise.all(files.map(async (file) => {
                const res = await fetch(file.download_url);
                if (!res.ok) throw new Error(`No se pudo descargar ${file.name}`);
                const blob = await res.blob();
                root.file(file.name,blob);
            }));

            // 3) Generar el zip y disparar la descarga
            const content = await zip.generateAsync({
                type: 'blob',
                compression: 'DEFLATE',
                compressionOptions: { level: 6 }
            });

            // Nombre: "20261019_id1_chetumal.zip"
            saveAs(content,`${folderName}.zip`);

        } catch (err) {
            console.error('Error generando el ZIP:',err);
            alert('Ocurrió un error al generar el ZIP. Revisa la consola.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalHTML;
        }
    });
}

// Estado global
const state = {
    allRows: [],          // todas las filas de la campaña activa
    filteredRows: [],     // filas después de aplicar filtros
    activePath: null,
    filters: { dateFrom: "",dateTo: "",station: "",city: "" },
    campaigns: []   // ← nuevo: [{ name, path, date, station, city }]
};

document.addEventListener('DOMContentLoaded',async function () {
    applyDarkMode();
    window.state = state;
    setupFilterListeners();
    setupZipDownload();   
    await loadFolders();
});

function applyDarkMode() {
    const themeBtn = document.getElementById('cvThemeToggle');
    const themeIcon = document.getElementById('cvThemeIcon');
    const themeLabel = document.getElementById('cvThemeModeLabel');
    const themeSub = document.getElementById('cvThemeModeSub');
    const dash = document.querySelector('.cv-dashboard');
    document.documentElement.classList.add('cv-dark-mode');
    document.body.classList.add('cv-dark-mode');
    if (dash) dash.classList.add('cv-dark');
    localStorage.setItem('cv_theme','dark');

    if (themeIcon) themeIcon.className = 'fas fa-sun';
    if (themeLabel) themeLabel.innerText = 'Modo';
    if (themeSub) themeSub.innerText = 'Claro';

    if (window.dashboardCharts) {
        allCharts.forEach(chart => {
            if (chart) {
                chart.updateOptions({
                    theme: { mode: 'dark' },
                    grid: { borderColor: '#23334D' },
                    xaxis: { labels: { style: { colors: '#94A3B8' } } }
                },false,false);
            }
        });
    }
}

/* ============================================================
   CARGA DE CAMPAÑAS
   ============================================================ */
async function loadFolders() {
    const items = await getContents(PATH);
    let folders = items.filter(item => item.type === "dir");
    
    folders.sort((a,b) => b.name.localeCompare(a.name));

    const container = document.getElementById("file-container");
    if (!container) return;

    // 1. Llenar los filtros dinámicamente
    populateDynamicFilters(folders);

    let html = '';
    folders.forEach(folder => {
        const displayName = formatFolderName(folder.name);
        const meta = parseFolderName(folder.name); // Extraemos los datos

        // 2. Guardar la info en atributos data-* para poder filtrarlos después
        html += `
        <a class="nav-link" href="javascript:void(0);" 
           data-path="${folder.path}"
           data-date="${meta.date || ''}"
           data-station="${meta.station || ''}"
           data-city="${meta.city || ''}">
            <span>${displayName}</span>
        </a>`;
    });
    container.innerHTML = html;

    container.addEventListener("click",async (e) => {
        const link = e.target.closest(".nav-link");
        if (!link) return;

        container.querySelectorAll(".nav-link").forEach(l => l.classList.remove("active"));
        link.classList.add("active");

        state.activePath = link.dataset.path;
        await renderCampaign(state.activePath);
    });

    const first = container.querySelector(".nav-link");
    if (first) first.click();
}

function parseFolderName(folderName) {
    const parts = folderName.split('_');
    let date = null,station = "",city = "";

    // Fecha: "20261019" → "2026-10-19"
    if (parts[0] && /^\d{8}$/.test(parts[0])) {
        date = `${parts[0].slice(0,4)}-${parts[0].slice(4,6)}-${parts[0].slice(6,8)}`;
    }

    // Estación: "id1" → "1"
    if (parts[1]) {
        const m = parts[1].match(/id(\d+)/i);
        if (m) station = m[1];
    }

    // Ciudad: "chetumal" → "Chetumal"
    if (parts[2]) {
        city = parts[2].charAt(0).toUpperCase() + parts[2].slice(1).toLowerCase();
    }

    return { date,station,city };
}

// Llena los <select> dinámicamente según lo que haya en las carpetas
function populateDynamicFilters(folders) {
    const stations = new Set();
    const cities = new Set();

    folders.forEach(folder => {
        const meta = parseFolderName(folder.name);
        if (meta.station) stations.add(meta.station);
        if (meta.city) cities.add(meta.city);
    });

    // Llenar selector de Estaciones
    const stationSelect = document.getElementById('filter-station');
    if (stationSelect) {
        // Conservar solo la primera opción ("Todas las estaciones")
        stationSelect.innerHTML = '<option value="">Todas las estaciones</option>';

        // Ordenar numéricamente (1, 2, 3...)
        Array.from(stations).sort((a,b) => a - b).forEach(st => {
            const opt = document.createElement('option');
            opt.value = st;
            opt.textContent = `Estación ${st}`;
            stationSelect.appendChild(opt);
        });
    }

    // Llenar selector de Ciudades
    const citySelect = document.getElementById('filter-city');
    if (citySelect) {
        citySelect.innerHTML = '<option value="">Todas las ciudades</option>';

        // Ordenar alfabéticamente
        Array.from(cities).sort().forEach(city => {
            const opt = document.createElement('option');
            opt.value = city;
            opt.textContent = city;
            citySelect.appendChild(opt);
        });
    }
}

function formatFolderName(folderName) {
    const meta = parseFolderName(folderName);
    if (!meta.date) return folderName;
    const [year,month,day] = meta.date.split('-');
    const meses = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
    const mesNombre = meses[parseInt(month) - 1];
    const yearShort = year.slice(-2);

    const fechaFormateada = `${day}/${mesNombre}/${yearShort}`;

    // Si hay estación, la agregamos. Si no, solo mostramos la fecha.
    if (meta.station) {
        return `${fechaFormateada} - Estación ${meta.station}`;
    }

    return fechaFormateada;
}

async function getContents(path) {
    const url = `https://api.github.com/repos/${OWNER}/${REPO}/contents/${path}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error(`GitHub respondió ${res.status}`);
    return res.json();
}

/* ============================================================
   CARGA Y RENDER DE UNA CAMPAÑA
   ============================================================ */
async function renderCampaign(path) {
    try {
        const items = await getContents(path);
        // Buscar el primer CSV dentro del folder
        const csvItem = items.find(i => i.type === "file" && /\.csv$/i.test(i.name));
        if (!csvItem) {
            console.warn(`No se encontró CSV en ${path}`);
            return;
        }
        
        // Extraer metadatos del nombre de la carpeta
        const folderName = path.split('/').pop(); // saca "20261019_id1_chetumal" de "data/20261019_id1_chetumal"
        const meta = parseFolderName(folderName);

        state.campaignMeta = meta;

        const rows = await readCsv(csvItem.download_url);
        state.allRows = rows;
        state.filteredRows = rows;

        // Render inicial (sin filtros)
        applyFilters(state.filters,rows);
    } catch (err) {
        console.error("Error cargando campaña:",err);
    }
}

async function readCsv(downloadUrl) {
    const res = await fetch(downloadUrl);
    if (!res.ok) throw new Error(`No se pudo descargar el CSV (${res.status})`);
    const text = await res.text();

    const result = Papa.parse(text,{
        header: true,
        skipEmptyLines: true,
        dynamicTyping: true
    });

    // Limpiar headers: quitar espacios, BOM y comillas
    const cleaned = result.data.map(row => {
        const out = {};
        Object.keys(row).forEach(k => {
            const key = k
                .replace(/^\ufeff/,'')   // BOM
                .trim()                    // ← esto arregla "time "
                .replace(/^"|"$/g,'')     // comillas
                .toLowerCase();
            out[key] = row[k];
        });
        return out;
    });

    // Forzar columnas de tiempo a string
    cleaned.forEach(r => {
        ['time','timestamp','date','datetime','fecha'].forEach(k => {
            if (r[k] !== undefined && r[k] !== null) r[k] = String(r[k]);
        });
    });

    if (result.errors.length) console.warn("Avisos al parsear:",result.errors);
    return cleaned;
}

/* ============================================================
   FILTROS
   ============================================================ */
function setupFilterListeners() {
    window.addEventListener('cv:filters-applied',(e) => {
        const filters = e.detail || {};
        state.filters = filters;
        filterSidebar(filters);   // ← SOLO oculta/muestra campañas
    });

    window.addEventListener('cv:filters-cleared',() => {
        state.filters = { dateFrom: "",dateTo: "",station: "",city: "" };
        filterSidebar(state.filters);   // ← SOLO resetea la lista
    });
}

function filterSidebar(filters) {
    const links = document.querySelectorAll('#file-container .nav-link');

    links.forEach(link => {
        const folderDate = link.dataset.date || '';
        const folderStation = link.dataset.station || '';
        const folderCity = link.dataset.city || '';

        let visible = true;

        // Filtro de fecha
        if (filters.dateFrom && folderDate < filters.dateFrom) visible = false;
        if (filters.dateTo && folderDate > filters.dateTo) visible = false;

        // Filtro de estación
        if (filters.station && folderStation !== filters.station) visible = false;

        // Filtro de ciudad
        if (filters.city && folderCity.toLowerCase() !== filters.city.toLowerCase()) visible = false;

        // Ocultar/mostrar
        link.style.display = visible ? '' : 'none';
    });
    
    // Si la campaña que estaba abierta se ocultó, abrir automáticamente la primera que sí coincida
    if (!activeStillVisible && firstVisibleLink) {
        firstVisibleLink.click();
    } else if (!firstVisibleLink) {
        // Si no hay ninguna campaña que coincida con los filtros
        updateCards([]);
        updateAllCharts([]);
    }
}

function readFilterInputs() {
    return {
        dateFrom: (document.getElementById('filter-date-from')?.value || '').trim(),
        dateTo: (document.getElementById('filter-date-to')?.value || '').trim(),
        station: (document.getElementById('filter-station')?.value || '').trim(),
        city: (document.getElementById('filter-city')?.value || '').trim()
    };
}

function clearFilterInputs() {
    const ids = ['filter-date-from','filter-date-to','filter-station','filter-city'];
    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
}

function toLocalDateString(d) {
    const y = d.getFullYear();
    const m = String(d.getMonth() + 1).padStart(2,'0');
    const day = String(d.getDate()).padStart(2,'0');
    return `${y}-${m}-${day}`;
}

// Y applyFilters ahora solo se encarga de pintar los datos:
function applyFilters(filters,rows) {
    state.filteredRows = rows;
    updateCards(rows);
    updateAllCharts(rows);
}

function extractTimestamp(row) {
    // Prioridad: 'time' primero porque es la columna real de estos CSVs
    const candidates = ['time','timestamp','date','datetime','fecha'];
    for (const key of candidates) {
        const raw = row[key];
        if (raw === undefined || raw === null || raw === '') continue;
        const d = parseDateString(raw);
        if (d) return d;
    }
    return null;
}

function parseDateString(raw) {
    // Si ya es Date
    if (raw instanceof Date) return isNaN(raw.getTime()) ? null : raw;

    // Si es número (epoch en segundos o milisegundos)
    if (typeof raw === 'number') {
        // heurística: < 1e12 → segundos
        const ms = raw < 1e12 ? raw * 1000 : raw;
        const d = new Date(ms);
        return isNaN(d.getTime()) ? null : d;
    }

    const s = String(raw).trim();

    // Formato DD/MM/YYYY HH:mm  (o con - o .)
    // Ej: 23/10/2026 00:00   |   23-10-2026 00:00   |   23/10/2026 00:00:00
    let m = s.match(/^(\d{1,2})[\/\-.](\d{1,2})[\/\-.](\d{4})(?:[ T](\d{1,2}):(\d{2})(?::(\d{2}))?)?$/);
    if (m) {
        const day = +m[1];
        const month = +m[2] - 1;      // JS: mes 0-11
        const year = +m[3];
        const hour = +(m[4] || 0);
        const min = +(m[5] || 0);
        const sec = +(m[6] || 0);
        const d = new Date(year,month,day,hour,min,sec);
        return isNaN(d.getTime()) ? null : d;
    }

    // Formato YYYY-MM-DD HH:mm (ISO extendido)
    m = s.match(/^(\d{4})-(\d{2})-(\d{2})(?:[ T](\d{2}):(\d{2})(?::(\d{2}))?)?/);
    if (m) {
        const d = new Date(+m[1],+m[2] - 1,+m[3],+(m[4] || 0),+(m[5] || 0),+(m[6] || 0));
        return isNaN(d.getTime()) ? null : d;
    }

    // Fallback: dejar que el navegador intente
    const d = new Date(s);
    return isNaN(d.getTime()) ? null : d;
}

/* ============================================================
   CARDS
   ============================================================ */
function updateCards(rows) {
    CAMPOS.forEach(campo => {
        const valores = rows
            .map(row => row[campo])
            .filter(v => v !== null && v !== undefined && v !== '' && !isNaN(v))
            .map(Number);

        const stats = calcularStats(valores);

        const valueEl = document.getElementById(`${campo}-value`);
        const maxEl = document.getElementById(`${campo}-max`);
        const minEl = document.getElementById(`${campo}-min`);

        if (valueEl) valueEl.textContent = valores.length ? stats.promedio.toFixed(2) : "N/A";
        if (maxEl) maxEl.textContent = valores.length ? stats.maximo.toFixed(2) : "--";
        if (minEl) minEl.textContent = valores.length ? stats.minimo.toFixed(2) : "--";
    });

    // Actualizar también el dial del viento con el promedio de wind_dir_10_mean
    const dirVals = rows.map(r => r.wind_dir_10_mean)
        .filter(v => v !== null && v !== undefined && !isNaN(v))
        .map(Number);
    if (dirVals.length && typeof window.setWindDirection === 'function') {
        const avg = dirVals.reduce((a,b) => a + b,0) / dirVals.length;
        window.setWindDirection(avg);
        // Sincronizar el número mostrado en el centro del dial
        const degEl = document.getElementById('wind_dir_10_mean-value');
        if (degEl) degEl.textContent = avg.toFixed(1);
    }
}

function calcularStats(valores) {
    if (!valores.length) return { actual: 0,promedio: 0,maximo: 0,minimo: 0 };
    const promedio = valores.reduce((a,b) => a + b,0) / valores.length;
    return {
        actual: valores[0],
        promedio,
        maximo: Math.max(...valores),
        minimo: Math.min(...valores)
    };
}

/* ============================================================
   GRÁFICAS (ApexCharts)
   ============================================================ */
function updateAllCharts(rows) {
    if (!window.chartById) return;

    const hasTimestamps = rows.some(r => extractTimestamp(r) !== null);
    const total = rows.length;
    const markerSize = total > 500 ? 0 : (total > 200 ? 1.5 : 3.5);

    Object.keys(CHART_MAP).forEach(group => {
        CHART_MAP[group].forEach(({ campo,chartId }) => {
            const chart = window.chartById[chartId];
            if (!chart) return;

            const nombreLegible = NOMBRES_VARIABLES[campo] || campo;
            
            let seriesData;
            let xaxisOpts;

            if (hasTimestamps) {
                // Modo datetime
                seriesData = rows
                    .map(r => {
                        const ts = extractTimestamp(r);
                        const v = r[campo];
                        if (!ts || v === null || v === undefined || v === '' || isNaN(v)) return null;
                        return { x: ts.getTime(),y: Number(v) };
                    })
                    .filter(Boolean);

                xaxisOpts = {
                    type: 'datetime',
                    labels: {
                        datetimeUTC: false,
                        style: { fontSize: '11px' },
                        formatter: function (value) {
                            const d = new Date(value);
                            const hh = String(d.getHours()).padStart(2,'0');
                            const mm = String(d.getMinutes()).padStart(2,'0');
                            return `${hh}:${mm}`;
                        }
                    }
                };
            } else {
                // Fallback: índice
                seriesData = rows.map(r => {
                    const v = r[campo];
                    return (v === null || v === undefined || v === '' || isNaN(v)) ? null : Number(v);
                });
                xaxisOpts = {
                    type: 'category',
                    categories: rows.map((_,i) => `#${i + 1}`)
                };
            }

            // Actualizar el título del eje Y con el nombre legible
            chart.updateOptions({
                xaxis: xaxisOpts,
                yaxis: {
                    title: { text: nombreLegible }
                },
                markers: { size: markerSize }
            },false,false);

            // Actualizar la serie con el nombre legible (así el tooltip muestra "Amoniaco" en lugar de "nh3")
            chart.updateSeries([{ name: nombreLegible,data: seriesData }],true);
        });
    });
}