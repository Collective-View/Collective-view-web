// ---------------
// GLOBAL CONSTANTS
// ---------------

const OWNER = "Collective-View";
const REPO = "Sargassum_Air_Quality";
const PATH = "data";

const defaultHours = ['06:00','08:00','10:00','12:00','14:00','16:00','18:00','20:00'];
const dashboardCharts = { ambiente: [], aire: [], suelo: [],gases: [] };
window.chartById = {};

const state = {
    activePath: null,
    filters: { dateFrom: "",dateTo: "",station: "",city: "" },
    campaigns: []
};

// Variables que se van a mostrar (Poner el nombre que aparece en el .CSV)
const VARIABLES = [
    
    // SECCIÓN AMBIENTE
    "wind_ms", // Velocidad del viento
    "wind_dir_10min_deg", // Dirección del viento
    "out_temp_c", // Temperatura
    "out_hum", // Humedad
    "out_feels_like_c", // Sensación Térmica
    "rel_pres_hpa", // Presión barométrica
    "solar_rad_wm2", // Radiación Solar
    "uv_index", // Índice UV
    "event_rain_mm", // Lluvia en MM durante el evento
    
    // SECCIÓN CALIDAD DEL AIRE
    "a_temp_c", // Temperatura (AQIN)
    "a_hum", // Humedad (AQIN)
    "a_co2_ppm", // Dióxido de carbono (AQIN)
    "a_pm2_5_ugm3", // PM2.5 (AQIN)
    "a_pm10_ugm3", // PM10 (AQIN)
    "a_pm1_ugm3", // PM1.0 (AQIN)
    "a_pm4_ugm3", // PM4.0 (AQIN)
    
    // SECCIÓN SUELO (Por el momento no existen las variables)

];

const OLD_GAS_VARIABLES = [
    // SECCIÓN GASES
    "nh3", // Amoniaco
    "temp_nh3", // Temperatura
    "hum_nh3", // Humedad
    "h2s", // Ácido sulfhídrico
    "o2", // Oxígeno
    "co", // Monóxido de carbono
    "lel" // Límite Inferior de Explosividad
];

const GAS_VARIABLES = [
    // SECCIÓN GASES
    "amon", // Amoniaco
    "temp_f", // Temperatura
    "hum", // Humedad
    "h2s", // Ácido sulfhídrico
    "o2", // Oxígeno
    "co", // Monóxido de carbono
    "lel" // Límite Inferior de Explosividad
];

// Nombres de cada variable para las gráficas
const VARIABLE_NAMES = {
    
    // SECCIÓN AMBIENTE
    wind_ms: "Velocidad del viento",
    wind_dir_10min_deg: "Dirección del viento",
    out_temp_c: "Temperatura",
    out_hum: "Humedad",
    out_feels_like_c: "Sensación Térmica",
    rel_pres_hpa: "Presión barométrica",
    solar_rad_wm2: "Radiación solar",
    uv_index: "Índice UV",
    event_rain_mm: "Lluvia",
    
    // SECCIÓN CALIDAD DEL AIRE
    a_temp_c: "Temperatura (AQIN)",
    a_hum: "Humedad (AQIN)",
    a_co2_ppm: "Dióxido de carbono (AQIN)",
    a_pm2_5_ugm3: "PM2.5 (AQIN)",
    a_pm10_ugm3: "PM10 (AQIN)",
    a_pm1_ugm3: "PM1.0 (AQIN)",
    a_pm4_ugm3: "PM4.0 (AQIN)",
    
    // SECCIÓN SUELO (Por el momento no existen las variables)
    
    // SECCIÓN GASES
    amon: "Amoniaco (NH3)",
    temp_f: "Temperatura (NH3)",
    hum: "Humedad (NH3)",
    h2s: "Sulfuro de hidrógeno (H2S)",
    o2: "Oxígeno (O)",
    co: "Monóxido de carbono (CO)",
    lel: "Límite inferior de explosividad (LEL)"
};

// Asignar una gráfica a cada variable
const CHART_MAP = {
    ambiente: [
        { campo: "wind_ms", chartId: "chart-wind_ms" },
        { campo: "wind_dir_10min_deg", chartId: "chart-wind_dir_10min_deg" },
        { campo: "out_temp_c", chartId: "chart-out_temp_c" },
        { campo: "out_hum", chartId: "chart-out_hum" },
        { campo: "out_feels_like_c", chartId: "chart-out_feels_like_c" },
        { campo: "rel_pres_hpa", chartId: "chart-rel_pres_hpa" },
        { campo: "solar_rad_wm2", chartId: "chart-solar_rad_wm2" },
        { campo: "uv_index", chartId: "chart-uv_index" },
        { campo: "event_rain_mm", chartId: "chart-event_rain_mm" }
    ],
    aire: [
        { campo: "a_temp_c",chartId: "chart-a_temp_c" },
        { campo: "a_hum",chartId: "chart-a_hum" },
        { campo: "a_co2_ppm",chartId: "chart-a_co2_ppm" },
        { campo: "a_pm2_5_ugm3",chartId: "chart-a_pm2_5_ugm3" },
        { campo: "a_pm10_ugm3",chartId: "chart-a_pm10_ugm3" },
        { campo: "a_pm1_ugm3",chartId: "chart-a_pm1_ugm3" },
        { campo: "a_pm4_ugm3",chartId: "chart-a_pm4_ugm3" }  
    ],
    suelo: [
        { campo: "Humedad del suelo", chartId: "chart-suelo-humedad" },
        { campo: "Temperatura del suelo", chartId: "chart-suelo-temperatura" }
    ]
};

const GAS_CHART_MAP = {
    gases: [
        { campo: "amon",chartId: "chart-amon" },
        { campo: "temp_f",chartId: "chart-temp_f" },
        { campo: "hum",chartId: "chart-hum" },
        { campo: "h2s",chartId: "chart-h2s" },
        { campo: "co",chartId: "chart-co" },
        { campo: "o2",chartId: "chart-o2" },
        { campo: "lel",chartId: "chart-lel" }
    ]
};

// Gráficas para cada variable

const chartConfigs = {
    ambiente: [
        { id: 'chart-wind_ms',name: 'Velocidad del viento',unit: 'mph',color: '#0B7A5C',data: [],decimals: 1 },
        { id: 'chart-wind_dir_10min_deg',name: 'Dirección del viento',unit: '°',color: '#78909C',data: [],min: 0,max: 360,tickAmount: 4,decimals: 0 },
        { id: 'chart-out_temp_c',name: 'Temperatura',unit: '°C',color: '#FF7043',data: [],decimals: 1 },
        { id: 'chart-out_hum',name: 'Humedad',unit: '%',color: '#29B6F6',data: [],min: 0,max: 100,decimals: 0 },
        { id: 'chart-out_feels_like_c',name: 'Sensación Térmica',unit: '°C',color: '#af3009',data: [],decimals: 1 },
        { id: 'chart-rel_pres_hpa',name: 'Presión barométrica',unit: 'hPa',color: '#7E57C2',data: [],decimals: 1 },
        { id: 'chart-solar_rad_wm2',name: 'Radiación Solar',unit: 'W/m²',color: '#FFA726',data: [],decimals: 0 },
        { id: 'chart-uv_index',name: 'Índice UV',unit: 'UV',color: '#EC407A',data: [],min: 0,max: 12,decimals: 1 },
        { id: 'chart-event_rain_mm',name: 'Lluvia',unit: 'mm',color: '#26A69A',data: [],min: 0,max: 100,decimals: 0 }
    ],
    aire: [
        { id: 'chart-a_temp_c',name: 'Temperatura (AQIN)',unit: '°C',color: '#0B7A5C',data: [],decimals: 1 },
        { id: 'chart-a_hum',name: 'Humedad (AQIN)',unit: '%',color: '#78909C',data: [],min: 0, max: 100, decimals: 0 },
        { id: 'chart-a_co2_ppm',name: 'Dióxido de carbono (AQIN)',unit: 'ppm',color: '#FF7043',data: [],decimals: 1 },
        { id: 'chart-a_pm2_5_ugm3',name: 'PM2.5 (AQIN)',unit: 'μm/m³',color: '#29B6F6',data: [],min: 0,max: 100,decimals: 1 },
        { id: 'chart-a_pm10_ugm3',name: 'PM10 (AQIN)',unit: 'μm/m³',color: '#af3009',data: [],decimals: 1 },
        { id: 'chart-a_pm1_ugm3',name: 'PM1.0 (AQIN)',unit: 'μm/m³',color: '#7E57C2',data: [],decimals: 1 },
        { id: 'chart-a_pm4_ugm3',name: 'PM4.0 (AQIN)',unit: 'μm/m³',color: '#FFA726',data: [],decimals: 0 },
    ],
    suelo: [
        { id: 'chart-suelo-humedad',name: 'Humedad del suelo',unit: '%',color: '#0B7A5C',data: [],min: 0,max: 100,decimals: 0 },
        { id: 'chart-suelo-temperatura',name: 'Temperatura del suelo',unit: '°C',color: '#FF7043',data: [],min: 15,max: 35,decimals: 1 }
    ],
    gases: [
        { id: 'chart-h2s',name: 'Sulfuro de hidrógeno (H2S)',unit: 'ppm',color: '#26A69A',data: [],decimals: 1 },
        { id: 'chart-amon',name: 'Amoniaco (NH3)',unit: 'ppm',color: '#FFA726',data: [],decimals: 1 },
        { id: 'chart-co',name: 'Monóxido de carbono (CO)',unit: 'ppm',color: '#EF5350',data: [],decimals: 0 },
        { id: 'chart-o2',name: 'Oxígeno (O)',unit: 'ppm',color: '#42A5F5',data: [],decimals: 1 },
        { id: 'chart-lel',name: 'LEL',unit: 'ppb',color: '#AB47BC',data: [],decimals: 0 },
        { id: 'chart-temp_f',name: 'Temperatura NH3',unit: '°C',color: '#FF7043',data: [],decimals: 1 },
        { id: 'chart-hum',name: 'Humedad NH3',unit: '%',color: '#29B6F6',data: [],min: 0,max: 100,decimals: 0 }
    ]
};

// ---------------
// MAIN
// ---------------

document.addEventListener('DOMContentLoaded', async function () {
    const dashContainer = document.querySelector('.cv-dashboard');
    dashContainer.classList.remove('cv-sidebar-collapsed');
    setSidebarEvents();
    setFilterEvents();
    setThemeEvent();
    setDarkMode(true);
    window.state = state;
    setupFilterListeners();
    setupZipDownload();
    setupCharts();
    await loadContent();
});

// ---------------
// BASE FUNCTIONS
// ---------------

async function loadContent() {
    await showCampaigns();
}

async function showCampaigns() {
    const folders = await getFolders();
    const campaigns = await getSortedCampaigns(folders);
    await listCampaigns(campaigns);
    establishFilters(campaigns);
    setCampaignEvent();
    await showFirstCampaign();
}

function listCampaigns(campaigns) {
    const campaignContainer = document.getElementById("file-container");
    let html = '';
    
    campaigns.forEach(campaign => {
        const displayName = formatCampaignName(campaign.name);
        const meta = parseCampaignName(campaign.name);

        html += `
        <a class="nav-link" href="javascript:void(0);" 
           data-path="${campaign.path}"
           data-date="${meta.date || ''}"
           data-station="${meta.station || ''}"
           data-city="${meta.location || ''}">
            <span>${displayName}</span>
        </a>`;
    });
    
    campaignContainer.innerHTML = html;
}

function establishFilters(campaigns) {
    const stations = new Set();
    const locations = new Set();

    campaigns.forEach(campaign => {
        const meta = parseCampaignName(campaign.name);
        if (meta.station) stations.add(meta.station);
        if (meta.location) locations.add(meta.location);
    });

    fillStationSelect(stations);
    fillLocationSelect(locations);
}

function setCampaignEvent() {
    const campaignContainer = document.getElementById("file-container");
    
    campaignContainer.addEventListener("click",async (e) => {
        const link = e.target.closest(".nav-link");
        if (!link) return;

        campaignContainer.querySelectorAll(".nav-link").forEach(l => l.classList.remove("active"));
        link.classList.add("active");
        state.activePath = link.dataset.path;
        await renderCampaign(state.activePath);
    });
}

async function renderCampaign(path) {
    try {
        establishCampaignName(path);
        const csvItem = await getCSV(path);
        const variables = await readCsv(csvItem.download_url);
        
        const gasCsv = await getCSV(path,"gases.csv")
        if (gasCsv) {
            const gasVariables = await readCsv(gasCsv.download_url);
            updateGasCards(gasVariables);
            updateGasCharts(gasVariables);
        } else {
            updateCards(variables, theresGas=false);
            updateAllCharts(variables,theresGas=false);
            updateWindCompass(variables);
            return;
        }
        
        updateCards(variables);
        updateAllCharts(variables);
        updateWindCompass(variables);
    } catch (err) {
        console.error("Error cargando campaña:",err);
    }
}

function setupZipDownload() {
    const btn = document.getElementById('btn-download-zip');
    if (!btn) return;

    btn.addEventListener('click',async () => {
        if (!state.activePath) {
            alert('Primero selecciona una campaña.');
            return;
        }
        if (typeof JSZip === 'undefined') {
            alert('La descarga no está disponible.');
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

        // Filtro de localidad
        if (filters.city && folderCity.toLowerCase() !== filters.city.toLowerCase()) visible = false;

        // Ocultar/mostrar
        link.style.display = visible ? '' : 'none';
    });
    
    // Si la campaña que estaba abierta se ocultó, abrir automáticamente la primera que sí coincida
    if (!activeStillVisible && firstVisibleLink) {
        firstVisibleLink.click();
    } else if (!firstVisibleLink) {
        updateCards([]);
        updateAllCharts([]);
    }
}

function calculateMode(values) {
    if (!values.length) return null;

    const frequencies = {};
    let maxFrequency = 0;
    let moda = values[0];

    values.forEach(val => {
        frequencies[val] = (frequencies[val] || 0) + 1;

        if (frequencies[val] > maxFrequency) {
            maxFrequency = frequencies[val];
            moda = val;
        }
    });

    return moda;
}

function updateCards(csvRows, theresGas=true) {
    VARIABLES.forEach(variable => {
        const values = csvRows
            .map(row => row[variable])
            .filter(v => v !== null && v !== undefined && v !== '' && !isNaN(v))
            .map(Number);
        
        const avgText = document.getElementById(`${variable}-value`);
        const maxText = document.getElementById(`${variable}-max`);
        const minText = document.getElementById(`${variable}-min`);
        
        if (variable === 'event_rain_mm') {
            if (avgText) avgText.textContent = values.length ? Math.max(...values) : "N/A";
            return;
        }
        
        if (variable === 'rel_pres_hpa') {
            let secondChance;

            if (!values.length) {
                secondChance = csvRows
                    .map(row => row['pres_rel_hpa'])
                    .filter(v => v !== null && v !== undefined && v !== '' && !isNaN(v))
                    .map(Number);
            } else {
                secondChance = values;
            }

            const finalValues = calculateFinalValues(secondChance);

            if (avgText) avgText.textContent = secondChance.length ? finalValues.promedio.toFixed(2) : "N/A";
            if (maxText) maxText.textContent = secondChance.length ? finalValues.maximo.toFixed(2) : "--";
            if (minText) minText.textContent = secondChance.length ? finalValues.minimo.toFixed(2) : "--";
            return;
        }
        
        if (variable === 'wind_dir_10min_deg') {
            let secondChance;
            
            if (!values.length) {
                secondChance = csvRows
                    .map(row => row['wind_dir_10_mean'])
                    .filter(v => v !== null && v !== undefined && v !== '' && !isNaN(v))
                    .map(Number);
            } else {
                secondChance = values;
            }
            
            const moda = calculateMode(secondChance);
            if (avgText) avgText.textContent = moda !== null ? moda.toFixed(0) : "N/A"
            return;
        }
        
        if (variable === 'solar_rad_wm2') {
            if (avgText) avgText.textContent = values.length ? Math.max(...values) : "N/A";
            return;
        }

        const finalValues = calculateFinalValues(values);

        if (avgText) avgText.textContent = values.length ? finalValues.promedio.toFixed(2) : "N/A";
        if (maxText) maxText.textContent = values.length ? finalValues.maximo.toFixed(2) : "--";
        if (minText) minText.textContent = values.length ? finalValues.minimo.toFixed(2) : "--";
    });
    
    if (!theresGas) updateGasCards(csvRows);
}

function updateGasCards(csvRows) {
    GAS_VARIABLES.forEach(variable => {
        const values = csvRows
            .map(row => row[variable])
            .filter(v => v !== null && v !== undefined && v !== '' && !isNaN(v))
            .map(Number);

        const avgText = document.getElementById(`${variable}-value`);
        const maxText = document.getElementById(`${variable}-max`);
        const minText = document.getElementById(`${variable}-min`);

        if (variable === 'amon' || variable === 'temp_f' || variable === 'hum') {
            let secondChance,newRow;
            
            if (variable === 'amon') {1
                newRow = 'nh3';
            } else if (variable === 'temp_f') {
                newRow = 'temp_nh3';
            } else {
                newRow = 'hum_nh3';
            }
            
            if (!values.length) {
                secondChance = csvRows
                    .map(row => row[newRow])
                    .filter(v => v !== null && v !== undefined && v !== '' && !isNaN(v))
                    .map(Number);
            } else {
                secondChance = values;
            }
            
            const finalValues = calculateFinalValues(secondChance);
            if (avgText) avgText.textContent = secondChance.length ? finalValues.promedio.toFixed(2) : "N/A";
            if (maxText) maxText.textContent = secondChance.length ? finalValues.maximo.toFixed(2) : "--";
            if (minText) minText.textContent = secondChance.length ? finalValues.minimo.toFixed(2) : "--";
            return;
        }

        const finalValues = calculateFinalValues(values);

        if (avgText) avgText.textContent = values.length ? finalValues.promedio.toFixed(2) : "N/A";
        if (maxText) maxText.textContent = values.length ? finalValues.maximo.toFixed(2) : "--";
        if (minText) minText.textContent = values.length ? finalValues.minimo.toFixed(2) : "--";
    });
}

function updateAllCharts(csvRows, theresGas=true) {
    if (!window.chartById) return;

    const hasTimestamps = csvRows.some(r => extractTimestamp(r) !== null);
    const total = csvRows.length;
    const markerSize = total > 500 ? 0 : (total > 200 ? 1.5 : 3.5);

    Object.keys(CHART_MAP).forEach(group => {
        CHART_MAP[group].forEach(({ campo,chartId }) => {
            const chart = window.chartById[chartId];
            if (!chart) return;
            const readableName = VARIABLE_NAMES[campo] || campo;
            let seriesData;
            let xaxisOpts;

            if (hasTimestamps) {
                seriesData = csvRows
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
                seriesData = csvRows.map(r => {
                    const v = r[campo];
                    return (v === null || v === undefined || v === '' || isNaN(v)) ? null : Number(v);
                });
                xaxisOpts = {
                    type: 'category',
                    categories: csvRows.map((_,i) => `#${i + 1}`)
                };
            }

            // Actualizar el título del eje Y con el nombre legible
            chart.updateOptions({
                xaxis: xaxisOpts,
                yaxis: {
                    title: { text: readableName }
                },
                markers: { size: markerSize }
            },false,false);

            // Actualizar la serie con el nombre legible
            chart.updateSeries([{ name: readableName,data: seriesData }],true);
        });
    });
    
    if (!theresGas) updateGasCharts(csvRows);
}

function updateGasCharts(csvRows) {
    if (!window.chartById) return;

    const hasTimestamps = csvRows.some(r => extractTimestamp(r) !== null);
    const total = csvRows.length;
    const markerSize = total > 500 ? 0 : (total > 200 ? 1.5 : 3.5);

    Object.keys(GAS_CHART_MAP).forEach(group => {
        GAS_CHART_MAP[group].forEach(({ campo,chartId }) => {
            const chart = window.chartById[chartId];
            if (!chart) return;
            const readableName = VARIABLE_NAMES[campo] || campo;
            let seriesData;
            let xaxisOpts;

            if (hasTimestamps) {
                seriesData = csvRows
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
                seriesData = csvRows.map(r => {
                    const v = r[campo];
                    return (v === null || v === undefined || v === '' || isNaN(v)) ? null : Number(v);
                });
                xaxisOpts = {
                    type: 'category',
                    categories: csvRows.map((_,i) => `#${i + 1}`)
                };
            }

            // Actualizar el título del eje Y con el nombre legible
            chart.updateOptions({
                xaxis: xaxisOpts,
                yaxis: {
                    title: { text: readableName }
                },
                markers: { size: markerSize }
            },false,false);

            // Actualizar la serie con el nombre legible
            chart.updateSeries([{ name: readableName,data: seriesData }],true);
        });
    });
}

// ---------------
// GRAPHS
// ---------------

function setupCharts() {
    const isCurrentlyDark = document.body.classList.contains('cv-dark-mode');
    
    Object.keys(chartConfigs).forEach(function (group) {
        chartConfigs[group].forEach(function (cfg) {
            const el = document.getElementById(cfg.id);
            if (!el) return;
            const chart = new ApexCharts(el,buildChartOptions(cfg,isCurrentlyDark));
            chart.render();
            dashboardCharts[group].push(chart);
            window.chartById[cfg.id] = chart;
        });
    });

    const allCharts = [].concat(dashboardCharts.ambiente,dashboardCharts.suelo,dashboardCharts.gases);
    window.dashboardCharts = dashboardCharts;

    window.updateAmbienteChart = function (c,s) { updateGroup('ambiente',c,s); };
    window.updateSueloChart = function (c,s) { updateGroup('suelo',c,s); };
    window.updateGasesChart = function (c,s) { updateGroup('gases',c,s); };

    if (typeof $ !== 'undefined') {
        $('a[data-toggle="pill"]').on('shown.bs.tab',function () {
            setTimeout(function () {
                allCharts.forEach(function (chart) { chart.windowResizeHandler(); });
                window.dispatchEvent(new Event('resize'));
            },60);
        });
    }
}

function buildChartOptions(cfg,dark) {
    const fmt = (v) => (v === undefined || v === null) ? '--' : Number(v).toFixed(cfg.decimals);
    return {
        chart: {
            height: 280,
            type: 'line',
            toolbar: {
                show: true,
                tools: { download: true,selection: false,zoom: true,zoomin: true,zoomout: true,pan: true,reset: true }
            },
            animations: { enabled: true,easing: 'easeinout',speed: 700 }
        },
        theme: { mode: dark ? 'dark' : 'light' },
        colors: [cfg.color],
        series: [{ name: cfg.name,data: cfg.data }],
        stroke: { curve: 'smooth',width: 2.5 },
        markers: { size: 3.5,strokeWidth: 1.5,hover: { size: 6 } },
        grid: {
            borderColor: dark ? '#23334D' : '#EEF4F2',
            strokeDashArray: 4,
            padding: { left: 15,right: 15 }
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
                    const hh = String(d.getHours()).padStart(2,'0');
                    const mm = String(d.getMinutes()).padStart(2,'0');
                    return `${hh}:${mm}`;
                }
            },
            tooltip: {
                enabled: true,
                formatter: function (value) {
                    const d = new Date(value);
                    const hh = String(d.getHours()).padStart(2,'0');
                    const mm = String(d.getMinutes()).padStart(2,'0');
                    return `${hh}:${mm}`;
                }
            }
        },
        yaxis: {
            title: { text: cfg.name + ' (' + cfg.unit + ')',style: { color: cfg.color,fontSize: '11px' } },
            min: cfg.min,
            max: cfg.max,
            tickAmount: cfg.tickAmount,
            labels: { style: { colors: cfg.color },formatter: fmt }
        },
        tooltip: {
            theme: dark ? 'dark' : 'light',
            style: { fontSize: '12px',fontFamily: 'Open Sans, sans-serif' },
            y: { formatter: (v) => (v === undefined || v === null) ? '--' : fmt(v) + ' ' + cfg.unit }
        }
    };
}

function updateGroup(group,categories,seriesData) {
    dashboardCharts[group].forEach(function (chart,i) {
        if (categories) chart.updateOptions({ xaxis: { categories: categories } },false,true);
        if (seriesData && seriesData[i] !== undefined) {
            const s = seriesData[i];
            chart.updateSeries([Array.isArray(s) ? { data: s } : s]);
        }
    });
}

// ---------------
// HELPERS
// ---------------

function updateFilterSummary() {
    const filterDateFrom = document.getElementById('filter-date-from');
    const filterDateTo = document.getElementById('filter-date-to');
    const filterStation = document.getElementById('filter-station');
    const filterCity = document.getElementById('filter-location');
    const filterDot = document.getElementById('cvFilterDot');
    const filterFeedback = document.getElementById('cvFiltersFeedback');
    const filterSummary = document.getElementById('cvFiltersSummary');

    const hasDateFrom = filterDateFrom && filterDateFrom.value.trim() !== '';
    const hasDateTo = filterDateTo && filterDateTo.value.trim() !== '';
    const hasStation = filterStation && filterStation.value.trim() !== '';
    const hasCity = filterCity && filterCity.value.trim() !== '';

    const isActive = hasDateFrom || hasDateTo || hasStation || hasCity;

    if (filterDot) filterDot.style.display = isActive ? 'block' : 'none';

    if (filterFeedback && filterSummary) {
        if (isActive) {
            let tags = [];
            if (hasDateFrom && hasDateTo) tags.push(`${filterDateFrom.value} al ${filterDateTo.value}`);
            else if (hasDateFrom) tags.push(`Desde ${filterDateFrom.value}`);
            else if (hasDateTo) tags.push(`Hasta ${filterDateTo.value}`);
            if (hasStation) tags.push(`Estación ${filterStation.value}`);
            if (hasCity) tags.push(filterCity.value);

            filterSummary.innerHTML = `<i class="fas fa-filter mr-1 text-primary"></i> ${tags.join(' • ')}`;
            filterFeedback.style.display = 'block';
        } else {
            filterFeedback.style.display = 'none';
        }
    }

    return {
        dateFrom: filterDateFrom ? filterDateFrom.value : '',
        dateTo: filterDateTo ? filterDateTo.value : '',
        station: filterStation ? filterStation.value : '',
        city: filterCity ? filterCity.value : ''
    };
}

function toggleFilterPanel() {
    const filterBtn = document.getElementById('cvSidebarFilterBtn');
    const filterPanel = document.getElementById('cvSidebarFiltersPanel');

    if (!filterPanel) return;
    const isOpen = filterPanel.classList.toggle('cv-panel-open');
    if (filterBtn) filterBtn.classList.toggle('active',isOpen);
}

function closeFilterPanel() {
    const filterBtn = document.getElementById('cvSidebarFilterBtn');
    const filterPanel = document.getElementById('cvSidebarFiltersPanel');

    if (!filterPanel) return;
    filterPanel.classList.remove('cv-panel-open');
    if (filterBtn) filterBtn.classList.remove('active');
}

function triggerChartResize() {
    const allCharts = [].concat(dashboardCharts.ambiente,dashboardCharts.suelo,dashboardCharts.gases);
    setTimeout(function () {
        allCharts.forEach(chart => chart.windowResizeHandler());
        window.dispatchEvent(new Event('resize'));
    },360);
}

function toggleSidebar() {
    const dashContainer = document.querySelector('.cv-dashboard');
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
        localStorage.setItem('cv_sidebar_collapsed',isCollapsed ? '1' : '0');
    }
    triggerChartResize();
}

function closeSidebar() {
    if (window.innerWidth < 992) {
        dashContainer.classList.remove('cv-sidebar-open-mobile');
        document.body.classList.remove('cv-sidebar-is-open');
    } else {
        dashContainer.classList.add('cv-sidebar-collapsed');
        localStorage.setItem('cv_sidebar_collapsed','1');
    }
    triggerChartResize();
}

async function getContents(path) {
    const url = `https://api.github.com/repos/${OWNER}/${REPO}/contents/${path}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error(`GitHub respondió ${res.status}`);
    return res.json();
}

function showFirstCampaign() {
    const campaignContainer = document.getElementById("file-container");
    const first = campaignContainer.querySelector(".nav-link");
    if (first) first.click();
}

async function getFolders() {
    return await getContents(PATH);
}

function getSortedCampaigns(folders) {
    let campaigns = folders.filter(folder => folder.type === "dir");
    campaigns.sort((a,b) => b.name.localeCompare(a.name));
    return campaigns;
}

function parseCampaignName(campaignName) {
    const parts = campaignName.split('_');
    let date = null,station = "",location = "";

    // Fecha: "20261019" => "2026-10-19"
    if (parts[0] && /^\d{8}$/.test(parts[0])) {
        date = `${parts[0].slice(0,4)}-${parts[0].slice(4,6)}-${parts[0].slice(6,8)}`;
    }

    // Estación: "id1" => "1"
    if (parts[1]) {
        const m = parts[1].match(/id(\d+)/i);
        if (m) station = m[1];
    }

    // Localidad: "chetumal" => "Chetumal"
    if (parts[2]) {
        location = parts[2].charAt(0).toUpperCase() + parts[2].slice(1).toLowerCase();
    }

    return { date,station,location };
}

function fillStationSelect(stationSet) {
    const stationSelect = document.getElementById('filter-station');
    stationSelect.innerHTML = '<option value="">Todas las estaciones</option>';
    Array.from(stationSet).sort((a,b) => a - b).forEach(st => {
        const opt = document.createElement('option');
        opt.value = st;
        opt.textContent = `Estación ${st}`;
        stationSelect.appendChild(opt);
    });
}

function fillLocationSelect(locationSet) {
    const locationSelect = document.getElementById('filter-location');
    locationSelect.innerHTML = '<option value="">Todas las localidades</option>';

    Array.from(locationSet).sort().forEach(location => {
        const opt = document.createElement('option');
        opt.value = location;
        opt.textContent = location;
        locationSelect.appendChild(opt);
    });
}

function formatCampaignName(campaignName) {
    const meta = parseCampaignName(campaignName);
    if (!meta.date) return campaignName;
    const [year,month,day] = meta.date.split('-');
    const meses = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
    const mesNombre = meses[parseInt(month) - 1];
    const yearShort = year.slice(-2);
    const fechaFormateada = `${day}/${mesNombre}/${yearShort} - Estación ${meta.station}`;
    return fechaFormateada;
}

async function getCSV(campaignPath, fileName) {
    const items = await getContents(campaignPath);
    let csvItem;
    
    if (fileName) {
        csvItem = items.find(i => {
            if (i.type !== "file") return false;
            if (!/\.csv$/i.test(i.name)) return false;

            if (fileName instanceof RegExp) return fileName.test(i.name);

            return i.name.toLowerCase() === fileName.toLowerCase()
                || i.name.toLowerCase().includes(fileName.toLowerCase());
        });
    } else {
        csvItem = items.find(i => i.type === "file" && /\.csv$/i.test(i.name));
    }
    
    if (!csvItem) {
        console.warn(`No se encontró CSV en ${campaignPath}`);
        return;
    }
    
    return csvItem;
}

function establishCampaignName(path) {
    const campaignName = path.split('/').pop();
    const meta = parseCampaignName(campaignName);
    state.campaignMeta = meta;
}

function polishCsv(csvContent) {
    return csvContent.data.map(row => {
        const out = {};
        Object.keys(row).forEach(k => {
            const key = k
                .replace(/^\ufeff/,'')
                .trim()
                .replace(/^"|"$/g,'')
                .toLowerCase();
            out[key] = row[k];
        });
        return out;
    });
}

async function getRawTextFromCsv(csvUrl) {
    const res = await fetch(csvUrl);
    if (!res.ok) throw new Error(`No se pudo descargar el CSV (${res.status})`);
    return await res.text();
}

function parseRawText(csvText) {
    return Papa.parse(csvText,{
        header: true,
        skipEmptyLines: true,
        dynamicTyping: true
    });
}

async function readCsv(csvUrl) {
    const text = await getRawTextFromCsv(csvUrl);
    const csvContent = await parseRawText(text);
    const cleanedCsv = await polishCsv(csvContent);

    // Forzar columnas de tiempo a string
    cleanedCsv.forEach(r => {
        ['time','timestamp','date','datetime','fecha'].forEach(k => {
            if (r[k] !== undefined && r[k] !== null) r[k] = String(r[k]);
        });
    });
    return cleanedCsv;
}

function setDarkMode(isDark) {
    const themeBtn = document.getElementById('cvThemeToggle');
    const themeIcon = document.getElementById('cvThemeIcon');
    const themeLabel = document.getElementById('cvThemeModeLabel');
    const themeSub = document.getElementById('cvThemeModeSub');
    const dash = document.querySelector('.cv-dashboard');
    const allCharts = [].concat(dashboardCharts.ambiente,dashboardCharts.suelo,dashboardCharts.gases);
    window.dashboardCharts = dashboardCharts;

    if (isDark) {
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
    } else {
        document.documentElement.classList.remove('cv-dark-mode');
        document.body.classList.remove('cv-dark-mode');
        if (dash) dash.classList.remove('cv-dark');
        localStorage.setItem('cv_theme','light');

        if (themeIcon) themeIcon.className = 'fas fa-moon';
        if (themeLabel) themeLabel.innerText = 'Modo';
        if (themeSub) themeSub.innerText = 'Oscuro';

        if (window.dashboardCharts) {
            allCharts.forEach(chart => {
                if (chart) {
                    chart.updateOptions({
                        theme: { mode: 'light' },
                        grid: { borderColor: '#EEF4F2' },
                        xaxis: { labels: { style: { colors: '#627D98' } } }
                    },false,false);
                }
            });
        }
    }
}

function setupFilterListeners() {
    window.addEventListener('cv:filters-applied',(e) => {
        const filters = e.detail || {};
        state.filters = filters;
        filterSidebar(filters);
    });

    window.addEventListener('cv:filters-cleared',() => {
        state.filters = { dateFrom: "",dateTo: "",station: "",city: "" };
        filterSidebar(state.filters);
    });
}

function toLocalDateString(d) {
    const y = d.getFullYear();
    const m = String(d.getMonth() + 1).padStart(2,'0');
    const day = String(d.getDate()).padStart(2,'0');
    return `${y}-${m}-${day}`;
}

function extractTimestamp(row) {
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

function calculateFinalValues(valores) {
    if (!valores.length) return { actual: 0,promedio: 0,maximo: 0,minimo: 0 };
    const promedio = valores.reduce((a,b) => a + b,0) / valores.length;
    return {
        actual: valores[0],
        promedio,
        maximo: Math.max(...valores),
        minimo: Math.min(...valores)
    };
}

function updateWindCompass(csvRows) {
    let dirVals = csvRows.map(r => r.wind_dir_10min_deg)
        .filter(v => v !== null && v !== undefined && !isNaN(v))
        .map(Number);

    if (!dirVals.length) {
        dirVals = csvRows.map(r => r.wind_dir_10_mean)
            .filter(v => v !== null && v !== undefined && !isNaN(v))
            .map(Number);
    }

    if (dirVals.length && typeof window.setWindDirection === 'function') {
        const avg = dirVals.reduce((a,b) => a + b,0) / dirVals.length;
        window.setWindDirection(avg);
        const degEl = document.getElementById('wind_dir_10min_deg-value');
        if (degEl) degEl.textContent = avg.toFixed(1);
    }
}

window.setWindDirection = function (degrees,cardinalName) {
    degrees = parseFloat(degrees) || 0;
    const normalized = ((degrees % 360) + 360) % 360;
    const CARDINALS = ['N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSO','SO','OSO','O','ONO','NO','NNO']
    const cardinalIndex = Math.round(normalized / 22.5) % 16;
    const cardinal = cardinalName || CARDINALS[cardinalIndex];

    const wheel = document.getElementById('cv-wind-wheel');
    if (wheel) wheel.style.setProperty('--cv-wind-deg',normalized + 'deg');

    const degEl = document.getElementById('cv-wind-deg');
    if (degEl) degEl.innerText = Math.round(normalized);

    const cardEl = document.getElementById('cv-wind-cardinal');
    if (cardEl) cardEl.innerText = cardinal;
};

function setSidebarEvents() {
    const sidebarToggle = document.getElementById('cvSidebarToggle');
    const sidebarBackdrop = document.getElementById('cvSidebarBackdrop');

    if (sidebarToggle) sidebarToggle.addEventListener('click',toggleSidebar);
    if (sidebarBackdrop) sidebarBackdrop.addEventListener('click',closeSidebar);
}

function setFilterEvents() {
    const filterDateFrom = document.getElementById('filter-date-from');
    const filterDateTo = document.getElementById('filter-date-to');
    const filterStation = document.getElementById('filter-station');
    const filterCity = document.getElementById('filter-location');
    const filterBtn = document.getElementById('cvSidebarFilterBtn');
    const filterCloseBtn = document.getElementById('cvFiltersCloseBtn');
    const btnApplyFilters = document.getElementById('btn-apply-filters');
    const btnResetFilters = document.getElementById('btn-reset-filters');


    if (filterBtn) filterBtn.addEventListener('click',toggleFilterPanel);
    if (filterCloseBtn) filterCloseBtn.addEventListener('click',closeFilterPanel);

    if (btnApplyFilters) {
        btnApplyFilters.addEventListener('click',function () {
            updateFilterSummary();
            const filters = {
                dateFrom: filterDateFrom ? filterDateFrom.value : '',
                dateTo: filterDateTo ? filterDateTo.value : '',
                station: filterStation ? filterStation.value : '',
                city: filterCity ? filterCity.value : ''
            };
            window.dispatchEvent(new CustomEvent('cv:filters-applied',{ detail: filters }));
        });
    }

    if (btnResetFilters) {
        btnResetFilters.addEventListener('click',function () {
            if (filterDateFrom) filterDateFrom.value = '';
            if (filterDateTo) filterDateTo.value = '';
            if (filterStation) filterStation.value = '';
            if (filterCity) filterCity.value = '';
            updateFilterSummary();
            window.dispatchEvent(new CustomEvent('cv:filters-cleared'));
        });
    }
}

function setThemeEvent() {
    const themeBtn = document.getElementById('cvThemeToggle');
    if (themeBtn) {
        themeBtn.addEventListener('click',function () {
            setDarkMode(!document.body.classList.contains('cv-dark-mode'));
        });
    }
}

