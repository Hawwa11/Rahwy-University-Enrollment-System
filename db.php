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
$sql = "CREATE DATABASE IF NOT EXISTS rahwyuni2";
if ($conn->query($sql) === TRUE) {

} else {
  echo "Error creating database: " . $conn->error;
}

// Select the databse
$conn = new mysqli($servername,$username,$password,"rahwyuni2");

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
    UNIQUE (c_time),-- Set c_time as UNIQUE index
    fee INT(100) NOT NULL, 
  )";
  
  if ($conn->query($sql) === TRUE) {
       // Do nothing if table created successfully
  } else {
    echo "Error creating table: " . $conn->error;
  }


?>