<?php include "intelligent-funtions.php";?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inspect</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <div class="header">
    <div class="logo"> <a href="index.php">Inspect System </a></div>
    <div class="header-links">
      <ul>
      <li><a href="patients.php">Manage Patients</a></li>
        <li><a href="monitor-patients.php">Monitor Patients</a></li>
      </ul>
    </div>
  </div>
  <div class="landing-middle">
    <div class="big-font">Manage Beds</div>
    <div class="patients-table">
    <a href="newbed.php" class="button2">New bed</a>
    <div class="table-container">
    <table>
    <tr>
      <thead>
        <th>Bed ID</th>
        <th>Clinic</th>
        <th>Floor </th>
        <th>Room</th>
        <th>Action</th>
     </thead>
    </tr>
    <tbody> 
      <?php  bedTable();?> 
  </tbody>
  </table>
  </div>
</div>
  </div>
<?php include "footer.php";?>
