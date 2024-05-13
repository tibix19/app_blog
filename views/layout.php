<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log Your Knowledge</title>
    <link rel="shortcut icon" type="image/icon" href="../../../public/static/logo/favicon.ico"/>
    <!-- Importation des libraires nodejs-->
    <!-- uikit -->
    <link rel="stylesheet" href="../../../node_modules/uikit/dist/css/uikit.min.css">
    <script src="../../../node_modules/uikit/dist/js/uikit.min.js"></script>
    <script src="../../../node_modules/uikit/dist/js/uikit-icons.min.js"></script>
    <!--  WYSIWYG tinymce -->
    <script src="../../../node_modules/tinymce/tinymce.min.js"></script>
    <script src="../../../public/static/tinymceTextareaConfig.js"></script>
</head>
<body>
    <div class="uk-container">
        <!-- Afficher la navbar -->
        <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar >
            <div class="uk-navbar-left" >
                <!-- Afficher le logo -->
                <a class="uk-navbar-item uk-logo" href="/">
                    <img src="../../../public/static/logo/logo.png" width="260" height="160" alt="Log Your Knowledge logo">
                </a>
                <a class="uk-navbar-item uk-logo" href="/"></a>
            </div>
            <div class="uk-navbar-right">
                <!-- Afficher la barre de recherche -->
                <div class="uk-search uk-search-default">
                    <form action="/posts" method="GET">
                        <span uk-search-icon></span>
                        <input class="uk-search-input" aria-label="Search" type="search" name="search" placeholder="Rechercher...">
                    </form>
                </div>
                <ul class="uk-navbar-nav">
                    <?php // afficher les liens que les admins ont accès, s'ils sont connectés
                    if(isset($_SESSION['authAdmin']) &&  $_SESSION['authAdmin'] == 1 ): ?>
                        <li><a href="/create"><span uk-icon="file-edit"></span>Write</a></li>
                        <button class="uk-button uk-button-link" uk-icon="icon: user" type="button"></button>
                        <div uk-dropdown="mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="/account">Profil</a></li>
                                <li class="uk-active"><a href="/myposts">Mes postes</a></li>
                                <li class="uk-active"><a href="/rss.xml">RSS Feed</a></li>
                                <li class="uk-nav-divider"></li>
                                <li class="uk-nav-header">Panel Admin</li>
                                <li><a href="/admin/posts">Postes</a></li>
                                <li><a href="/admin/account">Comptes</a></li>
                                <li><a href="/admin/tags">Tags</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="/logout">Se déconnecter</a></li>
                            </ul>
                        </div>
                    <?php // afficher les liens que les users standards ont accès dès qu'ils sont connectés
                    elseif(isset($_SESSION['authAdmin']) == 2): ?>
                        <li><a href="/create"><span uk-icon="file-edit"></span>Write</a></li>
                        <li><a href="/myposts">Voir mes postes</a></li>
                        <li><a href="/account">Account</a></li>
                        <li><a href="/logout">Se déconnecter</a></li>
                    <?php // affiche le lien pour se connecter et aussi un lien pour écrire un article, mais qui redirige vers la page de login si pas connecter
                    else:  ?>
                        <li><a href="/create"><span uk-icon="file-edit"></span>Write</a></li>
                        <li><a href="/account">Se connecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
    <hr class="uk-margin-remove" style="border-bottom: 2px solid black; color: #01324b">

    <!-- Affiche le contenu des views -->
    <div class="uk-container" uk-height-viewport="expand: true">
        <div>
            <?= $content ?>
        </div>
    </div>

    <!-- footer (bas de la page) -->
    <div class="uk-container uk-padding-remove uk-container-expand">
        <footer id="footer" class="uk-margin-large-top">
            <div class="uk-padding" style="background: #01324b;">
                <div class="uk-container uk-container">
                    <p style="color: white; font-size: 14px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam minus aperiam recusandae eos eaque sint nobis officiis adipisci sed quisquam consequuntur beatae harum laborum non dolores, natus perferendis molestias. Aliquam.</p>
                    <p class="uk-padding-small-top uk-margin-remove" style="color: white; font-size: 14px;">© 2024 LogYourKnowledge</p>
                    <p class="uk-padding-small-top uk-margin-remove" style="color: white; font-size: 14px;">Timéo Beuchat</p>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>
