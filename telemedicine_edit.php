<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Check if the form is submitted for updating
if (isset($_POST['update'])) {
    $id = $_POST['edit_id'];
    $platformLink = $mysqli->real_escape_string($_POST["platformLink"]);
    $fee = $mysqli->real_escape_string($_POST["fee"]);

    // Update the record in the database
    $update_query = "UPDATE telemedicine SET platformLink='$platformLink', fee='$fee' WHERE telemedicineID=$id";

    if ($mysqli->query($update_query) === TRUE) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $mysqli->error . "</div>";
    }

    // Redirect back to the list page after updating
    header("Location: telemedicine_list.php");
}

// Retrieve the record ID from the URL
$id = $_GET['id'];

// Query the database to get the telemedicine record
$sql = "SELECT t.telemedicineID, a.appointmentDate, a.appointmentTime, p.patientName, d.doctorName, t.platformLink, t.fee, t.teleStatus 
        FROM telemedicine t
        INNER JOIN appointments a ON t.appointmentID = a.appointmentID
        INNER JOIN patients p ON a.patientIC = p.patientIC
        INNER JOIN doctors d ON a.doctorID = d.doctorID
        WHERE t.telemedicineID = $id";

$result = $mysqli->query($sql);
?>

<style>
    .custom-form {
        border: 2px solid #ccc; /* Set border thickness */
        background-color: transparent; /* Remove white background */
        padding: 20px;
        border-radius: 10px; /* Add some border radius */
    }
</style>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">EDIT TELEMEDICINE RECORD</p>
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
        echo "<div class='card custom-form'>";
        echo "<div class='card-body'>";
        echo "<form method='post'>";
        echo "<div class='form-group'>";
        echo "<label for='edit_id'>Telemedicine ID:</label>";
        echo "<input type='text' class='form-control' id='edit_id' name='edit_id' value='" . $row['telemedicineID'] . "' readonly>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "Appointment Date: " . $row['appointmentDate'];
        echo "</div>";

        echo "<div class='form-group'>";
        echo "Appointment Time: " . $row['appointmentTime'];
        echo "</div>";

        echo "<div class='form-group'>";
        echo "Patient Name: " . $row['patientName'];
        echo "</div>";

        echo "<div class='form-group'>";
        echo "Doctor Name: " . $row['doctorName'];
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='platformLink'>Platform Link:</label>";
        echo "<input type='text' class='form-control' name='platformLink' value='" . $row['platformLink'] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='fee'>Fee:</label>";
        echo "<input type='text' class='form-control' name='fee' value='" . $row['fee'] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "Telemedicine Status: " . $row['teleStatus'];
        echo "</div>";

        echo "<button type='submit' class='btn btn-primary' name='update'>Update</button>";
        echo "</form>";
        echo "</div>"; // End card-body
        echo "</div>"; // End card
        echo "</div>"; // End container
    } else {
        echo "<div class='container mt-4'>";
        echo "<div class='alert alert-danger'>Telemedicine record not found.</div>";
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
