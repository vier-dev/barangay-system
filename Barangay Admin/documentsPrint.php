<?php
include './api/tcpdf/tcpdf.php';

$name = $_POST['name'];
$subject = $_POST['subject'];
$date = $_POST['date'];
$purpose = $_POST['purpose'];

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setAuthor('Barangay Uno');
$pdf->setTitle('Barangay Certificate');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//-------------------------------------------

$pdf->AddPage();

$pdf->setFont('helvetica', '', 14);



$header = <<<EOD

Republic of the Philippines
Province of Zamboanga
Municipality of Caren
EOD;

// print a block of text using Write()
$pdf->Write(0, $header, '', 0, 'C', true, 0, false, false, 0);

$pdf->writeHTML
("
<style>
*{
    text-align: center;
    text-transform:uppercase;
}
</style>
<p><b>BARANGAY UNO</b></p>
");

$pdf->writeHTML
("
<style>
*{
    text-align: center;
    text-transform:uppercase;
}
</style>
<p><b>OFFICE OF THE PUNONG BARANGAY</b></p>
<br>
");


$pdf->writeHTML
("
<style>
*{
    text-align: center;
    text-transform:uppercase;
}
</style>

<h2> $subject </h2>
<br>
");


$pdf->writeHTML
("
<style>
*{
    text-align: end;
}
</style>

<p>To whom it may concern, </p>
<br>
");


$pdf->writeHTML
("
<style>
*{
    text-align: center;
}
</style>

<p> <b>THIS IS TO CERTIFY</b> that<b> Mr/Ms. $name</b> of legal age, Filipino and a resident of Barangay Uno, Zamboanga. </p>
<p> <b>THIS IS TO FURTHER CERTIFY</b> that the above named person is of good moral standing and has no degatory record on file or 
whatsoever as per our record. </p>
<p> <b> THIS CERTIFICATION </b>is issued upon personal request of the above named person on the purpose <i>$purpose</i>.</p>
<p> <b> ISSUED</b> on $date at Barangay Caren, Zamboanga. </p>
<br>
<br>

");



$footer = <<<EOD


HON. MANUEL SEBASTIAN
Punong Barangay
EOD;

// print a block of text using Write()
$pdf->Write(0, $footer, '', 0, 'E', true, 0, false, false, 0);




$pdf->Output('certificate.pdf','I');

?>