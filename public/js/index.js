'use strict';

ajaxRequest('GET', '/back/api/installateur/stats', (response) => {
    let count = response.total;
    let message = `Il y a ${count} marques d'installateurs différentes.`;
    document.querySelector('.installateurs_stats').textContent = message;
});

ajaxRequest('GET', '/back/api/onduleur/stats', (response) => {
    let count = response.marque;
    let message = `Il y a ${count} marques d'onduleurs différentes.`;
    document.querySelector('.onduleurs_stats').textContent = message;

});


ajaxRequest('GET', '/back/api/panneau/stats', (response) => {
    let count = response.marque;
    let message = `Il y a ${count} marques de panneaux photovoltaïques différentes.`;
    let count2 = response.total;
    let message2 = `Il y a ${count2} panneaux photovoltaïques d'installés.`;
    document.querySelector('.panneaux_stats').textContent = message;
    document.querySelector('.panneaux_count').textContent = message2;

});

ajaxRequest('GET', '/back/api/installation/stats', (response) => {
    let dico_insta_per_year = {};

     response.by_year.forEach(entry => {
        const annee = String(entry.annee); // On force en chaîne si besoin
        const total = parseInt(entry.total); // On convertit en entier

        dico_insta_per_year[annee] = total;
    });
    
    console.log(dico_insta_per_year)

    const ctx = document.querySelector('.chart_years');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(dico_insta_per_year),
            datasets: [{
                label: 'Nombre d\'installations',
                data: Object.values(dico_insta_per_year),
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
});



ajaxRequest('GET', '/back/api/installation/stats', (response) => {
    let dico_insta_per_year = {};

     response.by_year.forEach(entry => {
        const annee = String(entry.annee); // On force en chaîne si besoin
        const total = parseInt(entry.total); // On convertit en entier

        dico_insta_per_year[annee] = total;
    });
    
    console.log("............................................................................")
    console.log(dico_insta_per_year)

    const ctx = document.querySelector('.chart_years');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(dico_insta_per_year),
            datasets: [{
                label: 'Nombre d\'installations',
                data: Object.values(dico_insta_per_year),
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
});


ajaxRequest('GET', '/back/api/installation/stats', (response) => {
    let dico_insta_per_regions = {};

     response.by_year.forEach(entry => {
        const region = String(entry.denomination); // On force en chaîne si besoin
        const total = parseInt(entry.total); // On convertit en entier

        dico_insta_per_regions[region] = total;
    });
    
    console.log(dico_insta_per_regions)

    const ctx = document.querySelector('.chart_regions');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(dico_insta_per_regions),
            datasets: [{
                label: 'Nombre d\'installations',
                data: Object.values(dico_insta_per_regions),
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
});





