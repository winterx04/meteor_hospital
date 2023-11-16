<?php
include('navigation-login.php'); // Include the navigation bar
include('floating-menu.php'); // Include the floating menu
include('header.php');
include('connection.php');
?>

    <body>
        <div class="banner-make-appointment">
            <div class="breadcrumb-div">
                <p>
                    <a href="index.html">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <a href="doctor_appointment.html">MAKE APPOINTMENT</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <span class="selected-page">Health-Screening Appointment</span>
                </p>
            </div>
            <div class="banner-text">
                <p class="page-title">HEALTH-SCREENING<br> APPOINTMENT</p>
                <p class="page-text">Your health is our priority. Book an <br> appointment or enquire with us today.</p>
            </div>
        </div>

        <br>

        <div class="container border rounded p-4 mt-5 container-color">

            <div class="alert alert-success mt-4" role="alert">
                Congratulations! Your health-screening appointment has been successfully booked with us.
            </div>

            <div class="alert alert-info" role="alert">
                <strong>Reminder:</strong> As a reminder, please make sure to attend the appointment at the scheduled date and
                time. Your health is important to us.

                <br>

                <li>Wear clothing that allows easy access to the area being screened, following any specific instructions provided by your healthcare provider

                <br>
                <br>

                <p><strong>Fasting Requirements</strong></p>
                <li>For cholesterol and lipid panels, fasting for 9-12 hours is often required.</li>
                <li>Fasting for 8 hours is typically necessary for blood glucose tests.</li>
                <li>Basic Metabolic Panel (BMP) or Comprehensive Metabolic Panel (CMP) may require fasting for 8-12 hours.</li>
                <li>Fasting for 8 hours is generally needed for Fasting Blood Sugar (FBS) tests.</li>
                <li>Follow specific fasting instructions provided by your healthcare provider for liver function tests.</li>
                <br>
            </div>

            <div class="row justify-content-center">
                <a href="index_patient.php" class="btn btn-transparent custom-btn">Done</a>
            </div>

        </div>
    </body>

<?php
include('footer.php');
?>