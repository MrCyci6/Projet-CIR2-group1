const API = {
    url: "api",
    params: {
        key: "",
    }
};

const params = new URLSearchParams(document.location.search);
let page = params.get("page") || 1;
let rows = params.get("rows") || 20;

const loadInstallations = (data) => {
    if(!data.success) return;

    const list = document.getElementById("list-instal");
    list.innerHTML = ""
    for(let i = 0; i < data.data.length; i++) {
        const installation = data.data[i];

        list.innerHTML += `<tr>
            <td>${installation['id']}</td>
            <td>${installation['localite']}</td>
            <td>${installation['panneau']}</td>
            <td>${installation['onduleur']}</td>
            <td>${installation['mois']}/${installation['annee']}</td>
            <td>
                <a href="installation?id=${installation['id']}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link-icon lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                </a>
            </td>
        </tr>`;
    }
}

const submitSearch = (event) => {
    event.preventDefault();

    const form = event.target;
    API.params.query = form.query.value || "";
    API.params.rows = form.rows.value;
    API.params.page = page;

    ajaxRequest("GET", API.url + `/installation/search`, loadInstallations, API.params)
}

const changePage = (event) => {
    const pageText = event.target.textContent;
    switch(pageText) {
        case "Précédent":
            page = page == 1 ? 1 : page-1;
            break;
        case "Suivant":
            page = page+1;
            break;
        case "..":
            break;
        default:
            page = pageText
    }

    submitSearch({ target: document.getElementById("searchForm"), preventDefault: () => {} });
}

const loadPanneaux = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("id_panneau");
    for(let i = 0; i < data.data.length; i++) {
        const panneau = data.data[i];
        select.innerHTML += `
            <option value="${panneau["id"]}">${panneau["modele"]} (${panneau["marque"]})</option>
        `;
    }
}

const loadOnduleurs = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("id_onduleur");
    for(let i = 0; i < data.data.length; i++) {
        const onduleur = data.data[i];
        select.innerHTML += `
            <option value="${onduleur["id"]}">${onduleur["modele"]} (${onduleur["marque"]})</option>
        `;
    }
}

const loadInstallateurs = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("id_installateur");
    for(let i = 0; i < data.data.length; i++) {
        const installateur = data.data[i];
        select.innerHTML += `
            <option value="${installateur["id"]}">${installateur["denomination"]}</option>
        `;
    }
}

const loadLocalite = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("code_insee");
    for(let i = 0; i < data.data.length; i++) {
        const localite = data.data[i];
        select.innerHTML += `
            <option value="${localite["code_insee"]}">${localite["denomination"]} (${localite["code_departement"]})</option>
        `;
    }
}

const createInstallation = (data, code) => {
    if(code != 201) return;

    document.getElementById("close").click();
}

const addInstallation = (event) => {
    event.preventDefault();

    const form = event.target;
    API.params.puissance_crete = form.puissance_crete.value;
    API.params.surface = form.surface.value;
    API.params.pente = form.pente.value;
    API.params.pente_optimum = form.pente_optimum.value;
    API.params.orientation = form.orientation.value;
    API.params.orientation_optimum = form.orientation_optimum.value;
    API.params.production_pvgis = form.production_pvgis.value;
    API.params.mois = form.mois.value;
    API.params.annee = form.annee.value;
    API.params.latitude = form.latitude.value;
    API.params.longitude = form.longitude.value;
    API.params.code_insee = form.code_insee.value;
    API.params.id_installateur = form.id_installateur.value;
    API.params.id_panneau = form.id_panneau.value;
    API.params.nb_panneau = form.nb_panneau.value;
    API.params.id_onduleur = form.id_onduleur.value;
    API.params.nb_onduleur = form.nb_onduleur.value;
    API.params.political = "";

    ajaxRequest("POST", API.url + "/installation", createInstallation, API.params);
}

document.addEventListener("DOMContentLoaded", () => {
    API.params.page = page;
    API.params.rows = rows;
    ajaxRequest("GET", API.url + `/installation`, loadInstallations, API.params);

    delete API.params.page;
    delete API.params.rows;
    ajaxRequest("GET", API.url + `/panneau`, loadPanneaux, API.params);
    ajaxRequest("GET", API.url + `/onduleur`, loadOnduleurs, API.params);
    ajaxRequest("GET", API.url + `/installateur`, loadInstallateurs, API.params);
    ajaxRequest("GET", API.url + `/localite`, loadLocalite, API.params);

    const add = document.getElementById("addInstallation");
    add.addEventListener("submit", addInstallation);

    const form = document.getElementById("searchForm");
    form.addEventListener('submit', submitSearch);

    const pages = document.querySelectorAll(".page-link");
    pages.forEach(page => {
        page.addEventListener("click", changePage);
    })
});