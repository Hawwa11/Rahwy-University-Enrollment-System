<?php
// Set the variables 
include 'db.php';
include 'functions.php';



if (!empty($_GET)){
     
	echo "I dont have depression";
	$date=$_GET['link'];
	$classID=$_GET['class'];
    $url="tabs.php?link=".$date."&class=".$classID."";
	$dataLink="?link=".$date."&class=".$classID."";

	echo $url;








	
   
}else{

	echo "I have depression";
	$dataLink="";
  
}



if (isset($_POST['submit'])) {
    // no data passed by get

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	$pNum = mysqli_real_escape_string($conn, $_POST['pnum']);
	$fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lname = mysqli_real_escape_string($conn, $_POST['lname']);
	$passport = mysqli_real_escape_string($conn, $_POST['passport']);
	$programID = mysqli_real_escape_string($conn, $_POST['ProgramID']);
	$country = mysqli_real_escape_string($conn, $_POST['country']);
	$DOB = mysqli_real_escape_string($conn, $_POST['DOB']);
	$campus = "I21";
	$IDGen = $campus . substr($_POST['passport'], 1);
	$ID = mysqli_real_escape_string($conn, $IDGen);

	$uCheck = "SELECT * FROM student WHERE email = '$email'";
	$pCheck = "SELECT * FROM student WHERE phone = '$pNum'";
	$passportCheck = "SELECT * FROM student WHERE passport_no = '$passport'";
	$startUCheck = mysqli_query($conn, $uCheck);
	$startPassCheck = mysqli_query($conn, $pCheck);
	$startPassprtCheck = mysqli_query($conn, $passportCheck);

	if ($_POST['pass'] != $_POST['Rpass']) {
		echo "<script>alert('Password and confirm password must be the same!')</script>";
	} else if (mysqli_num_rows($startUCheck) > 0) {
		echo '<div class="alert">
			<span class="closebtn">&times;</span>  
			<strong>Change Email ! </strong> This email is associated with another account.
		  </div>
		  <script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>
		  ';
	} else if (mysqli_num_rows($startPassCheck) > 0) {

		echo '
			<div class="alert">
			<span class="closebtn">&times;</span>  
			<strong>Change Phone ! </strong> This Phone is associated with another account.
		  </div>
		  <script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>';
	} else if (mysqli_num_rows($startPassprtCheck) > 0) {
		echo '
			<div class="alert">
			<span class="closebtn">&times;</span>  
			<strong>Change Passport Number ! </strong> This Passport Number is associated with another account.
		  </div>
		  <script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>';
	} else {


		$insert = mysqli_query($conn, "INSERT INTO student (studentID, email, password_hash, phone, dob, passport_no, nationality, fname, lname, programID,start_sem) VALUES('$ID','$email','$pass','$pNum','$DOB','$passport','$country','$fname','$lname','$programID','AUG21')");
		//Sending Email to student with their new student ID
		$subject = "Your Student ID";
		$txt = "Thank you for registering. Your student ID is " . $IDGen;
		mail($email, $subject, $txt, 'From: rahwyco@gmail.com');//The email function
		if ($insert) {
			$_SESSION["username"] = $IDGen;

			echo '
			
			<script>
			window.location.href="enrollmentForm.php?ck=1";
			</script>
			
		  ';
		} else {
			echo 'Failed to add new record' . mysqli_error($conn);
		}
	}
}

if (isset($_POST['submit2'])) {


	$userID = mysqli_real_escape_string($conn, $_POST['userID']);
	$password = mysqli_real_escape_string($conn, $_POST['Loginpass']);

	$RoleID = substr($_POST['userID'], 0, 1);

	if($RoleID=="L"){

		$LoginCheckQuery = "SELECT * FROM lecturer WHERE lecturerID = '$userID' AND password_hash = '$password'";
		$startLoginCheck = mysqli_query($conn, $LoginCheckQuery);
	
		if (mysqli_num_rows($startLoginCheck) > 0) {
			$_SESSION["username"] = $_POST['userID'];
	
			echo '
				<script>
				window.location.href="teacherPortal.php?ck=1";
				</script>
			  ';
		} else {
			echo '
				<div class="alert">
				<span class="closebtn">&times;</span>  
				<strong>Incorrect credentials ! </strong> The User ID or Password are incorrect.
			  </div>
			  <script>
	var close = document.getElementsByClassName("closebtn");
	var i;
	
	for (i = 0; i < close.length; i++) {
	  close[i].onclick = function(){
		var div = this.parentElement;
		div.style.opacity = "0";
		setTimeout(function(){ div.style.display = "none"; }, 600);
	  }
	}
	</script>';
		}

	}else{



	$LoginCheckQuery = "SELECT * FROM student WHERE studentID = '$userID' AND password_hash = '$password'";
	$startLoginCheck = mysqli_query($conn, $LoginCheckQuery);

	if (mysqli_num_rows($startLoginCheck) > 0) {
		$_SESSION["username"] = $_POST['userID'];
// 		if(!empty($_POST["rememberme"])) {
// 			setcookie ("member_ID",$_POST["userID"],time()+ (86400));
// 			setcookie ("member_Password",$_POST["Loginpass"],time()+ (86400));
// 		}else { //delete cookie if checkbox is not checked
// 			if(isset($_COOKIE['member_ID']) && isset($_COOKIE["member_Password"])) {
// 				$CookieID = $_COOKIE["member_ID"];
// 				$Cookiepassword = $_COOKIE["member_Password"];
// 				setcookie("member_ID", $CookieID, time() - 1);
// 				setcookie("member_Password", $Cookiepassword, time() - 1);
// 			}
// 	} 
// 	echo '
// 	<script>
// 	window.location.href="tabs.php?ck=1";
// 	</script>
//   ';
// }else {

    
    if (!empty($_GET)){
     

		$date=$_GET['link'];
		$classID=$_GET['class'];
	

		header("Location: tabs.php?link=".$date."&class=".$classID."");
	
		
	   
	}else{
	
		header("Location: tabs.php");
	  
	}
	
	

	
		




	} else {
		echo '
			<div class="alert">
			<span class="closebtn">&times;</span>  
			<strong>Incorrect credentials ! </strong> The User ID or Password are incorrect.
		  </div>
		  <script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>';
	}
}
}


if(isset($_COOKIE['member_ID']) && isset($_COOKIE["member_Password"])) {
	$CookieID = $_COOKIE["member_ID"];
	$Cookiepassword = $_COOKIE["member_Password"];
	echo "<script>
		document.getElementById('userID').value = '$CookieID';
		document.getElementById('Loginpass').value = '$Cookiepassword';
		document.getElementById('rememberme').checked = true;
	</script>";
	//it is not showing in the fields idk why
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login/Register</title>
	<link rel="stylesheet" href="loginStyle.css">
</head>

<body>
	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

			<div class="login-form">
				<div class="sign-in-htm">
					<form action="<?php echo $_SERVER['PHP_SELF'].$dataLink; ?>" method="post">
						<div class="group">
							<div class="tasksInput">
							<label for="userID" class="label">User ID</label>
							<input id="userID" name="userID" type="text" class="input">
							</div>
						</div>
						<div class="group">
							<label for="Loginpass" class="label">Password</label>
							<input id="Loginpass" name="Loginpass" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<input id="rememberme" type="checkbox" class="check" name="rememberme" checked>
							<label for="rememberme"><span class="icon"></span> Keep me Signed in</label>
						</div>
						<div class="group">
							<input type="submit" name="submit2" class="button" value="Sign In">
						</div>

						<div class="hr"></div>
						<div class="foot-lnk">
							<a href="#forgot">Forgot Password?</a>
						</div>
						</from>
				</div>

				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="sign-up-htm">
						<div class="group">
							<label for="fname" class="label">First Name</label>
							<input id="fname" name="fname" type="text" class="input">
						</div>
						<div class="group">
							<label for="lname" class="label">Last Name</label>
							<input id="lname" name="lname" type="text" class="input">
						</div>
						<div class="group">
							<label for="passport" class="label">Passport Number</label>
							<input id="passport" name="passport" type="text" class="input">
						</div>
						<div class="group">
							<label for="programID" class="label">Program ID</label>
							<input id="ProgramID" name="ProgramID" type="text" class="input">
						</div>
						<div class="group">
							<label for="country" class="label">Nationality</label>
							<select id="country" name="country" class="country" style="width: 244px;
							margin-left: 75px; border-radius:36px; height: 40px;">
								<option value="Afghanistan">Afghanistan</option>
								<option value="Åland Islands">Åland Islands</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antarctica">Antarctica</option>
								<option value="Antigua and Barbuda">Antigua and Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Bouvet Island">Bouvet Island</option>
								<option value="Brazil">Brazil</option>
								<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
								<option value="Brunei Darussalam">Brunei Darussalam</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Cote D'ivoire">Cote D'ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern Territories">French Southern Territories</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guernsey">Guernsey</option>
								<option value="Guinea">Guinea</option>
								<option value="Guinea-bissau">Guinea-bissau</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
								<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Israel">Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jersey">Jersey</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
								<option value="Korea, Republic of">Korea, Republic of</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macao">Macao</option>
								<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malawi">Malawi</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
								<option value="Moldova, Republic of">Moldova, Republic of</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montenegro">Montenegro</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Namibia">Namibia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherlands">Netherlands</option>
								<option value="Netherlands Antilles">Netherlands Antilles</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Northern Mariana Islands">Northern Mariana Islands</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau">Palau</option>
								<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Philippines">Philippines</option>
								<option value="Pitcairn">Pitcairn</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russian Federation">Russian Federation</option>
								<option value="Rwanda">Rwanda</option>
								<option value="Saint Helena">Saint Helena</option>
								<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
								<option value="Saint Lucia">Saint Lucia</option>
								<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
								<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
								<option value="Samoa">Samoa</option>
								<option value="San Marino">San Marino</option>
								<option value="Sao Tome and Principe">Sao Tome and Principe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="Syrian Arab Republic">Syrian Arab Republic</option>
								<option value="Taiwan">Taiwan</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
								<option value="Thailand">Thailand</option>
								<option value="Timor-leste">Timor-leste</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad and Tobago">Trinidad and Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkey">Turkey</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Emirates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States">United States</option>
								<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
								<option value="Uruguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Viet Nam">Viet Nam</option>
								<option value="Virgin Islands, British">Virgin Islands, British</option>
								<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
								<option value="Wallis and Futuna">Wallis and Futuna</option>
								<option value="Western Sahara">Western Sahara</option>
								<option value="Yemen">Yemen</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
							</select>
						</div>
						<div class="group">
							<label for="DOB" class="label">Date of Birth</label>
							<input id="DOB" name="DOB" type="date" class="input" min="1950-01-01" max="2005-01-01">
						</div>
						<div class="group">
							<label for="pnum" class="label">Phone Number</label>
							<input id="pnum" name="pnum" type="text" class="input">
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass" name="pass" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<label for="Rpass" class="label">Repeat Password</label>
							<input id="Rpass" name="Rpass" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<label for="email" class="label">Email Address</label>
							<input id="email" name="email" type="text" class="input">
						</div>
						<div class="group">
							<input type="submit" name="submit" class="button" value="Sign Up">
						</div>
				</form>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

</html>