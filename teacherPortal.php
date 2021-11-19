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

    <title>Teacher Portal</title>

    <style>
    /* Styles for the navbar */
    
    /* Styles for the bootstrap table */
        .table {
            width: 100%;
        }
        .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #98c1d9;
        }
    </style>
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
            <a class="navbar-brand" href="#">Rahwy</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="teacherPortal.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
                <li><a href="teacherProfile.php"><i class="fa fa-fw fa-user"></i>Profile</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>
            </ul>
            </div>
        </div>
    </nav>
    <?php
      include("db.php");//Includes the database file that makes the connection

      //fixes and error where session is ignored because an error has been already started
      if(!isset($_SESSION))//If statement to start a session if none was started
      { 
          session_start(); 
      }
      //Getting username of logged in user
      $LecturerID = $_SESSION['username'];//Saving the username from the session into a variable
      if($LecturerID == null){//Redirect user to login page if they are not signe in
        header('Location: login.php');
      }
      else {
        $query = mysqli_query($conn, "SELECT * FROM lecturer WHERE lecturerID = '{$LecturerID}'");//Query to get all info related to logged in user and saving required info into variables
        while($row = mysqli_fetch_array($query)){
            $name = $row['lname'];         
        }
    ?>
    <div class="container">
        <?php echo 'Welcome ' . $name; echo "</br></br>";?>
    <?php
      }
    ?>
    <div class="container">
           
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Class Name</th>
              <th>Class Statistics</th>
              <th>Barcode</th>
            </tr>
          </thead>
          <tbody>
            <?php
              //Displaying classes taught by the logged in teacher
              $query = mysqli_query($conn, "SELECT * FROM class WHERE lecturerID = '{$LecturerID}'");//Query to get all info related to logged in user and saving required info into variables
              //$className = $row['c_name'];
              $Row = mysqli_fetch_row($query);
              do{
                echo "<tr><td>{$Row[1]}</td>";
            ?>

            <form action= "edit.php?pn=<?php echo $Row[1]; ?>" method="POST" enctype="multipart/form-data">
              <td><input type="submit" value="View Statistics" /></td>
            </form>
            <form action= "del.php?pn=<?php echo $Row[1]; ?>" method="POST" enctype="multipart/form-data">
              <td><input type="submit" value="Generate Barcode" /></td>
            </form>
            </tr>
            
            <?php
                $Row = mysqli_fetch_row($query);
              }
              while($Row);
            ?>
            
          </tbody>
        </table>
    </div>
</body>
</html>