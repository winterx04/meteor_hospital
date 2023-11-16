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
                <a href="index.html">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <a href="doctor_appointment.html">MAKE APPOINTMENT</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp; <span class="selected-page">Consultation Appointment</span>
            </p>
        </div>
        <div class="banner-text">
            <p class="page-title">CONSULTATION<br> APPOINTMENT</p>
            <p class="page-text">Your consultation appointment details.</p>
        </div>
    </div>

    <br>

    <div class="container border rounded p-4 mt-5 container-color">

        <div class="alert alert-success mt-4" role="alert">
            Congratulations! Your consultation appointment has been successfully booked.
        </div>

        <div class="alert alert-info" role="alert">
            <p><strong>Important Information:</strong></p>
            <li>Make sure to attend the appointment at the scheduled date and time.</li>
            <li>Prepare any relevant documents or information as requested by your healthcare provider.</li>
            <li>If you need to cancel or reschedule, please contact us at least [Cancellation/Rescheduling Notice Period] in advance.</li>

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
