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
        echo "Welcome back Mr/Ms: "
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
            <tr>
              <td>Class 1</td>
              <td><button type="button" class="btn btn-primary">View Statistics</button></td>
              <td><button type="button" class="btn btn-info">Generate Barcode</button></td>
            </tr>
            <tr>
              <td>Class 2</td>
              <td><button type="button" class="btn btn-primary">View Statistics</button></td>
              <td><button type="button" class="btn btn-info">Generate Barcode</button></td>
            </tr>
          </tbody>
        </table>
    </div>
</body>
</html>