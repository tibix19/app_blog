<?php
header("Content-Type: application/rss+xml;");
?>
<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0">
    <channel>
        <title>LogYourKnowledge</title>
        <description>Flux RSS du blog LogYourKnowledge</description>
        <lastBuildDate><?= @date(DATE_RSS, strtotime($latestPost->created_at)) ?></lastBuildDate>
        <link>http://localhost</link>
        <copyright>2024 LogYourKnowLedge. Tous droits reserves.</copyright>
        <?php foreach ($posts as $article): ?>
            <item>
                <title><?= $article->title ?></title>
                <description><?= substr($article->content, 0, 100). '...' ?></description>
                <pubDate><?= date(DATE_RSS, strtotime($article->created_at)) ?></pubDate>
                <link>http://localhost/posts/<?= $article->id ?></link>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>

