<h1>Administration des utilisateurs </h1>

<?php 
$message = "";
if(isset($_GET['success'])) {
    $message = "Modification effectuée !";
} 
elseif(isset($_GET['delete'])) {
    $message = "Utilisateur supprimé avec succès !";
} ?>

<?php if(!empty($message)): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<a href="/admin/account/create" class="btn btn-success my-3">Créer un nouvel utilisateur</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Username</th>
            <th scope="col">Level</th>
            <th scope="col">Créer le </th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($params['users'] as $user): ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->username ?></td>
                <td>
                    <form action="/admin/account/edit/<?= $user->id ?>" method="POST" class="d-inline">
                        <label for="admin">
                            <select name="admin" id="admin" class="form-control">
                                <option value="0" <?= ($user->admin == 0) ? 'selected' : '' ?>>User</option>
                                <option value="1" <?= ($user->admin == 1) ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </label>
                        <button type="submit" class="btn btn-warning">Save</button>
                    </form>
                </td>
                <td><?= $user->getCreatedAt() ?></td>
                <td>
                    <form action="/admin/account/delete/<?= $user->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>