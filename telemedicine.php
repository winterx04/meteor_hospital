<?php
include('navigation-login.php'); // Include the navigation bar
include('floating-menu.php'); // Include the floating menu
include('header.php');
?>

<body>
    <div class="banner-telemedicine">
        <div class="breadcrumb-div">
            <p>
                <a href="index_patient.php">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <span class="selected-page">Telemedicine</span>
            </p>
        </div>
        <div class="banner-text">
            <p class="page-title">TELEMEDICINE</p>
            <p class="page-text">Experience the future of healthcare with our Telemedicine services. <br>Schedule an appointment or reach out to us today to prioritize your health and well-being.</p>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4">Telemedicine Appointment Booking</h2>

        <div class="container border rounded p-4 mt-5 container-color">
            <form action="telemedicine-payment.php" method="post"> <!-- Updated the action to telemedicine-payment.php and method to post -->
                <div class="form-group telemedicine-form-group date-time">
                    <label class="label-telemedicine" for="datetime">Date & Time:</label>
                    <div class="row">
                        <div class="col">
                            <input class="form-control" type="text" name="date" id="date" placeholder="Select Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="time" id="time" placeholder="Select Time" onfocus="(this.type='time')" onblur="(this.type='text')">
                        </div>
                    </div>
                </div>

                <div class="form-group telemedicine-form-group">
                    <label class="label-telemedicine" for="specialist">Specialist:</label>
                    <div class="row">
                        <div class="col">
                            <select class="form-control" name="specialist" id="specialist">
                                <option value="all">All Specialists</option>
                                <option value="Anesthesiology">Anesthesiology</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="Dermatology">Dermatology</option>
                                <option value="Emergency Medicine">Emergency Medicine</option>
                                <option value="Endocrinology">Endocrinology</option>
                                <option value="Gastroenterology">Gastroenterology</option>
                                <option value="General Surgery">General Surgery</option>
                                <option value="Hematology">Hematology</option>
                                <option value="Neurology">Neurology</option>
                                <option value="Pulmonology">Pulmonology</option>
                                <option value="Radiology">Radiology</option>
                                <option value="Urology">Urology</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="doctor" id="doctor">
                                <option>Select a Doctor</option>
                                <!-- Doctors for Dermatology -->
                                <option value="Dr. Herbert Jodha" data-specialist="Dermatology">Dr. Herbert Jodha</option>
                                <option value="Dr. Mackenzie Vasey" data-specialist="Dermatology">Dr. Mackenzie Vasey</option>
                                <option value="Dr. Timothy Eggleston" data-specialist="Dermatology">Dr. Timothy Eggleston</option>
                                <option value="Dr. Willie Goudy" data-specialist="Dermatology">Dr. Willie Goudy</option>

                                <!-- Doctors for Emergency Medicine -->
                                <option value="Dr. Damian Toohey" data-specialist="Emergency Medicine">Dr. Damian Toohey</option>
                                <option value="Dr. Dora Kerkel" data-specialist="Emergency Medicine">Dr. Dora Kerkel</option>
                                <option value="Dr. Ella Serenil" data-specialist="Emergency Medicine">Dr. Ella Serenil</option>
                                <option value="Dr. Kenneth Trumper" data-specialist="Emergency Medicine">Dr. Kenneth Trumper</option>

                                <!-- Doctors for Endocrinology -->
                                <option value="Dr. Blakely Betenbaugh" data-specialist="Endocrinology">Dr. Blakely Betenbaugh</option>
                                <option value="Dr. Clyde Guhl" data-specialist="Endocrinology">Dr. Clyde Guhl</option>
                                <option value="Dr. Rodrigo Prezioso" data-specialist="Endocrinology">Dr. Rodrigo Prezioso</option>

                                <!-- Doctors for Gastroenterology -->
                                <option value="Dr. Benjamin Thompson" data-specialist="Gastroenterology">Dr. Benjamin Thompson</option>
                                <option value="Dr. Samantha Collins" data-specialist="Gastroenterology">Dr. Samantha Collins</option>

                                <!-- Doctors for General Surgery -->
                                <option value="Dr. Beverly Lulewicz" data-specialist="General Surgery">Dr. Beverly Lulewicz</option>
                                <option value="Dr. Briana Rav" data-specialist="General Surgery">Dr. Briana Rav</option>
                                <option value="Dr. Chris Hosteller" data-specialist="General Surgery">Dr. Chris Hosteller</option>
                                <option value="Dr. Cohen Lieder" data-specialist="General Surgery">Dr. Cohen Lieder</option>
                                <option value="Dr. Destiny Nicks" data-specialist="General Surgery">Dr. Destiny Nicks</option>
                                <option value="Dr. Giovanni Melcher" data-specialist="General Surgery">Dr. Giovanni Melcher</option>
                                <option value="Dr. Jessie Gelvin" data-specialist="General Surgery">Dr. Jessie Gelvin</option>
                                <option value="Dr. Lauren Shute" data-specialist="General Surgery">Dr. Lauren Shute</option>

                                <!-- Doctors for Hematology -->
                                <option value="Dr. Edwin Ligler" data-specialist="Hematology">Dr. Edwin Ligler</option>
                                <option value="Dr. Geraldine Buttrick" data-specialist="Hematology">Dr. Geraldine Buttrick</option>

                                <!-- Doctors for Neurology -->
                                <option value="Dr. Alaina Silman" data-specialist="Neurology">Dr. Alaina Silman</option>
                                <option value="Dr. John Connerstone" data-specialist="Neurology">Dr. John Connerstone</option>
                                <option value="Dr. Juliette Mccartha" data-specialist="Neurology">Dr. Juliette Mccartha</option>

                                <!-- Doctors for Pulmonology -->
                                <option value="Dr. Elmer Illas" data-specialist="Pulmonology">Dr. Elmer Illas</option>
                                <option value="Dr. Jace Morden" data-specialist="Pulmonology">Dr. Jace Morden</option>
                                <option value="Dr. Juliette Mccartha" data-specialist="Pulmonology">Dr. Juliette Mccartha</option>
                                <option value="Dr. Phillip Mcglothin" data-specialist="Pulmonology">Dr. Phillip Mcglothin</option>
                                <option value="Dr. Stephanie Frandeen" data-specialist="Pulmonology">Dr. Stephanie Frandeen</option>

                                <!-- Doctors for Radiology -->
                                <option value="Dr. Cecilia Halpert" data-specialist="Radiology">Dr. Cecilia Halpert</option>
                                <option value="Dr. Mirim Distar" data-specialist="Radiology">Dr. Mirim Distar</option>
                                <option value="Dr. Skylar Strawser" data-specialist="Radiology">Dr. Skylar Strawser</option>
                                <option value="Dr. Summer Vasile" data-specialist="Radiology">Dr. Summer Vasile</option>

                                <!-- Doctors for Urology -->
                                <option value="Dr. Corbin Fongvongsa" data-specialist="Urology">Dr. Corbin Fongvongsa</option>
                                <option value="Dr. Declan Decaen" data-specialist="Urology">Dr. Declan Decaen</option>
                                <option value="Dr. Helen Sheedy" data-specialist="Urology">Dr. Helen Sheedy</option>
                                <option value="Dr. Johnnie Safer" data-specialist="Urology">Dr. Johnnie Safer</option>
                                <option value="Dr. Rodrigo Prezioso" data-specialist="Urology">Dr. Rodrigo Prezioso</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group telemedicine-form-group">
                    <label class="label-telemedicine" for="platform"><strong>Platform:</strong></label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="zoom" name="platform[]" value="Zoom"> <!-- Added the name attribute and set it as an array to handle multiple selections -->
                        <label class="form-check-label" for="zoom">Zoom</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="skype" name="platform[]" value="Skype"> <!-- Added the name attribute and set it as an array to handle multiple selections -->
                        <label class="form-check-label" for="skype">Skype</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="microsoft-teams" name="platform[]" value="Microsoft Teams"> <!-- Added the name attribute and set it as an array to handle multiple selections -->
                        <label class="form-check-label" for="microsoft-teams">Microsoft Teams</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="google-meet" name="platform[]" value="Google Meet"> <!-- Added the name attribute and set it as an array to handle multiple selections -->
                        <label class="form-check-label" for="google-meet">Google Meet</label>
                    </div>
                </div>
                <br>

                <!-- Add a hidden field for the payment method selection -->
                <input type="hidden" name="payment_method" value="">

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary custom-btn">
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and store appointment details
    $date = $_POST['date'];
    $time = $_POST['time'];
    $specialist = $_POST['specialist'];
    $doctor = $_POST['doctor'];
    $platforms = isset($_POST['platform']) ? implode(', ', $_POST['platform']) : '';

    $_SESSION['telemedicine_appointment'] = [
        'date' => $date,
        'time' => $time,
        'specialist' => $specialist,
        'doctor' => $doctor,
        'platform' => $platforms,
    ];

    // Redirect to the payment page
    header("Location: telemedicine-payment.php");
    exit;
}

include('footer.php');
?>