<?php
include "db.php";
if (isset($_GET['amka'])) {
    global $conn;
    $amka = $_GET['amka'];

    $sql = "DELETE FROM patients WHERE amka = '$amka'";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: patients.php");
        exit();
    } else {
        echo "<script>
                alert('You cannot delete this patient as he/she is being monitored at the moment');
                window.location.href = 'patients.php';
              </script>";
        exit();
    }
}
?>
