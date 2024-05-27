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

<!-- quand on passe la souris sur une card le curseur change (pointeur à main) -->
<head>
    <style>
        .uk-card {
            cursor: pointer;
        }
    </style>
    <title></title>
</head>

<!-- Cards Begin -->
<div id="cards" class="uk-container uk-margin-large-top">
    <!-- Afficher les erreurs -->
    <?php if(!empty($params['message'])): ?>
        <div class="uk-alert-warning" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><?php echo $params['message']; ?></p>
        </div>
    <?php endif; ?>
    <div class="uk-child-width-1-4@m uk-child-width-1-2@s uk-grid-match" uk-grid="masonry: pack">
        <!-- card des postes-->
        <?php foreach ($params['posts'] as $post): ?>
            <div>
                <div class="uk-card uk-card-default uk-card-hover" data-post-id="<?= $post->id ?>">
                    <!-- Si pas d'image on affiche rien -->
                    <div class="uk-card-media-top">
                        <?php if (!empty($post->image)): ?>
                            <img class="" src="../../../static/images/<?= $post->image ?>" width="100%" height="100%" alt="image of the post">
                        <?php endif; ?>
                    </div>
                    <div class="uk-card-body uk-padding-small uk-padding-right-">
                        <h2 class="uk-card-title"><?= $post->title ?></h2>
                        <div class="uk-margin-small-bottom">
                            <?php foreach($post->getTags() as $tag): ?>
                                <span class="uk-badge uk-margin-small-right" style="background: #01324b;"><a style="color: white; " href="/tags/<?= $tag->id ?>" class="uk-link-text"><?= $tag->name ?></a></span>
                            <?php endforeach; ?>
                        </div>
                        <small class="uk-text-meta uk-margin-remove">Publié le <?= $post->getCreatedAt() ?></small>
                        <small class="uk-text-meta uk-margin-remove">par <?= $post->getCreatorPost(); ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>





