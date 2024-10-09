<?php
require "fpdf184/fpdf.php";
require "connect.php";
session_start();


$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$email=$_SESSION['email'];
$sql2="select * from students_details where email='$email'";
$result2 = mysqli_query($conn, $sql2);
if (!$result2) {
    echo "Something went wrong!";
    return;
}
$details = mysqli_fetch_assoc($result2);
if (!$details) {
    echo "Something went wrong!";
    return;
}
$property_id=$details['property_id'];
$full_name=$details['firstname']. " " .$details['lastname'];
$rent=$details['rent'];
$maintainance=$rent*0.1;
$total=$details['rent']+$maintainance;
$share=$details['share'];
$ac=$details['ac'];
$months=$details['months'];
$shareac=$share." ".","." ".$ac;

$sql_1 = "SELECT *, p.id AS property_id, p.name AS property_name, c.name AS college_name 
            FROM properties p
            INNER JOIN colleges c ON p.college_id = c.id 
            WHERE p.id = $property_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$property = mysqli_fetch_assoc($result_1);
if (!$property) {
    echo "Something went wrong!";
    return;
}
$sql1="select * from properties where id=$property_id";
$result1 = mysqli_query($conn, $sql1);
if (!$result1) {
    echo "Something went wrong!";
    return;
}
$property1 = mysqli_fetch_assoc($result1);
if (!$property1) {
    echo "Something went wrong!";
    return;
}
$date= date("d/m/Y");



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Image('img/logo.jpg',30,5,150,20);
$pdf->Line(10,30,200,30);
$pdf->SetY(35);
$pdf->Cell(0,10,"Booking Details :",0,1);
$pdf->Cell(70,10,'Booking ID :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$details['booking_id'],0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(55,10,'Status :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$details['bookedornot'],0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(88,10,'Date of Booking :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$date,0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(79,10,'Sharing & AC :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$shareac,0,0,false);
$pdf->Line(10,90,200,90);
$pdf->SetY(95);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,"Hostel Details :",0,1);
$pdf->Cell(70,10,'Hostel Name :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$property1['name'],0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(55,10,'Address :',0,0,'R',false);
$pdf->SetFont('Arial','',18);
$pdf->MultiCell(0,10,$property1['address'],0,1,false);
$pdf->Line(10,160,200,160);
$pdf->SetY(165);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,"Students Details :",0,1);
$pdf->Cell(50,10,'Name :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(70,10,$full_name,0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(60,10,'Address :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->MultiCell(0,10,$details['address'],0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(51,10,'Email :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->MultiCell(0,10,$details['email'],0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(82,10,'Phone Number :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->MultiCell(0,10,$details['phones'],0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(78,10,'College Name :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->MultiCell(0,10,$details['college'],0,1,false);
$pdf->Line(10,230,200,230);
$pdf->SetY(235);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,"Payment Details :",0,1);
$pdf->Cell(70,10,'Original Price :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$rent." "."*"." ".$months." "."="." ".$rent*$months,0,1,false);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(70,10,'Maintainance :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$maintainance." "."*"." ".$months." "."="." ".$maintainance*$months,0,1,false);
$pdf->Line(25,265,135,265);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(70,10,'Total :',0,0,'R',false);
$pdf->SetFont('Arial','',20);
$pdf->Cell(0,10,$rent*$months + $maintainance*$months,0,1,false);
$pdf->Line(25,275,135,275);

$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Image('img/logo.jpg',30,5,150,20);
$pdf->Line(10,35,200,35);
$pdf->SetY(40);
$pdf->Cell(0,10,"Rules and Regulations",0,1,'C');
$pdf->MultiCell(0,10,'1. Students must keep the Campus & Rooms clean. Defacing walls, equipment, furniture etc., is strictly prohibited.',0,1,false);
$pdf->MultiCell(0,10,'2. Students must turn off all the electrical equipments & lights before leaving their rooms.',0,1,false);
$pdf->MultiCell(0,10,'3. Students are not allowed to use electric stoves, heaters etc in rooms.',0,1,false);
$pdf->MultiCell(0,10,'4. Food will be served only in the designated Dining Hall(s) and only during the specified timings. Wasting food & water will not be encouraged.',0,1,false);
$pdf->MultiCell(0,10,'5. Visitors are allowed only in AV Room between: 4:30 p.m. and 6:30 p.m. Visitors are not allowed beyond the visiting area. No outside Guest\Students will be allowed inside the hostel.',0,1,false);
$pdf->MultiCell(0,10,'6. The Management & Staff will not be responsible for personal belongings',0,1,false);
$pdf->Cell(0,13,"Note :",0,1);
$pdf->MultiCell(0,10,"These Copies should be submitted in the hostel while Joining",0,0);
$pdf->SetY(255);
$pdf->Line(15,257,75,257);
$pdf->Cell(70,20,'Signature of Owner ',0,0,'R',false);
$pdf->Line(130,257,190,257);
$pdf->Cell(120,20,'Signature of Student ',0,1,'R',false);
$pdf->Output()

?>