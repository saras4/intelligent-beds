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
  if(!$conn){
    echo 'Connection error' . mysqli_connect_error();
  }
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

function readPatients(){
  global $conn;
  // write query
  $sql = 'SELECT patient_id,created_at,image_url,first_name,last_name FROM sensor_indications  JOIN patients ON patients.amka = sensor_indications.patient_id ORDER BY created_at DESC LIMIT 1';
	
  // make query and get the result
  $result = mysqli_query($conn, $sql);

  while ($record = mysqli_fetch_assoc($result))
    {
      // Output
      echo '<h2>'.'Indication generated at: '.$record['created_at'].'</h2>';
      echo '<h2>'."Patient's id(ΑΜΚΑ): ".$record['patient_id'].'</h2>';
      echo '<h2>'."Patient's name: ".$record['first_name']." ".$record['last_name'].'</h2>';
      echo '<img src="'.$record['image_url'].'" width="300">';
      

    }
  //Refresh
  header("refresh: 10");

  // free result from memory
  mysqli_free_result($result);

  // // close connection
  // mysqli_close($conn);
}


function search(){
  if (isset($_GET['search'])) {
      global $conn;
      $search = $_GET['search'];
      $query = "SELECT * FROM patients WHERE amka = '$search' ";
      $search_query = mysqli_query($conn, $query);
      if (!$search_query) {
        die('QUERY failed' . mysqli_error($conn));
      }      
      if($search_query->num_rows > 0){
        while($row = $search_query-> fetch_assoc()){
          echo '<tr><td>' . $row["first_name"] . "</td></tr>" . '<tr><td>' . $row["last_name"] . "</td></tr>" .'<tr><td>' . $row["amka"] . "</td></tr>";
        }
      }
      else {
        echo "No results";
      }
  }
  }
   


function patientCondition(){
if (isset($_GET['search'])) {
    global $conn;

    $picture = $_GET['search'];
    $query = 'SELECT * FROM sensor_indications WHERE patient_id = "$picture" ';
    $search_query = mysqli_query($conn, $query);
    if (!$search_query) {
        die('QUERY failed' . mysqli_error($conn));
    }
    while ($record = mysqli_fetch_assoc($search_query)) {
        // $record = mysqli_fetch_assoc($search_query);
        echo '<img src="'.$record['image_url'].'" width="300">';
    }
}
}
?>

