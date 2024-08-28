<!DOCTYPE html>
<html>
<head>
    <title>Faculty Details</title>
    <style>
        * {
            box-sizing: border-box;
        }
        input[type=text] {
            width: 40%;
            padding: 12px 3px;
            margin: 8px;
            display: inline-block;
            border-color: black;
            background: #483D8B;
            border-radius: 15px 50px 30px 5px;
            border-style: solid;
            font-size: 20px;
            color: black;
        }
        input[type=submit], input[type=reset] {
            width: 20%;
            padding: 12px 3px;
            margin: 8px;
            display: inline-block;
            border-color: black;
            background: green;
            border-radius: 15px 50px 30px 5px;
            border-style: solid;
            font-size: 20px;
            color: white;
        }
        h1 {
            font-size: 30px;
            color: #DC143C;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #483D8B;
            color: white;
        }
        .edit-btn, .delete-btn {
            background-color: #DC143C;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Faculty Details</h1>

    <!-- Form to insert new data -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <td><input type="text" name="m1" placeholder="Enter id"></td>
            </tr>
            <tr>
                <td><input type="text" name="m2" placeholder="Enter name"></td>
            </tr>
            <tr>
                <td><input type="text" name="m3" placeholder="Enter designation"></td>
            </tr>
            <tr>
                <td><input type="text" name="m4" placeholder="Enter specialisation"></td>
            </tr>
            <tr>
                <td><input type="text" name="m5" placeholder="Enter registernumber"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "niki5");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission to insert new record
        if (isset($_POST['submit'])) {
            $id = $_POST['m1'];
            $name = $_POST['m2'];
            $designation = $_POST['m3'];
            $specialisation = $_POST['m4'];
            $registernumber = $_POST['m5'];

            // Prepare SQL insert statement
            $sql_insert = "INSERT INTO faculty1 (id, name, designation, specialisation, registernumber) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql_insert);
            mysqli_stmt_bind_param($stmt, "sssss", $id, $name, $designation, $specialisation, $registernumber);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Record inserted successfully!</p>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        }

        // Handle delete operation
        if (isset($_POST['delete'])) {
            $id = $_POST['id'];

            // Prepare SQL delete statement
            $sql_delete = "DELETE FROM faculty1 WHERE id = ?";
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
    }

    // Select all records from faculty1 table
    $sql_select = "SELECT * FROM faculty1";
    $result = mysqli_query($conn, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Specialisation</th>
                    <th>Register Number</th>
                    <th>Action</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["designation"]."</td>";
            echo "<td>".$row["specialisation"]."</td>";
            echo "<td>".$row["registernumber"]."</td>";
            echo "<td>
                    <form style='display: inline-block;' method='post' action='editfaculty.php'>
                        <input type='hidden' name='id' value='".$row["id"]."'>
                        <input type='submit' name='edit' value='Edit' class='edit-btn'>
                    </form>
                    <form style='display: inline-block;' method='post' action='".$_SERVER['PHP_SELF']."'>
                        <input type='hidden' name='id' value='".$row["id"]."'>
                        <input type='submit' name='delete' value='Delete' class='delete-btn'>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No records found</p>";
    }

    // Close connection
    mysqli_close($conn);
    ?>

</body>
</html>
