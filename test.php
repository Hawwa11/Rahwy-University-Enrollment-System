<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        });
    </script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div id="calendar"></div>
    </div>
</body>
</html>