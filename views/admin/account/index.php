<h1>Administration des utilisateurs</h1>

<!-- Afficher les erreurs -->

<?php
$message = "";
if(isset($_GET['updatelevel'])) {
    $message = "Modification effectuée !";
}
elseif(isset($_GET['delete'])) {
    $message = "Utilisateur supprimé avec succès !";
}
elseif (isset($_GET['create'])) {
    $message = "Utilisateur créé avec succès !";
}?>

<?php if(!empty($message)): ?>
    <div class="uk-alert uk-alert-success" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <?php echo $message; ?>
    </div>
<?php endif; ?>


<!-- Afficher tous les comptes des users dans un tableau -->
<a href="/admin/account/create" class="uk-button uk-button-primary uk-margin-bottom">Créer un nouvel utilisateur</a>
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped uk-table-hover uk-table-divider">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Username</th>
            <th scope="col">Level</th>
            <th scope="col">Créer le</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($params['users'] as $user): ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->username ?></td>
                <td>
                    <form action="/admin/account/edit/<?= $user->id ?>" method="POST" class="uk-display-inline">
                        <label for="admin" class="uk-margin-right">
                            <select name="admin" id="admin" class="uk-select">
                                <option value="0" <?= ($user->admin == 0) ? 'selected' : '' ?>>User</option>
                                <option value="1" <?= ($user->admin == 1) ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </label>
                        <button type="submit" class="uk-button uk-button-warning">Save</button>
                    </form>
                </td>
                <td><?= $user->getCreatedAt() ?></td>
                <td>
                    <form action="/admin/account/delete/<?= $user->id ?>" method="POST" class="uk-display-inline">
                        <button type="submit" class="uk-button uk-button-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
