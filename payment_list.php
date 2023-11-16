<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Check if the form is submitted for batch deletion
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['selected_payments'])) {
        $selected_payments = $_POST['selected_payments'];
        $ids = implode(',', $selected_payments); // Create a comma-separated list of selected payment IDs

        // Construct the SQL query to delete the selected records
        $delete_query = "DELETE FROM payments WHERE paymentID IN ($ids)";

        if ($mysqli->query($delete_query) === TRUE) {
            echo "<div class='alert alert-success'>Selected records DELETED successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting selected records: " . $mysqli->error . "</div>";
        }
    }
}

// Step 2: Query the database to fetch payment information with patientName
$sql = "SELECT payments.paymentID, patients.patientName, payments.telemedicineID, payments.amount, payments.paymentDate, payments.paymentType
        FROM payments
        INNER JOIN patients ON payments.patientIC = patients.patientIC";
$result = $mysqli->query($sql);

?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">PAYMENT LIST</p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <form method="post">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Telemedicine ID</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Payment Type</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["paymentID"] . "</td>";
                        echo "<td>" . $row["patientName"] . "</td>";
                        echo "<td>" . $row["telemedicineID"] . "</td>";
                        echo "<td>" . $row["amount"] . "</td>";
                        echo "<td>" . $row["paymentDate"] . "</td>";
                        echo "<td>" . $row["paymentType"] . "</td>";
                        // Add a checkbox for selecting records for deletion
                        echo "<td><input type='checkbox' name='selected_payments[]' value='" . $row["paymentID"] . "'></td>";
                        // You can add more action buttons as needed
                        echo "<td><a href='#' class='btn btn-info btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?table=payments&column=paymentID&ID=" . $row["paymentID"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No payment records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="container mt-3">
            <button type='submit' class='btn btn-danger mb-5' name='delete_selected'>Delete Selected</button>
        </div>
    </form>
</div>
</html>
