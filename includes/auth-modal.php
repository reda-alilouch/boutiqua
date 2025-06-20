<div class="modal fade" id="formconnexion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Connexion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="index.php" method="post">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <button type="submit" class="btn btn-success" name="connexion">Connexion</button>
              <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#formInscription">Inscription</button>
            </form>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="formInscription" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Inscription</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="index.php" method="post" enctype='multipart/form-data'>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="nom" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="Prenom" name="Prenom" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="avatar" class="form-label">avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>

              <button type="submit" class="btn btn-success" name="inscription">Inscription</button>
            </form>
        </div>
      </div>
    </div>
  </div>