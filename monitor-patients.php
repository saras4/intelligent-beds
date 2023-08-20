<?php include "intelligent-funtions.php";?>
<?php include "header.php";?>
  <div class="introduction">
    <div class="hello">
      <div class="big-font">Hello,</div>
      <div class="small-font">Current patients: <?php numberOfPatients()?></div> 
    </div>

    <div class="search">
      <form action="patient-condition.php" method="get" class="search-bar">
       <input type="number" placeholder="Monitor patient (AMKA)" name="patient_id">
       <button type="submit"><img src="images/search.png"></button>
      </form>
    </div>
  </div>
  <div class="button-monitor-patients">
    <a href="monitor-all-patients.php" class="button2">Monitor all</a>
  </div>
  <table>
    <tr>
      <thead>
        <th>First name</th>
        <th>Last name </th>
        <th>AMKA</th>
        <th>Action</th>
     </thead>
    </tr>
    <tbody> 
      <?php  patientTable();?> 
  </tbody>
  </table>
  
  <?php include "footer.php";?>