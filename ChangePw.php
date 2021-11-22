<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>




<?php
include 'db.php';
session_start();
$studentID = $_SESSION['username'];
    
if (isset($_POST['submit5'])) {
    
	$newPass = mysqli_real_escape_string($conn, $_POST['newPass']);
    
if($_POST['newPass']==$_POST['Cpass']){
    $Upadtepass= "UPDATE student SET password_hash='$newPass' WHERE studentID='$studentID' ";
    $changed= mysqli_query($conn,$Upadtepass);
    
    if($changed){
        echo '
        <div class="alert alert-success alert-dismissible" style= "margin-bottom:0px;">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Password was changed successfullt!</strong> You can login using your new password now.
</div>';


    }else{
        echo "error";
    }
}else{
    echo '
            <div class="alert alert-danger alert-dismissible" style= "margin-bottom:0px;>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Password and Confrim Password Do Not Match!</strong> Please check your entry again.
          </div>';
}

}


?>


<div class="login-wrap">
        <div class="login-html">
            <div class="login-form">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="group">
                        <div class="tasksInput">
        <label for="newPass" class="label">New Password</label>
        <input id="newPass" name="newPass" class="input" data-type="password"> </input>
        </div>
</div>
<div class="group">
                        <div class="tasksInput">
        <label for="Cpass" class="label">Confrim Password</label>
        <input id="Cpass" name="Cpass" class="input" data-type="password"> </input>
        </div>
</div>
<div class="group">
        <button id="submit5" name="submit5" class="button">Submit</button>
</div>     
<div class="hr" style="margin: 26px 0 33px 0;"></div>
						<div class="foot-lnk">
							<a href="login.php">To Login!</a>
						</div>         
    </form>
   
    

            </div>
        </div>
</div>








</body>
</html>