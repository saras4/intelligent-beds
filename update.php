<?php include "intelligent-funtions.php";?>
<?php updatePatient(); ?>


<?php include "header.php";?>
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
      <input type="text" value="<?php fnUpdate(); ?>" name = "first_name"  class="input">
      </div>

      <div class="input_field">
      <label for="last_name">Last name</label>
      <input type="text" value="<?php lnUpdate(); ?>" name = "last_name"  class="input">
      </div>

      <div class="input_field">
      <label for="age">Age</label>
      <input type="text" value="<?php ageUpdate(); ?>" name = "age" class="input">
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
