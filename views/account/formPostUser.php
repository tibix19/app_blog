<h1><?= $params['post']->title ?? 'Créer un nouvelle article'?> </h1>

<form action="/post/edit/<?= $params['post']->id ?>" method="POST">
    <div class="uk-margin">
        <label for="title">Titre de l'article</label>
        <input class="uk-input" type="text" name="title" id="title" value="<?= $params['post']->title ?>">
    </div>
    <div class="uk-margin">
        <label for="content">Contenu de l'article</label>
        <textarea class="uk-textarea" name="content" id="content" rows="15"><?= $params['post']->content ?></textarea>
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
    <button type="submit" class="uk-button uk-button-primary">Enregistrer les modifications</button>
</form>