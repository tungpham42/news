<?php
$db_type = 'sqlite'; // mysql or sqlite
if ($db_type == 'mysql') {
	/* Database config */
	$db_host		= '127.0.0.1';
	$db_user		= 'cungrao_news';
	$db_pass		= 'NEWSv0d0i';
	$db_database	= 'cungrao_news';
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
            `excludeNumber` int(11) NOT NULL DEFAULT 0,
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
            `excludeNumber` INTEGER
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
    $defaultSettings = array(
        'username' => $username,
        'password' => $password
    );
    $insertSettingsQuery = '
    INSERT INTO `settings` (`username`, `password`)
    VALUES (:username, :password)
    ';
    $statement = $pdo->prepare($insertSettingsQuery);
    $statement->execute($defaultSettings);
}