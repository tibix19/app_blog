 <h1>Les derniers articles</h1>

 <div class="uk-container uk-container-expand uk-container-content">
     <div class="uk-child-width-1-2@m uk-grid-match uk-grid-small" uk-grid>
         <?php foreach ($params['posts'] as $post): ?>
             <div>
                 <div class="uk-card uk-card-default uk-card-hover uk-margin-bottom">
                     <div class="uk-card-body">
                         <h2><?= $post->title ?></h2>
                         <div>
                             <?php foreach($post->getTags() as $tag): ?>
                                 <span class="uk-badge uk-margin-small-right"><a href="/tags/<?= $tag->id ?>" class="uk-link-muted uk-text-emphasis"><?= $tag->name ?></a></span>
                             <?php endforeach; ?>
                         </div>
                         <small class="uk-text-meta">Publié le <?= $post->getCreatedAt() ?></small>
                         <small class="uk-text-meta">par <?= $post->getCreatorPost(); ?></small>
                         <p><?= $post->getExcerpt() ?></p>
                         <?= $post->getButton() ?>
                     </div>
                 </div>
             </div>
         <?php endforeach; ?>
     </div>
 </div>

