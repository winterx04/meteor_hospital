<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Check if the form is submitted for updating
if (isset($_POST['update'])) {
    $id = $_POST['edit_id'];
    $doctorName = htmlspecialchars($_POST["doctorName"]);
    $qualifications = htmlspecialchars($_POST["qualifications"]);
    $designation = htmlspecialchars($_POST["designation"]);
    $officeNum = htmlspecialchars($_POST["officeNum"]);
    $workDay = htmlspecialchars($_POST["workDay"]);
    $officeHour = htmlspecialchars($_POST["officeHour"]);
    $specialtyID = htmlspecialchars($_POST["specialtyID"]);

    // Update the record in the database
    $update_query = "UPDATE doctors SET doctorName='$doctorName', qualifications='$qualifications', designation='$designation', officeNum='$officeNum', workDay='$workDay', officeHour='$officeHour', specialtyID='$specialtyID' WHERE doctorID=$id";

    if ($mysqli->query($update_query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    // Redirect back to the list page after updating
    header("Location: doctor_list.php");
}

// Retrieve the record ID from the URL
$id = $_GET['id'];

// Query the database to get the doctor record
$sql = "SELECT * FROM doctors WHERE doctorID=$id";
$result = $mysqli->query($sql);

// Query the database to get the list of specialties
$specialtyQuery = "SELECT specialtyID, specialtyName FROM specialties";
$specialtyResult = $mysqli->query($specialtyQuery);
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
            <p class="page-title">EDIT DOCTOR RECORD</p>
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
        echo "<label for='edit_id'>Doctor ID:</label>";
        echo "<input type='text' class='form-control' id='edit_id' name='edit_id' value='" . $row['doctorID'] . "' readonly>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='doctorName'>Doctor Name:</label>";
        echo "<input type='text' class='form-control' name='doctorName' value='" . $row['doctorName'] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='qualifications'>Qualifications:</label>";
        echo "<input type='text' class='form-control' name='qualifications' value='" . $row['qualifications'] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='designation'>Designation:</label>";
        echo "<input type='text' class='form-control' name='designation' value='" . $row['designation'] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='officeNum'>Office Number:</label>";
        echo "<input type='text' class='form-control' name='officeNum' value='" . $row['officeNum'] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='workDay'>Work Day:</label>";
        echo "<input type='text' class='form-control' name='workDay' value='" . $row['workDay'] . "'>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='officeHour'>Office Hour:</label>";
        echo "<input type='text' class='form-control' name='officeHour' value='" . $row['officeHour'] . "'>";
        echo "</div>";

        // Display the specialty options retrieved from the database
        echo "<div class='form-group'>";
        echo "<label for='specialtyID'>Specialty:</label>";
        echo "<select class='form-control' name='specialtyID'>";
        while ($specialtyRow = $specialtyResult->fetch_assoc()) {
            $selected = ($specialtyRow['specialtyID'] == $row['specialtyID']) ? 'selected' : '';
            echo "<option value='" . $specialtyRow['specialtyID'] . "' $selected>" . $specialtyRow['specialtyName'] . "</option>";
        }
        echo "</select>";
        echo "</div>";

        echo "<button type='submit' class='btn btn-primary' name='update'>Update</button>";
        echo "</form>";
        echo "</div>"; // End card-body
        echo "</div>"; // End card
        echo "</div>"; // End container
        echo "<div class='container mt-4'></div>";
    } else {
        echo "<div class='alert alert-danger'>Doctor record not found.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Error: " . $mysqli->error . "</div>";
}

// Close the Database Connection
$mysqli->close();
?>