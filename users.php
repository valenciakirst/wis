<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valencia_studentinfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM Users";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addUser"])) {
    $newUsername = $_POST["newUsername"];
    $newPassword = $_POST["newPassword"];
    $newRole = $_POST["newRole"];

    $insertSql = "INSERT INTO Users (username, password, role) VALUES ('$newUsername', '$newPassword', '$newRole')";
    $conn->query($insertSql);
    header("Location: users.php"); 
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateUser"])) {
    $userId = $_POST["userId"];
    $newUsername = $_POST["newUsername"];
    $newPassword = $_POST["newPassword"];
    $newRole = $_POST["newRole"];

    $updateSql = "UPDATE Users SET username='$newUsername', password='$newPassword', role='$newRole' WHERE id=$userId";
    $conn->query($updateSql);
    header("Location: users.php"); 
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["deleteUser"])) {
    $userId = $_GET["deleteUser"];

    $deleteSql = "DELETE FROM Users WHERE id=$userId";
    $conn->query($deleteSql);
    header("Location: users.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h3>User Management</h3>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="newUsername">Username:</label>
    <input type="text" name="newUsername" required>
    <label for="newPassword">Password:</label>
    <input type="password" name="newPassword" required>
    <label for="newRole">Role:</label>
    <input type="text" name="newRole" required>
    <button type="submit" name="addUser">Add User</button>
</form>


<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["role"] . "</td>";
            echo "<td>
                   <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                       <input type='hidden' name='userId' value='" . $row["id"] . "'>
                       <button type='submit' name='updateUser'>Update</button>
                   </form>
                   <a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?deleteUser=" . $row["id"] . "'>Delete</a>
               </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No users found</td></tr>";
    }
    ?>
</table>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateUser"])) {
    $userId = $_POST["userId"];
    $sql = "SELECT * FROM Users WHERE id=$userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "
           <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
               <input type='hidden' name='userId' value='" . $row["id"] . "'>
               <label for='newUsername'>New Username:</label>
               <input type='text' name='newUsername' value='" . $row["username"] . "' required>
               <label for='newPassword'>New Password:</label>
               <input type='password' name='newPassword' value='" . $row["password"] . "' required>
               <label for='newRole'>New Role:</label>
               <input type='text' name='newRole' value='" . $row["role"] . "' required>
               <button type='submit' name='updateUser'>Update User</button>
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
