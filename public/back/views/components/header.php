<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Solar Sight</title>

     <link rel="stylesheet" href="assets/styles/navbar.css">
     <link rel="stylesheet" href="assets/styles/installations.css">
     <link rel="stylesheet" href="assets/styles/_root.scss">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="d-flex justify-content-center p-3">
        <div class="d-flex align-items-center justify-content-around w-75">
            <div class="container d-flex flex-column">    
                <a class="text-decoration-none text-black" href=""><h5 class="fw-bold">SolarSight</h5></a>
            </div>
            <div class="container-fluid d-flex justify-content-center gap-2">    
                <a class="d-flex justify-content-center gap-1 align-items-center p-2 hoverable-links text-decoration-none text-secondary <?= $selected == "accueil" ? "selected" : ""?>" href="dashboard">
                    <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    <h6 class="">Accueil</h6>
                </a>
            
                <a class="d-flex justify-content-center gap-1 align-items-center p-2 hoverable-links text-decoration-none text-secondary <?= $selected == "installations" ? "selected" : ""?>" href="installations"> 
                    <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sunset-icon lucide-sunset"><path d="M12 10V2"/><path d="m4.93 10.93 1.41 1.41"/><path d="M2 18h2"/><path d="M20 18h2"/><path d="m19.07 10.93-1.41 1.41"/><path d="M22 22H2"/><path d="m16 6-4 4-4-4"/><path d="M16 18a4 4 0 0 0-8 0"/></svg>
                    <h6 class="">Installations</h6>
                </a>

                <a class="d-flex justify-content-center gap-1 align-items-center p-2 hoverable-links text-decoration-none text-secondary <?= $selected == "installateurs" ? "selected" : ""?>" href="installateurs"> 
                    <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
                    <h6 class="">Installateurs</h6>
                </a>

                <a class="d-flex justify-content-center gap-1 align-items-center p-2 hoverable-links text-decoration-none text-secondary <?= $selected == "panneaux" ? "selected" : ""?>" href="panneaux"> 
                    <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-antenna-icon lucide-antenna"><path d="M2 12 7 2"/><path d="m7 12 5-10"/><path d="m12 12 5-10"/><path d="m17 12 5-10"/><path d="M4.5 7h15"/><path d="M12 16v6"/></svg>
                    <h6 class="">Pannaux</h6>
                </a>

                <a class="d-flex justify-content-center gap-1 align-items-center p-2 hoverable-links text-decoration-none text-secondary <?= $selected == "onduleurs" ? "selected" : ""?>" href="onduleurs"> 
                    <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cable-icon lucide-cable"><path d="M17 21v-2a1 1 0 0 1-1-1v-1a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v1a1 1 0 0 1-1 1"/><path d="M19 15V6.5a1 1 0 0 0-7 0v11a1 1 0 0 1-7 0V9"/><path d="M21 21v-2h-4"/><path d="M3 5h4V3"/><path d="M7 5a1 1 0 0 1 1 1v1a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a1 1 0 0 1 1-1V3"/></svg>
                    <h6 class="">Onduleurs</h6>
                </a>

                <a class="d-flex justify-content-center gap-1 align-items-center p-2 hoverable-links text-decoration-none text-secondary <?= $selected == "localites" ? "selected" : ""?>" href="localites"> 
                    <svg class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-house-icon lucide-map-pin-house"><path d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z"/><path d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2"/><path d="M18 22v-3"/><circle cx="10" cy="10" r="3"/></svg>
                    <h6 class="">Localite</h6>
                </a>
            </div>
        </div>
    </nav>
    