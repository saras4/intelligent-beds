<?php include "intelligent-funtions.php";?>
<?php updateBed(); ?>

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
<div class="wrapper">
  <div class="big-font">Update Patient Information</div>
  <div class="form">
    <form action="updatebed.php" method="post">

    <div class="input_field">
    <label for="id"> Bed id</label>
    <input type="text" value="<?php echo $_GET['bed_id']; ?>" name="id" class="input" readonly>
    </div>

      <div class="input_field">
      <label for="clinic">Clinic</label>
      <input type="text" value="<?php clinicUpdate(); ?>" name = "clinic"  oninput="this.value = this.value.toUpperCase(); this.value = this.value.replace(/[^A-Z]/g, '');" pattern="[A-Z]+" title="Please enter only uppercase characters" required class="input"> 
      </div>

      <div class="input_field">
      <label for="floor">Floor</label>
      <input type="number" value="<?php floorUpdate(); ?>" name = "floor"  required class="input" oninput="javascript: if (this.value.length > 2) this.value = this.value.slice(0, 2);">
      </div>

      <div class="input_field">
      <label for="room">Room</label>
      <input type="text" value="<?php roomUpdate(); ?>" name = "room" class="input" required oninput="this.value = this.value.toUpperCase();">
      </div>

      
      <div class="update_button">
      <input type="submit" name="submit" value="Update Bed" class="button2">
      <a href="beds.php" class="button2">Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php include "footer.php";?>
