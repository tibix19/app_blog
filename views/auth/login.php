<!-- Vue pour la page de login -->

<div class="uk-section uk-animation-fade">
    <div class="uk-width-1-1">
        <div class="uk-width-1-1">
            <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                <?php
                # <!-- Afficher les erreurs -->
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
                <h3 class="uk-card-title uk-text-center">Welcome back!</h3>
                <!-- Formulaire de connexion-->
                <form action="/login" method="POST">
                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon" uk-icon="icon: mail"></span>
                            <input class="uk-input uk-form-large" type="text" name="username" id="username">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input class="uk-input uk-form-large" type="password" name="password" id="password">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">Login</button>
                    </div>
                    <div class="uk-text-small uk-text-center">
                        Not registered? <a href="/signup">Create an account</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>