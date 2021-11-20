<?php

session_start();


function displayQrImage(){



    $showDate = date("Y.m.d");
    $_SESSION['storeDate'] = $showDate;


  global $urlRelativeFilePath;
  echo '<b><center>Todays Date: '.$showDate.'<b></center>';
echo '<center><img src="'.$urlRelativeFilePath.'" /></center>';

}




function callsession(){

  
  $showDate = date("Y.m.d");

  $_SESSION['storeDate'] = $showDate;



}



?>