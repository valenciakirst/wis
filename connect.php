<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "StudentRecord";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// else
// echo "Connected successfully";

$sql="Select * from Student";
$result=$conn->query("$sql");

if ($result){
while ($row=$result->fetch_assoc()){
echo "ID Number:" .$row["StudentID"] ."<br>"
. "First Name:" .$row["FirstName"] ."<br>"
. "Last Name:" .$row["LastName"] ."<br>"
. "Date Of Birth:" .$row["DateOfBirth"] ."<br>"
. "Email:" .$row["Email"] ."<br>"
. "Phone:" .$row["Phone"] ."<br>"
. "<br>";
}
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>