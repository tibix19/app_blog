<?php
# si pas reussi ou error afficher une erreur
# login pour se connecter au panel admin
if(isset($_SESSION['errors'])): ?>
    <?php foreach ($_SESSION['errors'] as $errorArray): ?>
        <?php foreach ($errorArray as $errors): ?>
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif ?>
<?php session_destroy() ?>

<h1>Se connecter</h1>

<form action="/login" method="POST" class="uk-form-stacked">
    <div class="uk-margin">
        <label class="uk-form-label" for="username">Nom d'utilisateur</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" name="username" id="username">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="password">Mot de passe</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="password" name="password" id="password">
        </div>
    </div>
    <button type="submit" class="uk-button uk-button-primary">Se connecter</button>
    <a href="/signup" class="uk-button uk-button-secondary">Créer un compte</a>
</form>

