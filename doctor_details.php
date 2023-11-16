<?php
include('connection.php');
include('navigation-login.php');
include('floating-menu.php');
include('header.php');
?>

<style>
    .card {
        max-height: 450px; /* Set a maximum height for the card */
        overflow-y: auto; /* Add a scrollbar if the content exceeds the max height */
        max-width: 750px;
    }

    .card-title {
        font-size: 24px; /* Adjust the font size for the card title */
    }

    .card-text {
        font-size: 18px; /* Adjust the font size for card text */
    }

    .btn {
        font-size: 18px; /* Adjust the font size for buttons */
    }
    .card-body {
        padding-left: 80px;
        padding-top: 50px;
    }
</style>

<body>
    <div class="banner-doctors">
        <div class="breadcrumb-div">
            <p>
                <a href="index.html">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp;<span class="selected-page">Doctors</span>
            </p>
        </div>

        <div class="banner-text">
            <p class="page-title">DOCTORS</p>
            <p class="page-text">Meet our experienced team of doctors. Your health is our priority, and our doctors are here to help you.</p>
        </div>
    </div>

    <br>

<?php
if (isset($_GET['doctorID'])) {
    $doctorID = $_GET['doctorID'];

    $sql = "SELECT * FROM doctors LEFT JOIN specialties ON doctors.specialtyID = specialties.specialtyID WHERE doctorID = $doctorID";
    $result = $mysqli->query($sql);

    if ($result === false) {
        echo "Error: " . $mysqli->error;
    } elseif ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        ?>
        <div class="container mt-5">
            <h2 class="mb-3 text-center fw-bold">Doctor Details</h2>
            <div class="card mx-auto">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $doctor['doctorName']; ?></h5>
                    <br>
                    <p class="card-text"><strong>Specialty:</strong> <?php echo $doctor['specialtyName']; ?></p>
                    <p class="card-text"><strong>Qualifications:</strong> <?php echo $doctor['qualifications']; ?></p>
                    <p class="card-text"><strong>Designation:</strong> <?php echo $doctor['designation']; ?></p>
                    <p class="card-text"><strong>Office Number:</strong> <?php echo $doctor['officeNum']; ?></p>
                    <p class="card-text"><strong>Work Day:</strong> <?php echo $doctor['workDay']; ?></p>
                    <p class="card-text"><strong>Office Hour:</strong> <?php echo $doctor['officeHour']; ?></p>
                </div>
            </div>

            <div class="text-center">
                <!-- Make Appointment Button -->
                <a href="make-appointment.php?doctorID=<?php echo $doctor['doctorID']; ?>" class="btn btn-primary custom-btn">Make Appointment</a>

                <!-- Back Button -->
                <a href="javascript:history.go(-1);" class="btn btn-secondary custom-btn-done">Back</a>
            </div>
        </div>
        <?php
    } else {
        echo "Doctor not found.";
    }
} else {
    echo "Invalid request. Please specify a doctorID.";
}

if ($mysqli) {
    $mysqli->close();
}

include('footer.php');
?>
