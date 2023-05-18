<?php include "intelligent-funtions.php";?>
<?php include "header.php";?>
<div class="middle-condition">
  <div class="patient-container">
    <div class="patient_cycle">
      <?php cyclePatients()?>
    </div>
  </div>
  <div class="patient-details">
  <div class="big-font"> Patient Information</div>
  <table>
    <tr>
        <th>First Name</th>
        <td><?php echo retrieveFN(); ?></td>
    </tr>
    <tr>
        <th>Last name</th>
        <td>data</td>
    </tr>
    <tr>
        <th>AMKA</th>
        <td>data</td>
    </tr>
    <tr>
        <th>Clinic</th>
        <td>data</td>
    </tr>
    <tr>
        <th>Floor</th>
        <td>data</td>
    </tr>
    <tr>
        <th>Room</th>
        <td>data</td>
    </tr>
    <tr>
        <th>Bed ID</th>
        <td>data</td>
    </tr>
</table>

  </div>
</div>
<?php include "footer.php";?>