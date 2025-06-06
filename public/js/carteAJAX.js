"use strict";

// Shuffle (ton utilitaire déjà prêt)
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

// get the years

ajaxRequest("GET", "/back/api/installation/stats", (response) => {
  if (response && response.by_year && Array.isArray(response.by_year)) {
    let annees = response.by_year.map((entry) => String(entry.annee));

    annees.sort((a, b) => b - a);

    const select = document.getElementById("annee");

    select
      .querySelectorAll("option:not([value=''])")
      .forEach((opt) => opt.remove());

    annees.forEach((annee) => {
      const option = document.createElement("option");
      option.value = annee;
      option.textContent = annee;
      select.appendChild(option);
    });
  } else {
    console.error("Réponse invalide pour /installation/stats", response);
  }
});
