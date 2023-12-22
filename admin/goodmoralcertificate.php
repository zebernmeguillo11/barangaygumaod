<?php
session_start();
include_once("connection.php");
require_once("fpdf.php");

$sql12 = "SELECT * FROM tbl_officials WHERE position_id = '1'";
$result12 = $mysqli->query($sql12);
$row12 = $result12->fetch_assoc();

$sql22 = "SELECT * FROM tbl_resident WHERE resident_id = '".$row12['resident_id']."'";
$result22 = $mysqli->query($sql22);
$row22 = $result22->fetch_assoc();

$brgycapt = "HON. ".strtoupper($row22["Firstname"])." ".strtoupper(substr($row22['Middlename'], 0, 1)).". ".strtoupper($row22["Lastname"]);

$sql = "SELECT * FROM tbl_docrequest WHERE id = '".$_GET['id']."'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

$sql1 = "SELECT * FROM tbl_resident WHERE resident_id = '".$row["resident_id"]."'";
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_assoc();

$fullname = strtoupper($row1["Firstname"])." ".strtoupper(substr($row1['Middlename'], 0, 1)).". ".strtoupper($row1["Lastname"]);

$sql2 = "SELECT * FROM tbl_familymember WHERE resident_id = '".$row["resident_id"]."'";
$result2 =  $mysqli->query($sql2);
$row2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM tbl_family WHERE houseNumber = '".$row2['houseNumber']."'";
$result3 = $mysqli->query($sql3);
$row3 = $result3->fetch_assoc();   

$fulladdress = "Zone ". $row3["purok"] ." ". " Gumaod, Claveria Misamis Oriental";

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


$pdf->Cell(210,15, 'CERTIFICATION FOR GOOD MORAL', 0,0,'C');
$pdf->Ln();

$pdf->SetXY(25,60);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(210,15, 'TO WHOM IT MAY CONCERN;', 0,0,'L');
$pdf->Ln();


$pdf->SetXY(30,75);
$lettercontent = "      This is to certify that ".$fullname.", of legal age and presently residing at ".$fulladdress.".";
$pdf->Write(5, $lettercontent);
$pdf->Ln();

$pdf->SetXY(30,90);
$lettercontent2 = "       This further certifies that base in our barangay data she having a good moral character, law abiding citizen and a god fearing person and no any derogatory record found.";
$pdf->Write(5, $lettercontent2);
$pdf->Ln();

$pdf->SetXY(30,110);
$lettercontent3 = "     This certification is being issued upon the request of the above name mention as a requirement for ".$_GET['purpose'].".";
$pdf->Write(5, $lettercontent3);
$pdf->Ln();

$pdf->SetXY(30,125);
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