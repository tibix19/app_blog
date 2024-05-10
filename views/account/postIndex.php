<h1 class="uk-heading-small uk-padding uk-padding-remove-left">Mes postes</h1>

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
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
                <thead>
                <tr>
                    <th class="uk-text-center">Titre</th>
                    <th class="uk-text-center">Etat</th>
                    <th class="uk-text-center">Publié le</th>
                    <th class="uk-text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($params['PostsDraftUser'] as $post): ?>
                    <tr>
                        <td><?= $post->title ?></td>
                        <td>
                            <form action="/post/edit/state/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                                <input type="hidden" name="return_to" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                <label for="published" class="uk-margin-right">
                                    <select name="published" id="published" class="uk-select uk-width-1-2">
                                        <option value="0" <?= ($post->published == 0) ? 'selected' : '' ?>>Brouillons</option>
                                        <option value="1" <?= ($post->published == 1) ? 'selected' : '' ?>>Publié</option>
                                    </select>
                                </label>
                                <button type="submit" class="uk-button uk-button-warning">Save</button>
                            </form>
                        </td>
                        <td><?= $post->getCreatedAt() ?></td>
                        <td>
                            <a href="/post/edit/<?= $post->post_id ?>" class="uk-button uk-button-secondary" style="padding-left: 3%; padding-right: 3%;">Modifier</a>
                            <form action="/post/delete/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                                <button type="submit" class="uk-button uk-button-danger" style="padding-left: 3%; padding-right: 3%;">Supprimer</button>
                            </form>
                            <a href="/posts/<?= $post->post_id ?>" class="uk-button uk-button-default" style="background: lightgrey; padding-right: 3%; padding-left: 3%;">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </li>
    <li>
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-striped uk-table-hover uk-table-divider uk-table-small">
                <thead>
                <tr>
                    <th class="uk-text-center">Titre</th>
                    <th class="uk-text-center">Etat</th>
                    <th class="uk-text-center">Publié le</th>
                    <th class="uk-text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($params['PostsPublishedUser'] as $post): ?>
                    <tr>
                        <td><?= $post->title ?></td>
                        <td>
                            <form action="/post/edit/state/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                                <input type="hidden" name="return_to" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                <label for="published" class="uk-margin-right">
                                    <select name="published" id="published" class="uk-select uk-width-1-2">
                                        <option value="0" <?= ($post->published == 0) ? 'selected' : '' ?>>Brouillons</option>
                                        <option value="1" <?= ($post->published == 1) ? 'selected' : '' ?>>Publié</option>
                                    </select>
                                </label>
                                <button type="submit" class="uk-button uk-button-warning">Save</button>
                            </form>
                        </td>
                        <td><?= $post->getCreatedAt() ?></td>
                        <td>
                            <a href="/post/edit/<?= $post->post_id ?>" class="uk-button uk-button-secondary" style="padding-left: 3%; padding-right: 3%;">Modifier</a>
                            <form action="/post/delete/<?= $post->post_id ?>" method="POST" class="uk-display-inline">
                                <button type="submit" class="uk-button uk-button-danger" style="padding-left: 3%; padding-right: 3%;">Supprimer</button>
                            </form>
                            <a href="/posts/<?= $post->post_id ?>" class="uk-button uk-button-default" style="background: lightgrey; padding-right: 3%; padding-left: 3%;">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </li>
</ul>




