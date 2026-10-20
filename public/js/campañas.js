const OWNER = "Collective-View";
const REPO = "Sargassum_Air_Quality";
const PATH = "data";

const CAMPOS = [
    "wind_ms",
    "wind_dir_10_mean",
    "out_feels_like_c",
    "a_hum",
    "pres_rel_hpa",
    "solar_rad_wm2",
    "uv_index",
    "rain_rate_mmhr",
    "out_temp_c",
    "out_hum",
    "nh3",
    "temp_nh3",
    "hum_nh3",
    "h2s",
    "o2",
    "co",
    "lel"
];

document.addEventListener('DOMContentLoaded',async function () {
    await loadFolders();
});

async function loadFolders() {
    const items = await getContents(PATH);
    const folders = items.filter(item => item.type === "dir");

    const container = document.getElementById("file-container");
    let html = '';

    folders.forEach(folder => {
        const displayName = formatFolderName(folder.name);
        html += `
        <a class="nav-link" href="javascript:void(0);" data-path="${folder.path}">
            <span>${displayName}</span>
        </a>`;
    });
    
    container.innerHTML = html;
    
    container.addEventListener("click",(e) => {
        const link = e.target.closest(".nav-link");
        if (link) {
            const path = link.dataset.path;
            renderCards(path);
        }
    });
}

function formatFolderName(name) {
    const match = name.match(/^(\d{4})(\d{2})(\d{2})/);

    if (!match) return name;

    const year = match[1];
    const month = match[2];
    const day = match[3];

    const date = new Date(year,parseInt(month) - 1,day);

    const formatter = new Intl.DateTimeFormat('es-ES',{
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });

    const formattedDate = formatter.format(date);

    return `Campaña del ${formattedDate}`;
}

async function getContents(path) {
    const url = `https://api.github.com/repos/${OWNER}/${REPO}/contents/${path}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error(`GitHub respondió ${res.status}`);
    return res.json();
}

async function renderCards(path) {
    const items = await getContents(path);
    const csv = items[0];
    
    const rows = await readCsv(csv.download_url);

    CAMPOS.forEach(campo => {
        const valores = rows.map(row => row[campo]).filter(v => v !== null && v !== undefined && v !== '');
        
        const stats = calcularStats(valores);
        
        const valueEl = document.getElementById(`${campo}-value`);
        const maxEl = document.getElementById(`${campo}-max`);
        const minEl = document.getElementById(`${campo}-min`);

        if (valueEl) valueEl.textContent = stats.promedio.toFixed(2) || "N/A";
        if (maxEl) maxEl.textContent = stats.maximo.toFixed(2);
        if (minEl) minEl.textContent = stats.minimo.toFixed(2);
    });
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

    if (result.errors.length) console.warn("Avisos al parsear:",result.errors);
    return result.data;
}

function calcularStats(valores) {
    if (valores.length === 0) {
        return { actual: "N/A",promedio: 0,maximo: 0,minimo: 0 };
    }

    const promedio = valores.reduce((a,b) => a + b,0) / valores.length;
    const maximo = Math.max(...valores);
    const minimo = Math.min(...valores);

    return {
        actual: valores[0],
        promedio: promedio,
        maximo: maximo,
        minimo: minimo
    };
}
