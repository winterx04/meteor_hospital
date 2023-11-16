<?php
include('connection.php');
include('navigation-login.php');
include('floating-menu.php');
include('header.php');
?>

<style>
    .doctor-card {
        margin: 10px 0; /* Adds 10px margin to the top and bottom of each card */
    }

    .extended-text {
        display: none; /* Hide the extended text by default */
    }

    .show {
        display: block; /* Show the extended text when the 'show' class is present */
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

    <br><br>

    <div class="container mt-5">
        <h2 class="mb-3 text-center fw-bold">Available Doctors</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM doctors LEFT JOIN specialties ON doctors.specialtyID = specialties.specialtyID";
            $result = $mysqli->query($sql);

            if ($result === false) {
                echo "Error: " . $mysqli->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card-mb-3 doctor-card">
                            <a href="doctor_details.php?doctorID=<?php echo $row['doctorID']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['doctorName']; ?></h5>
                                    <p class="card-text">Specialty: <?php echo $row['specialtyName']; ?></p>
                                    <p class="card-text">Work Day: <?php echo $row['workDay']; ?></p>
                                    <p class="card-text">Office Hour: <?php echo $row['officeHour']; ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No doctors available.";
            }
            ?>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const readMoreLink = document.querySelector('.read-more-link');
        const moreDoctorsSection = document.getElementById('moreDoctorsSection');

        readMoreLink.addEventListener('click', function (event) {
            event.preventDefault();
            moreDoctorsSection.classList.toggle('show');
            readMoreLink.textContent = moreDoctorsSection.classList.contains('show') ? 'Show Less...' : 'Show More...';
        });
    });
</script>

<?php
include('footer.php');
?>
