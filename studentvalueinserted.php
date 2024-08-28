<!DOCTYPE html>
<html>
<head>
    <title>STUDENTS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
			background-image: url("college9.jpg"); /* Path to your background image */
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
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input[type=text], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type=submit], input[type=reset] {
            width: 48%;
            padding: 10px;
            margin: 8px 1%;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            background-color: #28a745;
            cursor: pointer;
        }
        input[type=reset] {
            background-color: #dc3545;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>STUDENTS</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "niki5", 3306);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Get form data
            $registernumber = mysqli_real_escape_string($conn, $_POST['registernumber']);
            $facultyname = mysqli_real_escape_string($conn, $_POST['facultyname']);

            // Insert data into the table
            $sql_insert = "INSERT INTO student (registernumber, facultyname) VALUES ('$registernumber', '$facultyname')";

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
            <input type="text" name="registernumber" placeholder="Enter Register Number" required>
            <select name="facultyname" required>
                <option value="">Select Faculty</option>
                <option value="swamydosh">Samydosh</option>
                <option value="sakthivel">Sakthivel</option>
                <option value="malini">Malini</option>
                <option value="rajeshwari">Rajeshwari</option>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
