<!-- Page pour que l'admin puisse créer des utilisateurs depuis sa session  -->

<h1 class="uk-heading-small uk-padding uk-padding-remove-left">Créer un nouvel utilisateur</h1>

<?php // afficher les erreurs dans une variable de session qui va être dans une alerte
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

<!-- Formulaire avec : username - email - Level - password -->
<form action="/admin/account/create" method="POST">
    <div class="uk-width-1-4">
        <label class="uk-form-label" for="username">Nom d'utilisateur</label>
        <input class="uk-input uk-margin" type="text" name="username" id="username">
    </div>
    <div class="uk-width-1-4">
        <label class="uk-form-label" for="email">E-Mail</label>
        <input class="uk-input uk-margin" type="email" name="email" id="email">
    </div>
    <div class="uk-width-1-4">
        <label class="uk-form-label" for="admin">Level</label>
        <select class="uk-select uk-margin" name="admin" id="admin">
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
    </div>
    <div class="uk-width-1-4">
        <label class="uk-form-label" for="password">Mot de passe</label>
        <input class="uk-input uk-margin" type="password" name="password" id="password"">
    </div>
    <div class="uk-width-1-4">
        <button type="submit" class="uk-button uk-button-primary">Créer un utilisateur</button>
    </div>
</form>


