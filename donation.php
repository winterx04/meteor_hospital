<?php
include('connection.php');
include('navigation-login.php');
include('floating-menu.php');
include('header.php');
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

    <br><br>


    <div class="title">
        <h1>WHY DONATE?</h1>
        <p>Ways on how your donations can make an impact.</p>
    </div>

    <div class="info-container">
        <div class="info-section">
            <img src="images/healing.png" alt="HEALING">
            <p class="donation-image-title"> HEALING LIVES </p>
            <p>Providing critical medical services, advanced treatments, and compassionate care to patients from all walks of life.</p>
        </div>

        <div class="info-section">
            <img src="images/make-a-difference.png" alt="DIFFERENCE ">
            <p class="donation-image-title"> MAKE A DIFFERENCE </p>
            <p>Your donation isn't just a financial contribution; it's a lifeline for patients and their families.</p>
        </div>

        <div class="info-section">
            <img src="images/advancing-medicine.png" alt="MEDICINE">
            <p class="donation-image-title"> ADVANCING MEDICINE </p>
            <p>To discover groundbreaking treatments, pioneer new surgical techniques, and enhance our ability to combat diseases and conditions that affect millions worldwide.</p>
        </div>
    </div>

    <div class="submit-div">
        <button type="button" class="donate-button"> <!--//onclick="makeEnquiry()" -->
        <a href="donation_details.php" style="text-decoration: none; color: white;">Donate Here</a>
        </button>
    </div>

</body>

<?php
include('footer.php');
?>