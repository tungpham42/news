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
        $item_thumbnail = '';
        if (preg_match('/<img[^>]+src="([^">]+)"/i', $item->description, $matches)) {
            // Return the first found image URL
            $item_thumbnail = ($matches) ? $matches[1]: '/noimg.png';
        }
        $items[] = [
            'title' => (string) html_entity_decode(removeCdataTags($item->title)),
            'link'  => (string) $item->link,
            'image' => (string) $item_thumbnail,
            'description' => (string) html_entity_decode(removeCdataTags($item->description)),
            'pubDate' => (string) $item->pubDate,
        ];
    }
    
    return $items;
}

echo json_encode(fetchRSS($feed_url));
