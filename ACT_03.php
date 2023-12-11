<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentinfo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["newUsername"];
    $newEmail = $_POST["newEmail"];
    $userIdToUpdate = $_POST["userIdToUpdate"];

    // Use prepared statement to prevent SQL injection
    $updateQuery = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
    $updateQuery->bind_param("ssi", $newUsername, $newEmail, $userIdToUpdate);

    if ($updateQuery->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $updateQuery->error;
    }

    // Close the prepared statement
    $updateQuery->close();
}

// Select data
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>

<h2>Update User</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="userIdToUpdate">ID:</label>
    <input type="text" name="userIdToUpdate" required>

    <label for="newUsername">Username:</label>
    <input type="text" name="newUsername" required>

    <label for="newEmail">Email:</label>
    <input type="email" name="newEmail" required>

    <input type="submit" value="Update User">
</form>

<br>

<?php
// Display current user data
if ($result->num_rows > 0) {
    echo "<h3>Current Users:</h3>";
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Username: " . $row["username"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

</body>
</html>
