<h1>Account</h1>

<form action="/account" method="POST" >
    <div class="form-group">
        <label for="username" >Nom d'utiliateur</label>
        <input type="text" class="form-control" name="username" id="username" value="<?= $params['user']->username ?>">
    </div>
    <div class="form-group">
        <label for="password" >Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" value="">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>