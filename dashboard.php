<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valencia_studentinfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h2>Student Information System</h2>


<div class = "topnav">
    <a href="#students">Students</a>
    <a href="#users">Users</a>
    <a href="#courses">Courses</a>
    <a href="#instructors">Instructors</a>
</div>


<section id="students">
    <?php 
    include 'students.php';
    ?>
</section>


<section id="users">
    <?php
    include 'users.php';
    ?>
</section>


<section id="courses">

    <?php
    include 'course.php';
    ?>
</section>


<section id="instructors">
    <?php
    include 'instructor.php';
    ?>
</section>

</body>
</html>

<?php
if ($conn->ping()) {
    $conn->close();
}
?>