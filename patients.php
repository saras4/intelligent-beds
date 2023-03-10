<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>
<?php 
  addPatient();
?>

<?php include "header.php";?>
<div class="landing-middle">
  <div class="big-font">Form to manage patients</div>
  <div class = "forms">
    <form action="patients.php" method="post">

      <div class="form-group">
      <label for="amka">AMKA</label>
      <input type="text" name = "amka" class="form-control">
      </div>

      <div class="form-group">
      <label for="first_name">First name</label>
      <input type="text" name = "first_name"  class="form-control">
      </div>
      <div class="form-group">
      <label for="last_name">Last name</label>
      <input type="text" name = "last_name"  class="form-control">
      </div>
      <div class="form-group">
      <label for="age">Age</label>
      <input type="text" name = "age" class="form-control">
      </div>
      <div class="form-group">
        <label for="bed_id">Bed</label>
        <select name="bed_id" class="form-control">
          <?php fetchBed(); ?>
        </select>
        
      </div>


      <input type="submit" name = "submit" value = "Add patient">
    </form>
  </div>
</div>
<?php include "footer.php";?>
