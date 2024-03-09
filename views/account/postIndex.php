<h1>Mes postes</h1>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous étes connecté !</div>
<?php endif; ?>

<?php
$message = "";
if(isset($_GET['update'])) {
    $message = "Modification effectuée !";
}
elseif(isset($_GET['delete'])) {
    $message = "Post supprimé !";
}
elseif (isset($_GET['create'])) {
    $message = "Post créé avec succès !";
}?>

<?php if(!empty($message)): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<a href="/create" class="btn btn-success my-3">Créer un nouvel article</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Titre</th>
            <th scope="col">Publié le</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($params['myPosts'] as $post): ?>
            <tr>
                <th scope="row"><?= $post->post_id ?></th>
                <td><?= $post->title ?></td>
                <td><?= $post->getCreatedAt() ?></td>
                <td>
                    <a href="/post/edit/<?= $post->post_id ?>" class="btn btn-warning">Modifier</a>
                    <form action="/post/delete/<?= $post->post_id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
