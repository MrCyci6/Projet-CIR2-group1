<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <button data-bs-toggle="modal" data-bs-target="#editInstallationModal" class="btn btn-outline-secondary me-2">Edit</button>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header card-header-custom">Détails</div>
          <div class="card-body" id="details-body">
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header card-header-custom">Résumé</div>
          <div class="card-body" id="resume-body">
          </div>
        </div>
      </div>
    </div>

    <div style="height: 25em;"></div>
  </div>


<!-- Create installation -->
<div class="modal fade" id="editInstallationModal" tabindex="-1" aria-labelledby="editInstallationModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
        <div class="modal-header border-0">
            <div class="modal-title d-flex align-items-center gap-2">
                <div class="bg-success-subtle p-2 rounded-circle d-flex align-items-center">    
                    <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sunset-icon lucide-sunset"><path d="M12 10V2"/><path d="m4.93 10.93 1.41 1.41"/><path d="M2 18h2"/><path d="M20 18h2"/><path d="m19.07 10.93-1.41 1.41"/><path d="M22 22H2"/><path d="m16 6-4 4-4-4"/><path d="M16 18a4 4 0 0 0-8 0"/></svg>
                </div>
                <h1 class="fs-5">Modifier une installation</h1>
            </div>
        </div>

        <form id="editInstallation">
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
                <button type="submit" class="btn btn-success">Modifier</button>
            </div>
        </form>

    </div>
</div>
</div>

<script src="assets/js/ajax.js"></script>
<script src="assets/js/installation.js"></script>