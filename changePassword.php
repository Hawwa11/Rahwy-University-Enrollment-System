<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <label for="newPass">New Password</label>
        <input id="newPass" name="newPass"> </input>
        <button id="submit5" name="submit5">Submit</button>
    </form>
<?php
include 'db.php';
session_start();
$studentID = $_SESSION['username'];
    echo $studentID;
if (isset($_POST['submit5'])) {
    
	$newPass = mysqli_real_escape_string($conn, $_POST['newPass']);
    $Upadtepass= "UPDATE student SET password_hash='$newPass' WHERE studentID='$studentID' ";
    $changed= mysqli_query($conn,$Upadtepass);
    
    if($changed){
        echo "Succesfully changed password";
    }else{
        echo "error";
    }

}


?>
</body>
</html>