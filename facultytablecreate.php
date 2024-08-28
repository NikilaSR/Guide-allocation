<?php
$conn = mysqli_connect("localhost", "root", "", "niki5");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE  faculty1(
    id VARCHAR(10),
    name VARCHAR(20),
    designation VARCHAR(30),
    specialisation VARCHAR(35),
    registernumber VARCHAR(15)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
