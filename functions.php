<?php

session_start();


function displayQrImage(){
  
    $showDate = $_SESSION['date'];


  global $urlRelativeFilePath;
  echo '<b><center>Todays Date: '.$showDate.'<b></center>';
  echo '<center><img src="'.$urlRelativeFilePath.'" /></center>';

}
?>