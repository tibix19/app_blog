<h1><?= $params['post']->title ?></h1>
<div>
    <?php foreach($params['post']->getTags() as $tag): ?>
        <span class="uk-badge uk-margin-small-right"><?= $tag->name ?></span>
    <?php endforeach; ?>
</div>
<p><?= $params['post']->content ?></p>
<small>Publié le <?= $params['post']->getCreatedAt() ?></small>
<small>par <?= $params['post']->getCreatorPost() ?></small><br><br>
<a href="/posts" class="uk-button uk-button-secondary">Retourner en arrière</a>
