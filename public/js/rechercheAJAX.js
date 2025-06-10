const API = {
    url: "back/api",
    params: {}
};

const params = new URLSearchParams(document.location.search);

const page = params.get("page") || 1;
API.params.page = page;

const rows = params.get("rows") || 20;
API.params.rows = rows;

const loadOnduleursMarques = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("marqueOnduleur");
    select.innerHTML = `<option value="0">Toutes les marques d'onduleurs</option>`;
    for(let i = 0; i < data.data.length; i++) {
        const marque = data.data[i];
        select.innerHTML += `<option value="${marque["id"]}">${marque["denomination"]}</option>`;
    }
}

const loadPanneauxMarques = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("marquePanneaux");
    select.innerHTML = `<option value="0">Toutes les marques de panneau</option>`;
    for(let i = 0; i < data.data.length; i++) {
        const marque = data.data[i];
        select.innerHTML += `<option value="${marque["id"]}">${marque["denomination"]}</option>`;
    }
}

const loadDepartements = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("departement");
    select.innerHTML = `<option value="0">Tous les départements</option>`;
    for(let i = 0; i < data.data.length; i++) {
        const departement = data.data[i];
        select.innerHTML += `<option value="${departement["code"]}">${departement["denomination"]}</option>`;
    }
}

const loadInstallations = (data, code) => {
    if(code != 200) return;

    const body = document.getElementById("resultTableBody");
    body.innerHTML = "";
    for(let i = 0; i < data.data.length; i++) {
        const result = data.data[i];
        body.innerHTML += `<tr>
            <td>${result['mois']}/${result['annee']}</td>    
            <td class="text-center">${result['nb_panneau']}</td>
            <td class="text-center">${result['surface']}</td>
            <td class="text-center">${result['puissance_crete']}</td>
            <td class="ville-cell">${result['localite']} (${result['code_departement']})</td>
            <td class="text-center">
                <a class="btn btn-primary">Voir</a>
            </td>
        </tr>`;
    }
}

const updateSearch = (event) => {
    event.preventDefault();
    
    API.params.id_panneau = event.target.marquePanneaux.value || 0;
    API.params.id_onduleur = event.target.marqueOnduleur.value || 0;
    API.params.code_departement = event.target.departement.value || 0;
    API.params.query = event.target.query.value;

    ajaxRequest("GET", API.url + `/installation/search`, loadInstallations, API.params);
}

document.addEventListener('DOMContentLoaded', () => {
    ajaxRequest("GET", API.url + `/onduleur/marques`, loadOnduleursMarques, API.params);
    ajaxRequest("GET", API.url + `/panneau/marques`, loadPanneauxMarques, API.params);
    ajaxRequest("GET", API.url + `/departement`, loadDepartements, API.params);

    // ajaxRequest("GET", API.url + `/installation`, loadInstallations, API.params);

    const form = document.getElementById("searchForm");
    form.addEventListener('submit', updateSearch);
});
