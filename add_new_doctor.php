<?php
include("header.php");
include("connection.php");
include("navigation-admin.php");

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorName = $_POST["doctorName"];
    $specialtyID = $_POST["specialtyID"];
    $qualifications = $_POST["qualifications"];
    $designation = $_POST["designation"];
    $officeNum = $_POST["officeNum"];
    $workDay = $_POST["workDay"];
    $officeHour = $_POST["officeHour"];

    // SQL statement to insert values obtained from the form into the 'doctors' table
    $sql = "INSERT INTO doctors (doctorName, specialtyID, qualifications, designation, officeNum, workDay, officeHour)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the INSERT statement and bind the parameters accordingly
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sisssss", $doctorName, $specialtyID, $qualifications, $designation, $officeNum, $workDay, $officeHour);

    // Execute the statement and check for successful insertion or errors
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Doctor record added successfully.</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $mysqli->error . '</div>';
    }

    // Close the statement
    $stmt->close();
}

// SQL query to select specialties to display in the select dropdown
$sql_specialties = "SELECT specialtyID, specialtyName FROM specialties";
$result_specialties = $mysqli->query($sql_specialties);
?>

<!-- HTML Content: Add New Doctor Form -->
<body>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-6 my-10">
                <form action="add_new_doctor.php" method="POST" class="bg-light p-4">
                    <h2 class="mb-3 text-center fw-bold">Add New Doctor</h2>
                    <div class="form-group">
                        <label for="doctorName">Doctor Name:</label>
                        <input type="text" class="form-control" name="doctorName" id="doctorName" required>
                    </div>
                    <div class="form-group">
                        <label for="specialtyID">Specialty:</label>
                        <select class="form-control" name="specialtyID" id="specialtyID" required>
                            <?php
                            // Loop through specialties to populate the select options
                            while ($row_specialty = $result_specialties->fetch_assoc()) {
                                echo "<option value='" . $row_specialty['specialtyID'] . "'>" . $row_specialty['specialtyName'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qualifications">Qualifications:</label>
                        <input type="text" class="form-control" name="qualifications" id="qualifications" required placeholder="EX: MBBS (UM), M Anaes (Mal)">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation:</label>
                        <input type="text" class="form-control" name="designation" id="designation" required placeholder="EX: Anesthesiologist">
                    </div>
                    <div class="form-group">
                        <label for="officeNum">Office Number:</label>
                        <input type="text" class="form-control" name="officeNum" id="officeNum" required placeholder="EX: A305">
                    </div>
                    <div class="form-group">
                        <label for="workDay">Work Day:</label>
                        <input type="text" class="form-control" name="workDay" id="workDay" required placeholder="EX: Mon - Fri">
                    </div>
                    <div class="form-group">
                        <label for="officeHour">Office Hour:</label>
                        <input type="text" class="form-control" name="officeHour" id="officeHour" required placeholder="EX: 9am - 5pm">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mr-3">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        
                    </div>
                </form>
                <div class="text-end">
                <a href="doctor_list.php"><button class="btn btn-dark mt-3 mb-5">Cancel</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
