<!-- Affiche tous les postes qui font partis du tag en question -->

<h1 class="uk-heading-small uk-padding uk-padding-remove-left"><?= $params['tag']->name ?></h1>

<?php foreach ($params['tag']->getPosts() as $post): ?>
    <div class="uk-card uk-card-default uk-margin-bottom">
        <div class="uk-card-body">
            <a href="/posts/<?= $post->id ?>"><?= $post->title ?></a>
        </div>
    </div>
<?php endforeach; ?>

