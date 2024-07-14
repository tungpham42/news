<?php
header('Content-Type: application/json');

$feed_url = $_GET['rssUrl'];

function removeCdataTags($input) {
    return str_replace(["<![CDATA[", "]]>"], "", $input);
}

function fetchRSS($url) {
    $rss = simplexml_load_file($url);
    $items = [];
    
    // Detect if the feed is RSS or Atom
    $isRSS = isset($rss->channel->item);
    $isAtom = isset($rss->entry);

    if ($isRSS) {
        foreach ($rss->channel->item as $item) {
            $content_encoded = htmlspecialchars($item->children('content', true)->encoded, ENT_QUOTES, 'UTF-8');
            if (!$content_encoded) {
                $content_encoded = $item->description;
            }
            $items[] = [
                'title' => (string) html_entity_decode(removeCdataTags($item->title)),
                'link'  => (string) $item->link,
                'description' => (string) html_entity_decode(removeCdataTags($item->description)),
                'content' => (string) html_entity_decode(removeCdataTags($content_encoded)),
                'pubDate' => (string) $item->pubDate,
            ];
        }
    } elseif ($isAtom) {
        foreach ($rss->entry as $entry) {
            $content_encoded = htmlspecialchars($entry->children('content', true), ENT_QUOTES, 'UTF-8');
            if (!$content_encoded) {
                $content_encoded = $entry->summary;
            }
            $items[] = [
                'title' => (string) html_entity_decode(removeCdataTags($entry->title)),
                'link'  => (string) $entry->link['href'],
                'description' => (string) html_entity_decode(removeCdataTags($entry->summary)),
                'content' => (string) html_entity_decode(removeCdataTags($content_encoded)),
                'pubDate' => (string) $entry->updated,
            ];
        }
    }
    
    return $items;
}

echo json_encode(fetchRSS($feed_url));
