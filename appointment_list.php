<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">APPOINTMENT LIST</p>
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
                $delete_query = "DELETE FROM appointments WHERE appointmentID IN ($ids)";

                if ($mysqli->query($delete_query)) {
                    echo "<div class='alert alert-success'>Selected appointments DELETED successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error deleting selected appointments: " . $mysqli->error . "</div>";
                }
            }
        }
        ?>
        
        <br><br>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Issue</th>
                    <th>Status</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Query the database to fetch appointment information with doctor names, patient names, and admin names
                $sql = "SELECT a.appointmentID, p.patientName AS patientName, d.doctorName AS doctorName, a.appointmentDate, a.appointmentTime, a.appointmentType, a.issue, a.appointmentStatus
                        FROM appointments a
                        LEFT JOIN patients p ON a.patientIC = p.patientIC
                        LEFT JOIN doctors d ON a.doctorID = d.doctorID";

                $result = $mysqli->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["appointmentID"] . "</td>";
                        echo "<td>" . $row["patientName"] . "</td>";
                        echo "<td>" . $row["doctorName"] . "</td>";
                        echo "<td>" . $row["appointmentDate"] . "</td>";
                        echo "<td>" . $row["appointmentTime"] . "</td>";
                        echo "<td>" . $row["appointmentType"] . "</td>";
                        echo "<td>" . $row["issue"] . "</td>";
                        echo "<td>" . $row["appointmentStatus"] . "</td>";
                        echo "<td><input type='checkbox' name='selected_appointments[]' value='" . $row["appointmentID"] . "'></td>";
                        echo "<td><a href='appointment_edit.php?id=" . $row["appointmentID"] . "' class='btn btn-info btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?table=appointments&column=appointmentID&ID=" . $row["appointmentID"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
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