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
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newUserModal">
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

<!-- Create user -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
        <div class="modal-header border-0">
            <div class="modal-title d-flex align-items-center gap-2">
                <div class="bg-primary-subtle p-2 rounded-circle d-flex align-items-center">    
                    <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                </div>
                <h1 class="fs-5">Créer une installation</h1>
            </div>
        </div>
        <form action="users">
            <div class="modal-body border-0">
                <input type="hidden" name="action" value="create">

                <label for="nom" class="form-label">Nom</label> 
                <input type="text" class="form-control" id="nom" name="nom" value="" required>
                
                <label for="prenom" class="form-label">Prénom</label> 
                <input type="text" class="form-control" id="prenom" name="prenom" value="" required>
                
                <label for="email" class="form-label">Adresse E-mail</label> 
                <input type="text" class="form-control" id="email" name="email" value="" required>
                
                <label for="addresse" class="form-label">Adresse Postale</label> 
                <input type="text" class="form-control" id="addresse" name="adresse" value="" required>

                <div class="form-text">
                    Une fois le formulaire validé, un mot de passe auto-généré sera envoyé
                    sur l'adresse e-mail de l'utilisateur pour qu'il puisse se connecter
                    à son compte
                </div>
            </div>
            <div class="modal-footer border-0 mt-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer un utilisateur</button>
            </div>
        </form>
    </div>
</div>
</div>

<script src="assets/js/ajax.js"></script>
<script src="assets/js/installations.js"></script>