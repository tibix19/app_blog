<!-- page pour l'admin pour administer les articles -->

<h1 class="uk-heading-medium">Administration des articles</h1>

<?php
$message = "";
if(isset($_GET['update'])) {
    $message = "Modification effectuée !";
}
elseif(isset($_GET['delete'])) {
    $message = "Post supprimé !";
}
elseif (isset($_GET['create'])) {
    $message = "Post créé !";
}?>

<?php if(!empty($message)): ?>
    <div class="uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><?= $message ?></p>    </div>
<?php endif; ?>

<!-- Afficher le panel admin des postes dans un tableau -->
<a href="/admin/posts/create" class="uk-button uk-button-primary uk-margin-bottom">Créer un nouvel article</a>

<table class="uk-table uk-table-striped uk-table-divider">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Titre</th>
        <th scope="col">Etat</th>
        <th scope="col">Publié le</th>
        <th scope="col">Créateur</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($params['posts'] as $post): ?>
        <tr>
            <th scope="row"><?= $post->id ?></th>
            <td><?= $post->title ?></td>
            <td><?= $post->published ?></td>
            <td><?= $post->getCreatedAt() ?></td>
            <td><?= $post->getCreatorPost() ?></td>
            <td>
                <a href="/admin/posts/edit/<?= $post->id ?>" class="uk-button uk-button-secondary uk-margin-small-right">Modifier</a>
                <form action="/admin/posts/delete/<?= $post->id ?>" method="POST" class="uk-display-inline">
                    <button type="submit" class="uk-button uk-button-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
