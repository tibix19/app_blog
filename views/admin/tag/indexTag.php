<h1 class="uk-heading-medium">Administration des tags</h1>

<?php
$message = "";
if(isset($_GET['update'])) {
    $message = "Modification effectuée !";
}
elseif(isset($_GET['delete'])) {
    $message = "Tag supprimé !";
}
elseif (isset($_GET['create'])) {
    $message = "Tag créé !";
}?>

<?php if(!empty($message)): ?>
    <div class="uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><?= $message ?></p>
    </div>
<?php endif; ?>

<form action="/admin/tag/create/" method="post" class="uk-form-stacked uk-margin">
    <label class="uk-form-label" for="name">Nom du tag :</label>
    <div class="uk-form-controls">
        <input class="uk-input" type="text" name="name" id="name">
    </div>
    <button type="submit" class="uk-button uk-button-primary">Enregistrer le nouveau tag</button>
</form>

<div class="uk-overflow-auto">
    <table class="uk-table uk-table-divider uk-table-hover uk-table-striped">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Tag</th>
            <th scope="col">Créé le</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($params['tags'] as $tag): ?>
            <tr>
                <th scope="row"><?= $tag->id ?></th>
                <td>
                    <form action="/admin/tag/update/<?= $tag->id ?>" method="post" class="uk-form-stacked uk-margin-remove-bottom">
                        <div class="uk-inline">
                            <input class="uk-input" type="text" name="tag" id="tag" value="<?= $tag->name; ?>">
                        </div>
                        <button type="submit" class="uk-button uk-button-primary uk-margin-small-left">Enregistrer</button>
                    </form>
                </td>
                <td><?= $tag->getCreatedAt() ?></td>
                <td>
                    <form action="/admin/tag/delete/<?= $tag->id ?>" method="POST" class="uk-form-stacked uk-margin-remove-bottom">
                        <button type="submit" class="uk-button uk-button-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
