<?php

// affiche les errors
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


<form action="/signup" method="POST" >
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="captcha">Code Captcha</label>
        <input type="text" class="form-control" name="captcha" id="captcha" value="">
        <img src="<?= $captcha->getImage() ?>" alt="Captcha Image">
    </div>
    <button type="submit" class="btn btn-primary ">Créer un compte</button>
</form>


