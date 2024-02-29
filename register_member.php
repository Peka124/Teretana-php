<?php

require_once "config.php";
require_once "fpdf/fpdf.php";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $email=$_POST["email"];
    $phone_number=$_POST["phone_number"];
    $photo_path=$_POST["photo_path"];
    $training_plan_id=$_POST["training_plan_id"];
    $trainer_id=0;
    $access_card_pdf="";
}

$upit="INSERT INTO members (first_name, last_name, email, phone_number, photo_path, training_plan_id, trainer_id, access_card_pdf_path)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$run=$konekcija->prepare($upit);
$run->bind_param("sssssiis", $first_name, $last_name, $email, $phone_number, $photo_path, $training_plan_id, $trainer_id, $access_card_pdf);
$run->execute();

$member_id=$konekcija->insert_id;

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(40, 10, "Access Card");
$pdf->Ln();
$pdf->Cell(40, 10, "Member ID: " . $member_id);
$pdf->Ln();
$pdf->Cell(40, 10, "Name: " . $first_name . " " . $last_name);
$pdf->Ln();
$pdf->Cell(40, 10, "Email: " . $email);
$pdf->Ln();

$filename="access_cards/access_card" . $member_id . ".pdf";
$pdf->Output("F", $filename);

$upit="UPDATE members SET access_card_pdf_path='$filename' WHERE member_id=$member_id";
$konekcija->query($upit);
$konekcija->close();

$_SESSION["success_message"]="Clan teretane je uspesno dodat";
header("location: admin_dashboard.php");
exit();
?>