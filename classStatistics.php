<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--Implementing icon's library for navbar-->
    <!--Libraries for bootstrap table-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Class Statistics</title>
</head>
<body>
    <nav class="navbar navbar-inverse" style="background-color: #3d5a80;">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="teacherPortal.php">Rahwy</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="teacherPortal.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
                <li><a href="teacherProfile.php"><i class="fa fa-fw fa-user"></i>Profile</a></li>
                <li class="active"><a href="#"><i class="fa fa-fw fa-line-chart"></i> Class Statistics</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>
            </ul>
            </div>
        </div>
    </nav>
    <?php
    if(!isset($_SESSION))//If statement to start a session if none was started
    { 
        session_start(); 
    }
    if (!isset($_SESSION['username'])){ //directs user to login page if they are not signed in
      header("Location: login.php");
    }
    //Saving values from session into a variable
    $LecturerID = $_SESSION['username'];
    $ClassID = $_SESSION['statClassID'];
    $ClassDate = $_SESSION['statClassDate'];

    $tablename = $ClassID . "_attendance";
    $studentAttendance;
    echo "Class ID: " . $ClassID . " Class Date: " . $ClassDate;
    ?>

    <!--Generating attendance list-->
    <form action="" method="POST">
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Attendance</th>
                        <th scope="col">Current Attendance Rate</th>
                    </tr>
                </thead>                       
                <?php
                include("db.php");//Includes the database file that makes the connection
                $classID = mysqli_query($conn, "SELECT studentID, student_name FROM enrollment WHERE subject_list LIKE '%{$ClassID}%'");
                if (mysqli_num_rows($classID) != 0){
                    while($row = mysqli_fetch_array($classID)){
                                
                echo '<tbody>
                    <tr>
                        <td>'.$row['studentID'].'</td> 
                        <td>'.$row['student_name'].'</td>';
                        //Displaying if student is absent or present                        
                        $attendanceQuery = "SELECT studentID FROM $tablename WHERE c_date = '{$ClassDate}' AND studentID = '{$row['studentID']}'";
                        $attendanceResult=mysqli_query($conn, $attendanceQuery);
                        //echo $row['studentID'] . "</br>";
                        if ($attendanceResult->num_rows>0){
                            $studentAttendance = 'P';
                        }
                        else {
                            $studentAttendance = 'A';
                        }
                        echo '<td>'.$studentAttendance.'</td> 
                        <td> </td> 
                    </tr>';
                    }
                }                       
                        
            echo '</table>
        </div>
    </form>';

    ?>
</body>
</html>