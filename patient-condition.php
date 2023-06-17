<?php include "intelligent-funtions.php";?>
<?php include "header.php";?>
<div class="middle-condition">
  <div class="patient-container">
    <div id="image-container"></div>
    <div id="info-container"></div>
  </div>
  <div class="patient-details">
    <div class="big-font">Patient Information</div>
    <table>
      <tr>
        <th>First Name</th>
        <td><?php echo retrieveFN(); ?></td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td><?php echo retrieveLN()?></td>
      </tr>
      <tr>
        <th>AMKA</th>
        <td><?php echo retrieveAMKA()?></td>
      </tr>
      <tr>
        <th>Clinic</th>
        <td><?php echo retrieveClinic()?> </td>
      </tr>
      <tr>
        <th>Floor</th>
        <td><?php echo retrieveFloor()?> </td>
      </tr>
      <tr>
        <th>Room</th>
        <td><?php echo retrieveRoom()?> </td>
      </tr>
      <tr>
        <th>Bed ID</th>
        <td><?php echo retrieveBedid()?> </td>
      </tr>
    </table>
  </div>
</div>
<?php include "footer.php";?>

<?php cyclePatients(); ?>
