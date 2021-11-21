<?php 
include ("db.php");
include ("functions.php");

if (!empty($_GET)) {

$date=$_GET['link'];
$classID=$_GET['class'];


  //Check if user not logged in
 if (!isset($_SESSION['username'])) {
   header("Location: Login.php?link=".$date."&class=".$classID."");
 }else {  

    $studentID = $_SESSION['username'];

    $tablename = $classID . "_attendance";
    $insert = mysqli_query($conn,"INSERT INTO $tablename(ID,studentID,c_date) VALUES('NULL','$studentID','$date')");
     
    if($insert){
      echo "<script>alert('attendance captured successfully');window.location='login.php';</script>";
    }

    else{
      echo "query failed".mysqli_error($conn);
    }

    }
}


?>
<html>
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="tabs.css">
    
      </head>
      <body>
<nav>
    <ul>
    <img src="logo2.png" height="70%" class="img">
    <li><button class="tablink" onclick="openPage('Home', this)"id="defaultOpen">Home</button></li> 
    <li><button class="tablink" onclick="openPage('Enrollment', this)"id="defaultOpen2">Enrollment</button></li>
    <li><button class="tablink" onclick="openPage('Payment', this)"id="defaultOpen3">Payment</button></li>
    <li><button class="tablink" onclick="openPage('Timetable', this)"id="defaultOpen4">Timetable</button></li>
    <input type="submit" class="lbtn" name="logout" value="Logout">
    </ul>
    
</nav>

    

    <!-- Redirects to the page of the tab that is clicked  -->
    <div id="Home" class="tabcontent">
       <?php include("home.php"); ?> 
    </div>
    
    <div id="Enrollment" class="tabcontent">
    <?php include("enrollmentForm.php"); ?>
      
    </div>
    
    <div id="Payment" class="tabcontent">
      <?php include("payment.php"); ?>
    </div> 

    <div id="Timetable" class="tabcontent">
      <?php include("changePassword.php"); ?>
    </div> 


</body>

<script>
        function openPage(pageName,elmnt,color) {
          var i, tabcontent, tablinks;
          // Get the tabcontent
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          // Get tab links
          tablinks = document.getElementsByClassName("tablink");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.color = "";
          }
          //Get the tab page and style
          document.getElementById(pageName).style.display = "block";
          elmnt.style.color = color;
        }
        
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        // To open back the tabs in use instead of home
        <?php
          if (isset($_POST['cp'])) {
            ?>document.getElementById("defaultOpen3").click();<?php
          }
          else if (isset($_POST['update'])) {
            ?>document.getElementById("defaultOpen2").click();<?php
          }
        ?>

    </script>

</html>