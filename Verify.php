<!DOCTYPE html>
<html lang="en">
<?php
    include 'db.php';
    if (isset($_POST['submit3'])) {
        session_start();
        $_SESSION["username"] = $_POST['studentID'];
        $StudentID = mysqli_real_escape_string($conn, $_POST['studentID']);
        $GettingEmail = "SELECT email FROM student WHERE studentID='$StudentID' ";
        $GetEmail = mysqli_query($conn, $GettingEmail);

        if(mysqli_num_rows($GetEmail)>0){

            $Row = mysqli_fetch_row($GetEmail);
            $VerificationCode = mt_rand(1111, 9999);
            $ver = $VerificationCode;
            echo $ver;
            $subject = "Verification Code";
            $txt = "Your verification code is:" . $VerificationCode;
            mail($Row[0], $subject, $txt, 'From: rahwyco@gmail.com'); //The email function
    
            echo '
            <div class="alert alert-success alert-dismissible" style= "margin-bottom:0px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Email was sent successfully!</strong> Please write the verification code in the field below.
  </div>';
        }else{
            echo '
            <div class="alert alert-danger alert-dismissible" style= "margin-bottom:0px;>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>User ID not found!</strong> Please check your entry again.
          </div>';
        }
        
    }
    if (isset($_POST['submit4'])) {
        if ($_POST['Verification'] == "abc") {

            echo '
	<script>
	window.location.href="changePassword.php";
	</script>
  ';;
        }
    }


    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    
    <div class="login-wrap">
        <div class="login-html">
            <div class="login-form">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="group">
                        <div class="tasksInput">
                            <label for="studentID" class="label">Student ID</label>
                            <input id="studentID" name="studentID" class="input"> </input>
                        </div>
                    </div>
                    <div class="group">
                        <button id="submit3" name="submit3" class="button" style="margin-bottom: 50px;">Get Code</button>
                    </div>
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="group">
                        <div class="tasksInput">
                    <label for="Verification" class="label">Verification Code</label>
                    <input id="Verification" name="Verification" class="input"> </input>
                    </div>
                    </div>
                    <div class="group">
                    <button id="submit4" name="submit4" class="button">Check</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    
</body>

</html>