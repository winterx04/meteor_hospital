<!-- This is the report file for admins to analyze their service based on the age group -->

<?php
include('header.php');
include("connection.php");
include('navigation-admin.php');
?>

<div class="container mt-5">
    <h2 class="mb-3 text-center fw-bold">Patient Age Group and Appointment Counts</h2>

    <!-- Toggle button to switch between table and pie chart -->
    <div class="mb-3 text-center">
        <button id="toggleTable" class="btn btn-primary">View Table</button>
        <button id="toggleChart" class="btn btn-primary">View Pie Chart</button>
    </div>

    <!-- Table view -->
    <div id="tableView">
        <?php
        $sql = "SELECT
                    CASE
                        WHEN EXTRACT(YEAR FROM CURDATE()) - EXTRACT(YEAR FROM p.patientDOB) BETWEEN 18 AND 30 THEN '18-30'
                        WHEN EXTRACT(YEAR FROM CURDATE()) - EXTRACT(YEAR FROM p.patientDOB) BETWEEN 31 AND 45 THEN '31-45'
                        WHEN EXTRACT(YEAR FROM CURDATE()) - EXTRACT(YEAR FROM p.patientDOB) BETWEEN 46 AND 60 THEN '46-60'
                        ELSE '61+'
                    END AS ageGroup,
                    (SELECT COUNT(*)
                    FROM appointments a
                    WHERE a.patientIC = p.patientIC
                    AND a.appointmentStatus = 'APPROVED') AS totalAppointments,
                    (SELECT COUNT(*)
                    FROM appointments a
                    WHERE a.patientIC = p.patientIC
                    AND a.appointmentStatus = 'APPROVED'
                    AND a.appointmentType = 'CONSULTATION') AS consultationCount,
                    (SELECT COUNT(*)
                    FROM appointments a
                    WHERE a.patientIC = p.patientIC
                    AND a.appointmentStatus = 'APPROVED'
                    AND a.appointmentType = 'HEALTH-SCREENING') AS healthScreeningCount,
                    (SELECT COUNT(*)
                    FROM appointments a
                    WHERE a.patientIC = p.patientIC
                    AND a.appointmentStatus = 'APPROVED'
                    AND a.appointmentType = 'TELEMEDICINE') AS telemedicineCount
                FROM
                    patients p
                GROUP BY ageGroup";

        $result = $mysqli->query($sql);

        if ($result) {
            echo "<table id='appointmentsTable' class='display table table-bordered table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Age Group</th>
                            <th>Total Appointments</th>
                            <th>Consultation Count</th>
                            <th>Health Screening Count</th>
                            <th>Telemedicine Count</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['ageGroup'] . "</td>
                        <td>" . $row['totalAppointments'] . "</td>
                        <td>" . $row['consultationCount'] . "</td>
                        <td>" . $row['healthScreeningCount'] . "</td>
                        <td>" . $row['telemedicineCount'] . "</td>
                    </tr>";
            }

            echo "</tbody></table>";

            // Initialize DataTables
            echo "<script>
                    $(document).ready( function () {
                        $('#appointmentsTable').DataTable();
                    });
                </script>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $mysqli->error . "</div>";
        }
        ?>
    </div>

    <!-- Pie chart view -->
    <div id="chartView" style="display: none;">
        <canvas id="appointmentChart" width="200" height="200"></canvas>

        <?php
        $sql = "SELECT
                    CASE
                        WHEN EXTRACT(YEAR FROM CURDATE()) - EXTRACT(YEAR FROM p.patientDOB) BETWEEN 18 AND 30 THEN '18-30'
                        WHEN EXTRACT(YEAR FROM CURDATE()) - EXTRACT(YEAR FROM p.patientDOB) BETWEEN 31 AND 45 THEN '31-45'
                        WHEN EXTRACT(YEAR FROM CURDATE()) - EXTRACT(YEAR FROM p.patientDOB) BETWEEN 46 AND 60 THEN '46-60'
                        ELSE '61+'
                    END AS ageGroup,
                    (SELECT COUNT(*)
                    FROM appointments a
                    WHERE a.patientIC = p.patientIC
                    AND a.appointmentStatus = 'APPROVED') AS totalAppointments
                FROM
                    patients p
                GROUP BY ageGroup";

        $result = $mysqli->query($sql);

        if ($result) {
            // Initialize arrays to store data for the chart
            $labels = [];
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $labels[] = $row['ageGroup'];
                $data[] = $row['totalAppointments'];
            }

            // Convert PHP arrays to JavaScript arrays
            $labels_json = json_encode($labels);
            $data_json = json_encode($data);

            echo "<script>
                    var ctx = document.getElementById('appointmentChart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: $labels_json,
                            datasets: [{
                                data: $data_json,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                ],
                            }],
                        },
                    });
                </script>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $mysqli->error . "</div>";
        }
        ?>
    </div>

    <script>
        // Toggle between table and pie chart views
        document.getElementById('toggleTable').addEventListener('click', function () {
            document.getElementById('tableView').style.display = 'block';
            document.getElementById('chartView').style.display = 'none';
        });

        document.getElementById('toggleChart').addEventListener('click', function () {
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('chartView').style.display = 'block';
        });
    </script>

    <?php
    // Close the database connection
    $mysqli->close();
    ?>
</div>
