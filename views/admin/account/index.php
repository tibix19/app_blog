<h1>Administration des utilisateurs </h1>

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
                    <?php // il faire en sorte qu'on puisse choisir entre 1 ou 0 ?>
                    <?= $user->admin ?>
                </td>
                <td><?= $user->getCreatedAt() ?></td>
                <td>
                    <form action="/admin/account/update/<?= $user->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-warning">Modifier</button>
                    </form>
                    <form action="/admin/account/delete/<?= $user->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>