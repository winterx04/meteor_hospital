<?php
include('navigation-login.php'); // Include the navigation bar
include('floating-menu.php'); // Include the floating menu
include('header.php');

if (isset($_SESSION['telemedicine_appointment'])) {
    $appointment_data = $_SESSION['telemedicine_appointment'];
    $date = $appointment_data['date'];
    $time = $appointment_data['time'];
    $specialist = $appointment_data['specialist'];
    $doctor = $appointment_data['doctor'];
    $platforms = $appointment_data['platform'];
    $payment_method = $appointment_data['payment_method'];
}

if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];

    // Store the payment method in the session
    $_SESSION['telemedicine_appointment']['payment_method'] = [
        'payment_method' => $payment_method,
    ];
}
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

    <div class="container border rounded p-4 mt-5 container-color payment-success">
        <!-- <h2>Payment Successful</h2>
        <p>Your payment has been successfully processed.</p> -->
        <h2 class="text-center mb-4">Payment Successful</h2>
        <p>Your payment with <?= $payment_method ?> has been successfully processed.</p>
        <!-- Display appointment details if needed -->
        <p>Appointment Date: <?= $date ?></p>
        <p>Appointment Time: <?= $time ?></p>
        <p>Specialist: <?= $specialist ?></p>
        <p>Doctor: <?= $doctor ?></p>
        <p>Platform(s): <?= $platforms ?></p>

        <div class="row justify-content-center">
            <div class="col-md-6 text-right">
                <p><a href="generate-invoice.php" class="btn btn-primary custom-btn"><ion-icon name="print-outline"></ion-icon> Print Receipt</a></p>
            </div>
            <div class="col-md-6 text-left">
                <a href="index_patient.php" class="btn btn-transparent custom-btn-done">Done</a>
            </div>
        </div>
    </div>
</body>

<?php
include('footer.php');
?>