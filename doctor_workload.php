<?php
include('header.php');
include("connection.php");
include('navigation-admin.php');
?>

<div class="container mt-5">
    <h2 class="mb-3 text-center fw-bold">Doctor Workload</h2>

    <?php
    $sql = "SELECT
                doctorName,
                s.specialtyName,
                COALESCE(SUM(CASE WHEN appointmentType = 'CONSULTATION' THEN 1 ELSE 0 END), 0) AS Consultation,
                COALESCE(SUM(CASE WHEN appointmentType = 'HEALTH-SCREENING' THEN 1 ELSE 0 END), 0) AS HealthScreening,
                COALESCE(SUM(CASE WHEN appointmentType = 'TELEMEDICINE' THEN 1 ELSE 0 END), 0) AS Telemedicine
            FROM (
                SELECT
                    d.doctorName,
                    d.specialtyID,
                    a.appointmentType
                FROM
                    doctors d
                LEFT JOIN
                    appointments a ON d.doctorID = a.doctorID
            ) doctorData
            JOIN specialties s ON doctorData.specialtyID = s.specialtyID
            GROUP BY doctorName, s.specialtyName
            ORDER BY doctorName, s.specialtyName";

    $result = $mysqli->query($sql);

    if ($result) {
        echo "<table id='doctorWorkloadTable' class='display table table-bordered table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Specialty</th>
                        <th>Consultation</th>
                        <th>Health Screening</th>
                        <th>Telemedicine</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['doctorName'] . "</td>
                    <td>" . $row['specialtyName'] . "</td>
                    <td>" . $row['Consultation'] . "</td>
                    <td>" . $row['HealthScreening'] . "</td>
                    <td>" . $row['Telemedicine'] . "</td>
                </tr>";
        }

        echo "</tbody></table>";

        // Initialize DataTables
        echo "<script>
                $(document).ready( function () {
                    $('#doctorWorkloadTable').DataTable();
                });
            </script>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $mysqli->error . "</div>";
    }

    // Close the database connection
    $mysqli->close();
    ?>
</div>
