<?php
include('connection.php');
include('navigation-login.php');
include('floating-menu.php');
include('header.php');

if(isset($_POST['donationSubmitBtn'])) {
    // Retrieve form data
    $donor = $_POST['donor'];
    $donorContact = $_POST['donorContact'];
    $donorEmail = $_POST['donorEmail'];
    $message = $_POST['message'];
    
    // Check if amount has a value
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    
    $paymentType = $_POST['paymentType'];

    // Insert the donation information into the database if amount is set
    if ($amount !== null) {
        $insertQuery = "INSERT INTO donations (donor, donorContact, donorEmail, message, amount, paymentType)
                        VALUES ('$donor', '$donorContact', '$donorEmail', '$message', '$amount', '$paymentType')";

        $result = mysqli_query($mysqli, $insertQuery);

        if ($result) {
            echo '<script>alert("Donate successfully! Thank you for your kind-hearted action.");</script>';
        } else {
            echo '<script>alert("Please try again, your donation is unsuccessful.");</script>';
        }
    } else {
        echo "Please enter a valid donation amount.";
    }
}
?>

<body>
    <div class="banner-donation">
        <div class="breadcrumb-div">
            <p>
                <a href="index_patient.php">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp;<span class="selected-page">Donation</span>
            </p>
        </div>
            
        <div class="banner-text">
            <p class="page-title">DONATION</p>
            <p class="page-text">Be a meteor donor today and help us make a difference in the lives of our patients and their families. </p>
        </div>
    </div>
    <div class="container mt-4">
        <form action="donation_details.php" method="post" enctype="multipart/form-data" class="bg-light p-4">
            <h2 class="mb-3 text-center fw-bold">Make a Donation</h2>
            
            <!-- Donor Information -->
            <div class="mb-3">
                <label for="donor" class="form-label">Name</label>
                <input type="text" class="form-control" name="donor" placeholder="Enter your name" required>
            </div>
            
            <div class="mb-3">
                <label for="donorContact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" name="donorContact" placeholder="01131441234" required>
            </div>

            <div class="mb-3">
                <label for="donorEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="donorEmail" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Enter Amount:</label>
                <input type="text" class="form-control" name="amount" placeholder="Ex: 10">
            </div>

            <div class="mb-3">
                <label for="paymentType" class="form-label">Payment Type:</label>
                <select class="form-select" name="paymentType" id="paymentType">
                    <option value="online banking">Online Banking</option>
                    <option value="TNG">TNG/e-wallet</option>
                    <option value="credit card">Credit Card</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mr-3" name="donationSubmitBtn">Submit</button>
            <button type="reset" class="btn btn-warning mr-3" name="donationResetBtn">Reset</button>
        </form>
        <div class="text-end">
            <a href="donation.php"><button class="btn btn-dark" name="donationCancelBtn">Cancel</button></a>
        </div>
    </div>
</body>

<?php include('footer.php'); ?>
