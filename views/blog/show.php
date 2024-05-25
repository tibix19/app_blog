<!-- Page qui affiche les postes en entier -->

<div class="uk-margin-auto-right uk-margin-auto-left uk-width-2-3">
    <!-- Afficher le titre du poste -->
    <h1 class="uk-heading-small uk-padding uk-padding-remove-left uk-padding-remove-bottom"><?= $params['post']->title ?></h1>
    <!--  Contrôle si une image est présente, on l'affiche sinon on ne fait rien (!is_null => si le champ n'est pas nul)-->
    <?php if (!is_null($params['post']->image)): ?>
        <!-- Afficher l'image -->
        <img class="uk-margin uk-width-4-5 uk-flex-center uk-border-rounded" src="../../../static/images/<?= $params['post']->image ?>" alt="">
    <?php endif; ?>
    <div class="uk-margin-bottom">
        <!-- Afficher les tags du poste -->
        <?php foreach ($params['post']->getTags() as $tag): ?>
            <span class="uk-badge uk-margin-small-right" style="background: #01324b;"><?= $tag->name ?></span>
        <?php endforeach; ?>
    </div>
    <!-- Afficher le contenu -->
    <p class="uk-margin-bottom"><?= $params['post']->content ?></p>
    <!-- Afficher la date de création du post et le créateur -->
    <small>Publié le <?= $params['post']->getCreatedAt() ?></small>
    <small>par <?= $params['post']->getCreatorPost() ?></small><br><br>
    <a href="/posts" class="uk-button uk-button-secondary uk-margin-top">Retourner en arrière</a>
</div>