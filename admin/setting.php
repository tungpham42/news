<?php
error_reporting(-1);
ini_set('display_errors', 'On');
// Include the SQLite database connection
include realpath('../db.php');
// Check if the form is submitted
$defaultQuery = 'SELECT `username`, `password`, `siteTitle`, `siteDescription`, `theme` FROM `settings`';
$defaultStatement = $pdo->query($defaultQuery);
$settings = $defaultStatement->fetch(PDO::FETCH_ASSOC);
$themes = [
  "cerulean",
  "cosmo",
  "cyborg",
  "darkly",
  "flatly",
  "journal",
  "litera",
  "lumen",
  "lux",
  "materia",
  "minty",
  "morph",
  "pulse",
  "quartz",
  "sandstone",
  "simplex",
  "sketchy",
  "slate",
  "solar",
  "spacelab",
  "superhero",
  "united",
  "vapor",
  "yeti",
  "zephyr"
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  $siteTitle = $_POST['siteTitle'];
  $siteDescription = $_POST['siteDescription'];
  $theme = $_POST['theme'];

  $updatedQuery = 'UPDATE `settings` SET `username` = :username, `password` = :password, `siteTitle` = :siteTitle, `siteDescription` = :siteDescription, `theme` = :theme WHERE `id` = 1';
  $updatedStatement = $pdo->prepare($updatedQuery);
  $updatedStatement->bindValue(':username', $username);
  $updatedStatement->bindValue(':password', $password);
  $updatedStatement->bindValue(':siteTitle', $siteTitle);
  $updatedStatement->bindValue(':siteDescription', $siteDescription);
  $updatedStatement->bindValue(':theme', $theme);
  $updatedStatement->execute();
  // Close the database connection
  $pdo = null;
  header('Location: admin.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Random - Settings</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <?php
  include 'header.php';
  ?>
  <div class="container mt-5">
    <h1>Settings Panel</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group my-3">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $settings['username']; ?>">
      </div>
      <div class="form-group my-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $settings['password']; ?>">
      </div>
      <div class="form-group my-3">
        <label for="siteTitle">Site Title</label>
        <input type="text" class="form-control" id="siteTitle" name="siteTitle" value="<?php echo $settings['siteTitle']; ?>">
      </div>
      <div class="form-group my-3">
        <label for="siteDescription">Site Description</label>
        <input type="text" class="form-control" id="siteDescription" name="siteDescription" value="<?php echo $settings['siteDescription']; ?>">
      </div>
      <div class="form-group my-3">
        <label for="theme">Site Theme</label>
        <select id="theme" name="theme" class="form-select">
          <?php foreach ($themes as $theme): ?>
          <option value="<?php echo $theme ?>"<?php echo $theme == $settings['theme'] ? ' selected' : '' ?>><?php echo ucfirst($theme) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-dark my-4">Save</button>
    </form>
  </div>
</body>
</html>