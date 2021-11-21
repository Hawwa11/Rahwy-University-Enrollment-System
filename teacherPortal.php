<?php
  function getClassesID($LecturerID){//Function to get the classes that are taught by the logged in Lecturer
    include("db.php");//Includes the database file that makes the connection
    $classID = mysqli_query($conn, "SELECT classID  FROM class WHERE lecturerID = '{$LecturerID}'");
    $output='';
    while ($classIDrow = mysqli_fetch_array($classID)){
      $output .= '<option value="'.$classIDrow['classID'].'">'.$classIDrow['classID'].'</option>';//Displaying the query result in the dropdown list
    }
    return $output;
  }
?>

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
    <script src="jquery.js"></script>
    

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
                <li><a href="logout.php"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>
            </ul>
            </div>
        </div>
    </nav>
    <?php
      include("db.php");//Includes the database file that makes the connection
      include ("functions.php");
  


      $barcodestatus=0;
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
      
    if(isset($_POST["btn2"])){
      $classID = $_POST["classID"];
      $showDate = $_POST['classDate'];
      echo $classID."<br> " . $showDate;

      $barcodestatus=1;
      $_SESSION['barcode']=$barcodestatus;
      $_SESSION['classID']=$classID;
      $_SESSION['date']=$showDate;
        
        if(isset($_SESSION['barcode'])){
        
            header("Location:index.php");
        }
        
        else{
            header("Location:teacherPortal.php");
        }
        
        }
    }
    ?>

    <form action="teacherPortal.php" method="POST">
      <div class="container"> 
      <center><th colspan="2" class="text-center"><h3>Your Classes</h3></th></center>
      <td>&nbsp;</td>
        <table class="table table-hover">
          <tbody>               
              <th>Class ID:</th>
              <td>
              <select name ="classID" id="classID">
                <option value="">Select Class ID</option>
                <?php echo getClassesID($LecturerID); ?>
              </select>
              </td>
            </tr>
            <tr>                
              <th>Class Date:</th>
              <td>
              <select id="classDate" name="classDate">
                <option value="">Select Class Date</option>
              </select>
              </td>
            </tr>
            <tr>                
              <th>Class Statistics:</th>
              <td>
              <input type="button" name="btn1" value="View Statistics" /><!--Doesn't function yet-->
            </tr>
            <tr>                
              <th>Barcode</th>
              <td>
              <input type="submit" name="btn2" value="Generate barcode" /><!--Doesn't function yet-->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>


    
         
    </div>
</body>
</html>


<script>//JQuery to fetch calss time from database
  $(document).ready(function(){
    $('#classID').change(function(){
      var class_id = $(this).val();
      $.ajax({
        url:"fetch_date.php",
        method:"POST",
        data:{ClassId:class_id},
        dataType:"text",
        success:function(data){
          $('#classDate').html(data);
        }
      });
    });
  });
</script>

