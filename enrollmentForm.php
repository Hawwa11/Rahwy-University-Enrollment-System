<?php
include("db.php");
$c_data = array();
$query = mysqli_query($conn, "SELECT * FROM classes");
 
if (mysqli_num_rows($query) > 0) {
  
  while($row = mysqli_fetch_assoc($query)) {

    $c_data += array($row["classID"] => $row["c_name"]);
    
  }
} 

$query = mysqli_query($conn, "SELECT * FROM student WHERE studentID");
 
if (mysqli_num_rows($query) > 0) {
  
  while($row = mysqli_fetch_assoc($query)) {

  
    
  }
} 
?>



<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="form.css">
  </head>
  <body>
    <form class="signup-form" action="enrollment.php" method="post">

      <!-- form header -->
      <div class="form-header">
        <h1>Enrollment Form</h1>
      </div>

      <!-- form body -->
      <div class="form-body">

        <!-- Firstname and Lastname -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Student name</label>
          </div>
          <div class="form-group right">
            <label for="lastname" class="label">nameee</label>

          </div>
        </div>

        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Student ID</label>
          </div>
          <div class="form-group right">
        
            <label for="lastname" class="label">ID</label>

          </div>
        </div>

        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Study Year</label>
          </div>
          <div class="form-group right">
          
            <label for="lastname" class="label">year</label>
            
          </div>
        </div>

        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">Semester</label>
          </div>
          <div class="form-group right">
            <label for="lastname" class="label">sem</label>
          </div>
        </div>

  
        <!-- Select subjects -->
        <div class="horizontal-group">
        <div class="form-group middle">
        <br>
        <label class="label-title">Select Subjects to Enroll</label>
        </div>
        </div>


        <div class="horizontal-group">
        <div class="form-group container">
          <?php
          foreach($c_data as $key => $value){
            echo "<div class><label><input type=checkbox value=" . $key . ">" . $value . "</label></div><br>";
          }
          ?>
        </div>
        </div>
  


        </div>


      <!-- form-footer -->
      <div class="form-footer">
        <button type="submit" class="btn">Enroll</button>
      </div>

    </form>

  </body>
</html>
