<?php
include("db.php");
$studentID = "I2123456";

$query = mysqli_query($conn, "SELECT * FROM enrollment WHERE studentID = '{$studentID}'");
if (mysqli_num_rows($query) > 0) {
  while($row = mysqli_fetch_assoc($query)) {
    if(mysqli_num_rows($query)!=0){
      $subjectID = $row['subject_list'];
     }
    }
  
    $cID = explode(",",$subjectID);
    print_r($cID);
}
// $subject_list = createLTimetable($studentID,$conn);
// print_r($subject_list);
?>