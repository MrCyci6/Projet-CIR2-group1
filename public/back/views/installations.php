<!-- Content -->
<div class="p-4 mt-3">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Header -->
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-2">
                    <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sunset-icon lucide-sunset"><path d="M12 10V2"/><path d="m4.93 10.93 1.41 1.41"/><path d="M2 18h2"/><path d="M20 18h2"/><path d="m19.07 10.93-1.41 1.41"/><path d="M22 22H2"/><path d="m16 6-4 4-4-4"/><path d="M16 18a4 4 0 0 0-8 0"/></svg>
                    <h5 class="card-title ms-2 mt-1">Gestion des installations</h5>
                </div>

                <div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newInstallationModal">
                        <div class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            <span>Nouvelle Installation</span>
                        </div>
                    </button>
                </div>
            </div>
            <!-- Search -->
            <div class="card p-3 border-0 shadow">
                <form id="searchForm" method="GET">
                    <input type="hidden" name="hotel_id" value="<?= $hotelId ?>">
                    <div class="d-flex justify-content-between gap-3">
                        <div class="input-group w-75">
                            <input type="text" name="query" class="form-control" placeholder="Chercher une installation">
                            <button type="submit" id="search" class="btn btn-outline-success">Chercher</button>
                        </div>
                        <div class=" d-flex justify-content-center align-items-center gap-4">
                            
                            <select class="form-select" name="rows">
                                <option value="20" <?= (isset($_GET['rows']) && $_GET['rows'] == 20) ? "selected" : "" ?>>20 lignes</option>
                                <option value="50" <?= (isset($_GET['rows']) && $_GET['rows'] == 50) ? "selected" : "" ?>>50 lignes</option>
                                <option value="100" <?= (isset($_GET['rows']) && $_GET['rows'] == 100) ? "selected" : "" ?>>100 lignes</option>
                                <option value="250" <?= (isset($_GET['rows']) && $_GET['rows'] == 250) ? "selected" : "" ?>>250 lignes</option>
                                <option value="500" <?= (isset($_GET['rows']) && $_GET['rows'] == 500) ? "selected" : "" ?>>500 lignes</option>
                            </select>

                        </div>
                    </div>
                </form>
            </div>
            <!-- List -->
            <div class="card p-4 border-0 bt-3 shadow">
                <!-- Table -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td class="text-secondary">#</td>
                            <td class="text-secondary">LOCALITE</td>
                            <td class="text-secondary">PANNEAU</td>
                            <td class="text-secondary">ONDULEUR</td>
                            <td class="text-secondary">ANNEE</td>
                            <td class="text-secondary">ACTION</td>
                        </tr>
                    </thead>
                    <tbody id="list-instal"></tbody>
                </table>
                <nav class="d-flex justify-content-center">
                    <ul class="pagination d-flex">
                        <li class="page-item"><a class="page-link">Précédent</a></li>
                        <li class="page-item"><a class="page-link">..</a></li>
                        <li class="page-item"><a class="page-link">1</a></li>
                        <li class="page-item"><a class="page-link">2</a></li>
                        <li class="page-item"><a class="page-link">3</a></li>
                        <li class="page-item"><a class="page-link">4</a></li>
                        <li class="page-item"><a class="page-link">5</a></li>
                        <li class="page-item"><a class="page-link">6</a></li>
                        <li class="page-item"><a class="page-link">7</a></li>
                        <li class="page-item"><a class="page-link">8</a></li>
                        <li class="page-item"><a class="page-link">9</a></li>
                        <li class="page-item"><a class="page-link">10</a></li>
                        <li class="page-item"><a class="page-link">11</a></li>
                        <li class="page-item"><a class="page-link">..</a></li>
                        <li class="page-item"><a class="page-link">Suivant</a></li>
                    </ul>
                </nav>  
            </div>
        </div>
    </div>
</div>
</div>

<!-- Create installation -->
<div class="modal fade" id="newInstallationModal" tabindex="-1" aria-labelledby="newInstallationModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
        <div class="modal-header border-0">
            <div class="modal-title d-flex align-items-center gap-2">
                <div class="bg-success-subtle p-2 rounded-circle d-flex align-items-center">    
                    <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sunset-icon lucide-sunset"><path d="M12 10V2"/><path d="m4.93 10.93 1.41 1.41"/><path d="M2 18h2"/><path d="M20 18h2"/><path d="m19.07 10.93-1.41 1.41"/><path d="M22 22H2"/><path d="m16 6-4 4-4-4"/><path d="M16 18a4 4 0 0 0-8 0"/></svg>
                </div>
                <h1 class="fs-5">Créer une installation</h1>
            </div>
        </div>

        <form id="addInstallation">
            <div class="modal-body border-0">
                <label class="form-label">Puissance crète</label> 
                <input type="number" class="form-control" id="puissance_crete" name="puissance_crete" value="" required>
                
                <label class="form-label">Surface</label> 
                <input type="number" class="form-control" id="surface" name="surface" value="" required>
                
                <label class="form-label">Pente</label> 
                <input type="number" class="form-control" id="pente" name="pente" value="" required>
                
                <label class="form-label">Pente Optimum</label> 
                <input type="number" class="form-control" id="pente_optimum" name="pente_optimum" value="" required>
                
                <label class="form-label">Orientaton</label> 
                <input type="number" class="form-control" id="orientation" name="orientation" value="" required>
                
                <label class="form-label">Orientation Optimum</label> 
                <input type="number" class="form-control" id="orientation_optimum" name="orientation_optimum" value="" required>
                
                <label class="form-label">Production PVGIS</label> 
                <input type="number" class="form-control" id="production_pvgis" name="production_pvgis" value="" required>
                
                <label class="form-label">Mois</label> 
                <input type="number" class="form-control" id="mois" name="mois" value="" required>
                
                <label class="form-label">Année</label> 
                <input type="number" class="form-control" id="annee" name="annee" value="" required>
                
                <label class="form-label">Latitude</label> 
                <input type="number" class="form-control" id="latitude" name="latitude" value="" step="0.1" required>
                
                <label class="form-label">Longitude</label> 
                <input type="number" class="form-control" id="longitude" name="longitude" value="" step="0.1" required>
                
                <label class="form-label">Localite</label> 
                <select class="form-select" id="code_insee" name="code_insee" required></select>
                
                <label class="form-label">Installateur</label> 
                <select class="form-select" id="id_installateur" name="id_installateur"></select>
                
                <label class="form-label">Panneau</label> 
                <select class="form-select" id="id_panneau" name="id_panneau" required></select>
                
                <label class="form-label">Nombre Panneau</label> 
                <input type="number" class="form-control" id="nb_panneau" name="nb_panneau" value="" required>
                
                <label class="form-label">Onduleur</label> 
                <select class="form-select" id="id_onduleur" name="id_onduleur" required></select>
                
                <label class="form-label">Nombre Onduleur</label> 
                <input type="number" class="form-control" id="nb_onduleur" name="nb_onduleur" value="" required>

            </div>
            <div class="modal-footer border-0 mt-2">
                <button id="close" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success">Créer une installation</button>
            </div>
        </form>

    </div>
</div>
</div>

<script src="assets/js/ajax.js"></script>
<script src="assets/js/installations.js"></script>