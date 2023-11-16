<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Check if the form is submitted for batch deletion
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['selected_shippings'])) {
        $selected_shippings = $_POST['selected_shippings'];
        $ids = implode(',', $selected_shippings); // Create a comma-separated list of selected shipping IDs

        // Construct the SQL query to delete the selected records
        $delete_query = "DELETE FROM shippings WHERE shippingID IN ($ids)";

        if ($mysqli->query($delete_query) === TRUE) {
            echo "<div class='alert alert-success'>Selected records DELETED successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting selected records: " . $mysqli->error . "</div>";
        }
    }
}

// Step 2: Query the database to fetch shipping information with medicines and quantities
$sql = "SELECT s.shippingID, s.telemedicineID, s.shippingDate, s.remarks, s.shippingStatus,
               GROUP_CONCAT(CONCAT(m.medicineName, ' (', sm.quantity, ')') SEPARATOR ', ') AS medicines
        FROM shippings s
        LEFT JOIN shippings_medicine sm ON s.shippingID = sm.shippingID
        LEFT JOIN medicine m ON sm.medicineID = m.medicineID
        GROUP BY s.shippingID";

$result = $mysqli->query($sql);
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">SHIPPING LIST</p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="container mt-3">
        <a href="new_shipping.php" class="btn btn-primary mb-5 ml-0">Add New Shipping</a>
    </div>
    <form method="post">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Telemedicine ID</th>
                    <th>Shipping Date</th>
                    <th>Remarks</th>
                    <th>Shipping Status</th>
                    <th>Medicines</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["shippingID"] . "</td>";
                        echo "<td>" . $row["telemedicineID"] . "</td>";
                        echo "<td>" . $row["shippingDate"] . "</td>";
                        echo "<td>" . $row["remarks"] . "</td>";
                        echo "<td>" . $row["shippingStatus"] . "</td>";
                        echo "<td>" . $row["medicines"] . "</td>";
                        // Add a checkbox for selecting records for deletion
                        echo "<td><input type='checkbox' name='selected_shippings[]' value='" . $row["shippingID"] . "'></td>";
                        echo "<td><a href='delete.php?table=shippings&column=shippingID&ID=" . $row["shippingID"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No shipping records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="container mt-3">
            <button type='submit' class='btn btn-danger mb-5' name='delete_selected'>Delete Selected</button>
        </div>
    </form>
</div>
