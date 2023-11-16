<?php
include("header.php");
include("connection.php");
include("navigation-admin.php");

$errors = []; // Array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the form data
    $appointmentID = $mysqli->real_escape_string($_POST["appointmentID"]);
    $platformLink = $mysqli->real_escape_string($_POST["platformLink"]);
    $fee = $mysqli->real_escape_string($_POST["fee"]);
    $teleStatus = $mysqli->real_escape_string($_POST["teleStatus"]);

    if (!empty($platformLink) && !filter_var($platformLink, FILTER_VALIDATE_URL)) {
        $errors[] = "Platform Link is not a valid URL.";
    }

    // Add validation for fee (you can customize the regex pattern as needed)
    if (empty($fee)) {
        $errors[] = "Fee is required.";
    } elseif (!is_numeric($fee) || $fee <= 0) {
        $errors[] = "Fee must be a positive numeric value.";
    }

    // Add validation for teleStatus (you can customize the allowed values as needed)
    $allowedTeleStatus = ["COMPLETED", "UNCOMPLETED", "CANCEL"];
    if (empty($teleStatus) || !in_array($teleStatus, $allowedTeleStatus)) {
        $errors[] = "Invalid Telemedicine Status.";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        $telemedicine_insert_query = "INSERT INTO telemedicine (appointmentID, platformLink, fee, teleStatus)
                                      VALUES ('$appointmentID', '$platformLink', '$fee', '$teleStatus')";

        if ($mysqli->query($telemedicine_insert_query)) {
            echo '<div class="alert alert-success">Telemedicine record added successfully.</div>';
        } else {
            echo "Error: " . $mysqli->error;
        }
    } else {
        // Display validation errors
        echo '<div class="alert alert-danger"><ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul></div>';
    }
}
?>

<body>
    <div class="banner-appointment-list">
        <div class="col-md-8 intro">
            <div class="banner-text">
                <p class="page-title">Add New Telemedicine</p>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <form action="add_new_tele.php" method="POST" enctype="multipart/form-data" class="bg-light p-4">
            <div class="form-group">
                <label for="appointmentID">Appointment ID:</label>
                <select class="form-control" name="appointmentID" id="appointmentID">
                    <?php
                    $appointment_query = "SELECT a.appointmentID, a.patientIC, p.patientName FROM appointments a
                                        INNER JOIN patients p ON a.patientIC = p.patientIC WHERE appointmentType = 'TELEMEDICINE'";
                    $result_appointments = $mysqli->query($appointment_query);

                    if ($result_appointments->num_rows > 0) {
                        while ($row_appointment = $result_appointments->fetch_assoc()) {
                            echo "<option value='" . $row_appointment['appointmentID'] . "'>" . $row_appointment['appointmentID'] . " - " . $row_appointment['patientIC'] . " - " . $row_appointment['patientName'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No appointments found</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="platformLink">Platform Link:</label>
                <input class="form-control" type="text" name="platformLink" id="platformLink">
            </div>
            <div class="form-group">
                <label for="fee">Fee:</label>
                <input class="form-control" type="text" name="fee" id="fee" required>
            </div>
            <div class="form-group">
                <label for="teleStatus">Telemedicine Status:</label>
                <select class="form-control" name="teleStatus" id="teleStatus">
                    <option value="COMPLETED">COMPLETED</option>
                    <option value="UNCOMPLETED">UNCOMPLETED</option>
                    <option value="CANCEL">CANCEL</option>
                </select>
            </div>

            <div>
                <button type="submit" class="btn btn-primary mr-3">Submit</button>
                <button type="reset" class="btn btn-warning mr-3">Reset</button>
            </div>
        </form>
        <div class="text-end">
            <a href="telemedicine_list.php"><button class="btn btn-dark mt-3 mb-5">Cancel</button></a>
        </div>
    </div>
</body>
</html>
