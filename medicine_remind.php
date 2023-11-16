<?php
include('header.php');
include("connection.php");
include('navigation-admin.php');
?>

<div class="banner-appointment-list">
    <div class="col-md-8 intro">
        <div class="banner-text">
            <p class="page-title">MEDICINE STOCK</p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="mb-3 text-center fw-bold">Medicine Stock Status</h2>

    <form method="post" class="mb-3">
        <label for="quantityFilter" class="mr-2">Filter by Shipped Quantity:</label>
        <select name="quantityFilter" id="quantityFilter" class="form-control">
            <option value="0">All</option>
            <option value="5">Greater than 5</option>
            <option value="10">Greater than 10</option>
            <option value="50">Greater than 50</option>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Apply Filter</button>
        <a href="medicine_remind.php" class="btn btn-secondary mt-2">Clear Filter</a>
    </form>

    <?php
    $filterValue = isset($_POST['quantityFilter']) ? intval($_POST['quantityFilter']) : 0;

    $sql = "SELECT
            m.medicineID,
            m.medicineName,
            COALESCE(SUM(sm.quantity), 0) AS TotalQuantityShipped,
            CASE WHEN COALESCE(SUM(sm.quantity), 0) > 5 THEN 'Stock Up' ELSE 'Sufficient' END AS StockStatus
            FROM
            medicine m
            LEFT JOIN
            shippings_medicine sm ON m.medicineID = sm.medicineID
            GROUP BY
            m.medicineID, m.medicineName
            HAVING
            TotalQuantityShipped > $filterValue";

    $result = $mysqli->query($sql);

    if ($result) {
        echo "<table class='table table-bordered table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Medicine ID</th>
                        <th>Medicine Name</th>
                        <th>Total Quantity Shipped</th>
                        <th>Stock Status</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            $stockClass = $row['StockStatus'] == 'Stock Up' ? 'stock-up' : '';

            echo "<tr class='$stockClass'>
                    <td>" . $row['medicineID'] . "</td>
                    <td>" . $row['medicineName'] . "</td>
                    <td>" . $row['TotalQuantityShipped'] . "</td>
                    <td>" . $row['StockStatus'] . "</td>
                </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $mysqli->error . "</div>";
    }
    $mysqli->close();
    ?>
</div>

<style>
    .stock-up {
        background-color: #FFD700;
    }
</style>
