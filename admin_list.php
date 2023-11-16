<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Step 2: Query the database to fetch admin information
$sql = "SELECT adminID, adminName, role FROM admins";
$result = $mysqli->query($sql);

?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">ADMINISTRATOR LIST</p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <form method="post">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Admin Name</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["adminID"] . "</td>";
                        echo "<td>" . $row["adminName"] . "</td>";
                        echo "<td>" . $row["role"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No administrator records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="container mt-3">
            <a href="add_new_admin.php" class="btn btn-primary">Add New Administrator</a>
            
        </div>
    </form>
</div>
