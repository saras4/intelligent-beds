<?php include "intelligent-funtions.php";?>
<?php updateBed(); ?>


<?php include "header.php";?>
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
      <input type="text" value="<?php clinicUpdate(); ?>" name = "clinic"  class="input">
      </div>

      <div class="input_field">
      <label for="floor">Floor</label>
      <input type="text" value="<?php floorUpdate(); ?>" name = "floor"  class="input">
      </div>

      <div class="input_field">
      <label for="room">Room</label>
      <input type="text" value="<?php roomUpdate(); ?>" name = "room" class="input">
      </div>

      
      <div class="update_button">
      <input type="submit" name="submit" value="Update Bed" class="button2">
      <a href="beds.php" class="button2">Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php include "footer.php";?>
