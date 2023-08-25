<?php include "intelligent-funtions.php";?>
<?php updatePatient(); ?>

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
<div class="wrapper">
  <div class="big-font">Update Patient Information</div>
  <div class="form">
    <form action="update.php" method="post">

    <div class="input_field">
    <label for="ΑΜΚΑ">ΑΜΚΑ</label>
    <input type="text" value="<?php echo $_GET['amka']; ?>" name="amka" class="input" readonly>
    </div>

      <div class="input_field">
      <label for="first_name">First name</label>
      <input type="text" value="<?php fnUpdate(); ?>" name = "first_name"  oninput="this.value = this.value.toUpperCase(); this.value = this.value.replace(/[^A-Z]/g, '');" pattern="[A-Z]+" title="Please enter only uppercase characters" required class="input"> 
      </div>

      <div class="input_field">
      <label for="last_name">Last name</label>
      <input type="text" value="<?php lnUpdate(); ?>" name = "last_name"  oninput="this.value = this.value.toUpperCase(); this.value = this.value.replace(/[^A-Z]/g, '');" pattern="[A-Z]+" title="Please enter only uppercase characters" required class="input"> 
      </div>

      <div class="input_field">
      <label for="age">Age</label>
      <input type="number" value="<?php ageUpdate(); ?>" name = "age" required class="input" oninput="javascript: if (this.value.length > 3) this.value = this.value.slice(0, 3);">
      </div>

      <div class="input_field">
        <label for="bed_id">Bed</label>
        <select name="bed_id" class="input">
          <?php fetchBed2(); ?>
        </select>
      </div>
      <div class="update_button">
      <input type="submit" name="submit" value="Update Patient" class="button2">
      <a href="patients.php" class="button2">Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php include "footer.php";?>
