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
  }
}
?>
