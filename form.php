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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        session_start();
        $_SESSION['name'] = $_POST['tasks'];
        header("Location: delete.php");
        exit;
    } elseif (isset($_POST['modify'])) {
        session_start();
        $_SESSION['name1'] = $_POST['tasks'];
        header("Location: modify.php");
        exit;
    } elseif (isset($_POST['execute'])) {
        session_start();
        $_SESSION['name2'] = $_POST['tasks'];
        header("Location: execute.php");
        exit;
    }
}

// Fetching tasks from the database
$query = "SELECT TaskName FROM interview";
$result = mysqli_query($conn, $query);
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

$conn->close();
?>

<html>
<head>
    <style>
        h2 {
            background-color: DodgerBlue;
            color: white;
            padding: 10px;
        }
        label {
            font-weight: bold;
        }
        .button {
            background-color: DodgerBlue;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Task Library Display</h2>
    <form method="POST">
        <label for="tasks">List of tasks created thus far:</label><br>
        <select name="tasks" id="tasks">
            <?php foreach ($tasks as $task) { ?>
                <option><?php echo $task['TaskName']; ?></option>
            <?php } ?>
        </select>
        <br>
        <h2>Operation Interface</h2>
        <input type="submit" name="delete" class="button" value="Delete Task">
        <input type="submit" name="modify" class="button" value="Modify Task">
        <input type="submit" name="execute" class="button" value="Execute Task">
    </form>
</body>
</html>
