<?php
include("connection.php");
session_start();

// Check the method used
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check whether the variable isset
    if (isset($_POST['IC_ID']) && isset($_POST['password']) && isset($_POST['role'])) {

        // Retrieve data from form and validate them
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $ICID = validate($_POST['IC_ID']);
        $pass = validate($_POST['password']);
        $type = validate($_POST['role']);

        // Check the ICID and password is not empty
        if (empty($ICID) || empty($pass)) {
            header("Location: login.php?error=Username and password are required");
            exit();
        } else {
            if ($type == 'admin') {
                $table = "admins";
                $icIdColumn = "adminID";
            } else {
                $table = "patients";
                $icIdColumn = "patientIC";
            }

            $stmt = $mysqli->prepare("SELECT * FROM $table WHERE $icIdColumn = ? AND password = ?");
            $stmt->bind_param("ss", $ICID, $pass);
            $stmt->execute();
            $result = $stmt->get_result();


            // Fetch result from database and compare them
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();

                $_SESSION["${type}IC"] = $row[$icIdColumn];

                if ($type == 'admin') {
                    $_SESSION["name"] = $row["adminName"];
                    $_SESSION["id"] = $row["adminID"];
                } else {
                    // If it's a patient table, update the column names accordingly
                    $_SESSION["name"] = $row["patientName"];
                    $_SESSION["id"] = $row["patientIC"];
                }

                // Check if "Remember me" is checked
                if (isset($_POST['remember'])) {
                    // Set a cookie to remember the user for, say, 30 days (adjust as needed)
                    setcookie('remember_me', '1', time() + (30 * 24 * 60 * 60), '/'); // 30 days
                }

                // Different type of user leads to different index page
                if ($type == 'admin') {
                    header("Location: index_admin.php");
                    exit();
                } else {
                    header("Location: index_patient.php");
                    exit();
                }
            } else {
                header("Location: login.php?error=Incorrect User IC/ID or password");
                exit();
            }
        }
    } else {
        header("Location: login.php");
        exit();
    }
}
?>
