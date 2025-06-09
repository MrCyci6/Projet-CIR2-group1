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
}

const loadInstallateur = (data, code) => {
    if(code != 200) return;

    const detailsBody = document.getElementById("details-body");
    detailsBody.innerHTML += `<p><strong>Installateur:</strong> ${data.data['denomination']} </p>`;
}

document.addEventListener("DOMContentLoaded", () => {
    API.params.id = id;
    ajaxRequest("GET", API.url + "/installation", loadInstallation, API.params);
});