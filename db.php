<?php

// Set the variables 
$servername = "localhost";
$username = "root";
$password = "";

// Create connection to phpMyAdmin
$conn = new mysqli($servername,$username,$password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create new databse if it doesnt exist
$sql = "CREATE DATABASE IF NOT EXISTS rahwyuni";
if ($conn->query($sql) === TRUE) {

} else {
  echo "Error creating database: " . $conn->error;
}

// Select the databse
$conn = new mysqli($servername,$username,$password,"rahwyuni");

// Create the student table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS student (
    studentID VARCHAR(40) NOT NULL PRIMARY KEY, -- Set STUDENTid as the primary key
    fname VARCHAR(100) NOT NULL, 
    lname VARCHAR(100) NOT NULL, 
    email VARCHAR(1000) NOT NULL, -- Set email as the primary key
    UNIQUE (email),-- Set email as UNIQUE index
    password_hash CHAR(100) NOT NULL,
    dob DATE NOT NULL,
    phone VARCHAR(40) NOT NULL,
    passport_no VARCHAR(40) NOT NULL, 
    nationality VARCHAR(50) NOT NULL, 
    programID VARCHAR(40) NOT NULL,
    start_sem VARCHAR(40) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
         // Do nothing if table created successfully
    } else {
      echo "Error creating table: " . $conn->error;
    }

// Create the lecturer table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS lecturer (
    lecturerID VARCHAR(40) NOT NULL PRIMARY KEY, -- Set lecturerid as the primary key
    lname VARCHAR(100) NOT NULL, 
    email VARCHAR(1000) NOT NULL, -- Set email as the primary key
    UNIQUE (email),-- Set email as UNIQUE index
    password_hash CHAR(100) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    department VARCHAR(60) NOT NULL, 
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating table: " . $conn->error;
  }

 //add class records
 $query = mysqli_query($conn, "SELECT * FROM lecturer");
 
 $row = mysqli_fetch_array($query);
if($row == 0){
 //Insert data in the form table
 $insert = mysqli_query($conn, "INSERT INTO lecturer (lecturerID, lname, email, password_hash, phone, department)
  VALUES 
   ( 
    'L10020001',
    'Ms Melissa Warner',
    'L10020001@lecturer.rahwy.edu',
    'lecturer1',
    '+60-358-1241',
    'Faculty of IT'
    ),
    (
    'L11120154',
    'Dr Matilda Bozzelli',
    'L11120154@lecturer.rahwy.edu',
    'lecturer2',
    '+60-358-1241',
    'Faculty of CS'
    )
    -- (
    -- 'L11020112',
    -- 'Mr Jake Parker',
    -- 'L10020001@lecturer.rahwy.edu',
    -- ),
    -- (
    -- 'L10119993',
    -- 'Mrs Dane Johnson',
    -- 'L10020001@lecturer.rahwy.edu',
    -- ),
  ");
 
 //Check if insert successfull
 if($insert){
 } else {
   echo 'Failed to add records due to '.mysqli_error($conn);
 }
}

// Create the user table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS enrollment (
    enrollmentID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Set enrollmentID as the primary key
    studentID VARCHAR(40) NOT NULL,
    FOREIGN KEY (studentID) REFERENCES student(studentID),
    UNIQUE (studentID),-- Set email as UNIQUE index
    student_name VARCHAR(100) NOT NULL, 
    subject_list VARCHAR(200) NOT NULL,
    paid INT(10) NOT NULL,
    sem VARCHAR(60) NOT NULL, 
    enroll_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating enrollment table: " . $conn->error;
  }

// Create the user table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS class (
    classID VARCHAR(40) NOT NULL PRIMARY KEY, -- Set classID as the primary key
    c_name VARCHAR(40) NOT NULL, 
    dates_list VARCHAR(200) NOT NULL,
    c_time VARCHAR(60) NOT NULL, 
    lecturerID VARCHAR(40) NOT NULL,
    FOREIGN KEY (lecturerID) REFERENCES lecturer(lecturerID),
    fee INT(100) NOT NULL
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating table: " . $conn->error;
  }

  //add class records
  $query = mysqli_query($conn, "SELECT * FROM class");
 
  $row = mysqli_fetch_array($query);
if($row == 0){
  //Insert data in the form table
	$insert = mysqli_query($conn, "INSERT INTO class (classID, c_name, dates_list, c_time, lecturerID, fee)
   VALUES 
    (
     'ITM3201',
     'Software Engineering',
     '16-08-2021,18-08-2021',
     '8:00-10:00',
     'L11120154',
     2300
     ),
     (
     'SDT1302',
     'System Analysis',
     '17-08-2021,19-08-2021',
     '14:00-16:00',
     'L10020001',
     2300
     ),
     (
     'IBM2203',
     'Mobile App Development',
     '16-08-2021,18-08-2021',
     '12:00-14:00',
     'L10020001',
     2300
     ),
     (
     'ICT2208',
     'Software Testing',
     '17-08-2021,20-08-2021',
     '08:00-10:00',
     'L11120154',
     2300
     )
   ");
	
  //Check if insert successfull
	if($insert){
	} else {
		echo 'Failed to add records due to '.mysqli_error($conn);
	}
}

  // Create the user table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS ITM3201_attendance (
  ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Set ID as the primary key
  studentID VARCHAR(40) NOT NULL, 
  c_date VARCHAR(200) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
     // Do nothing if table created successfully
} else {
  echo "Error creating ITM3201_attendance table: " . $conn->error;
}

  // Create the user table if it doesnt exist
  $sql = "CREATE TABLE IF NOT EXISTS SDT1302_attendance (
    ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Set ID as the primary key
    studentID VARCHAR(40) NOT NULL, 
    FOREIGN KEY (studentID) REFERENCES student(studentID),
    c_date VARCHAR(200) NOT NULL
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating SDT1302_attendance table: " . $conn->error;
  }

// Create the user table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS IBM2203_attendance (
  ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Set ID as the primary key
  studentID VARCHAR(40) NOT NULL, 
  FOREIGN KEY (studentID) REFERENCES student(studentID),
  c_date VARCHAR(200) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
     // Do nothing if table created successfully
} else {
  echo "Error creating SDT1302_attendance table: " . $conn->error;
}

// Create the user table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS ICT2208_attendance (
  ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Set ID as the primary key
  studentID VARCHAR(40) NOT NULL, 
  FOREIGN KEY (studentID) REFERENCES student(studentID),
  c_date VARCHAR(200) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
     // Do nothing if table created successfully
} else {
  echo "Error creating SDT1302_attendance table: " . $conn->error;
}


?>