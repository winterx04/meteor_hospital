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

    <div class="container border rounded p-4 mt-5 container-color">
        <h2 class="text-center mb-4">Payment Details</h2>

        <div class="text-center">
            <h3>Total Amount: <span class="text-danger font-weight-bold">$50.00</span></h3>
        </div>

        <br>
        
        <form action="payment-success.php" method="post">
            <div class="form-group telemedicine-form-group">
                <label for="payment_method" class="label-telemedicine">Select Payment Method:</label>
                <select class="form-control" name="payment_method" id="payment_method">
                    <option value="Credit Card">Credit Card</option>
                    <option value="Paypal">PayPal</option>
                </select>
            </div>

            <br>
            
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-lg custom-btn">
                    Proceed to Payment
                </button>
            </div>
        </form>
    </div>
</body>

<?php
include('footer.php');
ob_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form data is for appointment details
    if (isset($_POST['date']) && isset($_POST['time']) && isset($_POST['specialist']) && isset($_POST['doctor'])) {
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
    }

    // Check if the form data is for payment processing
    if (isset($_POST['payment_method'])) {
        $payment_method = $_POST['payment_method'];
        
        // Store the payment method in the session
        $_SESSION['telemedicine_appointment']['payment_method'] = [
            'payment_method' => $payment_method,
        ];
        
        // Redirect to payment success page
        //header("Location: payment-success.php");
        exit;
    }
}

include('footer.php');
ob_end_flush();
?>