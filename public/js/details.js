const API = {
    url: "back/api",
    params: {}
};

const params = new URLSearchParams(document.location.search);
const id = params.get("id") || 1;

const loadInstallation = (data, code) => {
	if(code != 200) return;

	const container = document.getElementById("detailsContainer");
	container.innerHTML = `
		<p><strong>Date d'installation :</strong> ${data.data["mois"]}/${data.data["annee"]}</p>
		<p><strong>Nombre de panneaux :</strong> ${data.data["nb_panneau"]}</p>
		<p><strong>Surface :</strong> ${data.data["surface"]} m²</p>
		<p><strong>Puissance crête :</strong> ${data.data["puissance_crete"]} kWc</p>
		<p><strong>Localisation :</strong> ${data.data["localite"]} (${data.data["code_departement"]})</p>
		<p><strong>Onduleur :</strong> ${data.data["onduleur"]}</p>
		<p><strong>Panneaux :</strong> ${data.data["panneau"]}</p>
    `;
}

document.addEventListener('DOMContentLoaded', () => {
	API.params.id = id; 
	ajaxRequest("GET", API.url + "/installation", loadInstallation, API.params);
});