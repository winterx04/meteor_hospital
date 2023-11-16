<?php
include('header.php');
include('navigation-admin.php');
include("connection.php");

// // Debugging
// var_dump($_SESSION);

?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">WELCOME BACK</p>
            <p class="page-text">
                <?php
                    echo 'Welcome to the admin page, ' . $_SESSION['name'] . '!';
                ?>
            </p>
        </div>
    </div>
</div>
<br>
<div class="container mt-4">
        <br><br>
        <table class="table table-bordered table-hover">
            <h3 class="mb-3 text-center fw-bold">Appointments</h3>
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
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Query the database to fetch appointment information with doctor names, patient names, and admin names
                $sql = "SELECT a.appointmentID, p.patientName AS patientName, d.doctorName AS doctorName, a.appointmentDate, a.appointmentTime, a.appointmentType, a.issue, a.appointmentStatus
                        FROM appointments a
                        LEFT JOIN patients p ON a.patientIC = p.patientIC
                        LEFT JOIN doctors d ON a.doctorID = d.doctorID
                        LIMIT 3";

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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-danger'>Error: " . $mysqli->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
    <br><br>
    <table class="table table-bordered table-hover">
        <h3 class="mb-3 text-center fw-bold">Telemedicine</h3>
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
                        WHERE a.appointmentStatus = 'APPROVED'
                        LIMIT 3";

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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-danger'>Error: " . $mysqli->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
</div>
</div>

