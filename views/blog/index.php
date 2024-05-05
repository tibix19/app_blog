
<!-- Afficher les erreurs -->
<?php if(!empty($params['message'])): ?>
    <div class="uk-alert-warning" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><?php echo $params['message']; ?></p>
    </div>
<?php endif; ?>

<script>
    // Ajouter un gestionnaire d'événements sur chaque carte
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.uk-card');

        cards.forEach(card => {
            card.addEventListener('click', function() {
                // Récupérer l'ID du post à partir de l'attribut data-post-id
                const postId = this.getAttribute('data-post-id');
                // Rediriger vers la page du post correspondant
                window.location.href = '/posts/' + postId;
            });
        });
    });
</script>

<!-- quand on passe la souris sur une card le curseur change -->
<head>
    <style>
        .uk-card {
            cursor: pointer;
        }
    </style>
</head>

<!-- Cards Begin -->
<div class="uk-section uk-margin-medium-bottom">
    <div id="cards" class="uk-container uk-width-5-6">
        <div class="uk-child-width-1-3@m uk-child-width-1-2@s uk-grid-match" uk-grid="masonry: pack">
            <!-- card des postes-->
            <?php foreach ($params['posts'] as $post): ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover" data-post-id="<?= $post->id ?>">
                        <!-- Si pas d'image on affiche rien -->
                        <div class="uk-card-media-top">
                            <?php if (!empty($post->image)): ?>
                                <img class="" src="../../public/static/images/<?= $post->image ?>" width="100%" height="100%" alt="image of the post">
                            <?php endif; ?>
                        </div>
                        <div class="uk-card-body">
                            <h2 class="uk-card-title"><?= $post->title ?></h2>
                            <div class="uk-margin">
                                <?php foreach($post->getTags() as $tag): ?>
                                    <span class="uk-badge uk-margin-small-right"><a href="/tags/<?= $tag->id ?>" class="uk-link-muted uk-text-emphasis"><?= $tag->name ?></a></span>
                                <?php endforeach; ?>
                            </div>
                            <small class="uk-text-meta">Publié le <?= $post->getCreatedAt() ?></small>
                            <small class="uk-text-meta">par <?= $post->getCreatorPost(); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>




