<?php


$url = 'http://localhost/rss.xml'; // L'URL de votre flux RSS

// Utilisation de la fonction simplexml_load_file pour charger le contenu XML du flux RSS
$xml = simplexml_load_file($url);

// Vérifier si le chargement du XML a réussi
if ($xml) {
    // Afficher le titre du flux RSS
    echo "Titre du flux RSS : " . $xml->channel->title . "<br>";
    echo "Description : " . $xml->channel->description . "<br>";
    echo "lastBuildDate : " . $xml->channel->lastBuildDate . "<br>";
    echo "link du website : " . $xml->channel->link . "<br>";
    echo "copyright : " . $xml->channel->copyright . "<br>". "<br>";
    
    // Afficher les articles du flux RSS
    foreach ($xml->channel->item as $item) {
        echo "ID : " . $item->guid . "<br>";
        echo "Titre : " . $item->title . "<br>";
        echo "Content : " . $item->description . "<br>";
        echo "URL : " . $item->link . "<br>";
        echo "PubDate  : " . $item->pubDate . "<br>";
        echo "<hr>";
    }
} else {
    // En cas d'erreur lors du chargement du flux RSS
    echo "Erreur lors du chargement du flux RSS.";
}


// si jeux recupere seulement le dernier posts il faut faire  $latestItem = $xml->channel->item[0]; et après je fais $latestItem->title si je veux recupe le titre