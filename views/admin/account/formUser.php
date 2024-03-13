<?php // afficher les erreurs dans une variable de session dans une alerte
if(isset($_SESSION['errors'])): ?>
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
    <?php unset($_SESSION['errors']); // supprimer la variable de session pour pas que les messages restent afficher ?>
<?php endif ?>

<h1>Créer un nouvel utilisateur</h1>

<form action="/admin/account/create" method="POST" class="uk-form-stacked" uk-grid>
    <div class="uk-width-1-2@s">
        <label class="uk-form-label" for="username">Nom d'utilisateur</label>
        <input class="uk-input" type="text" name="username" id="username" value="<?= $params['user']->username ?? '' ?>">
    </div>
    <div class="uk-width-1-2@s">
        <label class="uk-form-label" for="admin">Level</label>
        <select class="uk-select" name="admin" id="admin">
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
    </div>
    <div class="uk-width-1-2@s">
        <label class="uk-form-label" for="password">Mot de passe</label>
        <input class="uk-input" type="password" name="password" id="password" value="<?= $params['user']->password ?? '' ?>">
    </div>
    <button type="submit" class="uk-button uk-button-primary uk-width-1-2@s"><?= isset($params['user']) ? 'Enregistrer les modifications' : 'Créer un utilisateur' ?></button>
</form>
