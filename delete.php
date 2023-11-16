<?php
session_start();

// Check if the form is submitted for deleting
if (!empty($_GET) && isset($_GET['table']) && isset($_GET['column']) && isset($_GET['ID'])) {
    include('connection.php');

    $table = validate($_GET['table']);
    $column = validate($_GET['column']);
    $ID = validate($_GET['ID']);

    // Construct the SQL query to delete a record
    $delete_query = "DELETE FROM $table WHERE $column='$ID'";

    if ($mysqli->query($delete_query) === TRUE) {
        echo "<div class='alert alert-success'>Data DELETED successfully.</div>";
    } else {
        echo "Error deleting data: " . $mysqli->error;
    }

    // Redirect back to the previous page after deleting
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    echo "Invalid request.";
}

// Function to validate and sanitize data
function validate($data) {
    global $mysqli; // Access the database connection
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    // Additional validation if needed

    return mysqli_real_escape_string($mysqli, $data);
}
