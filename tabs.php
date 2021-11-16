<?php 
include ("db.php");

  session_start();
  //Check if user not logged in
//   if (!isset($_SESSION['username'])) 
//     header("Location: Login.php");
//   else {  
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: sans-serif;
}

.logo{
  background-color: #f2f2f2;
  width: 100%;
}

/* Style tab links */
.tablink {
  background-color: #505050;
  color: whitesmoke;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: black;
  display: none;
  padding: 100px 20px;
}

.logout {
  background-color: #4d4dff;
  color: white;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 12px;
  font-size: 17px;
  width: 125px;
}
.inner{
  margin-top: 10px;
  margin-left: 10px;
  display:inline-block;
  float:left;
}

.inner2{
  margin-top: 10px;
  margin-right: 10px;
  display:inline-block;
  float: right;
}
.outer{
  background-color: #f2f2f2;
}

.bn632-hover.bn27 {
  width: 100%;
  padding: 10px 13px;
  cursor: pointer;
  display: block;
  text-align: center;
  font-size: 1.0rem;
  background: linear-gradient(to right, #2a2966, #a84392);
  border: 0;
  outline: none;
  border-radius: 5px;
  color: white;
  cursor: pointer;
  transition: 0.3s;
}


.success {background-color: #04AA6D;} /* Green */
.info {background-color: #2196F3;} /* Blue */
.danger {background-color: #f44336;} /* Red */ 

#Home {background-color:#f2f2f2;}
#Profile {background-color:#f2f2f2;}
#ChangePassword {background-color:#f2f2f2}
</style>
</head>
<body>
  <!-- Row with buttons -->
     <div class="outer">

     <div class="inner2">
        <button type="button" onclick="window.location.href='logout.php'" class="bn632-hover bn27">Logout</button>
     </div>
    </div>

    <!-- Display the logo image -->
     <div id="logo" class="logo">
        <center><img src="RAHWYLogo.png" width="10%" height="10%"> </center>
     </div>

     <!-- Display buttons for tabs (uses script function to pass tabs properties) -->
    <button class="tablink" onclick="openPage('Home', this, '#1bba93')"id="defaultOpen2">Home</button> 
    <button class="tablink" onclick="openPage('Enrollment', this, '#1bba93')"id="defaultOpen">Enrollment</button>
    <button class="tablink" onclick="openPage('Payment', this, '#1bba93')"id="defaultOpen3">Payment</button>
    <button class="tablink" onclick="openPage('Timetable', this, '#1bba93')"id="defaultOpen4">Timetable</button>

    <!-- Redirects to the page of the tab that is clicked  -->
    <div id="Home" class="tabcontent">
      <!-- <?php include("enrollmentForm.php"); ?> -->
    </div>
    
    <div id="Enrollment" class="tabcontent">
    <?php include("enrollmentForm.php"); ?>
      
    </div>
    
    <div id="Payment" class="tabcontent">
      <?php include("changePassword.php"); ?>
    </div> 

    <div id="Timetable" class="tabcontent">
      <?php include("changePassword.php"); ?>
    </div> 


    <!-- JS function to determine the tab content and change tab link properties accordingly  -->
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
            tablinks[i].style.backgroundColor = "";
          }
          //Get the tab page and style
          document.getElementById(pageName).style.display = "block";
          elmnt.style.backgroundColor = color;
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
   
</body>
<?php 
    

?>