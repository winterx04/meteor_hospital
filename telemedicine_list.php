<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">TELEMEDICINE LIST</p>
        </div>
    </div>
</div>

<div class="container mt-4">
    <form method="post">
        <?php
        // Check if the form is submitted for batch deletion
        if (isset($_POST['delete_selected'])) {
            if (!empty($_POST['selected_appointments'])) {
                $selected_appointments = $_POST['selected_appointments'];
                $ids = implode(',', $selected_appointments); // Create a comma-separated list of selected appointment IDs

                // Construct the SQL query to delete the selected records (using prepared statement)
                $delete_query = "DELETE FROM telemedicine WHERE telemedicineID IN (?)";
                $stmt = $mysqli->prepare($delete_query);
                $stmt->bind_param('s', $ids);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Selected telemedicine appointments DELETED successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error deleting selected telemedicine appointments: " . $stmt->error . "</div>";
                }
                $stmt->close();
            }
        }
        ?>
        
        <br><br>
        <div class="container mt-3">
            <a href="add_new_tele.php" class="btn btn-primary mb-5 ml-0">Add New Telemedicine</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Platform Link</th>
                    <th>Fee</th>
                    <th>Telemedicine Status</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Query the database to fetch telemedicine appointment information
                $sql = "SELECT t.telemedicineID, t.appointmentID, a.appointmentDate, a.appointmentTime, p.patientName, d.doctorName, t.platformLink, t.fee, t.teleStatus
                        FROM telemedicine t
                        INNER JOIN appointments a ON t.appointmentID = a.appointmentID
                        INNER JOIN patients p ON a.patientIC = p.patientIC
                        INNER JOIN doctors d ON a.doctorID = d.doctorID
                        WHERE a.appointmentStatus = 'APPROVED'";

                $result = $mysqli->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["telemedicineID"] . "</td>";
                        echo "<td>" . $row["appointmentDate"] . "</td>";
                        echo "<td>" . $row["appointmentTime"] . "</td>";
                        echo "<td>" . $row["patientName"] . "</td>";
                        echo "<td>" . $row["doctorName"] . "</td>";
                        echo "<td>" . $row["platformLink"] . "</td>";
                        echo "<td>" . $row["fee"] . "</td>";
                        echo "<td>" . $row["teleStatus"] . "</td>";
                        echo "<td><input type='checkbox' name='selected_appointments[]' value='" . $row["telemedicineID"] . "'></td>";
                        echo "<td><a href='telemedicine_edit.php?id=" . $row["telemedicineID"] . "' class='btn btn-info btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?table=telemedicine&column=telemedicineID&ID=" . $row["telemedicineID"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-danger'>Error: " . $mysqli->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger" name="delete_selected">Delete Selected</button>
    </form>
</div>