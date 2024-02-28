<h1><?= $params['post']->title ?> </h1>
<div>
    <?php foreach($params['post']->getTags() as $tag): ?>
        <span class="badge bg-info"><?= $tag->name ?></span>
    <?php endforeach; ?>
</div>
<p><?= $params['post']->content ?> </p>
<small>Publié le <?= $params['post']->getCreatedAt() ?></small>
<small>par <?= $params['post']->getCreatorPost() ?></small></br></br>
<a href="/posts" class="btn btn-secondary">Retourner en arrière</a>
