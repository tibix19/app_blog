<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
             if(isset($_SESSION['authAdmin']) == 1 ): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/posts">Panel Post Admin</a>
                </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/admin/account">Panel Account Admin</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="/account"></a>
                 </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Se déconnecter</a>
                </li>
            <?php // affiche le lien pour se connecter si pas connecter
             else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Se connecter</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container">

        <?= $content ?>

    </div>
</body>
</html>
