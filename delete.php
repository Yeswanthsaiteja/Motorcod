<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "motor_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$task = $_SESSION['name'];

// Delete the record from the database
$sql = "DELETE FROM interview WHERE TaskName='$task'";

if ($conn->query($sql) === TRUE) {
    $message = "Record deleted successfully";
    $messageColor = "dark";
} else {
    $message = "Error deleting record: " . $conn->error;
    $messageColor = "dark";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        h2 {
            background-color: DodgerBlue;
            color: white;
            padding: 10px;
        }

        .message {
            color: <?php echo $messageColor; ?>;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Delete Task</h2>
    <p class="message"><?php echo $message; ?></p>
</body>
</html>
