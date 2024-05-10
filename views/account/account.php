<!-- Page pour que les users puissent modifier leurs informations personnelles  -->

<h1 class="uk-heading-small uk-padding uk-padding-remove-left">Account</h1>

<?php if(isset($_GET['success'])): ?>
    <div class="uk-alert uk-alert-success" uk-alert>
        <a class="uk-alert-close uk-width-1-2" uk-close></a>
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


<!-- Display current username -->
<form action="/account" method="POST" class="uk-form-stacked">
    <div class="uk-margin">
        <label class="uk-form-label" for="username">Nom d'utilisateur</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" name="username" id="username" value="<?= $params['user']->username ?>" disabled>
        </div>
    </div>
    <!-- Button to open dialog for username modification -->
    <button class="uk-button uk-button-default" type="button" uk-toggle="target: #username-modal">Modifier le nom d'utilisateur</button>
    <!-- Button to open dialog for password modification -->
    <button class="uk-button uk-button-default" type="button" uk-toggle="target: #password-modal">Modifier le mot de passe</button>
</form>

<!-- Username Modification -->
<div id="username-modal" uk-modal>
    <div class="uk-modal-dialog">
        <form action="/update-username" method="POST" class="uk-form-stacked">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Modifier le nom d'utilisateur</h2>
            </div>
            <div class="uk-modal-body">
                <div class="uk-margin">
                    <label class="uk-form-label" for="username">Nouveau nom d'utilisateur</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="username" id="username" value="<?= $params['user']->username ?>">
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Annuler</button>
                <button class="uk-button uk-button-primary" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Password Modification -->
<div id="password-modal" uk-modal>
    <div class="uk-modal-dialog">
        <form action="/update-password" method="POST" class="uk-form-stacked">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Modifier le mot de passe</h2>
            </div>
            <div class="uk-modal-body">
                <div class="uk-margin">
                    <label class="uk-form-label" for="password">Nouveau mot de passe</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="password" name="password" id="password">
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Annuler</button>
                <button class="uk-button uk-button-primary" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<?php unset($_SESSION['errors']); ?>