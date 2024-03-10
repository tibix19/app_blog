<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Blog</title>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/posts">Les derniers articles</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            <?php // affiche le lien pour accéder à la page admin et le bouton pour se deco si connecter
             if(isset($_SESSION['authAdmin']) &&  $_SESSION['authAdmin'] == 1 ): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/posts">Panel Post</a>
                </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/admin/account">Panel Account</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/admin/tags">Panel Tags</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/myposts">Voir mes postes</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/account">Account</a>
                 </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Se déconnecter</a>
                </li>
             <?php // affiche le lien pour se connecter si pas connecter, mais pour les users standard seulement ces liens vont s'afficher
             elseif(isset($_SESSION['authAdmin']) == 2) : ?>
                 <li class="nav-item">
                     <a class="nav-link" href="/create">Créer un post</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/myposts">Voir mes postes</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/account">Account</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/logout">Se déconnecter</a>
                 </li>
            <?php // affiche le lien pour se connecter si pas connecter
             else: // si pas connecter on afficher la page pour se co ?>
                 <li class="nav-item">
                     <a class="nav-link" href="/create">Créer un post</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/account">Se connecter</a>
                 </li>
            <?php endif; ?>
            </ul>
            <form action="/posts" method="GET">
                <label>
                    <input type="search" class="form-control" name="search" placeholder="Rechercher...">
                </label>
            </form>
        </div>
    </nav>
    <div class="container">

        <?= $content ?>

    </div>
</body>
</html>
