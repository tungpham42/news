<?php
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News - Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="container mt-5">
    <h1>Manage News</h1>
    <div class="mb-3">
      <a href="create.php" class="btn btn-dark">Create</a>
    </div>
    <div class="table-responsive">
      <table class="table" id="newsTable">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">News Title</th>
            <th scope="col">RSS URL</th>
            <th scope="col">Short Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- DataTables JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
      var table = $('#newsTable').DataTable({
        "ajax": "get_data.php",
        "columns": [
          { "data": "id" },
          { "data": "title" },
          { "data": "url" },
          { "data": "name" },
          {
            "data": null,
            "render": function(data, type, row) {
              return  '<button class="m-2 btn btn-dark" onclick="editRow(' + row.id + ')">Edit</button>' +
                      '<button class="m-2 btn btn-dark" onclick="deleteRow(' + row.id + ')">Delete</button>';
            }
          }
        ],
        "searching": true,
        "paging": true,
        "ordering": true,
        'order': [[ 0, 'asc' ]],
        "info": true
      });

      setInterval(function() {
        table.ajax.reload(null, false); // user paging is not reset on reload
      }, 30000);
      
      window.editRow = function(id) {
        window.location.href = 'edit.php?id=' + id;
      };

      window.deleteRow = function(id) {
        if (confirm("Are you sure you want to delete this record?")) {
          $.ajax({
            url: 'delete.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
              if (response.success) {
                table.ajax.reload();
              } else {
                alert('Error deleting record.');
              }
            }
          });
        }
      };
    });
  </script>
</body>
</html>
