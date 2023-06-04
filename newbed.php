<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>
<?php addBed(); ?>

<?php include "header.php";?>
<div class="wrapper">
  <div class="big-font">Form to manage beds</div>
  <div class = "form">
    <form action="newbed.php" method="post">

      <div class="input_field">
      <label for="clinic">Clinic</label>
      <input type="text" name = "clinic" class="input">
      </div>

      <div class="input_field">
      <label for="floor">Floor</label>
      <input type="text" name = "floor"  class="input">
      </div>
      <div class="input_field">
      <label for="Room">Room</label>
      <input type="text" name = "room"  class="input">
      </div>

      <input type="submit" name = "submit" value = "Add bed" class="button">
    </form>
  </div>
</div>
<?php include "footer.php";?>
