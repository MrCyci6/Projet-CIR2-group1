const marquesOnduleur = ["Huawei", "SMA", "Fronius", "ABB", "SolarEdge", "Delta", "Enphase", "Kaco", "APSystems", "Schneider",
                              "Growatt", "Omnik", "Solax", "Victron", "GoodWe", "Ginlong", "Mastervolt", "AEconversion", "Refusol", "Tigo"];

    const marquesPanneaux = ["SunPower", "LG", "QCells", "Trina Solar", "JinkoSolar", "Canadian Solar", "REC", "LONGi", "JA Solar", "Yingli",
                             "Sharp", "Panasonic", "First Solar", "Boviet", "ET Solar", "Axitec", "Phono Solar", "Seraphim", "ZNSHINE", "Solarwatt"];

    const departements = ["75", "44", "13", "33", "69", "59", "92", "34", "77", "31", "83", "38", "76", "62", "35", "95", "91", "78", "67", "974"];

    function chargerSelect(id, data) {
      const select = document.getElementById(id);
      data.forEach(item => {
        const option = document.createElement("option");
        option.value = item;
        option.textContent = item;
        select.appendChild(option);
      });
    }

    chargerSelect("marqueOnduleur", marquesOnduleur);
    chargerSelect("marquePanneaux", marquesPanneaux);
    chargerSelect("departement", departements);

    // Données complètes avec id et infos supplémentaires
const installations = [
  { id: 1, date: "03/2022", nbPanneaux: 10, surface: 25, puissance: 3.5, localisation: "Nantes (44)", marqueOnduleur: "SMA", marquePanneaux: "QCells" },
  { id: 2, date: "06/2023", nbPanneaux: 15, surface: 35, puissance: 5.2, localisation: "Lyon (69)", marqueOnduleur: "Huawei", marquePanneaux: "Trina Solar" },
  { id: 3, date: "09/2021", nbPanneaux: 8, surface: 18, puissance: 2.8, localisation: "Toulouse (31)", marqueOnduleur: "Fronius", marquePanneaux: "LG" },
  { id: 4, date: "12/2020", nbPanneaux: 20, surface: 50, puissance: 6.0, localisation: "Marseille (13)", marqueOnduleur: "ABB", marquePanneaux: "JA Solar" },
  { id: 5, date: "05/2021", nbPanneaux: 12, surface: 30, puissance: 3.9, localisation: "Paris (75)", marqueOnduleur: "Delta", marquePanneaux: "REC" },
  { id: 6, date: "07/2022", nbPanneaux: 16, surface: 38, puissance: 4.5, localisation: "Lille (59)", marqueOnduleur: "Enphase", marquePanneaux: "LONGi" },
  { id: 7, date: "01/2023", nbPanneaux: 14, surface: 33, puissance: 4.1, localisation: "Nice (06)", marqueOnduleur: "Kaco", marquePanneaux: "Canadian Solar" },
  { id: 8, date: "11/2022", nbPanneaux: 9, surface: 22, puissance: 3.0, localisation: "Strasbourg (67)", marqueOnduleur: "SolarEdge", marquePanneaux: "Yingli" },
  { id: 9, date: "08/2023", nbPanneaux: 18, surface: 42, puissance: 5.5, localisation: "Bordeaux (33)", marqueOnduleur: "Schneider", marquePanneaux: "SunPower" },
  { id: 10, date: "04/2021", nbPanneaux: 6, surface: 15, puissance: 1.8, localisation: "Rennes (35)", marqueOnduleur: "Omnik", marquePanneaux: "Panasonic" },
  { id: 11, date: "06/2023", nbPanneaux: 11, surface: 27, puissance: 3.3, localisation: "Reims (51)", marqueOnduleur: "Victron", marquePanneaux: "First Solar" },
  { id: 12, date: "10/2022", nbPanneaux: 13, surface: 31, puissance: 4.0, localisation: "Grenoble (38)", marqueOnduleur: "APSystems", marquePanneaux: "Phono Solar" },
  { id: 13, date: "09/2023", nbPanneaux: 17, surface: 45, puissance: 5.8, localisation: "Montpellier (34)", marqueOnduleur: "Solax", marquePanneaux: "Sharp" },
  { id: 14, date: "07/2021", nbPanneaux: 20, surface: 50, puissance: 6.0, localisation: "Versailles (78)", marqueOnduleur: "Ginlong", marquePanneaux: "Axitec" },
  { id: 15, date: "05/2020", nbPanneaux: 10, surface: 25, puissance: 3.2, localisation: "Clermont-Ferrand (63)", marqueOnduleur: "GoodWe", marquePanneaux: "ZNSHINE" },
  { id: 16, date: "03/2023", nbPanneaux: 14, surface: 36, puissance: 4.3, localisation: "Le Havre (76)", marqueOnduleur: "Mastervolt", marquePanneaux: "Solarwatt" },
  { id: 17, date: "02/2022", nbPanneaux: 12, surface: 28, puissance: 3.6, localisation: "Saint-Denis (974)", marqueOnduleur: "AEconversion", marquePanneaux: "QCells" },
  { id: 18, date: "01/2021", nbPanneaux: 7, surface: 17, puissance: 2.0, localisation: "Rouen (76)", marqueOnduleur: "Refusol", marquePanneaux: "LG" },
  { id: 19, date: "10/2020", nbPanneaux: 9, surface: 21, puissance: 2.5, localisation: "Metz (57)", marqueOnduleur: "Tigo", marquePanneaux: "Trina Solar" },
  { id: 20, date: "04/2022", nbPanneaux: 13, surface: 32, puissance: 4.2, localisation: "Angers (49)", marqueOnduleur: "Delta", marquePanneaux: "LONGi" },
  { id: 21, date: "11/2021", nbPanneaux: 15, surface: 38, puissance: 5.0, localisation: "Orléans (45)", marqueOnduleur: "SolarEdge", marquePanneaux: "JA Solar" },
  { id: 22, date: "08/2020", nbPanneaux: 10, surface: 24, puissance: 3.1, localisation: "Perpignan (66)", marqueOnduleur: "Fronius", marquePanneaux: "REC" },
  { id: 23, date: "06/2021", nbPanneaux: 16, surface: 40, puissance: 4.7, localisation: "Nancy (54)", marqueOnduleur: "SMA", marquePanneaux: "SunPower" },
  { id: 24, date: "09/2023", nbPanneaux: 11, surface: 26, puissance: 3.4, localisation: "Bayonne (64)", marqueOnduleur: "Huawei", marquePanneaux: "Boviet" },
  { id: 25, date: "03/2024", nbPanneaux: 14, surface: 34, puissance: 4.6, localisation: "Caen (14)", marqueOnduleur: "GoodWe", marquePanneaux: "Seraphim" },
  { id: 26, date: "05/2023", nbPanneaux: 19, surface: 48, puissance: 5.9, localisation: "Annecy (74)", marqueOnduleur: "Enphase", marquePanneaux: "ZNSHINE" },
  { id: 27, date: "07/2022", nbPanneaux: 12, surface: 30, puissance: 3.7, localisation: "Chambéry (73)", marqueOnduleur: "ABB", marquePanneaux: "Solarwatt" },
  { id: 28, date: "02/2021", nbPanneaux: 9, surface: 20, puissance: 2.6, localisation: "Dijon (21)", marqueOnduleur: "Omnik", marquePanneaux: "Sharp" },
  { id: 29, date: "12/2023", nbPanneaux: 18, surface: 44, puissance: 5.4, localisation: "Saint-Étienne (42)", marqueOnduleur: "Victron", marquePanneaux: "Panasonic" },
  { id: 30, date: "01/2024", nbPanneaux: 17, surface: 41, puissance: 5.1, localisation: "Tours (37)", marqueOnduleur: "APSystems", marquePanneaux: "First Solar" }
];



let currentPage = 1;
const resultsPerPage = 10;
let currentData = installations.slice(); // Copie initiale

function afficherResultats(data, page = 1) {
  const tbody = document.getElementById("resultTableBody");
  tbody.innerHTML = "";

  // Pagination
  const start = (page - 1) * resultsPerPage;
  const end = start + resultsPerPage;
  const pageData = data.slice(start, end);

  pageData.forEach(item => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${item.date}</td>
      <td class="text-center">${item.nbPanneaux}</td>
      <td class="text-center">${item.surface}</td>
      <td class="text-center">${item.puissance}</td>
      <td>${item.localisation}</td>
      <td class="text-center">
        <a href="details.html?id=${item.id}" class="button">
          Détails
          <svg class="button-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
            <polyline points="15 3 21 3 21 9"></polyline>
            <line x1="10" y1="14" x2="21" y2="3"></line>
          </svg>
        </a>
      </td>
    `;
    tbody.appendChild(row);
  });

  afficherPagination(data.length, page);
}

function afficherPagination(total, page) {
  const pagination = document.getElementById("pagination");
  pagination.innerHTML = "";
  const totalPages = Math.ceil(total / resultsPerPage);

  if (totalPages <= 1) return;

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement("button");
    btn.textContent = i;
    btn.className = "pagination-btn";
    if (i === page) btn.style.fontWeight = "bold";
    btn.addEventListener("click", () => {
      currentPage = i;
      afficherResultats(currentData, currentPage);
    });
    pagination.appendChild(btn);
  }
}

// Initial display
afficherResultats(installations, 1);

// Gestion des filtres
const selectes = document.querySelectorAll("select");
selectes.forEach(select => {
  select.addEventListener("change", () => {
    const filtreOnduleur = document.getElementById("marqueOnduleur").value;
    const filtrePanneaux = document.getElementById("marquePanneaux").value;
    const filtreDepartement = document.getElementById("departement").value;

    currentData = installations.filter(item => {
      return (!filtreOnduleur || item.marqueOnduleur === filtreOnduleur) &&
             (!filtrePanneaux || item.marquePanneaux === filtrePanneaux) &&
             (!filtreDepartement || item.localisation.includes(`(${filtreDepartement})`));
    });
    currentPage = 1;
    afficherResultats(currentData, currentPage);
  });
});