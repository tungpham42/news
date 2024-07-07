<?php
$db_type = 'sqlite'; // mysql or sqlite
if ($db_type == 'mysql') {
    $url = parse_url(getenv("JAWSDB_URL"));
	/* Database config */
	$db_host		= $url["host"];
	$db_user		= $url["user"];
	$db_pass		= $url["pass"];
	$db_database	= substr($url["path"], 1);
	/* End config */
	$pdo = new PDO('mysql:host='.$db_host.';port=3306;dbname='.$db_database,$db_user,$db_pass);
	$pdo->query('SET names UTF8');
    $createNewsTableQuery = '
        CREATE TABLE IF NOT EXISTS `news` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
    ';
    $createSettingsTableQuery = '
        CREATE TABLE IF NOT EXISTS `settings` (
            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `username` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `siteTitle` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `siteDescription` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `theme` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
    ';
} else if ($db_type == 'sqlite') {
    $db_path = __DIR__ . '/db/data.db';
	$pdo = new PDO('sqlite:'.$db_path);
    $createNewsTableQuery = '
        CREATE TABLE IF NOT EXISTS `news` (
            `id` INTEGER PRIMARY KEY AUTOINCREMENT,
            `title` TEXT,
            `url` TEXT,
            `name` TEXT
        )
    ';
    $createSettingsTableQuery = '
        CREATE TABLE IF NOT EXISTS `settings` (
            `id` INTEGER PRIMARY KEY,
            `username` TEXT,
            `password` TEXT,
            `siteTitle` TEXT,
            `siteDescription` TEXT,
            `theme` TEXT
        )
    ';
}
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$pdo->exec($createNewsTableQuery);
$pdo->exec($createSettingsTableQuery);
// Check if admin account already exists
$countSql = 'SELECT COUNT(*) FROM `settings` WHERE `id` = 1';
$countStatement = $pdo->prepare($countSql);
$countStatement->execute();
$count = $countStatement->fetchColumn();
if ($count === 0) {
    $username = 'admin';
    $password = 'password';
    $siteTitle = 'World News';
    $siteDescription = 'Latest news from popular newspapers. Updated 24/7.';
    $theme = 'quartz';
    $defaultSettings = array(
        'username' => $username,
        'password' => $password,
        'siteTitle' => $siteTitle,
        'siteDescription' => $siteDescription,
        'theme' => $theme
    );
    $insertSettingsQuery = '
    INSERT INTO `settings` (`username`, `password`, `siteTitle`, `siteDescription`, `theme`)
    VALUES (:username, :password, :siteTitle, :siteDescription, :theme)
    ';
    $statement = $pdo->prepare($insertSettingsQuery);
    $statement->execute($defaultSettings);

    $firstNews = array(
        'title' => 'New York Times',
        'url' => 'https://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml',
        'name' => 'nyt'
    );
    $insertFirstNewsQuery = '
    INSERT INTO `news` (`title`, `url`, `name`)
    VALUES (:title, :url, :name)
    ';
    $newsStatement = $pdo->prepare($insertFirstNewsQuery);
    $newsStatement->execute($firstNews);
}
