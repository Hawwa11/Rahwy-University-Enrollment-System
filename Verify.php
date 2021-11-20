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
<label for="studentID">Student ID</label>
<input id="studentID" name="studentID"> </input>
<button id="submit3" name="submit3">Submit</button>
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label for="Verification">Verification Code</label>
<input id="Verification" name="Verification"> </input>
<button id="submit4" name="submit4">Submit</button>
</form>
<?php
include 'db.php';
if (isset($_POST['submit3'])) {
    session_start();
    $_SESSION["username"] = $_POST['studentID'];
	$StudentID = mysqli_real_escape_string($conn, $_POST['studentID']);
    $GettingEmail= "SELECT email FROM student WHERE studentID='$StudentID' ";
    $GetEmail= mysqli_query($conn,$GettingEmail);
    $Row = mysqli_fetch_row($GetEmail);   
    echo "Email was sent!";
    
    $VerificationCode = mt_rand(1111,9999);
    $subject = "Verification Code";
    $txt = "Your verification code is:" . $VerificationCode;
    mail($Row[0], $subject, $txt, 'From: rahwyco@gmail.com');//The email function
}
if (isset($_POST['submit4'])) {
    if($_POST['Verification']=="abc"){
        
        echo '
	<script>
	window.location.href="changePassword.php";
	</script>
  ';;
    }
}


?>

</body>
</html>