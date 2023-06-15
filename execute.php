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
$task = $_SESSION['name2'];

// Fetch the existing values of the selected task
$sql = "SELECT `X-Motor`, `Y-Motor`, `Base-Motor`, `Arm1-Motor`, `Arm2-Motor`, `Tool-Motor` FROM interview WHERE TaskName='$task'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Retrieve the task values
    $row = $result->fetch_assoc();
    $X = 0;
    $Y = 0;
    $Base = 0;
    $Arm1 = 0;
    $Arm2 = 0;
    $Tool = 0;

    // For X-Motor
    echo "<h2 style='background-color: DodgerBlue; padding: 10px; color: white;'>For X-Motor:</h2>";
    echo "Original Position: $X<br>";
    $X = $row['X-Motor'];
    echo "New Position: $X<br>";
    echo "Task Name: $task<br>";
    echo "<br>";

    // For Y-Motor
    echo "<h2 style='background-color: DodgerBlue; padding: 10px; color: white;'>For Y-Motor:</h2>";
    echo "Original Position: $Y<br>";
    $Y = $row['Y-Motor'];
    echo "New Position: $Y<br>";
    echo "Task Name: $task<br>";
    echo "<br>";

    // For Base-Motor
    echo "<h2 style='background-color: DodgerBlue; padding: 10px; color: white;'>For Base-Motor:</h2>";
    echo "Original Position: $Base<br>";
    $Base = $row['Base-Motor'];
    echo "New Position: $Base<br>";
    echo "Task Name: $task<br>";
    echo "<br>";

    // For Arm1-Motor
    echo "<h2 style='background-color: DodgerBlue; padding: 10px; color: white;'>For Arm1-Motor:</h2>";
    echo "Original Position: $Arm1<br>";
    $Arm1 = $row['Arm1-Motor'];
    echo "New Position: $Arm1<br>";
    echo "Task Name: $task<br>";
    echo "<br>";

    // For Arm2-Motor
    echo "<h2 style='background-color: DodgerBlue; padding: 10px; color: white;'>For Arm2-Motor:</h2>";
    echo "Original Position: $Arm2<br>";
    $Arm2 = $row['Arm2-Motor'];
    echo "New Position: $Arm2<br>";
    echo "Task Name: $task<br>";
    echo "<br>";

    // For Tool-Motor
    echo "<h2 style='background-color: DodgerBlue; padding: 10px; color: white;'>For Tool-Motor:</h2>";
    echo "Original Position: $Tool<br>";
    $Tool = $row['Tool-Motor'];
    echo "New Position: $Tool<br>";
    echo "Task Name: $task<br>";
    echo "<br>";
} else {
    echo "No results";
}

$conn->close();
?>
