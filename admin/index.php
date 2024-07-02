<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('../db.php');

// Retrieve data from the "keys" table
$query = $pdo->query('SELECT `username`, `password` FROM `settings` WHERE `id` = 1');
$data = $query->fetch(PDO::FETCH_ASSOC);
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Perform authentication logic, e.g., checking against a user table in the database
  // If authentication is successful, set session variables and redirect to the admin panel
  // Otherwise, display an error message
  if ($_POST['username'] === $data['username'] && $_POST['password'] === $data['password']) {
    $_SESSION['authenticated'] = true;
    header('Location: admin.php');
    exit;
  } else {
    $error = 'Invalid username or password';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>News - Admin Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 mt-5">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Admin Login</h3>
          </div>
          <div class="card-body">
            <?php if (isset($error)) echo '<p>' . $error . '</p>'; ?>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" id="username" name="username" placeholder="Enter your username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-dark">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>