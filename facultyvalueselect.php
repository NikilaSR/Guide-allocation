<!DOCTYPE html>
<html>
<head>
    <title>View Faculty Details</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url("college3.jpg"); /* Path to your background image */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            padding: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background for table */
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
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; color: white;">FACULTY DETAILS</h1>

    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "niki5");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
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

        // Output data of each row
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
                    <form style='display: inline-block;' method='post' action='deletefaculty.php'>
                        <input type='hidden' name='id' value='".$row["id"]."'>
                        <input type='submit' name='delete' value='Delete' class='delete-btn'>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align: center; color: white;'>No records found</p>";
    }

    // Close connection
    mysqli_close($conn);
    ?>

    <!-- Link to go back to the insertion form -->
    <a href="facultyvalueinserted.php" class="button">Back to Insert</a>
</body>
</html>
