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
  </div>
  <div class="landing-middle">
    <div class="big-font">
      This is a monitoring system for bedridden patients. Please choose one of the options:
    </div>
  </div>
<div class="middle-options">
  <a href="patients.php">
  <div class="options">  
    <img src="icons/medical.png" alt="manage patients"> 
    <h3>Manage Patients</h3>
  </div>
  </a>

  <a href="beds.php">
  <div class="options">  
    <img src="icons/hospital-bed.png" alt="manage beds"> 
    <h3>Manage Beds</h3>
  </div>
  </a>

  <a href="monitor-patients.php">
  <div class="options">  
    <img src="icons/patient.png" alt="monitor patients"> 
    <h3>Monitor patients</h3>
  </div>
  </a>

</div>
<?php include "footer.php";?>
