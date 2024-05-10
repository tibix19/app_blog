<!-- Vue pour la page de création du compte -->
<div class="uk-section uk-margin-remove">
    <div class="uk-width-1-1">
        <div class="uk-width-1-1">
            <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
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
                // var_dump($captcha->getCode());

                ?>
                <h3 class="uk-card-title uk-text-center">Création d'un compte</h3>
                <!-- Formulaire de connexion-->
                <form action="/signup" method="POST" class="uk-form-stacked">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="username">Nom d'utilisateur</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="username" id="username">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="email">E-mail</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" name="email" id="email">
                        </div>
                    </div>
                    <!-- Champs password -->
                    <div class="uk-margin">
                        <label class="uk-form-label" for="password">Mot de passe</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="password" name="password" id="password">
                        </div>
                    </div>
                    <!-- Afficher le captcha et le champs pour le code du captcha -->
                    <div class="uk-margin">
                        <label class="uk-form-label" for="captcha">Captcha</label>
                        <div class="uk-form-controls">
                            <img class="uk-margin" src="<?= $captcha->getImage() ?>" alt="Captcha Image">
                            <input placeholder="Entré le code du Captcha" class="uk-input" type="text" name="captcha" id="captcha" value="">

                        </div>
                    </div>
                    <div class="uk-margin">
                         <button type="submit" class="uk-button uk-button-large uk-width-1-1" style="background: #01324b; color: white">Créer un compte</button>
                    </div>
                    <div class="uk-text-small uk-text-center">
                         Déjà un compte ? <a href="/login">Se connecter</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>