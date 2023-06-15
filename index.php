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

// Array to hold the error messages for each motor
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Getting all values from the HTML form
    $X = $_POST['X'];
    $Y = $_POST['Y'];
    $Base = $_POST['Base'];
    $Arm1 = $_POST['Arm1'];
    $Arm2 = $_POST['Arm2'];
    $Tool = $_POST['Tool'];
    $TaskName = $_POST['TaskName'];

    // Validating motor values as integers
    if (!empty($X) && !is_numeric($X)) {
        $errors['X'] = "Enter absolute value only";
    }
    if (!empty($Y) && !is_numeric($Y)) {
        $errors['Y'] = "Enter absolute value only";
    }
    if (!empty($Base) && !is_numeric($Base)) {
        $errors['Base'] = "Enter absolute value only";
    }
    if (!empty($Arm1) && !is_numeric($Arm1)) {
        $errors['Arm1'] = "Enter absolute value only";
    }
    if (!empty($Arm2) && !is_numeric($Arm2)) {
        $errors['Arm2'] = "Enter absolute value only";
    }
    if (!empty($Tool) && !is_numeric($Tool)) {
        $errors['Tool'] = "Enter absolute value only";
    }

    // Check if any motor values contain string values
    if ((!empty($X) && !ctype_digit($X)) || (!empty($Y) && !ctype_digit($Y)) || (!empty($Base) && !ctype_digit($Base)) ||
        (!empty($Arm1) && !ctype_digit($Arm1)) || (!empty($Arm2) && !ctype_digit($Arm2)) || (!empty($Tool) && !ctype_digit($Tool))) {
        $errors['motorValues'] = "Motor values should be integers";
    }

    // Check if there are any errors
    if (count($errors) === 0) {
        // Inserting values into the database
        $sql = "INSERT INTO interview (`X-Motor`, `Y-Motor`, `Base-Motor`, `Arm1-Motor`, `Arm2-Motor`, `Tool-Motor`, `TaskName`)
                VALUES ('$X', '$Y', '$Base', '$Arm1', '$Arm2', '$Tool', '$TaskName')";
        $result = $conn->query($sql);

        if ($result) {
            echo "Task created successfully!";
            header("Location: form.php");
            exit;
        } else {
            echo "Error creating task: " . $conn->error;
        }
    }
}

$conn->close();
?>

<html>
<head>
</head>
<body>
    <h2 style="background-color:DodgerBlue;color:white;">Task Creation Form<br></h2>
    <p>First value should be the absolute value. If not specified, leave it blank.</p>
    <style>
        th, td {
            padding: 5px;
            spacing: 5px;
        }
        .commaSeparated input[type="submit"] {
            background-color: DodgerBlue;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
    <div class="commaSeparated">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                <tr>
                    <th>Motor-Name</th>
                    <th>Moves</th>
                    <th>Test</th>
                </tr>
                <tr>
                    <td>X-Motor</td>
                    <td><input type="text" name="X" id="X" value="<?php echo isset($_POST['X']) ? $_POST['X'] : ''; ?>"></td>
                    <td><button>X-Motor</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php if (!empty($errors['X'])) { ?><span style="color: red;"><?php echo $errors['X']; ?></span><?php } ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Y-Motor</td>
                    <td><input type="text" name="Y" id="Y" value="<?php echo isset($_POST['Y']) ? $_POST['Y'] : ''; ?>"></td>
                    <td><button>Y-Motor</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php if (!empty($errors['Y'])) { ?><span style="color: red;"><?php echo $errors['Y']; ?></span><?php } ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Base-Motor</td>
                    <td><input type="text" name="Base" id="Base" value="<?php echo isset($_POST['Base']) ? $_POST['Base'] : ''; ?>"></td>
                    <td><button>Base-Motor</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php if (!empty($errors['Base'])) { ?><span style="color: red;"><?php echo $errors['Base']; ?></span><?php } ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Arm1-Motor</td>
                    <td><input type="text" name="Arm1" id="Arm1" value="<?php echo isset($_POST['Arm1']) ? $_POST['Arm1'] : ''; ?>"></td>
                    <td><button>Arm1-Motor</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php if (!empty($errors['Arm1'])) { ?><span style="color: red;"><?php echo $errors['Arm1']; ?></span><?php } ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Arm2-Motor</td>
                    <td><input type="text" name="Arm2" id="Arm2" value="<?php echo isset($_POST['Arm2']) ? $_POST['Arm2'] : ''; ?>"></td>
                    <td><button>Arm2-Motor</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php if (!empty($errors['Arm2'])) { ?><span style="color: red;"><?php echo $errors['Arm2']; ?></span><?php } ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tool-Motor</td>
                    <td><input type="text" name="Tool" id="Tool" value="<?php echo isset($_POST['Tool']) ? $_POST['Tool'] : ''; ?>"></td>
                    <td><button>Tool-Motor</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php if (!empty($errors['Tool'])) { ?><span style="color: red;"><?php echo $errors['Tool']; ?></span><?php } ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>TaskName-here</td>
                    <td><input type="text" name="TaskName" id="TaskName" value="<?php echo isset($_POST['TaskName']) ? $_POST['TaskName'] : ''; ?>"></td>
                    <td><input type="submit" value="Create Task"></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php if (isset($errors['motorValues'])) { ?>
                        <p style="color: red;"><?php echo $errors['motorValues']; ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
