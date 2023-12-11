<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valencia_studentinfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM Student";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addStudent"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];

    $insertSql = "INSERT INTO Student (first_name, last_name, birthdate, email) VALUES ('$firstName', '$lastName', '$birthdate', '$email')";
    $conn->query($insertSql);
    header("Location: students.php"); 
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateStudent"])) {
    $studentId = $_POST["studentId"];
    $newFirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newBirthdate = $_POST["newBirthdate"];
    $newEmail = $_POST["newEmail"];

    $updateSql = "UPDATE Student SET first_name='$newFirstName', last_name='$newLastName', birthdate='$newBirthdate', email='$newEmail' WHERE student_id=$studentId";
    $conn->query($updateSql);
    header("Location: students.php"); 
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["deleteStudent"])) {
    $studentId = $_GET["deleteStudent"];

    $deleteSql = "DELETE FROM Student WHERE student_id=$studentId";
    $conn->query($deleteSql);
    header("Location: students.php"); 
}

include('db.php');

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
</head>
<body>

<h2>Student Management</h2>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" required>
    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" required>
    <label for="birthdate">Birthdate:</label>
    <input type="date" name="birthdate" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <button type="submit" name="addStudent">Add Student</button>
</form>

<h3>Student List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birthdate</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["student_id"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["birthdate"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>
                    <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                        <input type='hidden' name='studentId' value='" . $row["student_id"] . "'>
                        <button type='submit' name='updateStudent'>Update</button>
                    </form>
                    <a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?deleteStudent=" . $row["student_id"] . "'>Delete</a>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No students found</td></tr>";
    }
    ?>
</table>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateStudent"])) {
    $studentId = $__POST["studentId"];
    $sql = "SELECT * FROM Student WHERE student_id=$studentId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "
            <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                <input type='hidden' name='studentId' value='" . $row["student_id"] . "'>
                <label for='newFirstName'>New First Name:</label>
                <input type='text' name='newFirstName' value='" . $row["first_name"] . "' required>
                <label for='newLastName'>New Last Name:</label>
                <input type='text' name='newLastName' value='" . $row["last_name"] . "' required>
                <label for='newBirthdate'>New Birthdate:</label>
                <input type='date' name='newBirthdate' value='" . $row["birthdate"] . "' required>
                <label for='newEmail'>New Email:</label>
                <input type='email' name='newEmail' value='" . $row["email"] . "' required>
                <button type='submit' name='updateStudent'>Update Student</button>
            </form>
        ";
    }
}
?>

</body>
</html>
