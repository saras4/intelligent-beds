<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Intelligent Beds</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <div class="header">
    <div class="logo">Intelligent Beds </div>
    <div class="header-links">
      <ul>
        <li><a href="#">Patients</a></li>
        <li><a href="#">Add patient</a></li>
        <li><a href="#">Update patient</a></li>
      </ul>
    </div>
  </div>
  <div class="introduction">
    <div class="hello">
      <div class="big-font">Hello,</div>
      <div class="small-font">Current patients: <?php numberOfPatients()?></div> 
    </div>
    <div class="search">
      <form action="" class="search-bar">
        <input type="text" placeholder="search patient (AMKA)" name="q">
        <button type="submit"><img src="images/search.png"></button>
      </form>
  </div>
  </div>
</body>

</html>