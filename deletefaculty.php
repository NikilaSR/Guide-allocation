<!DOCTYPE html>
<html>
<head>
    <title>Delete Faculty Details</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("college4.jpg"); /* Background image */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            background-color: #f4f4f4; /* Fallback color */
        }
        h1 {
            font-size: 30px;
            color: #DC143C;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: 20px;
        }
        input[type="submit"], a {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            margin: 10px;
        }
        input[type="submit"] {
            background-color: #DC143C;
        }
        input[type="submit"]:hover {
            background-color: #c8102e;
        }
        a {
            background-color: #4CAF50;
            color: #fff;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>DELETE FACULTY DETAILS</h1>

        <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "niki5");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $id = $_POST['id'];

            // SQL delete statement
            $sql_delete = "DELETE FROM faculty1 WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql_delete);
            mysqli_stmt_bind_param($stmt, "s", $id);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Record deleted successfully!</p>";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        ?>

        <!-- Delete confirmation form -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_POST['id'] ?? ''); ?>">
            <p>Are you sure you want to delete this record?</p>
            <input type="submit" name="delete" value="Delete">
            <a href="facultyvalueselect.php">Cancel</a>
        </form>
    </div>
</body>
</html>
