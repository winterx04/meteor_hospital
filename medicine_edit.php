<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Check if the form is submitted for updating
if (isset($_POST['update'])) {
    $id = $_POST['edit_id'];
    $medicineName = $mysqli->real_escape_string($_POST["medicineName"]);
    $price = $mysqli->real_escape_string($_POST["price"]);
    $expirationDate = $mysqli->real_escape_string($_POST["expirationDate"]);
    $description = $mysqli->real_escape_string($_POST["description"]);

    // Update the record in the database
    $update_query = "UPDATE medicine SET medicineName='$medicineName', price='$price', expirationDate='$expirationDate', description='$description' WHERE medicineID=$id";

    if ($mysqli->query($update_query) === TRUE) {
        echo "<div class='alert alert-success'>Record UPDATED successfully.</div>";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    // // Redirect back to the list page after updating
    // header("Location: medicine_list.php");
}

// Retrieve the record ID from the URL
$id = $_GET['id'];

// Query the database to get the medicine record
$sql = "SELECT * FROM medicine WHERE medicineID=$id";
$result = $mysqli->query($sql);

?>

<style>
    .custom-form {
        border: 2px solid #ccc;
        background-color: transparent;
        padding: 20px;
        border-radius: 10px;
    }
</style>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">EDIT MEDICINE RECORD</p>
        </div>
    </div>
</div>

<?php
if ($result) {
    // Display the edit form with pre-filled data
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='container mt-4'>";
        echo "<div class='row justify-content-center'>";
        echo "<div class='col-md-6'>";
        echo "<div class='card custom-form bg-light p-4 mb-5'>";
        echo "<div class='card-body'>";
        echo "<form method='post'>";
        echo "<div class='form-group'>";
        echo "Medicine ID: <input type='text' name='edit_id' value='" . $row['medicineID'] . "' readonly><br><br>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "Medicine Name: <input type='text' class='form-control' name='medicineName' value='" . $row['medicineName'] . "'><br><br>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "Price: <input type='text' class='form-control' name='price' value='" . $row['price'] . "'><br><br>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "Expiration Date: <input type='text' class='form-control' name='expirationDate' value='" . $row['expirationDate'] . "'><br><br>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "Description: <textarea class='form-control' name='description'>" . $row['description'] . "</textarea><br><br>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary' name='update'>Update</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='container mt-4'>";
        echo "<div class='alert alert-danger'>Medicine record not found.</div>";
        echo "</div>";
    }
} else {
    echo "<div class='container mt-4'>";
    echo "<div class='alert alert-danger'>Error: " . $mysqli->error . "</div>";
    echo "</div>";
}

// Close the Database Connection
$mysqli->close();
?>