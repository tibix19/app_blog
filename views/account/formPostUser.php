<!-- Formulaire de modification pour user standard -->

<!-- Afficher les erreurs (si manque de caractère pour le titre ou le content et si aucun tag n'est sélectionné) -->
<?php if(isset($_SESSION['errors'])): ?>
    <?php foreach ($_SESSION['errors'] as $errorArray): ?>
        <?php foreach ($errorArray as $errors): ?>
            <div class="uk-alert-danger" uk-alert>
                <?php foreach ($errors as $error): ?>
                        <a class="uk-alert-close" uk-close></a>
                        <p><?= $error ?></p>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif ?>


<h1 class="uk-heading-small uk-padding uk-padding-remove-left"><?= $params['post']->title ?> </h1>

<form action="/post/edit/<?= $params['post']->id ?>" method="POST" enctype="multipart/form-data">
    <div class="uk-margin">
        <label for="title">Titre de l'article</label>
        <input class="uk-input" type="text" name="title" id="title" value="<?= $params['post']->title ?>">
    </div>
    <div class="uk-margin">
        <!-- check si une image existe, l'afficher ou ne rien faire -->
        <?php if (isset($params['post']->image)) : ?>
            <label class="uk-form-label " for="image">Image actuelle</label><br>
            <img src="../../../static/images/<?= $params['post']->image ?>" width="50%" height="50%"><br><br>
        <?php endif ?>
        <label class="uk-form-label" for="image">Insérer la nouvelle image</label><br>
        <input type="file" aria-label="Custom controls" class="uk-margin" name="image" id="image">
    </div>
    <div class="uk-margin">
        <label for="content">Contenu de l'article</label>
        <textarea class="uk-textarea" name="content" id="content" rows="15"><?= $params['post']->content ?></textarea>
    </div>
    <div class="uk-width-1-1">
        <label class="uk-form-label" for="published">Etat du poste</label>
        <select name="published" id="published" class="uk-select">
            <option value="0" <?= ($params['post']->published == 0) ? 'selected' : '' ?>>Brouillons</option>
            <option value="1" <?= ($params['post']->published == 1) ? 'selected' : '' ?>>Publié</option>
        </select>
    </div>
    <div class="uk-margin">
        <label for="tags">Tags de l'article</label>
        <select multiple class="uk-select" id="tags" name="tags[]">
            <?php foreach ($params['tags'] as $tag) : ?>
                <option value="<?= $tag->id ?>"
                    <?php if(isset($params['post'])) : ?>
                        <?php foreach ($params['post']->getTags() as $postTag) {
                            echo ($tag->id === $postTag->id) ? 'selected' : '';
                        } ?>
                    <?php endif; ?>><?= $tag->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="uk-button uk-button-primary"><?= isset($params['post']) ? 'Enregistrer les modifications' : 'Enregistrer mon article' ?></button>
</form>
<!-- Vider la variable de session des erreurs -->
<?php unset($_SESSION['errors']); ?>