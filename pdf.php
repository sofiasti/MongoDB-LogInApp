<?php
require_once('tcpdf/tcpdf.php');
$pdf=new TCPDF();
$pdf->SetCreator('Mi Aplicacion');
$pdf->SetAuthor('Yo');
$pdf->SetTitle('Mi PDF');
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Hola, Mundo', 0, 1, 'C');
$pdf->OutPut('mi_pdf.pdf', 'I');
?>