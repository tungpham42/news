<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('../db.php');

// Retrieve data from the "news" table
$query = $pdo->query('SELECT `id`, `title`, `url`, `name` FROM `news`');
$data = $query->fetchAll(PDO::FETCH_ASSOC);

// Prepare the response in JSON format
$response = [
  "data" => $data
];

// Output the response
header('Content-Type: application/json');
echo json_encode($response);
?>