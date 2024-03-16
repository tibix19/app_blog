<div class="uk-margin uk-margin-auto-right uk-margin-auto-left uk-width-1-2@s">
    <h1 class="uk-margin-bottom"><?= $params['post']->title ?></h1>
    <div class="uk-margin-bottom">
        <?php foreach($params['post']->getTags() as $tag): ?>
            <span class="uk-badge uk-margin-small-right"><?= $tag->name ?></span>
        <?php endforeach; ?>
    </div>
    <p class="uk-margin-bottom"><?= $params['post']->content ?></p>
    <small>Publié le <?= $params['post']->getCreatedAt() ?></small>
    <small>par <?= $params['post']->getCreatorPost() ?></small><br><br>
    <a href="/posts" class="uk-button uk-button-secondary uk-margin-top">Retourner en arrière</a>
</div>


