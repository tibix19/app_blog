<?php
// affiche les errors
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
<?php endif ?>
<?php session_destroy() ?>

<?php
// génère l'image et le code du captcha
use LordDashMe\SimpleCaptcha\Captcha;
$captcha = new Captcha();
$captcha->code();
@$captcha->image();
$captcha->storeSession();
// pour faire les textes, c'est plus simple
var_dump($captcha->getCode());

?>

<form action="/signup" method="POST" class="uk-form-stacked">
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

    <div class="uk-margin">
        <label class="uk-form-label" for="captcha">Code Captcha</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" name="captcha" id="captcha" value="">
            <img src="<?= $captcha->getImage() ?>" alt="Captcha Image">
        </div>
    </div>

    <button type="submit" class="uk-button uk-button-primary">Créer un compte</button>
</form>


