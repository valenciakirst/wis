<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h2>Student Information System</h2>


<div class = "topnav">
    <a href="dashboard.php?page=students">Students</a>
    <a href="dashboard.php?page=users">Users</a>
    <a href="dashboard.php?page=course">Courses</a>
    <a href="dashboard.php?page=instructor">Instructors</a>
</div>


<div id="content">
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $filename = $page . '.php';

        if (file_exists($filename)) {
            include($filename);
        } else {
            echo "Page not found.";
        }
    } else {
        echo "Welcome to the Dashboard!";
    }
    ?>
</div>

</body>
</html>
