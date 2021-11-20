<?php 
include ("db.php");

  session_start();
  //Check if user not logged in
//   if (!isset($_SESSION['username'])) 
//     header("Location: Login.php");
//   else {  
?>
<html>
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="tabs.css">
    
      </head>
      <body>
<nav>
     <ul>
     <li><button class="tablink" onclick="openPage('Home', this)"id="defaultOpen2">Home</button></li> 
    <li><button class="tablink" onclick="openPage('Enrollment', this)"id="defaultOpen">Enrollment</button></li>
    <li><button class="tablink" onclick="openPage('Payment', this)"id="defaultOpen3">Payment</button></li>
    <li><button class="tablink" onclick="openPage('Timetable', this)"id="defaultOpen4">Timetable</button></li>
     </ul>
</nav>

    

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
// $(document).ready(function(){
// 	   $(window).bind('scroll', function() {
// 	   var navHeight = $( window ).height() - 70;
// 			 if ($(window).scrollTop() > navHeight) {
// 				 $('nav').addClass('fixed');
// 			 }
// 			 else {
// 				 $('nav').removeClass('fixed');
// 			 }
// 		});
// 	});
    </script>

</html>