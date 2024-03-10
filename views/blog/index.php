 <h1>Les derniers articles</h1>

 <?php if(!empty($params['message'])): ?>
     <div class="uk-alert-warning" uk-alert>
         <a class="uk-alert-close" uk-close></a>
         <p><?php echo $params['message']; ?></p>
     </div>
 <?php endif; ?>

 <?php foreach ($params['posts'] as $post): ?>
     <div class="uk-card uk-card-default uk-margin-bottom">
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
 <?php endforeach; ?>

