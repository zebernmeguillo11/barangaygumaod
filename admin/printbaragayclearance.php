<?php
session_start();
include_once("connection.php");
include_once("fpdf.php");

$sql11 = "SELECT * FROM tbl_officials WHERE position_id = '1'";
$result11 = $mysqli->query($sql11);
$row11 = $result11->fetch_assoc();

$sql22 = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row11['resident_id'] . "'";
$result22 = $mysqli->query($sql22);
$row22 = $result22->fetch_assoc();

$brgycapt = "HON. " . strtoupper($row22["Firstname"]) . " " . strtoupper(substr($row22['Middlename'], 0, 1)) . ". " . strtoupper($row22["Lastname"]);

$sql = "SELECT * FROM tbl_docrequest WHERE id = '" . $_GET['id'] . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

$sql1 = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row["resident_id"] . "'";
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_assoc();

$fullname = strtoupper($row1["Firstname"] . " " . $row1["Lastname"]);

$dob = new DateTime($row1['Birthdate']);
$today = new DateTime('today');
$year = $dob->diff($today)->y;

$sql2 = "SELECT * FROM tbl_familymember WHERE resident_id = '" . $row['resident_id'] . "'";
$result2 = $mysqli->query($sql2);
$row2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM tbl_family WHERE houseNumber  = '" . $row2['houseNumber'] . "'";
$result3 = $mysqli->query($sql3);
$row3 = $result3->fetch_assoc();

$poruk = "ZONE " . $row3["purok"];



$pdf = new FPDF();
$pdf->Addpage('P', 'A4', 0);
$pdf->SetMargins(55, 25, 25);

$pdf->Image('img/gumaodlogo2.png', 15, 40, 180, 180);
$pdf->SetXY(0, 0);
$pdf->SetDrawColor(100, 150, 100);
$pdf->SetLineWidth(3);
$pdf->Rect(10, 5, 190, 280);
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(68, 114, 197);


$pdf->Line(53, 6.5, 53, 284);



$pdf->SetXY(5, 15);
$pdf->SetFont('Times', '', 16);
$pdf->Cell(210, 15, 'REPUBLIC OF THE PHILIPPINES', 0, 0, 'C');
$pdf->Ln();
$pdf->SetXY(5, 20);
$pdf->Cell(210, 15, 'PROVINCE OF MISAMIS ORIENTAL', 0, 0, 'C');
$pdf->Ln();
$pdf->SetXY(5, 25);
$pdf->Cell(210, 15, 'MUNICIPALITY OF CLAVERIA', 0, 0, 'C');
$pdf->Ln();
$pdf->SetXY(5, 30);
$pdf->Cell(210, 15, 'BARANGAY GUMAOD', 0, 0, 'C');
$pdf->Ln();
$pdf->SetXY(0, 35);
$pdf->Cell(210, 15, '', 0, 0, 'C');
$pdf->Ln();
$pdf->Image('img/gumaodlogo.png', 12, 10, -150);
$pdf->Image('img/claveria.png', 160, 12, -150);

$pdf->SetXY(5, 55);
$pdf->SetFont('Times', '', 16);

$pdf->Cell(220, 15, 'OFFICE OF THE SANGGUNIANG BARANGAY', 0, 0, 'C');
$pdf->Ln();

$pdf->SetXY(5, 65);
$pdf->SetFont('Helvetica', 'I', 13);
$pdf->SetTextColor(0, 176, 80);

$pdf->Cell(210, 15, 'BARANGAY CLEARANCE', 0, 0, 'C');
$pdf->Ln();

$pdf->SetXY(55, 80);
$pdf->SetFont('Helvetica', 'I', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(210, 15, 'To whom it may concern;', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 95);
$lettercontent = "    This is to certify that  the name stated below shows that he/she had no derogatory record in Our barangay and a law abiding citizen and god fearing person in our Community. ";
$pdf->Write(5, $lettercontent);
$pdf->Ln();

$pdf->SetXY(55, 110);
$pdf->SetFont('Helvetica', 'B', 10);

$pdf->SetTextColor(0, 32, 146);
$pdf->Cell(210, 15, 'NAME:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 115);
$pdf->Cell(210, 15, 'AGE:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 120);
$pdf->Cell(210, 15, 'ADDRESS:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 125);
$pdf->Cell(210, 15, 'YEARS/MONTH OF STAY:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 130);
$pdf->Cell(210, 15, 'REASON FOR STAY:', 0, 0, 'L');
$pdf->Ln();


$pdf->SetXY(55, 135);
$pdf->Cell(210, 15, 'STATUS:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 140);
$pdf->Cell(210, 15, 'BIRTHDATE:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 145);
$pdf->Cell(210, 15, 'BIRTHPLACE: ', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 150);
$pdf->Cell(210, 15, 'HUSBAND/WIFE:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 155);
$pdf->Cell(210, 15, 'PARENTS:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 160);
$pdf->Cell(210, 15, 'BIRTHMARK:', 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 165);
$pdf->Cell(210, 15, 'PLACE OF ORIGIN:', 0, 0, 'L');
$pdf->Ln();


$pdf->SetXY(70, 110);
$pdf->SetTextColor(0, 176, 80);
$pdf->Cell(210, 15, $fullname, 0, 0, 'L');
$pdf->Ln();


$pdf->SetXY(70, 115);
$pdf->Cell(210, 15, strtoupper($year." years old"), 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(75, 120);
$pdf->Cell(210, 15, $poruk."GUMAOD CLAVERIA", 0, 0, 'L');
$pdf->Ln();

$query = "SELECT * FROM tbl_doctype2 WHERE request_id = '".$_GET['id']."'";
$resultquery = $mysqli->query($query);
$rowquery = $resultquery->fetch_assoc();

$pdf->SetXY(100, 125);
$pdf->Cell(210, 15,strtoupper($rowquery["time_of_stay"]), 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(92, 130);
$pdf->Cell(210, 15,strtoupper($rowquery["reason"]), 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(73, 135);
$pdf->Cell(210, 15,strtoupper($row22["m_status"]), 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(78, 140);
$date = date_create($row22["Birthdate"]);
$pdf->Cell(210, 15,strtoupper(date_format($date, "M d, Y")), 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(82, 145);
$pdf->Cell(210, 15,strtoupper($rowquery["bplace"]), 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(85, 150);
$pdf->Cell(210, 15,strtoupper($rowquery["spouse"]), 0, 0, 'L');
$pdf->Ln();


$pdf->SetXY(75, 155);
$pdf->Cell(210, 15,strtoupper($rowquery["parents"]), 0, 0, 'L');
$pdf->Ln();


$pdf->SetXY(80, 160);
$pdf->Cell(210, 15,strtoupper($rowquery["bmark"]), 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(90, 165);
$pdf->Cell(210, 15,"GUMAOD", 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 180);
$pdf->SetFont('Helvetica', 'I', 10);
$pdf->SetTextColor(0, 0, 0);
$lettercontent = "This certification is being issued upon the request of the above name stated ".strtoupper($rowquery["purpose"]).".";
$pdf->Write(5, $lettercontent);
$pdf->Ln();

$pdf->SetXY(55, 195);
$date = date_create();
$lettercontent4 = "Given this " . date_format($date, "jS") . " day of " . date_format($date, "F Y") . ".";
$pdf->Write(5, $lettercontent4);
$pdf->Ln();


$pdf->SetXY(55, 200);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(210, 15,"Certified by:", 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 210);
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->SetTextColor(0, 176, 80);
$pdf->Cell(100, 15,$brgycapt, 0, 0, 'C');
$pdf->Ln();

$pdf->SetXY(55, 215);
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->SetTextColor(0, 176, 80);
$pdf->Cell(100, 15,"Punong Barangay", 0, 0, 'C');
$pdf->Ln();

$pdf->SetXY(55, 225);
$pdf->SetFont('Helvetica', '', 9);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(100, 15,"O.R #  _____-____", 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(145, 225);
$pdf->Cell(100, 15," ________________________", 0, 0, 'L');
$pdf->Ln();
$pdf->SetXY(145, 230);
$pdf->Cell(100, 15," Signature requesting person", 0, 0, 'c');
$pdf->Ln();

$pdf->SetXY(55, 230);
$pdf->Cell(100, 15,"CTC #   _______________", 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(55, 235);
$pdf->Cell(100, 15,"ISSUED AT:", 0, 0, 'L');
$pdf->Ln();
$pdf->SetXY(55, 240);
$pdf->Cell(100, 15,"ISSUED ON:", 0, 0, 'L');
$pdf->Ln();

$date1 = new DateTime('now');
$date1->modify('+6 month'); // or you can use '-90 day' for deduct
$date1 = $date1->format('m-d-Y');


$pdf->SetXY(70, 255);
$pdf->SetFont('Times', '', 9);

$pdf->Cell(80, 15, 'Note: This barangay Clearance valid until '. $date1." and based on what purpose stated.", 0, 0, 'C');
$pdf->Ln();


$pdf->SetXY(12, 50);
$pdf->SetFont('Helvetica', 'I', 8);
$pdf->SetTextColor(0, 176, 240);
$pdf->Cell(80, 15, "BARANGAY GUMAOD", 0, 0, 'L');

$pdf->SetXY(12, 55);
$pdf->Cell(80, 15, "BARANGAY OFFICIALS", 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(12, 65);
$pdf->Cell(80, 15, $brgycapt, 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(12, 70);
$pdf->Cell(80, 15, "PUNONG BARANGAY", 0, 0, 'L');
$pdf->Ln();


$pdf->SetXY(12, 80);
$pdf->Cell(80, 15, "SANGGUNIANG", 0, 0, 'L');
$pdf->Ln();

$pdf->SetXY(12, 85);
$pdf->Cell(80, 15, "BARANGAY MEMBERS", 0, 0, 'L');
$pdf->Ln();

$sql12 = "SELECT * FROM tbl_officials WHERE position_id = '3'";
$result12 = $mysqli->query($sql12);
$startline = 95;

while ($row12 = $result12->fetch_assoc()) {

    $sql23 = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row12['resident_id'] . "'";
    $result22 = $mysqli->query($sql23);
    $row22 = $result22->fetch_assoc();

    $kagawad = "HON. " . strtoupper($row22["Firstname"]) . " " . strtoupper(substr($row22['Middlename'], 0, 1)) . ". " . strtoupper($row22["Lastname"]);
    $pdf->SetXY(12, $startline);
    $pdf->Cell(80, 15, $kagawad, 0, 0, 'L');
    $pdf->Ln();

$startline += 10;

}

$sql6 = "SELECT * FROM tbl_officials WHERE position_id = '6'";
$result6 = $mysqli->query($sql6);
$row6= $result6->fetch_assoc();

$sql7 = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row6['resident_id'] . "'";
$result7 = $mysqli->query($sql7);
$row7 = $result7->fetch_assoc();

$pdf->SetXY(12, $startline);
$pdf->Cell(80, 15, "S.K. CHAIRPERSON", 0, 0, 'L');
$pdf->Ln();
$startline += 5;


$skchair = strtoupper($row7["Firstname"]) . " " . strtoupper(substr($row7['Middlename'], 0, 1)) . ". " . strtoupper($row7["Lastname"]);
$pdf->SetXY(12, $startline);
$pdf->Cell(80, 15, $skchair, 0, 0, 'L');
$pdf->Ln();
$startline += 10;

$sql6a = "SELECT * FROM tbl_officials WHERE position_id = '5'";
$result6a = $mysqli->query($sql6a);
$row6a= $result6a->fetch_assoc();

$sql7a = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row6a['resident_id'] . "'";
$result7a = $mysqli->query($sql7a);
$row7a = $result7a->fetch_assoc();

$tres = strtoupper($row7a["Firstname"]) . " " . strtoupper(substr($row7a['Middlename'], 0, 1)) . ". " . strtoupper($row7a["Lastname"]);
$pdf->SetXY(12, $startline);
$pdf->Cell(80, 15, $tres, 0, 0, 'L');
$pdf->Ln();
$startline += 5;

$pdf->SetXY(12, $startline);
$pdf->Cell(80, 15, "BARANGAY TREASURER", 0, 0, 'L');
$pdf->Ln();
$startline += 10;

$sql6b = "SELECT * FROM tbl_officials WHERE position_id = '5'";
$result6b = $mysqli->query($sql6b);
$row6b= $result6b->fetch_assoc();

$sql7b = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row6b['resident_id'] . "'";
$result7b = $mysqli->query($sql7b);
$row7b = $result7b->fetch_assoc();

$tres = strtoupper($row7b["Firstname"]) . " " . strtoupper(substr($row7b['Middlename'], 0, 1)) . ". " . strtoupper($row7b["Lastname"]);
$pdf->SetXY(12, $startline);
$pdf->Cell(80, 15, $tres, 0, 0, 'L');
$pdf->Ln();
$startline += 5;

$pdf->SetXY(12, $startline);
$pdf->Cell(80, 15, "BARANGAY SECRETARY", 0, 0, 'L');
$pdf->Ln();
$startline += 10;





$pdf->Output();

?>