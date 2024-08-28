<!DOCTYPE html>
<html>
<head>
    <title>Insert Faculty Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
			background-image: url("college2.jpg"); /* Path to your background image */
            background-repeat: no-repeat;
			width:100%;
            background-size: cover; /* Ensures the image covers the entire viewport */
            background-position: center; /* Centers the image */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input[type=text] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type=submit], input[type=reset] {
            width: 48%;
            padding: 10px;
            margin: 8px 1%;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            cursor: pointer;
        }
        input[type=reset] {
            background-color: #f44336;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Insert Faculty Details</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "niki5");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Get form data
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $designation = mysqli_real_escape_string($conn, $_POST['designation']);
            $specialisation = mysqli_real_escape_string($conn, $_POST['specialisation']);
            $registernumber = mysqli_real_escape_string($conn, $_POST['registernumber']);

            // Insert data into the table
            $sql_insert = "INSERT INTO faculty1 (id, name, designation, specialisation, registernumber)
                            VALUES ('$id', '$name', '$designation', '$specialisation', '$registernumber')";

            if (mysqli_query($conn, $sql_insert)) {
                echo "<p>Record inserted successfully.</p>";
            } else {
                echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
            }

            // Close connection
            mysqli_close($conn);
        }
        ?>

        <!-- Form to insert new data -->
        <form method="post">
            <input type="text" name="id" placeholder="Enter ID" required>
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="text" name="designation" placeholder="Enter Designation" required>
            <input type="text" name="specialisation" placeholder="Enter Specialisation" required>
            <input type="text" name="registernumber" placeholder="Enter Register Number" required>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
            <br>
            <a href="facultyvalueselect.php" style="display: inline-block; padding: 10px 20px; margin-top: 10px; background-color: #008CBA; color: white; text-decoration: none; border-radius: 4px;">View Records</a>
        </form>
    </div>
</body>
</html>
