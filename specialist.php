<?php
include('navigation-login.php');
include('floating-menu.php');
include('header.php');
include('connection.php');

// Fetch data from the database
$sql = "SELECT * FROM specialties";
$result = $mysqli->query($sql);

?>

<body>
    <div class="banner-specialist">
        <div class="breadcrumb-div">
            <p>
                <a href="index_patient.html">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp;<span class="selected-page">Specialist</span>
            </p>
        </div>
            
        <div class="banner-text">
            <p class="page-title">SPECIALIST</p>
            <p class="page-text">Discover our team of dedicated specialists. Explore their expertise and services today.</p>
        </div>
    </div>

    <br><br>

    <div class="container mt-12">
        <div class="row">
            <?php
            if ($result === false) {
                // Query execution failed
                echo "Error: " . $conn->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['specialtyName']; ?></h5>
                                <p class="card-text"><?php echo $row['location']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No specialists found in the database.";
            }

            // Close the database connection if it's open
            if ($mysqli) {
                $mysqli->close();
            }
            ?>
        </div>
    </div>

</body>

<?php
include('footer.php');
?>
