<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>
<?php 
  addPatient();
?>

<?php include "header.php";?>
<div class="landing-middle">
  <div class="big-font">Form to manage patients</div>
  <div class = "forms">
    <form action="newpatient.php" method="post">

      <div class="input_field">
      <label for="amka">AMKA</label>
      <input type="text" name = "amka" class="input">
      </div>

      <div class="input_field">
      <label for="first_name">First name</label>
      <input type="text" name = "first_name"  class="input">
      </div>
      <div class="input_field">
      <label for="last_name">Last name</label>
      <input type="text" name = "last_name"  class="input">
      </div>
      <div class="input_field">
      <label for="age">Age</label>
      <input type="text" name = "age" class="input">
      </div>
      <div class="input_field">
        <label for="bed_id">Bed</label>
        <select name="bed_id" class="input">
          <?php fetchBed(); ?>
        </select>
        
      </div>


      <input type="submit" name = "submit" value = "Add patient">
    </form>
  </div>
</div>
<?php include "footer.php";?>
