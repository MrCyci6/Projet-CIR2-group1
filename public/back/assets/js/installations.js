const API = {
    url: "api",
    params: {
        key: "",
    }
};

const params = new URLSearchParams(document.location.search);
const page = params.get("page") || 1;
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
        API.params.id_marque = form.id_marque.value || 0;
        API.params.id_modele = form.id_modele.value || 0;
        API.params.code_departement = form.code_departement.value || 0;
        API.params.rows = form.rows.value;

        ajaxRequest("GET", API.url + `/installation/search`, loadInstallations, API.params)
    }

document.addEventListener("DOMContentLoaded", () => {
    API.params.page = page;
    API.params.rows = rows;
    ajaxRequest("GET", API.url + `/installation`, loadInstallations, API.params);

    const form = document.getElementById("searchForm");
    form.addEventListener('submit', submitSearch);
});