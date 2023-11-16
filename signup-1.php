<?php
include("header.php");
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize and validate input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve and validate input values
    $IC = test_input($_POST["IC"]);
    $fullName = test_input($_POST["fullName"]);
    $password = password_hash(test_input($_POST["password"]), PASSWORD_BCRYPT);
    $DOB = test_input($_POST["DOB"]);
    $gender = test_input($_POST["gender"]);
    $email = test_input($_POST["email"]);
    $address = test_input($_POST["address"]);
    $contactNum = test_input($_POST["contactNum"]);

    // Validate IC format (12 digits)
    if (!preg_match("/^\d{12}$/", $IC)) {
        echo "Invalid IC format. IC must contain 12 digits without symbols or characters.";
        exit;
    }

    // Validate Full Name format (only letters and spaces)
    if (!preg_match("/^[A-Za-z\s]*$/", $fullName)) {
        echo "Invalid Full Name format. Full Name cannot contain numbers or special characters.";
        exit;
    }

    // Validate Password format (8-20 characters, at least one lowercase, one uppercase, one number, and one special character)
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,20}$/", $_POST["password"])) {
        echo "Invalid Password format. Password must be 8-20 characters and contain at least one lowercase letter, one uppercase letter, one number, and one special character.";
        exit;
    }

    // Validate Email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email format.";
        exit;
    }

    // Perform database check for existing IC
    $sqlCheckIC = "SELECT * FROM patients WHERE patientIC = ?";
    $stmtCheckIC = $mysqli->prepare($sqlCheckIC);
    $stmtCheckIC->bind_param("s", $IC);

    if ($stmtCheckIC->execute()) {
        $resultCheckIC = $stmtCheckIC->get_result();

        if ($resultCheckIC->num_rows > 0) {
            echo "IC already in use. Please choose a different IC.";
            exit;
        } else {
            // Insert new patient data into the database
            $sqlInsert = "INSERT INTO patients (patientIC, patientName, password, patientDOB, gender, patientEmail, patientAddress, patientContact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtInsert = $mysqli->prepare($sqlInsert);

            if ($stmtInsert) {
                $stmtInsert->bind_param("ssssssss", $IC, $fullName, $password, $DOB, $gender, $email, $address, $contactNum);

                if ($stmtInsert->execute()) {
                    // Redirect to login.php
                    header("Location: login.php");
                    exit;
                } else {
                    echo "Error: " . $stmtInsert->error;
                    exit;
                }
            } else {
                echo "Error: " . $mysqli->error;
                exit;
            }
        }
    } else {
        echo "Error: " . $stmtCheckIC->error;
        exit;
    }
}
?>



<section class="section-signup">
    <div class="form-box-sign-up">
        <div class="form-value">
        <form action="signup-1.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
                <h2>Sign Up</h2>

                <!-- Patient IC -->
                <div class="inputbox">
                    <input type="text" name="IC" id="IC" maxlength="12" required>
                    <label for="IC">IC</label>
                </div>

                <!-- Patient Full Name -->
                <div class="inputbox">
                    <input type="text" name="fullName" id="fullName" required>
                    <label for="fullName">Full Name</label>
                </div>

                <!-- Password -->
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>

                <!-- Date of Birth -->
                <div class="inputbox">
                    <input type="date" name="DOB" id="DOB" required>
                    <label for="DOB">Date of Birth</label>
                </div>

                <!-- Gender -->
                <div class="role-selection">
                    <p>Gender:</p>
                    <div class="role-options">
                        <label>
                            <input type="radio" name="gender" value="Male" checked>
                            <span class="checkmark"></span>
                            Male
                        </label>

                        <label>
                            <input type="radio" name="gender" value="Female">
                            <span class="checkmark"></span>
                            Female
                        </label>
                    </div>
                </div>

                <!-- Patient Email -->
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>
                </div>

                <!-- Patient Address -->
                <div class="inputbox">
                    <input type="text" name="address" id="address" required>
                    <label for="address">Address</label>
                </div>

                <!-- Patient Contact -->
                <div class="inputbox">
                    <input type="text" name="contactNum" id="contactNum" required>
                    <label for="contactNum">Contact Number</label>
                </div>

                <button type="submit">Sign Up</button>

                <div class="register">
                    <p>Already have an account? <a href="login.php">Log In</a></p>
                </div>
            </form>
            <br>
            <a href="index.php"><button>Back to Home Page</button></a>
        </div>
    </div>
</section>

<script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
<script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>

<!-- <script>
    function validateForm() {
        // Validate IC
        var ic = document.getElementById("IC").value;
        if (!/^\d{12}$/.test(ic)) {
            alert("IC must contain 12 digits without symbols or characters.");
            return false;
        }

        // Validate Full Name
        var fullName = document.getElementById("fullName").value;
        if (!/^[A-Za-z\s]*$/.test(fullName)) {
            alert("Full Name cannot contain numbers or special characters.");
            return false;
        }

        // Validate Password
        var password = document.getElementById("password").value;
        if (!/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,20}$/.test(password)) {
            alert("Password must be 8-20 characters and contain at least one lowercase letter, one uppercase letter, one number, and one special character.");
            return false;
        }

        // Validate Email
        var email = document.getElementById("email").value;
        if (!/^\S+@\S+\.\S+$/.test(email)) {
            alert("Invalid email address.");
            return false;
        }

        // // Validate Contact Number
        // var contactNum = document.getElementById("contactNum").value;
        // if (!/^\d{3}-\d{7}$/.test(contactNum) && !/^\d{12}$/.test(contactNum)) {
        //     alert("Contact Number must be in XXX-XXXXXXX or XXXXXXXXXXX format.");
        //     return false;
        // }

        return true;
    }
</script> -->