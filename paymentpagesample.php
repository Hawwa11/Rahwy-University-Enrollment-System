<?php

session_start();
$studentID = $_SESSION['studentID'];
$student_name = $_SESSION['student_name'];
$subject_list = $_SESSION['subject_list'];
$sem = $_SESSION['sem'];

echo $studentID . "\n";
echo $student_name . "\n";
echo $subject_list . "\n";
echo $sem . "\n";


?>