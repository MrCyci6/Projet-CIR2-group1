"use strict";
// axiliaire function

// Shuffle
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

function getNomVille(codeInsee, callback) {
  ajaxRequest(
    "GET",
    `/back/api/localite?code_insee=${codeInsee}`,
    (response) => {
      if (response && Array.isArray(response.data)) {
        const ville = response.data.find((v) => v.code_insee === codeInsee);
        if (ville) {
          const nomComplet = `${ville.denomination} (${ville.dep_code})`;
          callback(nomComplet);
        } else {
          console.warn("Aucune ville trouvée pour le code INSEE :", codeInsee);
          callback("Ville inconnue");
        }
      } else {
        console.error("Réponse inattendue pour /localite/", response);
        callback("Ville inconnue");
      }
    },
    (xhr) => {
      console.error("Erreur API /localite/", codeInsee, xhr);
      callback("Ville inconnue");
    }
  );
}

// Get for inverter brand

ajaxRequest("GET", "/back/api/onduleur/marques", (response) => {
  const marques = response.data;

  // take 20 brands randomly
  const marquesAleatoires = shuffleArray([...marques]).slice(0, 20);

  // get the 'select' type
  const select = document.getElementById("marqueOnduleur");

  // clear the old stuff
  select
    .querySelectorAll("option:not([value=''])")
    .forEach((opt) => opt.remove());

  // add the 20 brands
  marquesAleatoires.forEach((marque) => {
    const option = document.createElement("option");
    option.textContent = marque.denomination;
    select.appendChild(option);
  });
});

// Get solar panel brand

ajaxRequest("GET", "/back/api/panneau/marques", (response) => {
  const marques = response.data;

  // take 20 brands randomly
  const marquesAleatoires = shuffleArray([...marques]).slice(0, 20);

  // get the 'select' type
  const select = document.getElementById("marquePanneaux");

  // clear the old stuff
  select
    .querySelectorAll("option:not([value=''])")
    .forEach((opt) => opt.remove());

  // add the 20 brands
  marquesAleatoires.forEach((marque) => {
    const option = document.createElement("option");
    option.textContent = marque.denomination;
    select.appendChild(option);
  });
});

// Get the department

ajaxRequest("GET", "/back/api/departement", (response) => {
  const marques = response.data;

  // take 20 brands randomly
  const marquesAleatoires = shuffleArray([...marques]).slice(0, 20);

  // get the 'select' type
  const select = document.getElementById("departement");

  // clear the old stuff
  select
    .querySelectorAll("option:not([value=''])")
    .forEach((opt) => opt.remove());

  // add the 20 brands
  marquesAleatoires.forEach((marque) => {
    const option = document.createElement("option");
    option.textContent = marque.denomination;
    select.appendChild(option);
  });
});

// Put the result on the resultTable

function updateTable() {
  //get the value of our filter
  const marqueOnduleur = document.getElementById("marqueOnduleur").value;
  const marquePanneaux = document.getElementById("marquePanneaux").value;
  const departement = document.getElementById("departement").value;

  // Si aucun filtre actif, on vide le tableau et on ne fait rien
  if (!marqueOnduleur && !marquePanneaux && !departement) {
    document.getElementById("resultTableBody").innerHTML = "";
    return;
  }

  // make the parameters
  const params = new URLSearchParams();
  if (marqueOnduleur) params.append("marqueOnduleur", marqueOnduleur);
  if (marquePanneaux) params.append("marquePanneaux", marquePanneaux);
  if (departement) params.append("departement", departement);

  // call the API
  ajaxRequest(
    "GET",
    `/back/api/installation/cherche${params.toString()}`,
    (response) => {
      const tbody = document.getElementById("resultTableBody");
      tbody.innerHTML = ""; // On vide l'ancien contenu

      response.data.forEach((entry) => {
        const row = document.createElement("tr");

        row.innerHTML = `
       <td>${entry.mois.toString().padStart(2, "0")}/${entry.annee}</td>    
        <td class="text-center">${entry.nb_panneau}</td>
        <td class="text-center">${entry.surface}</td>
        <td class="text-center">${entry.puissance_crete}</td>
        <td class="ville-cell">Chargement...</td>
        <td class="text-center">
          <button class="btn btn-primary">Voir</button>
        </td>
      `;
        getNomVille(entry.code_insee, (villeNom) => {
          // Une fois le nom obtenu, on remplace le contenu de la cellule
          row.querySelector(".ville-cell").textContent = villeNom;
        });

        tbody.appendChild(row);
      });
    }
  );
}

// make the update everytime we touch the filter
["marqueOnduleur", "marquePanneaux", "departement"].forEach((id) => {
  document.getElementById(id).addEventListener("change", updateTable);
});

// initial call
updateTable();
