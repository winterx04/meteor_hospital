<?php
// Add payment details to the CSV array
$csvData = array(
    array('Description', 'Amount'),
    array('Payment for Telemedicine', '50.00'), // Replace with actual payment details
);

$csvFile = fopen('receipt.csv', 'w');
foreach ($csvData as $row) {
    fputcsv($csvFile, $row);
}
fclose($csvFile);

// You can provide a link to download the CSV file
header("Location: receipt.csv");
?>
