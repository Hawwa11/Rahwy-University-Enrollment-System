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

//get enrolled subjects
$subject_list = getEnrolledClassList($conn, $studentID);


?>

<html>
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="form.css">
    
      </head>
      <body>
    
        <form class="signup-form" action="" method="">
    
           
         
    
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
              if($subject_list != null){
              foreach($subject_list as $key => $value){
                echo "<div class><label>".$key." ".$value ."</label></div><br>";
              }
            }
            echo "<div class><label>**Not In Enrolled In Any Subjects Yet.</label></div><br>";
              ?>
            </div>
            </div>
      
    
    
            </div>
    
    
          <!-- form-footer -->
          <div class="form-footer2">
          
          </div>
    
        </form>
    
      </body>
    </html>
  
    <?php

    function getEnrolledClassList($conn , $studentID) {
      //get enrolled class ID
      $query = mysqli_query($conn, "SELECT * FROM enrollment WHERE studentID = '{$studentID}'");
      if (mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
          if(mysqli_num_rows($query)!=0){
            $subjectID = $row['subject_list'];
           }
          }
          $cID = explode(",",$subjectID);
        

        //loop to get class names for enrolled class ID
         foreach($cID as $class){
           $query = mysqli_query($conn, "SELECT c_name FROM class WHERE classID = '".$class."'");
           while($row = mysqli_fetch_assoc($query)) {
             if(mysqli_num_rows($query)!=0){
               $cName[] = $row['c_name'];
               }
              }
            }
            
            //combine class name and ID
            $list = array_combine($cID, $cName);
          }else{
            $list = "";
          }
            return $list;
          }
    
  
    
    ?>