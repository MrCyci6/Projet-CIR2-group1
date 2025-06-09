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

document.addEventListener("DOMContentLoaded", () => {
    API.params.page = page;
    API.params.rows = rows;
    ajaxRequest("GET", API.url + `/installation`, loadInstallations, API.params);

    const form = document.getElementById("searchForm");
    form.addEventListener('submit', submitSearch);

    const pages = document.querySelectorAll(".page-link");
    pages.forEach(page => {
        page.addEventListener("click", changePage);
    })
});