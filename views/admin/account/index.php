<!-- PANEL ADMIN - Afficher tous les utilisateurs du site -->

<h1 class="uk-heading-small uk-padding uk-padding-remove-left">Administration des utilisateurs (<?= count($params['users']) ?>)</h1>

<!-- Afficher les erreurs ou autre message -->
<?php
$message = "";
if(isset($_GET['updateuser'])) {
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
    <table class="uk-table uk-table-striped uk-table-small uk-table-hover uk-table-divider">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Username</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Actions</th>
            <th scope="col">Créer le</th>
            <th scope="col">IP</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <!--  bouclé sur les utilisateurs pour les afficher dans un tableau-->
        <?php foreach ($params['users'] as $user): ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td>
                    <form action="/admin/account/edit/<?= $user->id ?>" method="POST" class="uk-display-inline">
                        <!-- Afficher si le user un champ option pour modifier si le user est admin ou User standard -->
                        <label for="admin" class="uk-margin-right uk-margin-remove-right">
                            <select name="admin" id="admin" class="uk-select uk-width-1-4">
                                <option value="0" <?= ($user->admin == 0) ? 'selected' : '' ?>>User</option>
                                <option value="1" <?= ($user->admin == 1) ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </label>
                        <!-- Afficher le champ de modification si le compte est bloqué ou actif  -->
                        <label for="etat_compte" class="uk-margin-righ uk-padding-remove-left">
                            <select name="etat_compte" id="admin" class="uk-select uk-width-1-3">
                                <option value="0" <?= ($user->etat_compte == 0) ? 'selected' : '' ?>>Actif</option>
                                <option value="1" <?= ($user->etat_compte == 1) ? 'selected' : '' ?>>Bloqué</option>
                            </select>
                        </label>
                        <button type="submit" class="uk-button uk-button-warning">Save</button>
                    </form>
                </td>
                <!--  Afficher la date de création du user-->
                <td><?= $user->getCreatedAt() ?></td>
                <!--  Afficher la dernière adresse IP de connexion de l'utilisateur -->
                <td><?= $user->ip_addr ?></td>
                <td>
                    <!-- bouton supprimer pour supprimer les utilisateurs -->
                    <form action="/admin/account/delete/<?= $user->id ?>" method="POST" class="uk-display-inline">
                        <button type="submit" class="uk-button uk-button-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
