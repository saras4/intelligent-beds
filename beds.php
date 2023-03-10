<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>
<?php 
  addBed();
?>

<?php include "header.php";?>
<div class="landing-middle">
  <div class="big-font">Form to manage beds</div>
  <div class = "forms">
    <form action="beds.php" method="post">

      <div class="form-group">
      <label for="clinic">Clinic</label>
      <input type="text" name = "clinic" class="form-control">
      </div>

      <div class="form-group">
      <label for="floor">Floor</label>
      <input type="text" name = "floor"  class="form-control">
      </div>
      <div class="form-group">
      <label for="Room">Room</label>
      <input type="text" name = "room"  class="form-control">
      </div>

      <input type="submit" name = "submit" value = "Add bed">
    </form>
  </div>
</div>
<?php include "footer.php";?>
