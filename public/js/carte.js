const API = {
    url: "back/api",
    params: {}
};

const map = L.map("map");
const layers = L.layerGroup().addTo(map);

const loadMarkers = (data, code) => {
	if(code != 200) return;

	for(let i = 0; i < data.data.length; i++) {
		const markerData = data.data[i];
		const marker = L.circleMarker([markerData["latitude"], markerData["longitude"]], {
			radius: Math.sqrt(markerData['nb_installations']),
			color: "blue",
			fillOpcaity: 0.6
		})
		.bindPopup(`
			${markerData["nom_departement"]} (${markerData["code_departement"]})<br>
			${markerData['nb_installations']} installations<br>
			${markerData['production_totale']} kW/h<br>
			${markerData['puissance_totale']} kW/c
		`);
		layers.addLayer(marker);
	}
}

const loadMarkersByLocalite = (data, code) => {
	if(code != 200) return;

	for(let i = 0; i < data.data.length; i++) {
		const markerData = data.data[i];
		const marker = L.marker([markerData["latitude"], markerData["longitude"]])
		.bindPopup(`
			${markerData["localite"]}<br>
			${markerData['production_pvgis']} kW/h<br>
			${markerData['puissance_crete']} kW/c<br>
			<a href="details.html?id=${markerData['id']}">Voir</a>
		`);
		layers.addLayer(marker);
	}
}

const updateMap = (event) => {
	const zoom = map.getZoom();
	API.params.annee = document.getElementById("annee").value ?? 0;
	API.params.code_departement = document.getElementById("departement").value ?? 0;

	layers.clearLayers();
	if(zoom < 9) {
		delete API.params.bbox;
  		ajaxRequest("GET", API.url + "/installation/aggregated", loadMarkers, API.params);
	} else {
		const bounds = map.getBounds();
		API.params.bbox = [bounds.getWest(), bounds.getSouth(), bounds.getEast(), bounds.getNorth()].join(",");
  		ajaxRequest("GET", API.url + "/installation/aggregated", loadMarkersByLocalite, API.params);
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

const loadAnnee = (data, code) => {
    if(code != 200) return;

    const select = document.getElementById("annee");
    select.innerHTML = `<option value="0">Toutes les années</option>`;
    for(let i = 0; i < data.by_year.length; i++) {
        const annee = data.by_year[i];
        select.innerHTML += `<option value="${annee["annee"]}">${annee["annee"]}</option>`;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    ajaxRequest("GET", API.url + `/departement`, loadDepartements, API.params);
    ajaxRequest("GET", API.url + `/installation/stats`, loadAnnee, API.params);

	map.setView([46.5, 2.5], 5);
	L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors'})
		.addTo(map);
  	ajaxRequest("GET", API.url + "/installation/aggregated", loadMarkers, API.params);
	map.on('moveend zoomed', updateMap);

	document.getElementById("annee").addEventListener("change", updateMap);
	document.getElementById("departement").addEventListener("change", updateMap);
});