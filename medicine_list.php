<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">MEDICINE LIST</p>
        </div>
    </div>
</div>

<div class="container mt-4">
    <form method="post">
        <?php
        // Check if the form is submitted for batch deletion
        if (isset($_POST['delete_selected'])) {
            if (!empty($_POST['selected_medicines'])) {
                $selected_medicines = $_POST['selected_medicines'];
                $ids = implode(',', $selected_medicines); // Create a comma-separated list of selected medicine IDs

                // Construct the SQL query to delete the selected records
                $delete_query = "DELETE FROM medicine WHERE medicineID IN ($ids)";

                if ($mysqli->query($delete_query) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Selected medicines DELETED successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error deleting selected medicines: ' . $mysqli->error . '</div>';
                }
            }
        }

        // Close the PHP block to insert HTML
        ?>
        <br><br>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Medicine Name</th>
                    <th>Price</th>
                    <th>Expiration Date</th>
                    <th>Description</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
        <?php
        // Step 2: Query the database to fetch medicine information
        $sql = "SELECT * FROM medicine";
        $result = $mysqli->query($sql);

        if ($result) {
            // Step 3: Display Data in a Table with checkboxes
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["medicineID"] . '</td>';
                echo '<td>' . $row["medicineName"] . '</td>';
                echo '<td>' . $row["price"] . '</td>';
                echo '<td>' . $row["expirationDate"] . '</td>';
                echo '<td>' . $row["description"] . '</td>';
                echo '<td><input type="checkbox" name="selected_medicines[]" value="' . $row["medicineID"] . '"></td>';
                echo '<td><a href="medicine_edit.php?table=medicine&id=' . $row["medicineID"] . '" class="btn btn-info btn-sm">Edit</a></td>';
                echo '<td><a href="delete.php?table=medicine&column=medicineID&ID=' . $row["medicineID"] . '" class="btn btn-danger btn-sm">Delete</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<button type="submit" name="delete_selected" class="btn btn-danger">Delete Selected</button>';
        } else {
            echo '<tr><td colspan="7">No medicines found.</td></tr>';
            echo '</table>';
        }
        ?>
    </form>
</div>