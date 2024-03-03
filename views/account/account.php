<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous étes connecté !</div>
<?php endif; ?>

<h1>Account</h1>

<form action="../../public/index.php" method="POST" >
    <div class="form-group">
        <label for="username" >Nom d'utiliateur</label>
        <input type="text" class="form-control" name="username" id="username" value="<?= $params['user']->username ?>">
    </div>
   <!-- <div class="form-group">
        <label for="password" >Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" value="">
    </div>-->
    <p>J'ai juste enlever la modif de mdp parce que quand j'update le username le mdp aussi s'updatait avec un champ vide</p>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>