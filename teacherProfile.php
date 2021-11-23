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

    <title>Profile</title>
</head>
<body>
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
                $id = $row['lecturerID'];
                $name = $row['lname'];
                $email = $row['email'];
                $phone = $row['phone'];
                $department = $row['department'];
            }
        }
        
        //To update the Teacher's phone number
        if(isset($_POST['update'])){
            $phone = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    
            $update = mysqli_query($conn, "UPDATE lecturer  SET phone='$phone' WHERE lecturerID  = '{$id}'");
                if($update){
                    echo '<script>alert("Record Successfully edited")</script>';               
                } 
                else {
                    echo 'Failed to edit record because '.mysqli_error($conn);
                }     
        }
        
    ?>
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
                <li class="active"><a href="teacherProfile.php"><i class="fa fa-fw fa-user"></i>Profile</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php"><i class="fa fa-fw fa-sign-out"></i>Logout</a></li>
            </ul>
            </div>
        </div>
    </nav>
    
    <?php
        $query = mysqli_query($conn, "SELECT * FROM lecturer WHERE lecturerID = '{$LecturerID}'");//Query to get all info related to logged in user and saving required info into variables
        if(mysqli_num_rows($query)!=0){
    ?>
    <form action="" method="POST">
        <div class="container">
            <table class="table table-striped">
                <tbody>
                    <tr>                
                    <th>ID</th>
                    <td><?php echo $id; ?></td>
                    </tr>
                    <tr>                
                    <th>Name</th>
                    <td><?php echo $name; ?></td>
                    </tr>                
                    <tr>
                    <th>Email</th>
                    <td><?php echo $email; ?></td>
                    </tr>                
                    <tr>
                    <th>Phone Number</th>
                    <td>
                        <input id="phoneNumber" name="phoneNumber" placeholder="" value="<?php echo $phone; ?>" required></input>
                        <input type="submit" name="update" value="Update">
                    </td>
                    </tr>
                    <tr>
                    <th>Department</th>
                    <td><?php echo $department; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
        }
    ?>
</body>
</html>
