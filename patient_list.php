<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">PATIENT LIST</p>
        </div>
    </div>
</div>

<div class="container mt-4">
    <form method="post">
        <?php
        // Check if the form is submitted for batch deletion
        if (isset($_POST['delete_selected'])) {
            if (!empty($_POST['selected_patients'])) {
                $selected_patients = $_POST['selected_patients'];
                $icNumbers = implode("','", $selected_patients); // Create a comma-separated list of selected patient IC numbers

                // Construct the SQL query to delete the selected records
                $delete_query = "DELETE FROM patients WHERE patientIC IN ('$icNumbers')";

                if ($mysqli->query($delete_query) === TRUE) {
                    echo "<div class='alert alert-success'>Selected patients DELETED successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error deleting selected patients: " . $mysqli->error . "</div>";
                }
            }
        }
        ?>
        
        <br><br>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Patient IC</th>
                    <th>Patient Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Query the database to fetch patient information
                $sql = "SELECT patientIC, patientName, gender, patientDOB, patientAddress, patientContact
                        FROM patients
                        ORDER BY patientName";

                $result = $mysqli->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["patientIC"] . "</td>";
                        echo "<td>" . $row["patientName"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["patientDOB"] . "</td>";
                        echo "<td>" . $row["patientAddress"] . "</td>";
                        echo "<td>" . $row["patientContact"] . "</td>";
                        echo "<td><a href='delete.php?table=patients&column=patientIC&IC=" . $row["patientIC"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-danger'>Error: " . $mysqli->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="container mt-3">     
            <button type='submit' class='btn btn-danger mb-5' name='delete_selected'>Delete Selected</button>
        </div>
    </form>
</div>