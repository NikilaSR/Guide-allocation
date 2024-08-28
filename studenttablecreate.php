<?php
$conn = mysqli_connect("localhost", "root", "", "niki5");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE  student(
    registernumber VARCHAR(20),
	facultyname VARCHAR(30)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
