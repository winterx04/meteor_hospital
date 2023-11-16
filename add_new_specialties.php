<?php
include("header.php");
include("connection.php");
include("navigation-admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $specialtyName = $_POST["specialtyName"];
    $location = $_POST["location"];


    $sql = "INSERT INTO specialties (specialtyName, location)
            VALUES (?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $specialtyName, $location);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Specialty record added successfully.</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $mysqli->error . '</div>';
    }

    $stmt->close();
}


?>

<body>
    <div class="d-flex container mt-5 mx-auto justify-content-center">
        <div class="col-md-6 my-10">
            
            <form action="add_new_specialties.php" method="POST" class="bg-light p-4">
                <h2 class="mb-3 text-center fw-bold">Add New Specialty</h2>
                <div class="form-group">
                    <label for="specialtyName">Specialty Name:</label>
                    <input type="text" class="form-control" name="specialtyName" id="specialtyName" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" name="location" id="location" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mr-3">Submit</button>
                    <button type="reset" class="btn btn-warning mr-3">Reset</button>
                </div>
            </form>
            <div class="text-end">
                <a href="specialties_list.php"><button class="btn btn-dark mt-3">Cancel</button></a>
            </div>
        </div>
    </div>
</body>
</html>