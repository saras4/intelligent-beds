<?php include "intelligent-funtions.php";?>
<?php include "header.php";?>

<div class="control-page">
  <?php
  // Retrieve the list of patients
  $patients = getAllPatients();

  if (!empty($patients)) {
    foreach ($patients as $patient) {
      $patientId = $patient['amka'];
      $patientFullName = $patient['first_name'] . ' ' . $patient['last_name'];

      echo '<div class="patient-container">';
      echo '<h3>' . $patientFullName . '</h3>';
      echo '<div id="image-container-' . $patientId . '"></div>';

      // Generate the JavaScript code for cycling through the images
      echo '<script>';
      echo 'var images_' . $patientId . ' = ' . json_encode(getPatientImages($patientId)) . ';';
      echo 'var index_' . $patientId . ' = 0;';
      echo 'function cycleImages_' . $patientId . '() {';
      echo 'if (index_' . $patientId . ' < images_' . $patientId . '.length) {';
      echo 'document.getElementById("image-container-' . $patientId . '").innerHTML = "<img src=\'" + images_' . $patientId . '[index_' . $patientId . '] + "\' alt=\'Patient Image\'>";';
      echo 'index_' . $patientId . '++;';
      echo 'setTimeout(cycleImages_' . $patientId . ', 5000);';
      echo '}';
      echo '}';
      echo 'cycleImages_' . $patientId . '();';
      echo '</script>';

      echo '</div>';
    }
  } else {
    echo '<p>No patients found.</p>';
  }
  ?>
</div>

<?php include "footer.php";?>
