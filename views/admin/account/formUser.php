<h1>Créer un nouvel utilisateur</h1>

<form action="/admin/account/create" method="POST" >
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="username" id="username" value="<?= $params['user']->username ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="admin">Level</label>
        <select name="admin" id="admin" class="form-control">
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
    </div>
    <div class="from-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control" value="<?= $params['user']->password ?? '' ?>">
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($params['user']) ? 'Enregistrer les modifications' : 'Créer un utilisateur' ?></button>
</form>