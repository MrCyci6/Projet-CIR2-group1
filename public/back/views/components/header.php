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
            </div>
        </div>
    </nav>
    