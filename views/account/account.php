<!-- Page pour que les users puissent modifier leurs informations personnelles (username, password et email) -->

<h1 class="uk-heading-small uk-padding uk-padding-remove-left">Account</h1>

<!-- Afficher les erreurs -->
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

<!-- Button to open dialog for username modification -->
<div class="uk-margin">
    <label for="username">Nom d'utilisateur</label>
    <div class="uk-form-controls uk-margin-top">
        <input class="uk-input uk-width-1-4" type="text" name="username" id="username" value="<?= $params['user']->username ?>" disabled>
        <button class="uk-button uk-button-default" style="background: lightgrey;" type="button" uk-toggle="target: #username-modal">Modifier le nom d'utilisateur</button>
    </div>

</div>
<!-- Button to open dialog for email modification -->
<div class="uk-margin">
    <label for="username">E-Mail</label>
    <div class="uk-form-controls uk-margin-top">
        <input class="uk-input uk-width-1-4" type="text" name="email" id="email" value="<?= $params['user']->email ?>" disabled>
        <button class="uk-button uk-button-default" style="background: lightgrey;" type="button" uk-toggle="target: #email-modal">Modifier l'adresse E-mail</button>
    </div>
</div>
<br>
<!-- Button to open dialog for password modification -->
<button class="uk-button uk-button-secondary" type="button" uk-toggle="target: #password-modal">Modifier le mot de passe</button>

<!-- Username modification box -->
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

<!-- Email modification box -->
<div id="email-modal" uk-modal>
    <div class="uk-modal-dialog">
        <form action="/update-email" method="POST" class="uk-form-stacked">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Modifier l'adresse E-mail</h2>
            </div>
            <div class="uk-modal-body">
                <label class="uk-form-label" for="email">Nouvelle adresse mail</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="email" id="email" value="<?= $params['user']->email ?>">
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Annuler</button>
                <button class="uk-button uk-button-primary" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>


<!-- Password modification box -->
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