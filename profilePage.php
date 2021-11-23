<?php 
    session_start();
    include ("db.php");
    $studentID = $_SESSION["username"];

    $email = "SELECT email FROM student WHERE studentID='$studentID'";
    $result1 = mysqli_query($conn, $email);
    $row = mysqli_fetch_assoc($result1);
    $currentEmail = $row['email'];

    $pnum = "SELECT phone FROM student WHERE studentID='$studentID'";
    $result2 = mysqli_query($conn, $pnum);
    $row = mysqli_fetch_assoc($result2);
    $currentPhone = $row['phone'];

    // If change password button is clicked
    if (isset($_POST['cp'])) {
        $passwordOld = trim($_POST['passwordOld']);
        $passwordNew = trim($_POST['passwordNew']);
        $passwordConfirm = trim($_POST['passwordConfirm']);
        $sql = "SELECT * FROM student WHERE studentID='$studentID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $password = $row['password_hash'];

        if($passwordNew == "" || $passwordConfirm == ""){
            echo "<script>alert('Please enter or confirm your new password.');</script>";
        } else if ($passwordOld == $password && $passwordNew != "" && $passwordConfirm != "" && $passwordNew == $passwordConfirm) {
            // Update user with the hashed new password
            $sql = "UPDATE student SET password_hash = '$passwordNew' WHERE studentID='$studentID'";
            mysqli_query($conn, $sql);

            echo "<script>alert('Password successfully changed.');</script>";
        } else if ($passwordNew != $passwordConfirm) {
            echo "<script>alert('The confirmation password does not match.');</script>";
        } else {
            echo "<script>alert('Operation cancelled. Incorrect password entered.');</script>";
        }
    } else if (isset($_POST['pn'])) {
        $phoneNum = $_POST['pnum'];
        $pCheck = "SELECT * FROM student WHERE phone = '$phoneNum'";
        $pCheck2 = "SELECT * FROM student WHERE phone = '$phoneNum' AND studentID='$studentID'";
        $startPassCheck = mysqli_query($conn, $pCheck);
        if($phoneNum == ""){
            echo "<script>alert('Please enter your updated phone number.');</script>";
        } else if (strlen((string)$phoneNum) < 7) {
            echo "<script>alert('Please enter a valid phone number.');</script>";
        } else if ($phoneNum == $pCheck2) {
            echo "<script>alert('Error changing phone number. Phone number entered same as current phone number.');</script>";
        } else if (mysqli_num_rows($startPassCheck) > 0) {
            echo "<script>alert('Error changing phone number. Phone number entered is associated with another account.');</script>";
        } else {
            $sql = "UPDATE student SET phone = '$phoneNum' WHERE studentID='$studentID'";
            mysqli_query($conn, $sql);
            echo "<script>alert('Phone Number successfully updated.');</script>";
        }
    } else if (isset($_POST['em'])) {
        $email = $_POST['email'];
        $uCheck = "SELECT * FROM student WHERE email = '$email'";
        $uCheck2 = "SELECT * FROM student WHERE email = '$email' AND studentID='$studentID'";
        $startUCheck = mysqli_query($conn, $uCheck);
        if($email == ""){
            echo "<script>alert('Please enter your updated email.');</script>";
        } else if ($email == $uCheck2) {
            echo "<script>alert('Error changing email. Email entered same as current email.');</script>";
        } else if (mysqli_num_rows($startUCheck) > 0) {
            echo "<script>alert('Error changing email. Email entered is associated with another account.');</script>";
        } else {
            $sql = "UPDATE student SET email = '$email' WHERE studentID='$studentID'";
            mysqli_query($conn, $sql);
            echo "<script>alert('Email successfully updated.');</script>";
        }
    }    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="form.css">
        <title>Profile Page</title>
    </head>
    <body>
        <form action="" class="signup-form" method="post">
            <div class="form-header">
                <h1>Profile Page</h1>
            </div>
            
            <div class="form-body">
                <button type="button" class="btn" onclick="window.location.href='tabs.php'">
                    < Back
                </button>
                <table border="0" width=100%>
                    <tr>
                        <td colspan="4">
                            <div style="font-weight: bold;">
                                <h2>Change Password</h2>
                            </div>
                            <hr />
                        </td>
                    </tr>

                    <tr>
                        <td><div><label class="label-title">Old password</label></div></td>
                    </tr>
                    <tr>
                        <td><div style="padding-top: 5px;"><input type="password" size="50" placeholder="Enter your old password" name="passwordOld"></div></td>
                    </tr>

                    <tr>
                        <td><div style="padding-top: 10px;"><label class="label-title">New password</label></div></td>
                    </tr>
                    <tr>
                        <td><div style="padding-top: 5px;"><input type="password" size="50" placeholder="Enter your new password" name="passwordNew"></div></td>
                    </tr>
                    <tr>
                        <td><div style="padding-top: 10px;"><label class="label-title">Confirm New Password</label></div></td>
                    </tr>
                    <tr>
                        <td><div style="padding-top: 5px;"><input type="password" size="50" placeholder="Please re-enter to confirm your new password" name="passwordConfirm"></div></td>
                    </tr>

                    <tr>
                        <td><div style="float: right;"><input type="submit" name="cp" class="btn" value="Change Password"></div></td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <div style="font-weight: bold;">
                                <h2>Update Phone Number</h2>
                            </div>
                            <hr />
                        </td>
                    </tr>

                    <tr>
                        <td><div><label class="label-title">Enter your updated Phone Number</label></div></td>
                    </tr>
                    <tr>
                        <td><div style="padding-top: 5px;"><input id="pnum" name="pnum" size="50" type="tel" placeholder="<?php echo 'Current Phone Number: ' . $currentPhone ?>" class="input"></div></td>
                    </tr>
                    <tr>
                        <td><div style="float: right;"><input type="submit" name="pn" class="btn" value="Change Phone Number"></div></td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <div style="font-weight: bold;">
                                <h2>Update Email Address</h2>
                            </div>
                            <hr />
                        </td>
                    </tr>

                    <tr>
                        <td><div><label class="label-title">Enter your updated Email</label></div></td>
                    </tr>
                    <tr>
                        <td><div style="padding-top: 5px;"><input id="email" name="email" size="50" placeholder="<?php echo 'Current Email: ' . $currentEmail ?>" type="email" class="input"></div></td>
                    </tr>
                    <tr>
                        <td><div style="float: right;"><input type="submit" name="em" class="btn" value="Change Email"></div></td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>