<?php
include('navigation-login.php');
include('floating-menu.php');
include('header.php');
include('connection.php');

// Fetch data from the database
$sql = "SELECT * FROM medicine";
$result = $mysqli->query($sql);

?>

<style>
    .medicine-card {
        margin-bottom: 20px !important;
    }

    .card-body {
        padding: 20px; /* Add padding to the top and bottom of the card body */
        margin-bottom: 20px;
    }

    .medicine-spaces {
        margin-bottom: 20px;
    }

    /* .card-img-top {
        object-fit: cover;
    } */
</style>

<body>
    <div class="banner-medicine">
        <div class="breadcrumb-div">
            <p>
                <a href="index.html">HOME</a> &nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;&nbsp;<span class="selected-page">Medicine</span>
            </p>
        </div>
            
        <div class="banner-text">
            <p class="page-title">MEDICINE</p>
            <p class="page-text">Your health inventory is at your fingertips. Explore our comprehensive medicine list for your needs.</p>
        </div>
    </div>

    <br><br>

    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold">Available Medicines</h2>
        <div class="row">
            <?php
            if ($result === false) {
                // Query execution failed
                echo "Error: " . $mysqli->error;
            } elseif ($result->num_rows > 0) {
                $count = 0; // Initialize a counter
                while ($row = $result->fetch_assoc()) {
                    // Start a new row every 3 medicines
                    if ($count % 3 == 0) {
                        echo '</div><div class="row">';
                    }
                    ?>
                    <div class="col-md-4 medicine-spaces">
                        <div class="card medicine-card">
                            <div class="card-img-container">
                                <img src="images/<?php echo $row['medicineName']; ?>.png" class="card-img-top" alt="<?php echo $row['medicineName']; ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['medicineName']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
            } else {
                echo "No medicines found in the database.";
            }

            // Close the database connection if it's open
            if ($mysqli) {
                $mysqli->close();
            }
            ?>
        </div>

        <br>
    </div>

</body>

<?php
include('footer.php');
?>
