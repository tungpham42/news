<!DOCTYPE html>
<html>
<head>
  <title>News - Create</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <?php
  include 'header.php';
  ?>
  <div class="container mt-5">
    <h1>Create</h1>
    <?php
    error_reporting(-1);
    ini_set('display_errors', 'On');
    // Include the SQLite database connection
    include realpath('../db.php');
    if (isset($_POST['submit'])) {
      if (isset($_POST['title']) && isset($_POST['url']) && isset($_POST['name'])) {
        $newTitle = $_POST['title'];
        $newUrl = $_POST['url'];
        $newName = $_POST['name'];
        $query = 'INSERT INTO `news` (`title`, `url`, `name`) VALUES (:new_title, :new_url, :new_name)';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':new_title', $newTitle);
        $statement->bindValue(':new_url', $newUrl);
        $statement->bindValue(':new_name', $newName);

        try {
            $statement->execute();
        } catch (PDOException $e) {
            die("Error inserting record: " . $e->getMessage());
        }

        // Check the result of the update operation
        if ($statement->rowCount() > 0) {
            echo "Record inserted successfully.";
        } else {
            echo "No records were inserted.";
        }

        // Close the database connection
        $pdo = null;
        sleep(1);
        header('Location: admin.php');
        exit;
      }
    } else {
    ?>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group my-3">
          <label for="title">News Title:</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group my-3">
          <label for="url">RSS URL:</label>
          <input type="text" class="form-control" id="url" name="url" required>
        </div>

        <div class="form-group my-3">
          <label for="name">Short name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <button name="submit" type="submit" class="btn btn-dark my-3">Create</button>
      </form>
    <?php
    }
    ?>
    <a href="./admin.php" class="btn btn-dark">Back to Admin</a>
  </div>
</body>
</html>