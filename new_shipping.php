<?php
include("header.php");
include("connection.php");
include("navigation-admin.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $telemedicineID = $mysqli->real_escape_string($_POST["telemedicineID"]);
    $shippingDate = $mysqli->real_escape_string($_POST["shippingDate"]);
    $remarks = $mysqli->real_escape_string($_POST["remarks"]);
    $shippingStatus = $mysqli->real_escape_string($_POST["shippingStatus"]);

    // You may need to validate and sanitize the input data here

    // Check if any medicines were selected
    if (isset($_POST["medicine"])) {
        $selectedMedicines = $_POST["medicine"];

        // Insert the shipping record into the database
        $shipping_insert_query = "INSERT INTO shippings (telemedicineID, shippingDate, remarks, shippingStatus)
                                 VALUES (?, ?, ?, ?)";

        $stmt_shipping = $mysqli->prepare($shipping_insert_query);
        $stmt_shipping->bind_param("isss", $telemedicineID, $shippingDate, $remarks, $shippingStatus);

        if ($stmt_shipping->execute()) {
            // Get the ID of the inserted shipping record
            $shippingId = $mysqli->insert_id;

            // Insert the selected medicines into the shipping_medicines table
            foreach ($selectedMedicines as $medicineID) {
                $medicine_insert_query = "INSERT INTO shipping_medicines (shipping_id, medicineID) VALUES (?, ?)";
                $stmt_medicine = $mysqli->prepare($medicine_insert_query);
                $stmt_medicine->bind_param("ii", $shippingId, $medicineID);

                if (!$stmt_medicine->execute()) {
                    // Handle the error if the insertion fails
                    echo "Error: " . $mysqli->error;
                }

                $stmt_medicine->close();
            }

            echo "Shipping record added successfully.";
        } else {
            // Handle the error if the insertion fails
            echo "Error: " . $mysqli->error;
        }

        $stmt_shipping->close();
    } else {
        // Handle the case where no medicines were selected
        echo "No medicines selected.";
    }
}
?>

<body>
    <div class="banner-appointment-list">
        <div class="col-md-8 intro">
            <div class="banner-text">
                <p class="page-title">Add New Shipping</p>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <form action="new_shipping.php" method="POST" enctype="multipart/form-data" class="bg-light p-4">
        <div class="form-group">
    <label for="telemedicineID">Telemedicine ID:</label>
    <select class="form-control" name="telemedicineID" id="telemedicineID">
        <?php
        // Fetch telemedicine options with patientName from the database
        $telemedicine_query = "SELECT t.telemedicineID, p.patientName
                               FROM telemedicine t
                               INNER JOIN appointments a ON t.appointmentID = a.appointmentID
                               INNER JOIN patients p ON a.patientIC = p.patientIC";

        $result_telemedicine = $mysqli->query($telemedicine_query);

        if ($result_telemedicine->num_rows > 0) {
            while ($row_telemedicine = $result_telemedicine->fetch_assoc()) {
                echo "<option value='" . $row_telemedicine['telemedicineID'] . "'>" . $row_telemedicine['patientName'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No telemedicine records found</option>";
        }
        ?>
    </select>
</div>


            <div class="form-group">
                <label for="shippingDate">Shipping Date:</label>
                <input class="form-control" type="date" name="shippingDate" id="shippingDate" required>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <textarea class="form-control" name="remarks" id="remarks" cols="20" rows="6"></textarea>
            </div>
            <div class="form-group">
                <label for="shippingStatus">Shipping Status:</label>
                <select class="form-control" name="shippingStatus" id="shippingStatus">
                    <option value="SHIPPED OUT">SHIPPED OUT</option>
                    <option value="NOT SHIPPED OUT">NOT SHIPPED OUT</option>
                    <option value="CANCEL">CANCEL</option>
                </select>
            </div>

            <br>
            <h5>Select Medicines:</h5>

            <div style="max-height: 200px; overflow-y: scroll;">
                <?php
                // Fetch medicine options from the database
                $medicine_query = "SELECT medicineID, medicineName FROM medicine";
                $result_medicines = $mysqli->query($medicine_query);

                if ($result_medicines->num_rows > 0) {
                    while ($row_medicine = $result_medicines->fetch_assoc()) {
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='checkbox' name='medicine[]' value='" . $row_medicine['medicineID'] . "' id='med" . $row_medicine['medicineID'] . "'>";
                        echo "<label class='form-check-label' for='med" . $row_medicine['medicineID'] . "'>" . $row_medicine['medicineName'] . "</label>";
                        echo "</div>";
                    }
                } else {
                    echo "No medicines found.";
                }
                ?>
            </div>

            <br>

            <div>
                <button type="submit" class="btn btn-primary mr-3">Submit</button>
                <button type="reset" class="btn btn-warning mr-3">Reset</button>
            </div>
        </form>
            <div class="text-end">
                <a href="shippings_list.php"><button class="btn btn-dark mt-3 mb-5">Cancel</button></a>
            </div>
    </div>
</body>
</html>
