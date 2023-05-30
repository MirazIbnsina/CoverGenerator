<?php
require('fpdf.php');

// Set up the PDF document
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Load the image and get its dimensions
$image_file = $_GET['file_name'];
$id = $_GET['id'];
list($width, $height) = getimagesize($image_file);

// Calculate the scale factor to fit the image on the page
$max_width = 210; // A4 width in mm
$max_height = 297; // A4 height in mm
$scale = min($max_width / $width, $max_height / $height);

// Calculate the position of the image on the page
$x = (210 - $width * $scale) / 2; // Center the image horizontally
$y = (297 - $height * $scale) / 2; // Center the image vertically

// Add the image to the PDF document
$pdf->Image($image_file, $x, $y, $width * $scale, $height * $scale);

// Output the PDF file for download

$pdf->Output("$id.pdf", 'D');
?>
