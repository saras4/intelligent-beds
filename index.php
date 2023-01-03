<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>
<?php include "header.php";?>
  <div class="introduction">
    <div class="hello">
      <div class="big-font">Hello,</div>
      <div class="small-font">Current patients: <?php numberOfPatients()?></div> 
    </div>
    <div class="search">
      <form action="patient-status.php" method = "get" class="search-bar">
        <input type="number" placeholder="search patient (AMKA)" name="search" >
        <button type="submit"><img src="images/search.png"></button>
      </form>
  </div>
  </div>
  <table>
    <tr>
      <thead>
        <th>First name</th>
        <th>Last name </th>
        <th>AMKA</th>
     </thead>
    </tr>
    <tbody> <?php  patientTable();?> </tbody>
  </table>
  <?php include "footer.php";?>