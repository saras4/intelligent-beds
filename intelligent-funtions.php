<?php include "db.php";?>

<style>
<?php include "styles/style.css";?>
</style>

<?php 

// START OF monitor-patients.php  FUNCTIONS


function numberOfPatients() {
  global $conn;
  $sql = 'SELECT COUNT(*) c FROM patients';
  
  // make query and get the result
  $result = mysqli_query($conn, $sql);
  $record = mysqli_fetch_assoc($result); 
  echo $record['c'];

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


// END OF monitor-patients.php  FUNCTIONS






// START OF newbed.php  FUNCTIONS
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
        echo '<script>window.location.href = "beds.php";</script>'; // Redirect using JavaScript(getting error with header redirection)
        exit;
      }
  }
}
// END OF newbed.php  FUNCTIONS
 


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


function addPatient() {
  if (isset($_POST["submit"])) {
    global $conn;
    $amka = mysqli_real_escape_string($conn, $_POST['amka']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $bed_id = mysqli_real_escape_string($conn, $_POST['bed_id']);

    // Check if the amka (primary key) already exists in the database
    $checkQuery = "SELECT * FROM patients WHERE amka = '$amka'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
      // Primary key already exists, display an error message
      echo "Error: The primary key (AMKA) is already taken.";
      return; // Exit the function without executing the insertion
    }

    $query = "INSERT INTO patients (amka, first_name, last_name, age, bed_id)";
    $query .= " VALUES ('$amka', '$first_name', '$last_name', '$age', '$bed_id')";

    $result = mysqli_query($conn, $query);

    if (!$result) {
      die('Query failed');
    } else {
      // Redirect using JavaScript (getting error with header redirection)
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

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT image_url, patient_id, created_at
                                FROM sensor_indications
                                WHERE patient_id = ?");
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $images = [];
        $patientIds = [];
        $dates = [];

        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image_url'];
            $patientIds[] = $row['patient_id'];
            $dates[] = $row['created_at'];
        }

        if (!empty($images)) {
            echo '<script>';
            echo 'var images = ' . json_encode($images) . ';';
            echo 'var patientIds = ' . json_encode($patientIds) . ';';
            echo 'var dates = ' . json_encode($dates) . ';';
            echo 'var index = 0;';
            echo 'function cycleImages() {';
            echo 'if (index < images.length) {';
            echo 'document.getElementById("image-container").innerHTML = "<img src=\'" + images[index] + "\' alt=\'Patient Image\'>";';
            echo 'document.getElementById("info-container").innerHTML = "<span class=\'image-info\'>Patient ID: " + patientIds[index] + "<br>Created At: " + dates[index] + "</span>";';
            echo 'index++;';
            echo 'setTimeout(cycleImages, 5000);';
            echo '}';
            echo '}';
            echo 'cycleImages();';
            echo '</script>';
        }
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
      echo '<tr>
              <td>' . $row["first_name"] . '</td>
              <td>' . $row["last_name"] . '</td>
              <td>' . $row["amka"] . '</td>
              <td>' . $row["age"] . '</td>
              <td>' . $row["bed_id"] . '</td>
              <td>
                <a href="delete.php?amka=' . $row["amka"] . '" class="icon-link">
                  <img src="icons/delete.png" alt="delete.png" class="icon">
                </a>
                <a href="update.php?amka=' . $row["amka"] . '" class="icon-link">
                  <img src="icons/edit.png" alt="edit.png" class="icon">
                </a>
              </td>
            </tr>';
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





// START OF beds.php  FUNCTIONS
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
          echo 
            '<tr>
              <td>' . $row["id"] . '</td>
              <td>' . $row["clinic"] . '</td>
              <td>' . $row["floor"] . '</td>
              <td>' . $row["room"] . '</td>
              <td>
                <a href="deletebed.php?bed_id=' . $row["id"] . '" class="icon-link">
                <img src="icons/delete.png"   alt="delete.png" class="icon"></a>
                <a href="updatebed.php?bed_id=' . $row["id"] . '" class="icon-link">
                <img src="icons/edit.png" alt="edit.png" class="icon">
              </a>
              </td>
            </tr>';
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
// END OF beds.php  FUNCTIONS


        
        
        
        
        
    
function updatePatient()
{
  global $conn;

  if(isset($_POST["submit"])){
    $amka = mysqli_real_escape_string($conn,$_POST['amka']);
    $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
    $age = mysqli_real_escape_string($conn,$_POST['age']);
    $bed_id = mysqli_real_escape_string($conn,$_POST['bed_id']);
    $query = "UPDATE patients SET ";
    $query .= "first_name = '$first_name', ";
    $query .= "last_name = '$last_name', ";
    $query .= "age = '$age', ";
    $query .= "bed_id = '$bed_id' ";
    $query .= "WHERE amka = '$amka'";
    $result = mysqli_query($conn,$query);
  
    if (!$result) {
      die('Query failed: ' . mysqli_error($conn));
    } 
    else {
      // Redirect using JavaScript(getting error with header redirection)
      echo '<script>window.location.href = "patients.php";</script>';
      exit;
    }
  }
}


function fnUpdate(){
  global $conn;
  //pull data from database
  if(isset($_GET['amka'])) {
 
    $amka = $_GET['amka'];
    $sql = "SELECT * FROM patients WHERE amka = $amka" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      echo $fn = $row['first_name'];
    }
  }
}

function lnUpdate(){
  global $conn;
  //pull data from database
  if(isset($_GET['amka'])) {
 
    $amka = $_GET['amka'];
    $sql = "SELECT * FROM patients WHERE amka = $amka" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      echo $ln = $row['last_name'];
    }
  }
}

function ageUpdate() {
  global $conn;
  //pull data from database
  if(isset($_GET['amka'])) {
 
    $amka = $_GET['amka'];
    $sql = "SELECT * FROM patients WHERE amka = $amka" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      echo $age = $row['age'];
    }
  }
}

function fetchBed2(){

global $conn;
if(isset($_GET['amka'])) {

    $amka = $_GET['amka'];
    $sql = "SELECT * FROM patients WHERE amka = $amka" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
       $currentBedId = $row['bed_id'];
    }
}
  // Query to fetch the beds that are unassigned and the current bed_id (if provided)
  $query = "SELECT id FROM beds WHERE id NOT IN (SELECT bed_id FROM patients)";
  if ($currentBedId !== null) {
    $query .= " OR id = '$currentBedId'";
  }
  $result = mysqli_query($conn, $query);
  
  while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    $selected = ($id == $currentBedId) ? 'selected' : ''; // Set 'selected' attribute for the current bed_id
    echo "<option value='$id' $selected>$id</option>";
  }
}

function updateBed()
{
  global $conn;

  if(isset($_POST["submit"])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $clinic = mysqli_real_escape_string($conn,$_POST['clinic']);
    $floor = mysqli_real_escape_string($conn,$_POST['floor']);
    $room = mysqli_real_escape_string($conn,$_POST['room']);
    $query = "UPDATE beds SET ";
    $query .= "clinic = '$clinic', ";
    $query .= "floor = '$floor', ";
    $query .= "room = '$room' ";
    $query .= "WHERE id = '$id'";
    $result = mysqli_query($conn,$query);
  
    if (!$result) {
      die('Query failed: ' . mysqli_error($conn));
    } 
    else {
      // Redirect using JavaScript(getting error with header redirection)
      echo '<script>window.location.href = "beds.php";</script>';
      exit;
    }
  }
}

function clinicUpdate(){
  global $conn;
  //pull data from database
  if(isset($_GET['bed_id'])) {
 
    $bed_id = $_GET['bed_id'];
    $sql = "SELECT * FROM beds WHERE id = $bed_id" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      echo $clinic = $row['clinic'];
    }
  }
}

function floorUpdate(){
  global $conn;
  //pull data from database
  if(isset($_GET['bed_id'])) {
 
    $bed_id = $_GET['bed_id'];
    $sql = "SELECT * FROM beds WHERE id = $bed_id" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      echo $floor = $row['floor'];
    }
  }
}

function roomUpdate(){
  global $conn;
  //pull data from database
  if(isset($_GET['bed_id'])) {
 
    $bed_id = $_GET['bed_id'];
    $sql = "SELECT * FROM beds WHERE id = $bed_id" ;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      echo $room = $row['room'];
    }
  }
}




//TEST

// Function to retrieve all patients from the database
function getAllPatients()
{
    global $conn;

    $sql = "SELECT * FROM patients";
    $result = mysqli_query($conn, $sql);

    $patients = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $patients[] = $row;
        }
    }

    mysqli_free_result($result);

    return $patients;
}

// Function to retrieve image URLs for a specific patient
function getPatientImages($patientId)
{
    global $conn;

    $sql = "SELECT image_url FROM sensor_indications WHERE patient_id = '$patientId'";
    $result = mysqli_query($conn, $sql);

    $images = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $images[] = $row['image_url'];
        }
    }

    mysqli_free_result($result);

    return $images;
}
?>
