<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('./db.php');

// Retrieve data from the "news" table
$newQuery = $pdo->query('SELECT `id`, `title`, `url`, `name` FROM `news`');
$newsData = $newQuery->fetchAll(PDO::FETCH_ASSOC);
$firstKey = array_key_first($newsData);

$siteQuery = 'SELECT `siteTitle`, `siteDescription`, `theme` FROM `settings`';
$siteStatement = $pdo->query($siteQuery);
$settings = $siteStatement->fetch(PDO::FETCH_ASSOC);

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Get the domain name
$domainName = $_SERVER['HTTP_HOST'];

// Combine them to get the full URL
$currentURL = $protocol . $domainName;