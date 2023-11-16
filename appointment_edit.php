<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Check if the form is submitted for updating
if (isset($_POST['update'])) {
    $id = $_POST['edit_id'];
    $doctorName = $mysqli->real_escape_string($_POST["doctorName"]);
    $preferredPaymentType = $mysqli->real_escape_string($_POST["preferredPaymentType"]);
    $appointmentStatus = $mysqli->real_escape_string($_POST["appointmentStatus"]);

    // Update the record in the database
    $update_query = "UPDATE appointments a
                    LEFT JOIN doctors d ON a.doctorID = d.doctorID
                    SET d.doctorName='$doctorName', a.preferredPaymentType='$preferredPaymentType', a.appointmentStatus='$appointmentStatus'
                    WHERE a.appointmentID=$id";

    if ($mysqli->query($update_query) === TRUE) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $mysqli->error . "</div>";
    }

    // // Redirect back to the list page after updating
    // header("Location: appointment_list.php");
}

// Retrieve the record ID from the URL
$id = $_GET['id'];

// Query the database to get the appointment record with the doctor's name
$sql = "SELECT a.appointmentID, d.doctorName, a.preferredPaymentType, a.appointmentStatus 
        FROM appointments a
        LEFT JOIN doctors d ON a.doctorID = d.doctorID
        WHERE a.appointmentID = $id";

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
            <p class="page-title">EDIT APPOINTMENT RECORD</p>
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
        echo "<label for='edit_id'>Appointment ID:</label>";
        echo "<input type='text' class='form-control' id='edit_id' name='edit_id' value='" . $row['appointmentID'] . "' readonly>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='doctorName'>Doctor's Name:</label>";
        echo "<select class='form-control' name='doctorName'>";
        // Fetch and display the list of doctors
        $doctorQuery = "SELECT doctorID, doctorName FROM doctors";
        $doctorResult = $mysqli->query($doctorQuery);
        while ($doctorRow = $doctorResult->fetch_assoc()) {
            $selected = ($doctorRow['doctorName'] == $row['doctorName']) ? 'selected' : '';
            echo "<option value='" . $doctorRow['doctorName'] . "' $selected>" . $doctorRow['doctorName'] . "</option>";
        }
        echo "</select>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='preferredPaymentType'>Preferred Payment Type:</label>";
        echo "<select class='form-control' name='preferredPaymentType'>";
        echo "<option value='Credit Card' " . ($row['preferredPaymentType'] === 'Credit Card' ? 'selected' : '') . ">Credit Card</option>";
        echo "<option value='Cash' " . ($row['preferredPaymentType'] === 'Cash' ? 'selected' : '') . ">Cash</option>";
        echo "<option value='Insurance' " . ($row['preferredPaymentType'] === 'Insurance' ? 'selected' : '') . ">Insurance</option>";
        echo "</select>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='appointmentStatus'>Appointment Status:</label>";
        echo "<select class='form-control' name='appointmentStatus'>";
        echo "<option value='APPROVED' " . ($row['appointmentStatus'] === 'APPROVED' ? 'selected' : '') . ">APPROVED</option>";
        echo "<option value='PENDING' " . ($row['appointmentStatus'] === 'PENDING' ? 'selected' : '') . ">PENDING</option>";
        echo "<option value='REJECT' " . ($row['appointmentStatus'] === 'REJECT' ? 'selected' : '') . ">REJECT</option>";
        echo "</select>";
        echo "</div>";

        echo "<button type='submit' class='btn btn-primary' name='update'>Update</button>";
        echo "</form>";
        echo "</div>"; // End card-body
        echo "</div>"; // End card
        echo "</div>"; // End container
    } else {
        echo "<div class='container mt-4'>";
        echo "<div class='alert alert-danger'>Appointment record not found.</div>";
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
