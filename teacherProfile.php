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
    ?>
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
        $query = mysqli_query($conn, "SELECT * FROM lecturer WHERE lecturerID = '1'");//Query to get all info related to logged in user and saving required info into variables
        if(mysqli_num_rows($query)!=0){
    ?>
    <div class="container">
        <table class="table table-striped">
            <tbody>
                <tr>                
                <th>First Name</th>
                <td><?php echo $fn; ?></td>
                </tr>
                <tr>
                <th>Last Name</th>
                <td><?php echo $ln; ?></td>
                </tr>
                <tr>
                <th>Email</th>
                <td><?php echo $email; ?></td>
                </tr>
                <tr>
                <th>Date of Birth</th>
                <td><?php echo $dob; ?></td>
                </tr>
                <tr>
                <th>Phone Number</th>
                <td><?php echo $phone; ?></td>
                </tr>
                <tr>
                <th>Department</th>
                <td><?php echo $department; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
        }
    ?>
</body>
</html>
