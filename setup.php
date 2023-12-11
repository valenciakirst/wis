<?php
$servername = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS valencia_studentinfo";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->select_db("valencia_studentinfo");


$sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Users table created successfully<br>";
} else {
    echo "Error creating Users table: " . $conn->error . "<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS Student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    email VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Student table created successfully<br>";
} else {
    echo "Error creating Student table: " . $conn->error . "<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS Instructor (
    instructor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Instructor table created successfully<br>";
} else {
    echo "Error creating Instructor table: " . $conn->error . "<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS Course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    instructor_id INT,
    FOREIGN KEY (instructor_id) REFERENCES Instructor(instructor_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Course table created successfully<br>";
} else {
    echo "Error creating Course table: " . $conn->error . "<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS Enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (course_id) REFERENCES Course(course_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Enrollment table created successfully<br>";
} else {
    echo "Error creating Enrollment table: " . $conn->error . "<br>";
}


$conn->close();
?>

