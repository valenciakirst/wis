<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valencia_studentinfo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM Course";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addCourse"])) {
    $newCourseName = $conn->real_escape_string($_POST["newCourseName"]);
    $newInstructorId = $conn->real_escape_string($_POST["newInstructorId"]);

    $insertSql = "INSERT INTO Course (course_name, instructor_id) VALUES ('$newCourseName', '$newInstructorId')";
    $conn->query($insertSql);
    header("Location: course.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateCourse"])) {
    $courseId = $_POST["courseId"];
    $newCourseName = $conn->real_escape_string($_POST["newCourseName"]);
    $newInstructorId = $conn->real_escape_string($_POST["newInstructorId"]);

    $updateSql = "UPDATE Course SET course_name='$newCourseName', instructor_id='$newInstructorId' WHERE course_id=$courseId";
    $conn->query($updateSql);
    header("Location: course.php"); 
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["deleteCourse"])) {
    $courseId = $_GET["deleteCourse"];

    $deleteSql = "DELETE FROM Course WHERE course_id=$courseId";
    $conn->query($deleteSql);
    header("Location: course.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h3>Course Management</h3>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="newCourseName">Course Name:</label>
    <input type="text" name="newCourseName" required>
    <label for="newInstructorId">Instructor ID:</label>
    <input type="text" name="newInstructorId" required>
    <button type="submit" name="addCourse">Add Course</button>
</form>


<table border="1">
    <tr>
        <th>ID</th>
        <th>Course Name</th>
        <th>Instructor ID</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["course_id"] . "</td>";
            echo "<td>" . $row["course_name"] . "</td>";
            echo "<td>" . $row["instructor_id"] . "</td>";
            echo "<td>
                   <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                       <input type='hidden' name='courseId' value='" . $row["course_id"] . "'>
                       <button type='submit' name='updateCourse'>Update</button>
                   </form>
                   <a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?deleteCourse=" . $row["course_id"] . "'>Delete</a>
               </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No courses found</td></tr>";
    }
    ?>
</table>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateCourse"])) {
    $courseId = $_POST["courseId"];
    $sql = "SELECT * FROM Course WHERE course_id=$courseId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "
           <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
               <input type='hidden' name='courseId' value='" . $row["course_id"] . "'>
               <label for='newCourseName'>New Course Name:</label>
               <input type='text' name='newCourseName' value='" . $row["course_name"] . "' required>
               <label for='newInstructorId'>New Instructor ID:</label>
               <input type='text' name='newInstructorId' value='" . $row["instructor_id"] . "' required>
               <button type='submit' name='updateCourse'>Update Course</button>
           </form>
       ";
    }
}
?>

</body>
</html>

<?php
include('db.php');
$conn->close();
?>
