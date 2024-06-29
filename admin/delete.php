<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('../db.php');

// Retrieve the ID parameter
$id = $_POST['id'];

// Delete the row from the "keys" table
$deleteQuery = $pdo->prepare('DELETE FROM `news` WHERE `id` = :id');
$deleteQuery->bindParam(':id', $id);
$success = $deleteQuery->execute();

// Prepare the response
$response = [
  'success' => $success
];

// Output the response
header('Content-Type: application/json');
echo json_encode($response);
?>