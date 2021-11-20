<?php
        include("db.php");
        include("functions.php"); 

        callsession();
        $showDate=$_SESSION['storeDate'];
        echo $showDate;

                if(!isset($_SESSION))
                { 
                    session_start(); 
                }
                //Getting username of logged in user
                $LecturerID = $_SESSION['username'];//Saving the username from the session into a variable
                if($LecturerID == null){//Redirect user to login page if they are not signed in
                    header('Location: login.php');
                }
                else {

        $query = mysqli_query($conn, "SELECT * FROM lecturer WHERE lecturerID = '1'");//Query to get all info related to logged in user and saving required info into variables
        while($row = mysqli_fetch_array($query)){
            $fn = $row['fname'];
            $ln = $row['lname'];
            $email = $row['email'];
            //$pw = $row['password_hash'];
            $dob = $row['dob'];
            $phone = $row['phone'];
            $department = $row['department'];
        }

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

    <title>Generate</title>
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


    <table border="1 px solid blue" text allign="center">
    <tr>

<?php


    include('phpqrcode/qrlib.php');


    // how to save PNG codes to server
    
    $tempDir = "qrcodes/";
    

    
    $codeContents = "https://cutt.ly/RahwyUni?link=".$showDate."";
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = '005_file_'.md5($codeContents).'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath =$tempDir.$fileName;

    echo "changes reflected";
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        echo 'File generated!';
        echo '<center>Server PNG File: '.$pngAbsoluteFilePath;
        echo '</center>';
      
    } else {

        echo '<center>Server PNG File: '.$pngAbsoluteFilePath;
        echo '</center>';
     
      
    }
    
 

    if($_SESSION['barcode']){


    displayQrImage();

    }
     
    else{

        echo "failed to capture session";
    }

     echo "</tr>";
     ?>

  </table>



