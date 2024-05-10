<!-- page pour l'admin pour administer les articles -->
<h1 class="uk-heading-small uk-padding uk-padding-remove-left">Administration des postes</h1>

<!-- Afficher les actions effectuées -->
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
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped uk-table-small uk-table-hover uk-table-divider">
        <thead>
        <tr>
            <th class="uk-text-center">id</th>
            <th class="uk-text-center">Titre</th>
            <th class="uk-text-center">Etat</th>
            <th class="uk-text-center">Publié le</th>
            <th class="uk-text-center">Créateur</th>
            <th class="uk-text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($params['posts'] as $post): ?>
            <tr>
                <th><?= $post->id ?></th>
                <td><?= $post->title ?></td>
                <td>
                    <form action="/post/edit/state/<?= $post->id ?>" method="POST" class="uk-display-inline">
                        <input type="hidden" name="return_to" value="<?= $_SERVER['REQUEST_URI'] ?>">
                        <label for="published" class="uk-margin-right">
                            <select name="published" id="published" class="uk-select uk-width-1-2">
                                <option value="0" <?= ($post->published == 0) ? 'selected' : '0' ?>>Brouillons</option>
                                <option value="1" <?= ($post->published == 1) ? 'selected' : '1' ?>>Publié</option>
                            </select>
                            <button type="submit" class="uk-button uk-button-warning" style="padding-left: 3%; padding-right: 3%;">Save</button>
                        </label>

                    </form>
                </td>
                <td class="uk-text-center"><?= $post->getCreatedAt() ?></td>
                <td class="uk-text-center"><?= $post->getCreatorPost() ?></td>
                <td class="uk-width-1-3 uk-padding-right-remove uk-text-center">
                    <a href="/admin/posts/edit/<?= $post->id ?>" class="uk-button uk-button-secondary" style="padding-left: 3%; padding-right: 3%;">Modifier</a>
                    <form action="/admin/posts/delete/<?= $post->id ?>" method="POST" class="uk-display-inline">
                        <button type="submit" class="uk-button uk-button-danger" style="padding-left: 3%; padding-right: 3%;" >Supprimer</button>
                    </form>
                    <a href="/posts/<?= $post->id ?>" class="uk-button uk-button-default" style="background: lightgrey; padding-left: 4%; padding-right: 4%;">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
