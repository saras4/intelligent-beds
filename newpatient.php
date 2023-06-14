<?php include "intelligent-funtions.php";?>
<?php 
  addPatient();
?>

<?php include "header.php";?>
<div class="wrapper">
  <div class="big-font">Please add the patients info</div>
  <div class = "form">
    <form action="newpatient.php" method="post">

      <div class="input_field">
        <label for="amka">AMKA</label>
        <input type="number" name="amka" required class="input" oninput="javascript: this.value = this.value.slice(0, 11); if (this.value.length !== 11) this.setCustomValidity('Please enter exactly 11 numbers.'); else this.setCustomValidity('');">
      </div>


      <!-- Js function to replace and reject any invalid characters -->
      <div class="input_field">
        <label for="first_name">First name</label>
        <input type="text" name="first_name" oninput="this.value = this.value.toUpperCase(); this.value = this.value.replace(/[^A-Z]/g, '');" pattern="[A-Z]+" title="Please enter only uppercase characters" required class="input"> 
      </div>

      <div class="input_field">
      <label for="last_name">Last name</label>
      <input type="text" name = "last_name"  oninput="this.value = this.value.toUpperCase(); this.value = this.value.replace(/[^A-Z]/g, '');" pattern="[A-Z]+" title="Please enter only uppercase characters" required class="input"> 
      </div>

      <div class="input_field">
        <label for="age">Age</label>
        <input type="number" name="age" required class="input" oninput="javascript: if (this.value.length > 3) this.value = this.value.slice(0, 3);">
      </div>









      <div class="input_field">
        <label for="bed_id">Bed</label>
        <select name="bed_id" class="input">
          <?php fetchBed(); ?>
        </select>
      </div>

      <div class="update_button">
        <input type="submit" name = "submit" value = "Add patient" class="button2">
        <a href="patients.php" class="button2">Cancel</a>
      </div>
      
    </form>
  </div>
</div>
<?php include "footer.php";?>
