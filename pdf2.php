<?php
require_once('tcpdf/tcpdf.php');
$pdf = new TCPDF();
$pdf->SetCreator('Mi Aplicacion');
$pdf->SetAuthor('Yo');
$pdf->SetTitle('Mi PDF');
$pdf->AddPage();

$data = array(
    array('1', '2'),
    array('3', '4'),
);

$pdf->SetFont('helvetica', '', 12);
$html = '<table style="width:100%; border-collapse: collapse;">';

foreach ($data as $row) {
    $html .= '<tr>';
    foreach ($row as $cell) {
        $html .= '<td style="border:1px solid black; padding: 5px;">' . $cell . '</td>';
    }
    $html .= '</tr>';
}

$html .= '</table>';
$pdf->writeHTML($html);

$x = $pdf->GetX();
$y = $pdf->GetY();
$imageFile = 'TaylorSwift.jpg';
$pdf->Image($imageFile, $x, $y + 10, 50, 0, 'jpg');

$pdf->Output('mi_pdf.pdf', 'I');
?>

