<?php
header('Content-Type: application/json');

$feed_url = $_GET['rssUrl'];

function fetchRSS($url) {
    $rss = simplexml_load_file($url);
    $items = [];
    
    foreach ($rss->channel->item as $item) {
        $items[] = [
            'title' => (string) $item->title,
            'link'  => (string) $item->link,
            'description' => (string) $item->description,
            'pubDate' => (string) $item->pubDate,
        ];
    }
    
    return $items;
}

echo json_encode(fetchRSS($feed_url));
