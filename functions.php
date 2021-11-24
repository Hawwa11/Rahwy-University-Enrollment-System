<?php

session_start();


function displayQrImage(){
  
    $showDate = $_SESSION['date'];


  global $urlRelativeFilePath;
  echo '<b><center>Class Date: '.$showDate.'<b></center>';
  echo '<center><img src="'.$urlRelativeFilePath.'" /></center>';

}
?>