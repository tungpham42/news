<?php
header('Content-Type: application/json');

$feed_url = $_GET['rssUrl'];

function removeCdataTags($input) {
    return str_replace(["<![CDATA[", "]]>"], "", $input);
}

function fetchRSS($url) {
    $rss = simplexml_load_file($url);
    $items = [];
    
    foreach ($rss->channel->item as $item) {
        $items[] = [
            'title' => (string) html_entity_decode($item->title),
            'link'  => (string) $item->link,
            'description' => (string) html_entity_decode(removeCdataTags($item->description)),
            'pubDate' => (string) $item->pubDate,
        ];
    }
    
    return $items;
}

echo json_encode(fetchRSS($feed_url));
