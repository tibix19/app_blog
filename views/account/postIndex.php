<h1>Mes postes</h1>

<?php if(isset($_GET['success'])): ?>
    <div class="uk-alert uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        Vous êtes connecté !
    </div>
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
    <div class="uk-alert uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<a href="/create" class="uk-button uk-button-primary uk-margin-bottom">Créer un nouvel article</a>



<ul class="uk-tab" uk-tab>
    <li class="uk-active"><a href="#">Brouillons</a></li>
    <li><a href="#">Publiées</a></li>
</ul>

<ul class="uk-switcher uk-margin">
    <li>
        <table class="uk-table uk-table-striped uk-table-divider">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Titre</th>
                <th scope="col">Etat</th>
                <th scope="col">Publié le</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['PostsDraftUser'] as $post): ?>
                <tr>
                    <th scope="row"><?= $post->post_id ?></th>
                    <td><?= $post->title ?></td>
                    <td>
                        <form action="/post/edit/state/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                            <label for="published" class="uk-margin-right">
                                <select name="published" id="published" class="uk-select">
                                    <option value="0" <?= ($post->published == 0) ? 'selected' : '' ?>>Brouillons</option>
                                    <option value="1" <?= ($post->published == 1) ? 'selected' : '' ?>>Publié</option>
                                </select>
                            </label>
                            <button type="submit" class="uk-button uk-button-warning">Save</button>
                        </form>
                    </td>
                    <td><?= $post->getCreatedAt() ?></td>
                    <td>
                        <a href="/post/edit/<?= $post->post_id ?>" class="uk-button uk-button-default">Modifier</a>
                        <form action="/post/delete/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                            <button type="submit" class="uk-button uk-button-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </li>
    <li>
        <table class="uk-table uk-table-striped uk-table-divider">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Titre</th>
                <th scope="col">Etat</th>
                <th scope="col">Publié le</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['PostsPublishedUser'] as $post): ?>
                <tr>
                    <th scope="row"><?= $post->post_id ?></th>
                    <td><?= $post->title ?></td>
                    <td>
                        <form action="/post/edit/state/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                            <label for="published" class="uk-margin-right">
                                <select name="published" id="published" class="uk-select">
                                    <option value="0" <?= ($post->published == 0) ? 'selected' : '' ?>>Brouillons</option>
                                    <option value="1" <?= ($post->published == 1) ? 'selected' : '' ?>>Publié</option>
                                </select>
                            </label>
                            <button type="submit" class="uk-button uk-button-warning">Save</button>
                        </form>
                    </td>
                    <td><?= $post->getCreatedAt() ?></td>
                    <td>
                        <a href="/post/edit/<?= $post->post_id ?>" class="uk-button uk-button-default">Modifier</a>
                        <form action="/post/delete/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                            <button type="submit" class="uk-button uk-button-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </li>
</ul>




