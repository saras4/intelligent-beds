<?php include "db.php";?>
<?php 

function numberOfPatients() {
  global $conn;
  $sql = 'SELECT COUNT(*) c FROM patients';
  
  // make query and get the result
  $result = mysqli_query($conn, $sql);
  $record = mysqli_fetch_assoc($result);
  echo $record['c'];

  // free result from memory
  mysqli_free_result($result);

  // close connection
  mysqli_close($conn);

}












?>