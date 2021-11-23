<?php 
    session_start();
    include ("db.php");
    $studentID = $_SESSION["username"];

    $profile = "SELECT * FROM student WHERE studentID='$studentID'";
    $result1 = mysqli_query($conn, $profile);
    $row = mysqli_fetch_assoc($result1);
    $firstName = $row['fname'];
    $lastName = $row['lname'];
    $dob = $row['dob'];
    $passport = $row['passport_no'];
    $nationality = $row['nationality'];
    $program = $row['programID'];
    $session = $row['start_sem'];
    $currentEmail = $row['email']; //get the current email for the student
    $currentPhone = $row['phone']; //get the current phone number for the student

    // If change password button is clicked
    if (isset($_POST['cp'])) {
        $passwordOld = trim($_POST['passwordOld']);
        $passwordNew = trim($_POST['passwordNew']);
        $passwordConfirm = trim($_POST['passwordConfirm']);
        $sql = "SELECT * FROM student WHERE studentID='$studentID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $password = $row['password_hash'];

        if($passwordNew == "" || $passwordConfirm == ""){ //if the fields for the new and confirm new password are empty
            echo "<script>alert('Please enter or confirm your new password.');</script>";
        } else if ($passwordOld == $password && $passwordNew != "" && $passwordConfirm != "" && $passwordNew == $passwordConfirm) {
            // Update user with the hashed new password
            $sql = "UPDATE student SET password_hash = '$passwordNew' WHERE studentID='$studentID'";
            mysqli_query($conn, $sql);

            if(isset($_COOKIE['member_ID']) && isset($_COOKIE["member_Password"])) {//delete cookie if it exists
                $CookieID = $_COOKIE["member_ID"];
                $Cookiepassword = $_COOKIE["member_Password"];
                setcookie("member_ID", $CookieID, time() - 1);
                setcookie("member_Password", $Cookiepassword, time() - 1);
            }

            echo "<script>alert('Password successfully changed.');</script>";
        } else if ($passwordNew != $passwordConfirm) {
            echo "<script>alert('The confirmation password does not match.');</script>";
        } else { //if the user entered incorrect password for the old password
            echo "<script>alert('Operation cancelled. Incorrect password entered.');</script>";
        }
    } else if (isset($_POST['pn'])) { //if update phone number button is clicked
        $phoneNum = $_POST['pnum'];
        $pCheck = "SELECT * FROM student WHERE phone = '$phoneNum'";
        $startPassCheck = mysqli_query($conn, $pCheck);
        if($phoneNum == ""){ //if the phone number field is empty
            echo "<script>alert('Please enter your updated phone number.');</script>";
        } else if (strlen((string)$phoneNum) < 7) { //if the student entered an invalid phone number
            echo "<script>alert('Please enter a valid phone number.');</script>";
        } else if ($phoneNum == $currentPhone) { //if the phone number entered is the same as current phone number
            echo "<script>alert('Error changing phone number. Phone number entered same as current phone number.');</script>";
        } else if (mysqli_num_rows($startPassCheck) > 0) { //if the phone number entered exists in the system that is from another student
            echo "<script>alert('Error changing phone number. Phone number entered is associated with another account.');</script>";
        } else {
            $sql = "UPDATE student SET phone = '$phoneNum' WHERE studentID='$studentID'";
            mysqli_query($conn, $sql);
            echo "<script>alert('Phone Number successfully updated.');</script>";
        }
    } else if (isset($_POST['em'])) { //if update email button is clicked
        $email = $_POST['email'];
        $uCheck = "SELECT * FROM student WHERE email = '$email'";
        $startUCheck = mysqli_query($conn, $uCheck);
        if($email == ""){ //if the email field is empty
            echo "<script>alert('Please enter your updated email.');</script>";
        } else if ($email == $currentEmail) { //if the email entered is the same as current email
            echo "<script>alert('Error changing email. Email entered same as current email.');</script>";
        } else if (mysqli_num_rows($startUCheck) > 0) { //if the email entered exists in the system that is from another student
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
                                <h2>About Me</h2>
                            </div>
                            <hr />
                        </td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">First Name:</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $firstName ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Last Name:</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $lastName ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Email</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $currentEmail ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Date of Birth</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $dob ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Phone</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $currentPhone ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Passport No.</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $passport ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Nationality</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $nationality ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Program ID</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $program ?></label></div></td>
                    </tr>
                    <tr>
                        <td width=50%><div style="padding-top: 10px;"><label class="label-title">Session</label></div></td>
                        <td><div><label style="float: left; font-weight: normal;"><?php echo $session ?></label></div></td>
                    </tr>
                    
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
                        <td colspan="4"><div style="padding-top: 5px;"><input type="password" size="50" placeholder="Enter your old password" name="passwordOld"></div></td>
                    </tr>

                    <tr>
                        <td><div style="padding-top: 10px;"><label class="label-title">New password</label></div></td>
                    </tr>
                    <tr>
                        <td colspan="4"><div style="padding-top: 5px;"><input type="password" size="50" placeholder="Enter your new password" name="passwordNew"></div></td>
                    </tr>
                    <tr>
                        <td><div style="padding-top: 10px;"><label class="label-title">Confirm New Password</label></div></td>
                    </tr>
                    <tr>
                        <td colspan="4"><div style="padding-top: 5px;"><input type="password" size="50" placeholder="Please re-enter to confirm your new password" name="passwordConfirm"></div></td>
                    </tr>

                    <tr>
                        <td colspan="4"><div style="float: right; padding-top: 5px;"><input type="submit" name="cp" class="btn" value="Change Password"></div></td>
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
                        <td colspan="4"><div style="padding-top: 5px;"><input id="pnum" name="pnum" size="50" type="tel" placeholder="<?php echo 'Current Phone Number: ' . $currentPhone ?>" class="input"></div></td>
                    </tr>
                    <tr>
                        <td colspan="4"><div style="float: right; padding-top: 5px;"><input type="submit" name="pn" class="btn" value="Change Phone Number"></div></td>
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
                        <td colspan="4"><div style="padding-top: 5px;"><input id="email" name="email" size="50" placeholder="<?php echo 'Current Email: ' . $currentEmail ?>" type="email" class="input"></div></td>
                    </tr>
                    <tr>
                        <td colspan="4"><div style="float: right; padding-top: 5px;"><input type="submit" name="em" class="btn" value="Change Email"></div></td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>