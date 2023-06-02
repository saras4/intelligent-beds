<?php
include "db.php";

if (isset($_GET['bed_id'])) {
  global $conn;
  $bed_id = $_GET['bed_id'];
  $sql = "DELETE FROM beds WHERE id = '$bed_id'";
  $result = $conn->query($sql);
  
  if ($result) {
    header("Location: beds.php");
    exit();
  }
}
?>
