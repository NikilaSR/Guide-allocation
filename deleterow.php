<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "niki5");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if delete button is clicked and if an ID is provided
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // SQL to delete a record
    $sql = "DELETE FROM faculty1 WHERE id = 21?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

