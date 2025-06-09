const charts = {
  years: null,
  regions: null
};

// --- Texte : Stats installateurs ---
ajaxRequest("GET", "back/api/installateur/stats", (response) => {
  const count = response.total;
  document.querySelector(".installateurs_stats").textContent =
    `${count}`;
});

// --- Texte : Stats onduleurs ---
ajaxRequest("GET", "back/api/onduleur/stats", (response) => {
  const count = response.marque;
  document.querySelector(".onduleurs_stats").textContent =
    `${count}`;
});

// --- Texte : Stats panneaux ---
ajaxRequest("GET", "back/api/panneau/stats", (response) => {
  const count = response.marque;
  const count2 = response.total;

  document.getElementById("panneaux_marques_count").textContent =
    `${count}`;

  document.querySelector(".panneaux_count").textContent =
    `${count2}`;
});

// --- Graphique des installations par année (pie) ---
ajaxRequest("GET", "back/api/installation/stats", (response) => {
  const dico = {};

  response.by_year.forEach(entry => {
    const annee = String(entry.annee);
    const total = parseInt(entry.total);
    dico[annee] = total;
  });

  const ctx = document.querySelector(".chart_years");

  if (charts.years) charts.years.destroy();

  charts.years = new Chart(ctx, {
    type: "pie",
    data: {
      labels: Object.keys(dico),
      datasets: [{
        label: "Nombre d'installations",
        data: Object.values(dico),
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          display: true,
          position: "bottom"
        }
      }
    }
  });
});




// --- Graphique des installations par région (bar) ---
ajaxRequest("GET", "back/api/installation/stats", (response) => {
  const dico = {};


  response.by_region.forEach(entry => {
    const region = String(entry.denomination);
    const total = parseInt(entry.total);
    dico[region] = total;
  });

  const ctx = document.querySelector(".chart_regions");

  if (charts.regions) charts.regions.destroy();

  charts.regions = new Chart(ctx, {
    type: "bar",
    data: {
      labels: Object.keys(dico),
      datasets: [{
        label: "Nombre d'installations",
        data: Object.values(dico),
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: "bottom"
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
});
