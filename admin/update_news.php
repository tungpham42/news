<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('../db.php');
// Retrieve the updated values from the form or user input
$id = $_POST['id']; // Assuurlg 'id' is the primary title of the record to be updated
$newTitle = $_POST['title'];
$newUrl = $_POST['url'];
$newName = $_POST['name'];

// Build and execute the SQL query to update the record
$query = 'UPDATE `news` SET `title` = :new_title, `url` = :new_url, `name` = :new_name WHERE `id` = :id';
$statement = $pdo->prepare($query);
$statement->bindValue(':new_title', $newTitle);
$statement->bindValue(':new_url', $newUrl);
$statement->bindValue(':new_name', $newName);
$statement->bindValue(':id', $id);

try {
    $statement->execute();
} catch (PDOException $e) {
    die("Error updating record: " . $e->getMessage());
}

// Check the result of the update operation
if ($statement->rowCount() > 0) {
    echo "Record updated successfully.";
} else {
    echo "No records were updated.";
}

// Close the database connection
$pdo = null;
sleep(1);
header('Location: admin.php');
exit;
?>