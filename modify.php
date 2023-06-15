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
$task = $_SESSION['name1'];

// Fetch the existing values of the selected task
$sql = "SELECT `X-Motor`, `Y-Motor`, `Base-Motor`, `Arm1-Motor`, `Arm2-Motor`, `Tool-Motor`, `TaskName` FROM interview WHERE TaskName='$task'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output form with pre-filled values
    $row = $result->fetch_assoc();
    $X = $row['X-Motor'];
    $Y = $row['Y-Motor'];
    $Base = $row['Base-Motor'];
    $Arm1 = $row['Arm1-Motor'];
    $Arm2 = $row['Arm2-Motor'];
    $Tool = $row['Tool-Motor'];
    $TaskName = $row['TaskName'];

    if (isset($_POST['modify'])) {
        // Getting modified values from the form
        $modifiedX = isset($_POST['X']) ? $_POST['X'] : $X;
        $modifiedY = isset($_POST['Y']) ? $_POST['Y'] : $Y;
        $modifiedBase = isset($_POST['Base']) ? $_POST['Base'] : $Base;
        $modifiedArm1 = isset($_POST['Arm1']) ? $_POST['Arm1'] : $Arm1;
        $modifiedArm2 = isset($_POST['Arm2']) ? $_POST['Arm2'] : $Arm2;
        $modifiedTool = isset($_POST['Tool']) ? $_POST['Tool'] : $Tool;
        $modifiedTaskName = isset($_POST['TaskName']) ? $_POST['TaskName'] : $TaskName;

        // Update the values in the database
        $updateSql = "UPDATE interview SET `X-Motor`='$modifiedX', `Y-Motor`='$modifiedY', `Base-Motor`='$modifiedBase', `Arm1-Motor`='$modifiedArm1', `Arm2-Motor`='$modifiedArm2', `Tool-Motor`='$modifiedTool', `TaskName`='$modifiedTaskName' WHERE TaskName='$task'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Record updated successfully";
            
            // Update the variable values for displaying in the text fields
            $X = $modifiedX;
            $Y = $modifiedY;
            $Base = $modifiedBase;
            $Arm1 = $modifiedArm1;
            $Arm2 = $modifiedArm2;
            $Tool = $modifiedTool;
            $TaskName = $modifiedTaskName;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
?>

<html>
<head>
    <style>
        h2 {
            background-color: DodgerBlue;
            padding: 10px;
            color: white;
        }
        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 200px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Modify Task</h2>
    <form method="POST">
        <label for="X">X-Motor:</label>
        <input type="text" name="X" value="<?php echo $X; ?>" placeholder="X-Motor"><br>
        <label for="Y">Y-Motor:</label>
        <input type="text" name="Y" value="<?php echo $Y; ?>" placeholder="Y-Motor"><br>
        <label for="Base">Base-Motor:</label>
        <input type="text" name="Base" value="<?php echo $Base; ?>" placeholder="Base-Motor"><br>
        <label for="Arm1">Arm1-Motor:</label>
        <input type="text" name="Arm1" value="<?php echo $Arm1; ?>" placeholder="Arm1-Motor"><br>
        <label for="Arm2">Arm2-Motor:</label>
        <input type="text" name="Arm2" value="<?php echo $Arm2; ?>" placeholder="Arm2-Motor"><br>
        <label for="Tool">Tool-Motor:</label>
        <input type="text" name="Tool" value="<?php echo $Tool; ?>" placeholder="Tool-Motor"><br>
        <label for="TaskName">TaskName:</label>
        <input type="text" name="TaskName" value="<?php echo $TaskName; ?>" placeholder="TaskName"><br>
        <input type="submit" name="modify" value="Modify">
    </form>
</body>
</html>

<?php
} else {
    echo "No results";
}

$conn->close();
?>
