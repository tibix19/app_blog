<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Log Your Knowledge</title>
    <link rel="stylesheet" href="../../../node_modules/uikit/dist/css/uikit.min.css">
    <script src="../../../node_modules/uikit/dist/js/uikit.min.js"></script>
    <script src="../../../node_modules/uikit/dist/js/uikit-icons.min.js"></script>
</head>
<body>
<div class="uk-container uk-container-expand ">
    <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="/">
                <img src="../../../public/logo/logo.png" width="260" height="160" alt="Log Your Knowledge logo">
            </a>
            <a class="uk-navbar-item uk-logo" href="/"></a>
            <div class="uk-navbar-item">
                <form action="/posts" method="GET">
                    <input class="uk-input" type="search" name="search" placeholder="Rechercher...">
                </form>
            </div>
        </div>

        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <?php // affiche le lien pour accéder à la page admin et le bouton pour se deco si connecter
                if(isset($_SESSION['authAdmin']) &&  $_SESSION['authAdmin'] == 1 ): ?>
                    <li><a href="/create"><span uk-icon="file-edit"></span>Write</a></li>
                    <button class="uk-button uk-button-link" uk-icon="icon: user" type="button"></button>
                    <div uk-dropdown="mode: click">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><a href="/account">Profil</a></li>
                            <li class="uk-active"><a href="/myposts">Mes postes</a></li>
                            <li class="uk-nav-divider"></li>
                            <li class="uk-nav-header">Panel Admin</li>
                            <li><a href="/admin/posts">Postes</a></li>
                            <li><a href="/admin/account">Comptes</a></li>
                            <li><a href="/admin/tags">Tags</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="/logout">Se déconnecter</a></li>
                        </ul>
                    </div>
                <?php // affiche le lien pour se connecter si pas connecter, mais pour les users standard seulement ces liens vont s'afficher
                elseif(isset($_SESSION['authAdmin']) == 2): ?>
                    <li><a href="/create"><span uk-icon="file-edit"></span>Write</a></li>
                    <li><a href="/myposts">Voir mes postes</a></li>
                    <li><a href="/account">Account</a></li>
                    <li><a href="/logout">Se déconnecter</a></li>
                <?php // affiche le lien pour se connecter si pas connecter
                else: // si pas connecter on afficher la page pour se co ?>
                    <li><a href="/create"><span uk-icon="file-edit"></span>Write</a></li>
                    <li><a href="/account">Se connecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav >
    <div class="uk-grid uk-child-width-1-1 uk-margin-small-top">
        <div>
            <?= $content ?>
        </div>
    </div>
</div>
</body>
</html>
