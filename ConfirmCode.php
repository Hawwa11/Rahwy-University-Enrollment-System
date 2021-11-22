<!DOCTYPE html>
<html lang="en">


<?php
session_start();

$verf= $_SESSION["verificationCode"];


if (isset($_POST['submit4'])) {
    
    echo $code;
    if ($_POST['Verification'] ==$verf ) {

        echo '<script>
                window.location.href="ChangePw.php";
            </script>
';
    }
}
?>
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

<div class="login-wrap">
        <div class="login-html">
            <div class="login-form">
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