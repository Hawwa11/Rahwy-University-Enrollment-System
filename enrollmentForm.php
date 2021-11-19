<?php
include("db.php");
session_start();

$c_data = array();
$query = mysqli_query($conn, "SELECT * FROM class");
 
if (mysqli_num_rows($query) > 0) {
  
  while($row = mysqli_fetch_assoc($query)) {

    $c_data += array($row["classID"] => $row["c_name"]);
    
  }
} 

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


//add class records
// $query = mysqli_query($conn, "SELECT * FROM enrollment WHERE studentID = '{$studentID}'");
 
// $row = mysqli_fetch_array($query);
// if($row == 0){
  if(isset($_POST['submit'])){
    echo "hallooooooooooooo";
  $_SESSION['studentID'] = $sID;
  $_SESSION['student_name'] = $sName;
  $_SESSION['subject_list'] =  $_POST['subs'];
  $_SESSION['sem'] = $semester;

  header("Location: paymentpagesample.php");

  }else{
    ?>

    <html>
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="form.css">
    
      </head>
      <body>
    
        <form class="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    
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
                <label for="lastname" class="label"><?php echo $sName ?></label>
    
              </div>
            </div>
    
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
            <label class="label-title">Select Subjects to Enroll</label>
            </div>
            </div>
    
    
            <div class="horizontal-group">
            <div class="form-group container">
              <?php
              foreach($c_data as $key => $value){
                echo "<div class><label><input type=checkbox name=subs[] id=subs value=" . $key . ">" . $value . "</label></div><br>";
              }
              ?>
            </div>
            </div>
      
    
    
            </div>
    
    
          <!-- form-footer -->
          <div class="form-footer">
          <input type="submit" class="btn" name="submit" value="Submit">
          </div>
    
        </form>
    
      </body>
    </html>
    
    <?php
  }
// }else{

  ?>

  <!-- <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="form.css">
  </head>
  <body>
      form body 
      <div class="form-body">
        
        <div class="horizontal-group">
        <div class="form-group container">
        <label class="label-title">Student already enrolled</label>
        </div>
        </div>
  


        </div>


  </body>
</html> -->
  
<?php

// }

?>

