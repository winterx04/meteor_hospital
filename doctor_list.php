<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Check if the form is submitted for batch deletion
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['selected_doctors'])) {
        $selected_doctors = $_POST['selected_doctors'];
        $ids = implode(',', $selected_doctors); // Create a comma-separated list of selected doctor IDs

        // Construct the SQL query to delete the selected records
        $delete_query = "DELETE FROM doctors WHERE doctorID IN ($ids)";

        if ($mysqli->query($delete_query) === TRUE) {
            echo "<div class='alert alert-success'>Selected records DELETED successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting selected records: " . $mysqli->error . "</div>";
        }
    }
}

// Step 2: Query the database to fetch doctor information
$sql = "SELECT doctorID, doctorName, qualifications, designation, officeNum, workDay, officeHour, specialtyName, location
        FROM doctors
        LEFT OUTER JOIN specialties ON doctors.specialtyID = specialties.specialtyID";
$result = $mysqli->query($sql);

?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">DOCTOR LIST</p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="container mt-3">
        <a href="add_new_doctor.php" class="btn btn-primary mb-5 ml-0">Add New Doctor</a>
    </div>
    <form method="post">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Doctor Name</th>
                    <th>Qualifications</th>
                    <th>Designation</th>
                    <th>Office Number</th>
                    <th>Work Day</th>
                    <th>Office Hour</th>
                    <th>Specialty</th>
                    <th>Location</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["doctorID"] . "</td>";
                        echo "<td>" . $row["doctorName"] . "</td>";
                        echo "<td>" . $row["qualifications"] . "</td>";
                        echo "<td>" . $row["designation"] . "</td>";
                        echo "<td>" . $row["officeNum"] . "</td>";
                        echo "<td>" . $row["workDay"] . "</td>";
                        echo "<td>" . $row["officeHour"] . "</td>";
                        echo "<td>" . $row["specialtyName"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td><input type='checkbox' name='selected_doctors[]' value='" . $row["doctorID"] . "'></td>";
                        echo "<td><a href='edit.php?table=specialties&id=" . $row["doctorID"] . "' class='btn btn-info btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?table=doctors&column=doctorID&ID=" . $row["doctorID"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No doctor records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="container mt-3">
            <button type='submit' class='btn btn-danger mb-5' name='delete_selected'>Delete Selected</button>
        </div>
    </form>
</div>

