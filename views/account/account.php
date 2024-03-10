<?php if(isset($_GET['success'])): ?>
    <div class="uk-alert uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        Vous êtes connecté !
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['errors'])): ?>
    <?php foreach ($_SESSION['errors'] as $errorArray): ?>
        <?php foreach ($errorArray as $errors): ?>
            <div class="uk-alert uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <ul class="uk-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif ?>

<h1>Account</h1>

<form action="/account" method="POST" class="uk-form-stacked">
    <div class="uk-margin">
        <label class="uk-form-label" for="username">Nom d'utilisateur</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" name="username" id="username" value="<?= $params['user']->username ?>">
        </div>
    </div>
    <!-- <div class="uk-margin">
        <label class="uk-form-label" for="password">Mot de passe</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="password" name="password" id="password" value="">
        </div>
    </div> -->
    <p>J'ai juste enlevé la modification de mot de passe parce que lorsque j'update le nom d'utilisateur, le mot de passe était également mis à jour avec un champ vide</p>
    <button type="submit" class="uk-button uk-button-primary">Enregistrer les modifications</button>
</form>
