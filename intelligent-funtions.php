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
      echo '<tr><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["amka"] . '</td><td><a href="patient-condition.php?patient_id=' . $row["amka"] . '"><img src="icons/eye.png" alt="eye.png"></a></td></tr>';
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


// SAFE EYE CODE
//  echo '<tr><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["amka"] . '</td><td><img src="icons/eye.png" alt="eye.png"></td></tr>';


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
   


// function patientCondition(){
// if (isset($_GET['search'])) {
//     global $conn;

//     $picture = $_GET['search'];
//     $query = 'SELECT * FROM sensor_indications WHERE patient_id = "$picture" ';
//     $search_query = mysqli_query($conn, $query);
//     if (!$search_query) {
//         die('QUERY failed' . mysqli_error($conn));
//     }
//     while ($record = mysqli_fetch_assoc($search_query)) {
//         // $record = mysqli_fetch_assoc($search_query);
//         echo '<img src="'.$record['image_url'].'" width="300">';
//     }
// }
// }
function patientCondition(){
  if (isset($_GET['search'])) {
      global $conn;
      $picture = $_GET['search'];
      $query = 'SELECT * FROM sensor_indications WHERE patient_id = "$picture" ';
      $query = mysqli_query($conn, $query);
      if (!$query) {
          die('QUERY failed' . mysqli_error($conn));
      }
      while ($row = mysqli_fetch_assoc($query)) {
          $patient_image = $row['image_url'];
          echo $patient_image;
      }
  }
  }

function patientState(){
    if (isset($_GET['search'])) {
        global $conn;
        $picture = $_GET['search'];
        $query = 'SELECT image_url FROM sensor_indications WHERE patient_id = "$picture" ';
        $search_query = mysqli_query($conn, $query);
        $result = mysqli_query($conn, $query);
        $record = mysqli_fetch_assoc($result); 
        echo $record['image_url'];

        // free result from memory
        mysqli_free_result($result);
    }
    }
     

    // beds
    function addBed() {
      if (isset($_POST["submit"])) {
        global $conn;
        $clinic = mysqli_real_escape_string($conn, $_POST['clinic']);
        $floor = mysqli_real_escape_string($conn, $_POST['floor']);
        $room = mysqli_real_escape_string($conn, $_POST['room']);
        
        $query = "INSERT INTO beds (clinic, floor, room)";
        $query .= " VALUES ('$clinic', '$floor', '$room')";
    
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
          die('query failed');
        } else {
          // Redirect using JavaScript(getting error with header redirection)
          echo '<script>window.location.href = "beds.php";</script>';
          exit;
        }
      }
    }
    

// function fetchBed(){
//       global $conn;
//       $query = "SELECT id FROM beds";
//       $result = mysqli_query($conn,$query);
//       while($row = mysqli_fetch_assoc($result)){
//         $id = $row['id'];
//         echo "<option value='$id'>$id</option>";
//       }
//     }

function fetchBed(){
  global $conn;
  // Query to fetch only the beds that are unassigned
  $query = "SELECT id FROM beds WHERE id NOT IN (SELECT bed_id FROM patients)";
  $result = mysqli_query($conn, $query);
  
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    echo "<option value='$id'>$id</option>";
  }
}


function addPatient(){
      if(isset($_POST["submit"])){
        global $conn;
        $amka = mysqli_real_escape_string($conn,$_POST['amka']);
        $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
        $age = mysqli_real_escape_string($conn,$_POST['age']);
        $bed_id = mysqli_real_escape_string($conn,$_POST['bed_id']);
        $query = "INSERT INTO patients(amka, first_name, last_name, age, bed_id )";
        $query .= "VALUES ('$amka', '$first_name', '$last_name', '$age', '$bed_id')";
      
        $result = mysqli_query($conn,$query);
      
        if (!$result) {
          die('query failed');
        } else {
          // Redirect using JavaScript(getting error with header redirection)
          echo '<script>window.location.href = "patients.php";</script>';
          exit;
        }
      }
      
    }

    function cyclePatients()
    {
        if (isset($_GET['patient_id'])) {
            global $conn;
            $patient_id = $_GET['patient_id'];
            $sql = "SELECT * FROM sensor_indications WHERE patient_id = $patient_id";
            $result = $conn->query($sql);
    
            // Generate an HTML page that includes a JavaScript function to cycle through the images
            $page = '<html><head><title>Patient Images</title></head><body>';
            $page .= '<div id="image-container"></div>';
            $page .= '<div id="info-container"></div>';
            $page .= '<script>';
            $page .= 'var images = [';
            $first = true;
            while ($row = $result->fetch_assoc()) {
                if (!$first) {
                    $page .= ',';
                }
                $image_url = $row['image_url'];
                $page .= '"' . $image_url . '"';
                $first = false;
            }
            $page .= '];';
            $page .= 'var patientIds = [';
            $result->data_seek(0); // Reset the result set pointer to the beginning
            $first = true;
            while ($row = $result->fetch_assoc()) {
                if (!$first) {
                    $page .= ',';
                }
                $patient_id = $row['patient_id'];
                $page .= '"' . $patient_id . '"';
                $first = false;
            }
            $page .= '];';
            $page .= 'var dates = [';
            $result->data_seek(0); // Reset the result set pointer to the beginning
            $first = true;
            while ($row = $result->fetch_assoc()) {
                if (!$first) {
                    $page .= ',';
                }
                $created_at = $row['created_at'];
                $page .= '"' . $created_at . '"';
                $first = false;
            }
            $page .= '];';
            $page .= 'var index = 0;';
            $page .= 'function cycleImages() {';
            $page .= 'if (index < images.length) {';
            $page .= 'document.getElementById("image-container").innerHTML = "<img src=\'" + images[index] + "\' alt=\'Patient Image\'>";';
            $page .= 'document.getElementById("info-container").innerHTML = "<span class=\'image-info\'>Patient ID: " + patientIds[index] + "<br>Created At: " + dates[index] + "</span>";';
            $page .= 'index++;';
            $page .= 'setTimeout(cycleImages, 5000);';
            $page .= '}';
            $page .= '}';
            $page .= 'cycleImages();';
            $page .= '</script>';
            $page .= '</body></html>';
    
            // Close the database connection
            // $conn->close();
    
            // Output the HTML page
            echo $page;
        }
    }
    // Patient Information Table
    function retrieveFN()
    {
      if (isset($_GET['patient_id'])) {
        global $conn;
        $patient_id = $_GET['patient_id'];
        $sql = "SELECT first_name FROM patients WHERE amka = '$patient_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['first_name'];
        }
      }

      return "No data available";
    }


    function retrieveLN()
    {
      if (isset($_GET['patient_id'])) {
        global $conn;
        $patient_id = $_GET['patient_id'];
        $sql = "SELECT last_name FROM patients WHERE amka = '$patient_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['last_name'];
        }
      }

      return "No data available";
    }
    function retrieveAMKA()
    {
      if (isset($_GET['patient_id'])) {
        global $conn;
        $patient_id = $_GET['patient_id'];
        $sql = "SELECT amka FROM patients WHERE amka = '$patient_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['amka'];
        }
      }

      return "No data available";
    }

    function retrieveClinic()
    {
        if (isset($_GET['patient_id'])) {
            global $conn;
            $patient_id = $_GET['patient_id'];
            $sql = "SELECT b.clinic
                    FROM patients p
                    INNER JOIN beds b ON p.bed_id = b.id
                    WHERE p.amka = '$patient_id'";
            $result = $conn->query($sql);
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['clinic'];
            }
        }
    
        return "No data available";
    }


    function retrieveFloor()
    {
        if (isset($_GET['patient_id'])) {
            global $conn;
            $patient_id = $_GET['patient_id'];
            $sql = "SELECT b.floor
                    FROM patients p
                    INNER JOIN beds b ON p.bed_id = b.id
                    WHERE p.amka = '$patient_id'";
            $result = $conn->query($sql);
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['floor'];
            }
        }
    
        return "No data available";
    } 

    function retrieveRoom()
    {
        if (isset($_GET['patient_id'])) {
            global $conn;
            $patient_id = $_GET['patient_id'];
            $sql = "SELECT b.room
                    FROM patients p
                    INNER JOIN beds b ON p.bed_id = b.id
                    WHERE p.amka = '$patient_id'";
            $result = $conn->query($sql);
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['room'];
            }
        }
    
        return "No data available";
    }



    function retrieveBedid()
    {
        if (isset($_GET['patient_id'])) {
            global $conn;
            $patient_id = $_GET['patient_id'];
            $sql = "SELECT b.id
                    FROM patients p
                    INNER JOIN beds b ON p.bed_id = b.id
                    WHERE p.amka = '$patient_id'";
            $result = $conn->query($sql);
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['id'];
            }
        }
    
        return "No data available";
    }
    


    function deletePatient()
    {
      global $conn;
    
      if (isset($_GET['amka'])) {
        $amka = $_GET['amka'];
        $sql = "DELETE FROM patients WHERE amka = ?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $amka);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
          echo "Row deleted successfully.";
        } else {
          echo "Error deleting row.";
        }
    
        $stmt->close();
      }
    }
    

function patientTable2(){
  global $conn;
  if(!$conn){
    echo 'Connection error' . mysqli_connect_error();
  }
  //Query
  $sql = "SELECT * FROM patients";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<tr><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["amka"] . '</td><td>' . $row["bed_id"] . '</td><td><a href="delete.php?amka=' . $row["amka"] . '"><img src="icons/delete.png" alt="delete.png"></a></td></tr>';
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






function bedTable(){

      global $conn;
      if(!$conn){
        echo 'Connection error' . mysqli_connect_error();
      }
      //Query
      $sql = "SELECT * FROM beds";
      $result = mysqli_query($conn, $sql);
    
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<tr><td>' . $row["id"] . '</td><td>' . $row["clinic"] . '</td><td>' . $row["floor"] . '</td><td>' . $row["room"] . '</td><td><a href="deletebed.php?bed_id=' . $row["id"] . '"><img src="icons/delete.png" alt="delete.png"></a></td></tr>';
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
?>
