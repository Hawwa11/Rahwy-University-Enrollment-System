<?php
    include("db.php");//Includes the database file that makes the connection
    $timetable = mysqli_query($conn, "SELECT class, start_event, end_event FROM lecturertimetable");//Loading events for the calendar
    $myArray = array();
    if ($timetable->num_rows > 0) {
        // To output the data of each row
        while($row = $timetable->fetch_assoc()) {
            $myArray[] = $row;
        }
    } 
    echo json_encode($myArray);
?>