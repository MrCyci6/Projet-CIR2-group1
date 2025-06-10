const API = {
    url: "api",
    params: {
        key: "",
    }
};

const params = new URLSearchParams(document.location.search);
const id = params.get("id") || 1;

const loadInstallation = (data, code) => {
    if(code != 200) return;

    const installation = data.data;
    const detailsBody = document.getElementById("details-body");
    detailsBody.innerHTML = `
    <p><strong>Date d'installation:</strong> ${installation['mois']}/${installation['annee']}</p>
    <p><strong>Localisation:</strong> ${installation['latitude']}, ${installation['longitude']}</p>
    <p><strong>Localité:</strong> ${installation['localite']} (${installation['code_departement']})</p>
    <p><strong>Pente:</strong> ${installation['pente']}</p>
    <p><strong>Surface:</strong> ${installation['surface']} m²</p>
    <p><strong>Orientation:</strong> ${installation['orientation']} °</p>`;

    if(installation["id_installateur"]) {
        API.params.id = installation["id_installateur"];
        ajaxRequest("GET", API.url + "/installateur", loadInstallateur, API.params);
    }

    const resumtBody = document.getElementById("resume-body");
    resumtBody.innerHTML = `
    <p><strong>Puissance:</strong> ${installation['puissance_crete']} kW/c</p>
    <p><strong>Production:</strong> ${installation['production_pvgis']} kW/h</p>
    <p><strong>Panneaux:</strong> x${installation['nb_panneau']} ${installation['panneau']}</p>
    <p><strong>Onduleurs:</strong> x${installation['nb_onduleur']} ${installation['onduleur']}</p>`;

    const modalForm = document.getElementById("editInstallation");
    modalForm.puissance_crete.value = installation["puissance_crete"];
    modalForm.surface.value = installation["surface"];
    modalForm.pente.value = installation["pente"];
    modalForm.pente_optimum.value = installation["pente_optimum"];
    modalForm.orientation.value = installation["orientation"];
    modalForm.orientation_optimum.value = installation["orientation_optimum"];
    modalForm.production_pvgis.value = installation["production_pvgis"];
    modalForm.mois.value = installation["mois"];
    modalForm.annee.value = installation["annee"];
    modalForm.latitude.value = installation["latitude"];
    modalForm.longitude.value = installation["longitude"];
    modalForm.id_installateur.value = installation["id_installateur"];
    modalForm.id_panneau.value = installation["id_panneau"];
    modalForm.id_onduleur.value = installation["id_onduleur"];
    modalForm.nb_panneau.value = installation["nb_panneau"];
    modalForm.nb_onduleur.value = installation["nb_onduleur"];
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

const loadInstallateur = (data, code) => {
    if(code != 200) return;

    const detailsBody = document.getElementById("details-body");
    detailsBody.innerHTML += `<p><strong>Installateur:</strong> ${data.data['denomination']} </p>`;
}

const modifyInstallation = (data, code) => {
    if(code != 200) return;

    document.getElementById("close").click();
}

const editInstallation = (event) => {
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

    ajaxRequest("PUT", API.url + `/installation/${id}`, modifyInstallation, API.params);
}

document.addEventListener("DOMContentLoaded", () => {
    API.params.id = id;
    ajaxRequest("GET", API.url + "/installation", loadInstallation, API.params);
    
    delete API.params.id;
    ajaxRequest("GET", API.url + `/panneau`, loadPanneaux, API.params);
    ajaxRequest("GET", API.url + `/onduleur`, loadOnduleurs, API.params);
    ajaxRequest("GET", API.url + `/installateur`, loadInstallateurs, API.params);
    ajaxRequest("GET", API.url + `/localite`, loadLocalite, API.params);

    const edit = document.getElementById("editInstallation");
    edit.addEventListener("submit", editInstallation);
});