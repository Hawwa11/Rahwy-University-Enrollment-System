<?php
    include("db.php");//Includes the database file that makes the connection
    $classDate = mysqli_query($conn, "SELECT dates_list FROM class WHERE classID = '".$_POST["ClassId"]."'");
    $output='';
    while ($classDaterow = mysqli_fetch_array($classDate)){
        //$output .= '<option value="'.$classDaterow['dates_list'].'">'.$classDaterow['dates_list'].'</option>';
        $dates = explode(',', $classDaterow[0], 2);//Separating content of this array to read the 2 dates stored
        foreach($dates as $item){
            echo "<option value='$item'>$item</option>";//displaying each content of the new array in the dropdown list
        }
      }
      echo $output;
?>