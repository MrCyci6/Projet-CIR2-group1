const installations = [
  { id: 1, annee: "2022", departement: "44", ville: "Nantes", puissance: 3.5, lat: 47.2186, lng: -1.5536 },
  { id: 2, annee: "2023", departement: "69", ville: "Lyon", puissance: 5.2, lat: 45.7634, lng: 4.8343 },
  { id: 3, annee: "2021", departement: "31", ville: "Toulouse", puissance: 2.8, lat: 43.6047, lng: 1.4442 },
  { id: 4, annee: "2020", departement: "13", ville: "Marseille", puissance: 6.0, lat: 43.2965, lng: 5.3698 },
  { id: 5, annee: "2021", departement: "75", ville: "Paris", puissance: 3.9, lat: 48.8647, lng: 2.3490 },
  { id: 6, annee: "2022", departement: "59", ville: "Lille", puissance: 4.5, lat: 50.6292, lng: 3.0573 },
  { id: 7, annee: "2023", departement: "06", ville: "Nice", puissance: 4.1, lat: 43.7102, lng: 7.2620 },
  { id: 8, annee: "2022", departement: "67", ville: "Strasbourg", puissance: 3.0, lat: 48.5734, lng: 7.7521 },
  { id: 9, annee: "2023", departement: "33", ville: "Bordeaux", puissance: 5.5, lat: 44.8378, lng: -0.5792 },
  { id: 10, annee: "2021", departement: "35", ville: "Rennes", puissance: 1.8, lat: 48.1173, lng: -1.6778 },
  { id: 11, annee: "2020", departement: "76", ville: "Rouen", puissance: 2.9, lat: 49.4431, lng: 1.0993 },
  { id: 12, annee: "2022", departement: "25", ville: "Besançon", puissance: 3.7, lat: 47.2378, lng: 6.0241 },
  { id: 13, annee: "2021", departement: "45", ville: "Orléans", puissance: 2.4, lat: 47.9029, lng: 1.9093 },
  { id: 14, annee: "2023", departement: "42", ville: "Saint-Étienne", puissance: 4.0, lat: 45.4397, lng: 4.3872 },
  { id: 15, annee: "2020", departement: "49", ville: "Angers", puissance: 3.1, lat: 47.4784, lng: -0.5632 },
  { id: 16, annee: "2021", departement: "21", ville: "Dijon", puissance: 2.2, lat: 47.3220, lng: 5.0415 },
  { id: 17, annee: "2022", departement: "38", ville: "Grenoble", puissance: 4.3, lat: 45.1885, lng: 5.7245 },
  { id: 18, annee: "2023", departement: "64", ville: "Pau", puissance: 3.6, lat: 43.2951, lng: -0.3708 },
  { id: 19, annee: "2020", departement: "83", ville: "Toulon", puissance: 3.2, lat: 43.1242, lng: 5.9280 },
  { id: 20, annee: "2021", departement: "14", ville: "Caen", puissance: 2.7, lat: 49.1829, lng: -0.3700 },
  { id: 21, annee: "2022", departement: "63", ville: "Clermont-Ferrand", puissance: 4.6, lat: 45.7772, lng: 3.0870 },
  { id: 22, annee: "2023", departement: "86", ville: "Poitiers", puissance: 2.5, lat: 46.5802, lng: 0.3404 },
  { id: 23, annee: "2020", departement: "02", ville: "Laon", puissance: 1.9, lat: 49.5624, lng: 3.6245 },
  { id: 24, annee: "2021", departement: "11", ville: "Carcassonne", puissance: 2.3, lat: 43.2130, lng: 2.3517 },
  { id: 25, annee: "2022", departement: "17", ville: "La Rochelle", puissance: 3.4, lat: 46.1603, lng: -1.1511 },
  { id: 26, annee: "2023", departement: "29", ville: "Brest", puissance: 3.0, lat: 48.3904, lng: -4.4861 },
  { id: 27, annee: "2020", departement: "34", ville: "Montpellier", puissance: 4.7, lat: 43.6111, lng: 3.8767 },
  { id: 28, annee: "2021", departement: "74", ville: "Annecy", puissance: 2.6, lat: 45.8992, lng: 6.1294 },
  { id: 29, annee: "2022", departement: "41", ville: "Blois", puissance: 1.7, lat: 47.5861, lng: 1.3359 },
  { id: 30, annee: "2023", departement: "24", ville: "Périgueux", puissance: 3.3, lat: 45.1840, lng: 0.7210 }
];

    const annees = Array.from({ length: 20 }, (_, i) => (2005 + i).toString());
    const departements = ["44", "69", "31", "13", "75", "33", "59", "34", "77", "83", "38", "76", "62", "35", "95", "91", "78", "67", "974", "29"];

    function chargerSelect(id, data) {
      const select = document.getElementById(id);
      data.forEach(item => {
        const option = document.createElement("option");
        option.value = item;
        option.textContent = item;
        select.appendChild(option);
      });
    }

    chargerSelect("annee", annees.reverse());
    chargerSelect("departement", departements);

    const map = L.map('map').setView([46.5, 2.2], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    let markers = [];

    function afficherMarkers(data) {
      markers.forEach(m => map.removeLayer(m));
      markers = [];

      data.forEach(item => {
        const marker = L.marker([item.lat, item.lng]).addTo(map);
        marker.bindPopup(`
          <strong>${item.ville} (${item.departement})</strong><br>
          Puissance : ${item.puissance} kWc<br>
          <a href="details.html?id=${item.id}">Voir détails</a>
        `);
        markers.push(marker);
      });
    }

    afficherMarkers(installations);

    const selects = document.querySelectorAll("select");
    selects.forEach(select => {
      select.addEventListener("change", () => {
        const filtreAnnee = document.getElementById("annee").value;
        const filtreDept = document.getElementById("departement").value;

        const filtres = installations.filter(item => {
          return (!filtreAnnee || item.annee === filtreAnnee) &&
                 (!filtreDept || item.departement === filtreDept);
        });

        afficherMarkers(filtres);
      });
    });