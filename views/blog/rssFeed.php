<?php
// Page pour le flucx RSS
header("Content-Type: application/rss+xml;");
?>
<rss version="2.0">
    <channel>
        <title>LogYourKnowledge</title>
        <description>Flux RSS du blog LogYourKnowledge</description>
        <lastBuildDate><?= @date(DATE_RSS, strtotime($latestPost->created_at)) ?></lastBuildDate>
        <link>http://localhost</link>
        <copyright>2024 LogYourKnowLedge. Tous droits reserves.</copyright>
        <?php foreach ($posts as $article): ?>
            <item>
                <guid><?= $article->id ?></guid>
                <title><?= $article->title ?></title>
                <pubDate><?= date(DATE_RSS, strtotime($article->created_at)) ?></pubDate>
                <link>http://localhost/posts/<?= $article->id ?></link>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>

