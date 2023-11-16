<?php
include('navigation-login.php'); // Include the navigation bar
include('floating-menu.php'); // Include the floating menu
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <div class="banner-make-appointment">
            <div class="breadcrumb-div">
                <p>
                    <a href="index_patient.php">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <span class="selected-page">Make Appointment</span>
                </p>
            </div>
            <div class="banner-text">
                <p class="page-title">APPOINTMENT /<br> ENQUIRY</p>
                <p class="page-text">Your health is our priority. Book an <br> appointment or enquire with us today.</p>
            </div>
        </div>

        <br>
        <br>

        <div class="container container-appointment form-step" id="step1">
            <div class="text-center-appointment">
                <div class="row choose-buttons">
                    <div class="col-md-4">
                        <div class="button-group text-center">
                            <a href="consultation_appointment.php">
                                <button class="btn-appointment">
                                    <span>
                                        <img class="before next-button" src="images/consultation-appointment.png" alt="First Appointment">
                                        <img class="after" src="images/consultation-appointment-white.png" alt="First Appointment">
                                    </span>
                                    <h5>Consultation</h5>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="button-group text-center">
                            <a href="health_screening.php">
                                <button class="btn-appointment">
                                    <span>
                                        <img class="before"src="images/health-screening-appointment.png" alt="Health Screening">
                                        <img class="after" src="images/health-screening-appointment-white.png" alt="Health Screening">
                                    </span>
                                    <h5>Health Screening</h5>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="button-group text-center">
                            <a href="telemedicine.php">
                                <button class="btn-appointment">
                                    <span>
                                        <img class="before" src="images/telemedicine-appointment.png" alt="Health Guidance">
                                        <img class="after" src="images/telemedicine-appointment-white.png" alt="Health Guidance">
                                    </span>
                                    <h5>Telemedicine</h5>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        
            <p class="note">
                <strong>Note:</strong><br>
                <em>First-visit patients:</em> Refers to patients visiting our hospital's outpatient department for the first time.<br><br>
                <em>Follow-up patients:</em> Refers to patients with a previous medical record at any of our hospital's outpatient departments.
            </p>
        </div>

        <br><br><br><br><br>
    </body>
</html>

<?php
include('footer.php');
?>