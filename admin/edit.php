<!DOCTYPE html>
<html>
<head>
  <title>News - Edit</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <?php
  include 'header.php';
  ?>
  <div class="container mt-5">
    <h1>Edit</h1>
    <?php
    error_reporting(-1);
    ini_set('display_errors', 'On');
    // Include the SQLite database connection
    include realpath('../db.php');
    // Retrieve the news ID from the query string or form submission
    $id = $_GET['id'] ?? $_POST['id'] ?? null;

    // Check if the news ID is provided
    if (!$id) {
      echo '<p>Invalid news ID.</p>';
    } else {
      // Retrieve the news record from the database (assuming you have already established the database connection)
      $query = "SELECT * FROM `news` WHERE `id` = :id";
      $statement = $pdo->prepare($query);
      $statement->bindValue(':id', $id);

      try {
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die("Error retrieving news record: " . $e->getMessage());
      }

      // Check if the news record exists
      if (!$row) {
        echo '<p>Record not found.</p>';
      } else if (isset($_POST['submit'])) {
        $id = $_POST['id']; // Assuming 'id' is the primary title of the record to be updated
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
      } else {
    ?>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="form-group my-3">
          <label for="title">News Title:</label>
          <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
        </div>

        <div class="form-group my-3">
          <label for="url">RSS URL:</label>
          <input type="text" class="form-control" id="url" name="url" value="<?php echo $row['url']; ?>" required>
        </div>

        <div class="form-group my-3">
          <label for="name">Short name:</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-dark my-3">Edit</button>
      </form>
    <?php
      }
    }
    ?>
    <a href="./admin.php" class="btn btn-dark">Back to Admin</a>
  </div>
</body>
</html>