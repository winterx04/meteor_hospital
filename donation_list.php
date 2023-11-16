<?php
include("connection.php");
include("header.php");
include("navigation-admin.php");

// Calculate the total donation amount
$total_donation_amount = 0; 

// Query to get the sum of donation amounts
$sum_query = "SELECT SUM(amount) AS total_amount FROM donations";
$sum_result = $mysqli->query($sum_query);

if ($sum_result && $sum_result->num_rows > 0) {
    $row = $sum_result->fetch_assoc();
    $total_donation_amount = $row['total_amount'];
}
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">DONATION LIST</p>
        </div>
    </div>
</div>

<div class="container mt-4">   
        <br><br>
        <!-- Display the total donation amount -->
        <div class="container mt-4">
            <p style="font-size: 20px;"><b>Total Donation Amount: RM </b><?php echo $total_donation_amount; ?></p>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Donor</th>
                    <th>Donor Contact</th>
                    <th>Donor Email</th>
                    <th>Amount</th>
                    <th>Payment Type</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT donationID, donor, donorContact, donorEmail, amount, paymentType, message FROM donations";

                $result = $mysqli->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["donationID"] . '</td>';
                        echo '<td>' . $row["donor"] . '</td>';
                        echo '<td>' . $row["donorContact"] . '</td>';
                        echo '<td>' . $row["donorEmail"] . '</td>';
                        echo '<td>' . $row["amount"] . '</td>';
                        echo '<td>' . $row["paymentType"] . '</td>';
                        echo '<td>' . $row["message"] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
</div>
