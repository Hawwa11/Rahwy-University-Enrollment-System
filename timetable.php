<?php
include("db.php");
$studentID = $_SESSION['username'];

$cID = getClassID($studentID,$conn);
$subject_list = createLTimetable($studentID,$conn,$cID);
$lecturerID = getLecturerID($studentID,$conn,$cID);

?>

<html lang="en">
<head>
<link rel="stylesheet" href="form.css">
    <!--Libraries for Calendar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#calendar').fullCalendar({
                editable:false,//Prevents user from moving around events
                header:{
                left:'prev, next today',
                center:'title',
                right:'month, agendaWeek, agendaDay'
                },
                //events: 'loadCalendarEvents.php'
                events: function(start, end, timezone, callback){
                  $.ajax({
                    url: 'loadEventsStudent.php',
                    dataType: 'json',
                    data: {
                    },
                    success: function(data){
                      var events = [];
                  
                      for (var i=0; i<data.length; i++){
                        events.push({
                          title: data[i]['class'],
                          start: data[i]['start_event'],
                          end: data[i]['end_event'],
                        });
                      }
                      //adding the callback
                      callback(events);
                    }
                  });
                }
            });
            $("#defaultOpen4").on("click", function() {
              $( ".fc-today-button" ).trigger( "click" );
            });
        });
    </script>
     <body>


     <form class="signup-form" action="" method="">
    
           
         
    
    <!-- form body -->
    <div class="form-body">


      <div class="horizontal-group">
        <div class="form-group left">
          <label class="label-title">Class ID</label>
          <label class="label-title">Class Name</label>
        </div>
        <div class="form-group right">
            <label class="label-title">Lecturer Name</label>
        </div>
      </div>


      <div class="horizontal-group">
        <div class="form-group left">
              <?php
              foreach($subject_list as $key => $value){
                  echo "<div class><label>".$key." ".$value ."</label></div><br>";
                }
                ?>
        </div>
        <div class="form-group right">
            <?php
            for($l=0; $l<count($lecturerID); $l++){
                echo "<div class><label>".$lecturerID[$l]."</label></div><br>";
            }
            ?>
        </div>
      </div>



      </div>


    <!-- form-footer -->
    <div class="form-footer2"></div>
  
  </form>
  <div class="container">
        <div id="calendar"></div>
    </div>
 
    </body>
</html>

<?php

  function getClassID($studentID,$conn){//get enrolled class ID
    $query = mysqli_query($conn, "SELECT * FROM enrollment WHERE studentID = '{$studentID}'");
    if (mysqli_num_rows($query) > 0) {
      while($row = mysqli_fetch_assoc($query)) {
        if(mysqli_num_rows($query)!=0){
          $subjectID = $row['subject_list'];
         }
        }
      
        $cID = explode(",",$subjectID);
        return $cID;
  }
}


  function createLTimetable($studentID,$conn,$cID){//Function to create student timetable database
    mysqli_query($conn, "DELETE FROM studenttimetable");
    
            //loop to get class names for enrolled class ID
             foreach($cID as $class){
               $query = mysqli_query($conn, "SELECT * FROM class WHERE classID = '".$class."'");
               while($row = mysqli_fetch_assoc($query)) {
                 if(mysqli_num_rows($query)!=0){
                   $cName[] = $row['c_name'];
                   $cDates[] = $row['dates_list'];
                   $cTime[] = $row['c_time'];
                   $lecturerID[] = $row['lecturerID'];
                   }
                  } 
                }
             
                //combine class name and ID
                $list = array_combine($cID, $cName);
             

    for ($i=0; $i<count($cID); $i++){//Creating new arrays to save info that will be saved in the database

        $dates = explode(",",$cDates[$i], 10);

         //separating start and end time
      $query = mysqli_query($conn, "SELECT c_time FROM class WHERE classID='{$cID[$i]}'");
      $timeArray = array();        
      while($classTimerow = mysqli_fetch_assoc($query)){
        $timeArray[] = $classTimerow['c_time'];
      }
      //exploding
      for ($k=0; $k< count($timeArray); $k++){
        $rawTime[] = explode('-', $timeArray[0], 2);
      }

      for($count=0; $count<count($dates); $count++){
        $strstart = $dates[$count] . ' ' . $rawTime[0][0];//Saving start date and time in a variable
        $strend = $dates[$count] . ' ' . $rawTime[0][1];
        $start = date("y-m-d H:i:s", strtotime($strstart));
        $end = date("y-m-d H:i:s", strtotime($strend));


        //Query to insert info into database
        mysqli_query($conn, "INSERT INTO studenttimetable (class, start_event, end_event)
        VALUES
        (
          '{$cID[$i]}',
          '{$start}',
          '{$end}'
          )"
        );
      }
      $rawTime=array();
    }
    
    return $list;
}
 

function getLecturerID($studentID,$conn,$cID){//Function to create lecturer timetable database

            //loop to get lecturer ID
             foreach($cID as $class){
               $query = mysqli_query($conn, "SELECT * FROM class WHERE classID = '".$class."'");
               while($row = mysqli_fetch_assoc($query)) {
                 if(mysqli_num_rows($query)!=0){
                   $lecturerID[] = $row['lecturerID'];
                   }
                  } 
                }
            //loop to get lecturer name
            foreach($lecturerID as $l){
                $query = mysqli_query($conn, "SELECT * FROM lecturer WHERE lecturerID = '".$l."'");
                while($row = mysqli_fetch_assoc($query)) {
                  if(mysqli_num_rows($query)!=0){
                    $lname[] = $row['lname'];
                    }
                   } 
                 }
             
    
    return  $lname;
}
 

  ?>