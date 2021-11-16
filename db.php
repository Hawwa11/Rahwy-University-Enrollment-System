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
    fname VARCHAR(100) NOT NULL, 
    lname VARCHAR(100) NOT NULL, 
    email VARCHAR(1000) NOT NULL, -- Set email as the primary key
    UNIQUE (email),-- Set email as UNIQUE index
    password_hash CHAR(100) NOT NULL,
    dob DATE NOT NULL,
    phone VARCHAR(40) NOT NULL,
    department VARCHAR(60) NOT NULL, 
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating table: " . $conn->error;
  }

// Create the user table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS enrollment (
    enrollmentID VARCHAR(40) NOT NULL PRIMARY KEY, -- Set enrollmentID as the primary key
    studentID VARCHAR(40) NOT NULL, 
    UNIQUE (studentID),-- Set email as UNIQUE index
    subject_list VARCHAR(200) NOT NULL,
    sem VARCHAR(60) NOT NULL, 
    enroll_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating table: " . $conn->error;
  }

// Create the user table if it doesnt exist
$sql = "CREATE TABLE IF NOT EXISTS classes (
    classID VARCHAR(40) NOT NULL PRIMARY KEY, -- Set classID as the primary key
    c_name VARCHAR(40) NOT NULL, 
    dates_list VARCHAR(200) NOT NULL,
    c_time VARCHAR(60) NOT NULL, 
    fee INT(100) NOT NULL
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating table: " . $conn->error;
  }

  //add class records
  $query = mysqli_query($conn, "SELECT * FROM classes");
 
  $row = mysqli_fetch_array($query);
if($row == 0){
  //Insert data in the form table
	$insert = mysqli_query($conn, "INSERT INTO classes (classID, c_name, dates_list, c_time, fee)
   VALUES 
    (
     'ITM3201',
     'Software Engineering',
     '16-08-2021,18-08-2021',
     '8:00-10:00',
     2300
     ),
     (
     'SDT1302',
     'System Analysis',
     '16-08-2021,18-08-2021',
     '10:00-12:00',
     2300
     ),
     (
     'IBM2203',
     'Mobile App Development',
     '16-08-2021,18-08-2021',
     '12:00-14:00',
     2300
     ),
     (
     'PGR4204',
     'Programming Logic',
     '17-08-2021,19-08-2021',
     '8:00-10:00',
     2300
     ),
     (
     'MPU2105',
     'Malaysian Studies',
     '17-08-2021,19-08-2021',
     '10:00-12:00',
     500
     ),
     (
     'IBM3106',
     'Web Programming',
     '17-08-2021,19-08-2021',
     '12:00-14:00',
     2300
     ),
     (
     'MAT4107',
     'Mathemetics',
     '16-08-2021,19-08-2021',
     '14:00-16:00',
     2300
     ),
     (
     'ICT2208',
     'Software Testing',
     '17-08-2021,18-08-2021',
     '14:00-16:00',
     2300
     ),
     (
     'CAP3409',
     'Capstone',
     '18-08-2021,20-08-2021',
     '16:00-18:00',
     2300
     ),
     (
     'ITM4010',
     'Computer Architecture Fundamentals',
     '17-08-2021,19-08-2021',
     '16:00-18:00',
     2300
     )
   ");
	
  //Check if insert successfull
	if($insert){
	} else {
		echo 'Failed to add records due to '.mysqli_error($conn);
	}
}

?>