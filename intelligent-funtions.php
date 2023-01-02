<?php include "db.php";?>

<style>
<?php include "styles/style.css";?>
</style>
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

  // // close connection
  // mysqli_close($conn);

}

function patientTable(){
  global $conn;

  //Query
  $sql = "SELECT * FROM patients";
  $result = mysqli_query($conn, $sql);

  if($result->num_rows > 0){
    while($row = $result-> fetch_assoc()){
      echo '<tr><td>' . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["amka"] . "</td><tr>";
    }
  }
  else {
    echo "No results";
  }
  
  // free result from memory
  mysqli_free_result($result);

  // close connection
  mysqli_close($conn);

}
//Getting the value form search bar
function amkaPost(){
  if(isset($_POST['amka']))
   echo $_POST['amka']; 
}

?>