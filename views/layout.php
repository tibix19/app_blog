<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blog</title>
    <link rel="stylesheet" href="../node_modules/uikit/dist/css/uikit.min.css">
    <script src="../node_modules/uikit/dist/js/uikit.min.js"></script>
    <script src="../node_modules/uikit/dist/js/uikit-icons.min.js"></script>
</head>
<body>
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo" href="/">Blog</a>
        <ul class="uk-navbar-nav">
            <li><a href="/posts">Les derniers articles</a></li>
        </ul>
    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <?php // affiche le lien pour accéder à la page admin et le bouton pour se deco si connecter
            if(isset($_SESSION['authAdmin']) &&  $_SESSION['authAdmin'] == 1 ): ?>
                <li><a href="/admin/posts">Panel Post</a></li>
                <li><a href="/admin/account">Panel Account</a></li>
                <li><a href="/admin/tags">Panel Tags</a></li>
                <li><a href="/myposts">Voir mes postes</a></li>
                <li><a href="/account">Account</a></li>
                <li><a href="/logout">Se déconnecter</a></li>
            <?php // affiche le lien pour se connecter si pas connecter, mais pour les users standard seulement ces liens vont s'afficher
            elseif(isset($_SESSION['authAdmin']) == 2): ?>
                <li><a href="/create">Créer un post</a></li>
                <li><a href="/myposts">Voir mes postes</a></li>
                <li><a href="/account">Account</a></li>
                <li><a href="/logout">Se déconnecter</a></li>
            <?php // affiche le lien pour se connecter si pas connecter
            else: // si pas connecter on afficher la page pour se co ?>
                <li><a href="/create">Créer un post</a></li>
                <li><a href="/account">Se connecter</a></li>
            <?php endif; ?>
        </ul>
        <div class="uk-navbar-item">
            <form action="/posts" method="GET">
                <input class="uk-input" type="search" name="search" placeholder="Rechercher...">
            </form>
        </div>
    </div>
</nav>


<div class="uk-container">
    <?= $content ?>
</div>
</body>
</html>

