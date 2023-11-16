<?php
session_start();

if (isset($_SESSION['telemedicine_appointment'])) {
    $appointment_data = $_SESSION['telemedicine_appointment']; // Change 'telemedicine_data' to 'telemedicine_appointment'
    $date = $appointment_data['date'];
    $time = $data['time'];
    $specialist = $data['specialist'];
    $doctor = $data['doctor'];
    $platforms = $data['platform'];
    $payment_method = $data['payment_method'];

    // Include the FPDF library
    require('fpdf/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();

    // Set background color
    $pdf->SetFillColor(233, 242, 242); // Light Blue background
    $pdf->Rect(0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'F'); // Fill the entire page with the background color

    // Insert the hospital logo
    $logoPath = 'images/meteor_logo.png'; // Replace with the actual path to your hospital logo image
    $pdf->Image($logoPath, 10, 10, 40); // Adjust the coordinates and dimensions as needed

    // Set font and font size
    $pdf->SetFont('Arial', '', 16);

    // Add invoice details
    $pdf->Cell(0, 10, 'Invoice for Telemedicine Appointment', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Telemedicine Appointment', 0, 1, 'C');
    $pdf->Cell(0, 10, '', 0, 1); // Line break
    $pdf->Cell(0, 10, 'Date: ' . $date, 0, 1);
    $pdf->Cell(0, 10, 'Time: ' . $time, 0, 1);
    $pdf->Cell(0, 10, 'Specialist: ' . $specialist, 0, 1);
    $pdf->Cell(0, 10, 'Doctor: ' . $doctor, 0, 1);
    $pdf->Cell(0, 10, 'Platform(s): ' . $platforms, 0, 1);
    $pdf->Cell(0, 10, 'Payment Method: ' . $payment_method, 0, 1); // Include payment method
    $pdf->Cell(0, 10, 'Amount Paid: RM50', 0, 1); // Include amount paid
    $pdf->Cell(0, 10, '', 0, 1); // Line break

    $pdf->Cell(0, 10, 'Thank you for scheduling your appointment!', 0, 1);

    // Output the PDF
    ob_clean();
    $pdf->Output('appointment_invoice.pdf', 'D'); // Display the PDF or save it as 'appointment_invoice.pdf'
} else {
    echo 'No appointment data available for the invoice.';
}
include('footer.php');
?>