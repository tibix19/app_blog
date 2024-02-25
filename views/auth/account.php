<h1>Ton compte</h1>


<form action="POST">
    <p>ID : <?= $_SESSION['idUser']; ?></p>
    <div class="form-group">
        <label for="username" >Nom d'utiliateur</label>
        <input type="text" class="form-control" name="username" id="username" value="<?= $_SESSION['username']; ?>">
    </div>
    <div class="form-group">
        <label for="password" >Entré le nouveau mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" value="">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>