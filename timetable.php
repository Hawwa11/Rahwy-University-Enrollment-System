<?php
include("db.php");
$studentID = "I2123456";

$subject_list = createLTimetable($studentID,$conn);

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
                    url: 'loadCalendarEvents.php',
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
      <div class="form-group container">
        <?php
        foreach($subject_list as $key => $value){
          echo "<div class><label>".$key." ".$value ."</label></div><br>";
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
  function createLTimetable($studentID,$conn){//Function to create lecturer timetable database
    mysqli_query($conn, "DELETE FROM studenttimetable");
          //get enrolled class ID
          $query = mysqli_query($conn, "SELECT * FROM enrollment WHERE studentID = '{$studentID}'");
          if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
              if(mysqli_num_rows($query)!=0){
                $subjectID = $row['subject_list'];
               }
              }
            
              $cID = explode(",",$subjectID);
    
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
        $rawTime = explode("-",$cTime[$i], 2);
        print_r($cTime);

      for($count=0; $count<count($dates); $count++){
        $strstart = $dates[$count] . ' ' . $rawTime[0][0];//Saving start date and time in a variable
        $strend = $dates[$count] . ' ' . $rawTime[0][1];
        $start = date("y-m-d H:i:s", strtotime($strstart));
        $end = date("y-m-d H:i:s", strtotime($strend));

        echo $dates[$count] . "<br>";
        echo $cTime[$i] . "<br>";
        echo $rawTime[0][0] . "<br>";
        echo $rawTime[0][1] . "<br>";

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
 
}
  ?>