<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valencia_studentinfo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM Instructor";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addInstructor"])) {
    $newFirstName = $conn->real_escape_string($_POST["newFirstName"]);
    $newLastName = $conn->real_escape_string($_POST["newLastName"]);
    $newEmail = $conn->real_escape_string($_POST["newEmail"]);

    $insertSql = "INSERT INTO Instructor (first_name, last_name, email) VALUES ('$newFirstName', '$newLastName', '$newEmail')";
    $conn->query($insertSql);
    header("Location: instructor.php"); 
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateInstructor"])) {
    $instructorId = $_POST["instructorId"];
    $newFirstName = $conn->real_escape_string($_POST["newFirstName"]);
    $newLastName = $conn->real_escape_string($_POST["newLastName"]);
    $newEmail = $conn->real_escape_string($_POST["newEmail"]);

    $updateSql = "UPDATE Instructor SET first_name='$newFirstName', last_name='$newLastName', email='$newEmail' WHERE instructor_id=$instructorId";
    $conn->query($updateSql);
    header("Location: instructor.php"); 
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["deleteInstructor"])) {
    $instructorId = $_GET["deleteInstructor"];

    $deleteSql = "DELETE FROM Instructor WHERE instructor_id=$instructorId";
    $conn->query($deleteSql);
    header("Location: instructor.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h3>Instructor Management</h3>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="newFirstName">First Name:</label>
    <input type="text" name="newFirstName" required>
    <label for="newLastName">Last Name:</label>
    <input type="text" name="newLastName" required>
    <label for="newEmail">Email:</label>
    <input type="email" name="newEmail" required>
    <button type="submit" name="addInstructor">Add Instructor</button>
</form>


<table border="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["instructor_id"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>
                   <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                       <input type='hidden' name='instructorId' value='" . $row["instructor_id"] . "'>
                       <button type='submit' name='updateInstructor'>Update</button>
                   </form>
                   <a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?deleteInstructor=" . $row["instructor_id"] . "'>Delete</a>
               </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No instructors found</td></tr>";
    }
    ?>
</table>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateInstructor"])) {
    $instructorId = $_POST["instructorId"];
    $sql = "SELECT * FROM Instructor WHERE instructor_id=$instructorId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "
           <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
               <input type='hidden' name='instructorId' value='" . $row["instructor_id"] . "'>
               <label for='newFirstName'>New First Name:</label>
               <input type='text' name='newFirstName' value='" . $row["first_name"] . "' required>
               <label for='newLastName'>New Last Name:</label>
               <input type='text' name='newLastName' value='" . $row["last_name"] . "' required>
               <label for='newEmail'>New Email:</label>
               <input type='email' name='newEmail' value='" . $row["email"] . "' required>
               <button type='submit' name='updateInstructor'>Update Instructor</button>
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
