<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">SPECIALTY LIST</p>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="container mt-3">
        <a href="add_new_specialties.php" class="btn btn-primary mb-3 ml-0">Add New Specialist</a>   
    </div>
    <form method="post">
        <?php
        // Check if the form is submitted for batch deletion
        if (isset($_POST['delete_selected'])) {
            if (!empty($_POST['selected_specialties'])) {
                $selected_specialties = $_POST['selected_specialties'];
                $ids = implode(',', $selected_specialties); // Create a comma-separated list of selected specialty IDs

                // Construct the SQL query to delete the selected records
                $delete_query = "DELETE FROM specialties WHERE specialtyID IN ($ids)";

                if ($mysqli->query($delete_query) === TRUE) {
                    echo "Selected specialties DELETED successfully.";
                } else {
                    echo "Error deleting selected specialties: " . $mysqli->error;
                }
            }
        }
        ?>
        
        <br><br>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Specialty Name</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Query the database to fetch specialty information
                $sql = "SELECT specialtyID, specialtyName FROM specialties";
                $result = $mysqli->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["specialtyID"] . "</td>";
                        echo "<td>" . $row["specialtyName"] . "</td>";
                        echo "<td><input type='checkbox' name='selected_specialties[]' value='" . $row["specialtyID"] . "'></td>";
                        echo "<td><a href='edit.php?table=specialties&id=" . $row["specialtyID"] . "' class='btn btn-info btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?table=specialties&column=specialtyID&ID=" . $row["specialtyID"] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-danger'>Error: " . $mysqli->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="container mt-3">     
            <button type='submit' class='btn btn-danger mb-5' name='delete_selected'>Delete Selected</button>
        </div>
    </form>
</div>