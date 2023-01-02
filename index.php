<?php include "db.php";?>
<?php include "intelligent-funtions.php";?>
<?php include "header.php";?>
  <div class="introduction">
    <div class="hello">
      <div class="big-font">Hello,</div>
      <div class="small-font">Current patients: <?php numberOfPatients()?></div> 
    </div>
    <div class="search">
      <form action="" class="search-bar">
        <input type="text" placeholder="search patient (AMKA)" name="q">
        <button type="submit"><img src="images/search.png"></button>
      </form>
  </div>
  </div>
  <table>
    <tr>
      <thead>
        <th>First name</th>
        <th>Last name </th>
        <th>Amka</th>
     </thead>
    </tr>
    <tbody> <?php  patientTable();?> </tbody>
  </table>
  <?php include "footer.php";?>