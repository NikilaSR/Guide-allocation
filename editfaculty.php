<!DOCTYPE html>
<html>
<head>
    <title>Edit Faculty Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
			background-image: url("college5.jpg"); /* Path to your background image */
            background-repeat: no-repeat;
			width:100%;
            background-size: cover;
            background-position: center;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            font-size: 24px;
            color: #DC143C;
            text-align: center;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type=text], input[type=submit], input[type=reset] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type=submit], input[type=reset] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        input[type=submit]:hover, input[type=reset]:hover {
            background-color: #45a049;
        }
        input[type=reset] {
            background-color: #f44336;
        }
        input[type=reset]:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <h1>UPDATE FACULTY DETAILS</h1>

    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "niki5");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_POST['id'] ?? ''; // Initialize $id to empty string if not set

    // Fetch current data based on ID if $id is set and not empty
    if (!empty($id)) {
        $sql_select = "SELECT * FROM faculty1 WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql_select);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        // Check if record with given ID exists
        if (!$row) {
            die("Record not found!");
        }

        mysqli_stmt_close($stmt);
    } else {
        // If $id is empty or not set, handle the case here (redirect or display error)
        die("No ID provided for editing!");
    }

    // Handle form submission to update record
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Retrieve form data
        $name = $_POST['m2'];
        $designation = $_POST['m3'];
        $specialisation = $_POST['m4'];
        $registernumber = $_POST['m5'];

        // SQL update statement
        $sql_update = "UPDATE faculty1 SET name=?, designation=?, specialisation=?, registernumber=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $designation, $specialisation, $registernumber, $id);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Record updated successfully!</p>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);

        // Refresh $row with updated data after successful update
        $sql_select = "SELECT * FROM faculty1 WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql_select);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
    ?>

    <!-- Edit form -->
    <div class="form-container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <input type="text" name="m2" placeholder="Enter name" value="<?php echo htmlspecialchars($row['name']); ?>"><br>
            <input type="text" name="m3" placeholder="Enter designation" value="<?php echo htmlspecialchars($row['designation']); ?>"><br>
            <input type="text" name="m4" placeholder="Enter specialisation" value="<?php echo htmlspecialchars($row['specialisation']); ?>"><br>
            <input type="text" name="m5" placeholder="Enter registernumber" value="<?php echo htmlspecialchars($row['registernumber']); ?>"><br>
            <input type="submit" name="submit" value="Update">
        </form>
    </div>
</body>
</html>
