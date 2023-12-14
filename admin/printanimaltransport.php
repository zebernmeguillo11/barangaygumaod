<?php
session_start();
include_once("connection.php");
require_once("fpdf.php");

$sql = "SELECT * FROM tbl_doctype1 WHERE request_id = '".$_GET['id']."'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

$sql1 = "SELECT * FROM tbl_officials WHERE position_id = '1'";
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_assoc();

$sql2 = "SELECT * FROM tbl_resident WHERE resident_id = '".$row1['resident_id']."'";
$result2 = $mysqli->query($sql2);
$row2 = $result2->fetch_assoc();

$brgycapt = "HON. ".strtoupper($row2["Firstname"])." ".strtoupper(substr($row2['Middlename'], 0, 1)).". ".strtoupper($row2["Lastname"]);

$pdf= new FPDF();
$pdf->Addpage('P', 'A4', 0);
$pdf->SetMargins(25, 25, 25);

$pdf->Image('img/gumaodlogo2.png', 15, 40, 180, 180);
$pdf->SetXY(0,0);
$pdf->SetDrawColor(100, 150, 100);
$pdf->SetLineWidth(3);
$pdf->Rect(10,5, 190, 280);



$pdf->SetXY(0,5);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(210,15, 'REPUBLIC OF THE PHILIPPINES', 0,0,'C');
$pdf->Ln();
$pdf->SetXY(0,10);
$pdf->Cell(210,15, 'PROVINCE OF MISAMIS ORIENTAL', 0,0,'C');
$pdf->Ln();
$pdf->SetXY(0,15);
$pdf->Cell(210,15, 'MUNICIPALITY OF CLAVERIA', 0,0,'C');
$pdf->Ln();
$pdf->SetXY(0,20);
$pdf->Cell(210,15, 'OFFICE OF THE PUNONG BARANGAY', 0,0,'C');
$pdf->Ln();
$pdf->Image('img/gumaodlogo.png', 40, 10, -300);
$pdf->Image('img/claveria.png', 150, 10, -300);

$pdf->SetXY(0,40);
$pdf->SetFont('Times', '', 20);

$pdf->Cell(210,15, 'C E R T I F I C A T I O N', 0,0,'C');
$pdf->Ln();

$pdf->SetXY(25,60);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(210,15, 'TO WHOM IT MAY CONCERN;', 0,0,'L');
$pdf->Ln();

$pdf->SetXY(30,75);
$lettercontent = "     This is to certify that, ".$row['Firstname']." ".$row['Lastname'].", resident of  ".$row['Address']." bought ".$row['purchase_details'].".";
$pdf->Write(5, $lettercontent);
$pdf->Ln();
$pdf->SetXY(30,90);
$lettercontent2 = "     Furthermore, certifies that he is the buyer of the said livestocks stated above from herein our barangay GUMAOD, CLAVERIA MISAMIS ORIENTAL.";
$pdf->Write(5, $lettercontent2);
$pdf->Ln();

$pdf->SetXY(30,105);
$lettercontent3 = "     This certification is being issued upon the request of the above named mention for transporting the said livestocks to outside the municipality of Claveria to the ".$row['destination'].".";
$pdf->Write(5, $lettercontent3);
$pdf->Ln();

$pdf->SetXY(30,120);
$date = date_create();
$lettercontent4 = "     Done this ".date_format($date, "jS")." day of ".date_format($date, "F Y").".";
$pdf->Write(5, $lettercontent4);
$pdf->Ln();

$pdf->SetXY(30,145);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(210,15, 'NOTED BY:', 0,0,'L');
$pdf->Ln();
$pdf->SetXY(40,160);
$pdf->Cell(80,15, $brgycapt, 0,0,'C');
$pdf->Ln();
$pdf->SetXY(40,165);
$pdf->Cell(80,15, 'PUNONG BARANGAY', 0,0,'C');








$pdf->Output();

?>