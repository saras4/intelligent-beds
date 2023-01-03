<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>
<?php include "header.php";?>
<div class="patient">
  <div class="patient-info">
  <table>
    <tr>
      <thead>
        <th>Patient</th>
     </thead>
    </tr>
    <tbody> <?php  search();?> </tbody>
  </table>
  <!-- <?php search();?> -->
  </div>
  <div class="patient-current-stage">
    <!-- <?php patientCondition();?> -->
    <?php readPatients(); ?>
  </div>
  </div>

<?php include "footer.php";?>
