<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('../db.php');
if (isset($_POST['query'])) {
  $searchQuery = $_POST['query'];

  // Construct and execute the search query
  $query = "SELECT * FROM news WHERE title LIKE :searchQuery";
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':searchQuery', "%$searchQuery%");
  $stmt->execute();

  // Fetch the results and convert to JSON
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($results);
}
?>