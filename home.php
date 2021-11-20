<?php
include("db.php");
$studentID = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM student WHERE studentID = '{$studentID}'");
 
if (mysqli_num_rows($query) > 0) {
  
  while($row = mysqli_fetch_assoc($query)) {
    if(mysqli_num_rows($query)!=0){
      $sID = $row['studentID'];
      $sFname = $row['fname'];
      $slName = $row['lname'];
      $pID = $row['programID'];
      $semester = $row['start_sem'];
      $sName = $sFname . " " . $slName;
    }
  }
} 
?>

<html>
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="form.css">
    
      </head>
      <body>
    
        <form class="signup-form" action="" method="">
    
            <h1>Welcome, <?php echo $sName ?> </h1>
         
    
          <!-- form body -->
          <div class="form-body">
              <h1>Welcome, <?php echo $sName ?> </h1>
    
    
            <div class="horizontal-group">
              <div class="form-group left">
                <label for="firstname" class="label-title">Student ID</label>
              </div>
              <div class="form-group right">
            
                <label for="lastname" class="label"><?php echo $sID ?></label>
    
              </div>
            </div>
    
            <div class="horizontal-group">
              <div class="form-group left">
                <label for="firstname" class="label-title">Program ID</label>
              </div>
              <div class="form-group right">
              
                <label for="lastname" class="label"><?php echo $pID ?></label>
                
              </div>
            </div>
    
            <div class="horizontal-group">
              <div class="form-group left">
                <label for="firstname" class="label-title">Semester</label>
              </div>
              <div class="form-group right">
                <label for="lastname" class="label"><?php echo $semester ?></label>
              </div>
            </div>
    
      
            <!-- Select subjects -->
            <div class="horizontal-group">
            <div class="form-group middle">
            <br>
            <label class="label-title">List of Subject Enrolled</label>
            </div>
            </div>
    
    
            <div class="horizontal-group">
            <div class="form-group container">
              <?php
            //   foreach($c_data as $key => $value){
            //     echo "<div class><label></div><br>";
            //   }
              ?>
            </div>
            </div>
      
    
    
            </div>
    
    
          <!-- form-footer -->
          <div class="form-footer">
          
          </div>
    
        </form>
    
      </body>
    </html>
    