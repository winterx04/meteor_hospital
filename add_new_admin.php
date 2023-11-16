<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Use array to store the errors
$errors = [];

// Check whether the method is POST and do pattern matching using regular expressions
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Admin Name matching
    if (empty($_POST["adminName"])) {
        $errors[] = "Administrator Name is required.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $_POST["adminName"])) {
        $errors[] = "Administrator Name can only contain letters (lower and upper case).";
    }

    // Password matching
    if (empty($_POST["password"])) {
        $errors[] = "Password is required.";
    } elseif (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%^&*]{8,}$/", $_POST["password"])) {
        $errors[] = "Password must be at least 8 characters long and contain at least one letter and one number.";
    }

    // Admin ID matching
    if (empty($_POST["adminID"])) {
        $errors[] = "Admin ID is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $_POST["adminID"])) {
        $errors[] = "Admin ID can only contain letters, numbers, and underscores.";
    }

    // If there is no errors
    if (empty($errors)) {

        // Assign values to variables
        $adminName = $_POST["adminName"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
        $adminID = $_POST["adminID"];

        // SQL to insert values into database
        $sql = "INSERT INTO admins (adminName, password, adminID)
                VALUES (?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sss", $adminName, $password, $adminID);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Administrator record added successfully.</div>';
        } else {
            echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }

        $stmt->close();
    } else {
        echo '<div class="alert alert-danger"><ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul></div>';
    }
}
?>

<!-- HTML content: Add New Admin Form -->
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 my-10">
                <form action="add_new_admin.php" method="POST" class="bg-light p-4">
                    <h2 class="mb-3 text-center fw-bold">Add New Administrator</h2>
                    <div class="form-group">
                        <label for="adminID">Admin ID:</label>
                        <input type="text" class="form-control" name="adminID" id="adminID" required>
                    </div>
                    <div class="form-group">
                        <label for="adminName">Administrator Name:</label>
                        <input type="text" class="form-control" name="adminName" id="adminName" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mr-5">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
                <div class="text-end">
                    <a href="admin_list.php"><button class="btn btn-dark mt-3">Cancel</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
