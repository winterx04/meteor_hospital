<?php
include('header.php');
include("connection.php");
include('navigation-admin.php');
?>

<div class="container mt-5">
    <h2 class="mb-3 text-center fw-bold">Telemedicine Appointments, Shipping, and Medicine Details</h2>

    <?php
    $sql = "SELECT
                a.patientIC,
                p.patientName,
                t.teleStatus,
                s.shippingID,
                s.shippingDate,
                s.shippingStatus,
                GROUP_CONCAT(m.medicineName ORDER BY sm.quantity SEPARATOR ', ') AS medicineNames
            FROM
                telemedicine t
            LEFT JOIN
                appointments a ON t.appointmentID = a.appointmentID
            LEFT JOIN
                shippings s ON t.telemedicineID = s.telemedicineID
            LEFT JOIN
                shippings_medicine sm ON s.shippingID = sm.shippingID
            LEFT JOIN
                medicine m ON sm.medicineID = m.medicineID
            LEFT JOIN
                patients p ON a.patientIC = p.patientIC
            GROUP BY
                a.patientIC,
                p.patientName,
                t.teleStatus,
                s.shippingID,
                s.shippingDate,
                s.shippingStatus
            ORDER BY
                a.patientIC";

    $result = $mysqli->query($sql);

    if ($result) {
        echo "<table id='telemedicineTable' class='display table table-bordered table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Patient IC</th>
                        <th>Patient Name</th>
                        <th>Telemedicine Status</th>
                        <th>Shipping ID</th>
                        <th>Shipping Date</th>
                        <th>Shipping Status</th>
                        <th>Medicine Names</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['patientIC'] . "</td>
                    <td>" . $row['patientName'] . "</td>
                    <td>" . $row['teleStatus'] . "</td>
                    <td>" . $row['shippingID'] . "</td>
                    <td>" . $row['shippingDate'] . "</td>
                    <td>" . $row['shippingStatus'] . "</td>
                    <td>" . $row['medicineNames'] . "</td>
                </tr>";
        }

        echo "</tbody></table>";

        echo "<script>
                $(document).ready( function () {
                    $('#telemedicineTable').DataTable();
                });
            </script>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $mysqli->error . "</div>";
    }
    $mysqli->close();
    ?>
</div>
