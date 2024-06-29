<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('./db.php');

// Retrieve data from the "news" table
$newQuery = $pdo->query('SELECT `id`, `title`, `url`, `name` FROM `news`');
$newsData = $newQuery->fetchAll(PDO::FETCH_ASSOC);
$firstKey = array_key_first($newsData);

$siteQuery = 'SELECT `siteTitle`, `siteDescription` FROM `settings`';
$siteStatement = $pdo->query($siteQuery);
$settings = $siteStatement->fetch(PDO::FETCH_ASSOC);