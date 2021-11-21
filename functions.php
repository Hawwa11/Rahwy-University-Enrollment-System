<?php

session_start();


function displayQrImage(){
  
    $showDate = $_SESSION['date'];


  global $urlRelativeFilePath;
  echo '<b><center>Todays Date: '.$showDate.'<b></center>';
  echo '<center><img src="'.$urlRelativeFilePath.'" /></center>';

}

function logout(){
		//remove existing sessions
		session_start();
		session_destroy();

		// Direct user to Login page
		header("Location:Login.php");
}
?>