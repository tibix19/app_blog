<?php
# si pas reussi ou error afficher les
# login pour ce connecter au panel admin
if(isset($_SESSION['errors'])): ?>
    <?php foreach ($_SESSION['errors'] as $errorArray): ?>
        <?php foreach ($errorArray as $errors): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif ?>
<?php session_destroy() ?>

<h1>Se connecter</h1>

<form action="/login" method="POST" >
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary ">Se connecter</button>
    <a href="/signup" class="btn btn-secondary">Créer un compte</a>
</form>


