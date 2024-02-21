<h1> Administration des utilisateurs </h1>

 <a href="/admin/posts/create" class="btn btn-success my-3">Créer un nouvel utilisateur</a>

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
                <td><?= $user->admin ?></td>
                <td><?= $user->getCreatedAt() ?></td>
                <td>
                    <form action="/admin/user/delete/<?= $user->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>