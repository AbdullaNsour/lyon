<?php
require('./fpdf185/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'User Information',0,0,'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottoms
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Connect to the MySQL server
$conn = new mysqli("localhost", "root", "", "lyon");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user id from the URL
$id = $_GET['id'];

// Retrieve the user information from the database
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $image = $row["image"];
    $user_type = $row["user_type"];
    $shop_name = $row["shop_name"];
    $shop_phone = $row["shop_phone"];
    $shop_location = $row["shop_location"];
} else {
    echo "No user found with ID: $id";
    exit();
}

$conn->close();

// Create a new PDF object
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Arial 12
$pdf->SetFont('Arial','',12);

// Output the user's information
$pdf->Cell(0,10,"Name: $name",0,1);
$pdf->Cell(0,10,"Email: $email",0,1);

$pdf->Cell(0,10,"User Type: $user_type",0,1);
if($user_type == 'seller'){
    $pdf->Cell(0,10,"Shop Name: $shop_name",0,1);
    $pdf->Cell(0,10,"Shop Phone: $shop_phone",0,1);
    $pdf->Cell(0,10,"Shop Location: $shop_location",0,1);
}
$pdf->Image("images/$image", 100, 30, 60, 60);
// Output the PDF
$pdf->Output();
