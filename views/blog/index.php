 <h1>Les derniers articles </h1>


 <?php if(!empty($params['message'])): ?>
     <div class="alert alert-warning"><?php echo $params['message']; ?></div>
 <?php endif; ?>


<?php foreach ($params['posts'] as $post):  ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2><?= $post->title ?></h2>
                <div>
                    <?php foreach($post->getTags() as $tag): ?>
                        <span class="badge bg-success"><a href="/tags/<?= $tag->id ?>" class="text-white"><?= $tag->name ?></a></span>
                    <?php endforeach; ?>
                </div>
            <small class="text-info">Publié le <?= $post->getCreatedAt() ?></small>
            <small class="text-info">par <?= $post->getCreatorPost(); ?></small>
            <p><?= $post->getExcerpt() ?></p>
            <?= $post->getButton() ?>
        </div>
    </div>
 <?php endforeach; ?>
