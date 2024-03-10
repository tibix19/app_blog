<h1>Administration des tags</h1>

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
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<form action="/admin/tag/create/" method="post" class="d-inline">
    <label for="name">
        <input type="text" name="name" id="name">
    </label>
    <button type="submit" class="btn btn-success">Enregistrer le nouveau tag</button>
</form>


<table class="table">
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
                <form action="/admin/tag/update/<?= $tag->id ?>" method="post" class="d-inline">
                    <label for="tag">
                        <input type="text" name="tag" id="tag" value="<?= $tag->name; ?>">
                    </label>
                    <button type="submit" class="btn btn-warning">Save</button>
                </form>
            </td>
            <td><?= $tag->getCreatedAt() ?></td>
            <td>
                <form action="/admin/tag/delete/<?= $tag->id ?>" method="POST" class="d-inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
