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
        <li><a href="beds.php">Manage Beds</a></li>
        <li><a href="monitor-patients.php">Monitor Patients</a></li>
      </ul>
    </div>
  </div>
  <div class="landing-middle">
    <div class="big-font">Manage patients</div>
    <div class="patients-table">
    <a href="newpatient.php" class="button2">New patient</a>
    <table>
    <tr>
      <thead>
        <th>First name</th>
        <th>Last name </th>
        <th>AMKA</th>
        <th>Action</th>
     </thead>
    </tr>
    <tbody> 
      <?php  patientTable2();?> 
  </tbody>
  </table>
  </div>
  </div>
<?php include "footer.php";?>
