<?php
require_once('tcpdf/tcpdf.php');
require 'autoload.php';
use MongoDB\Client as Mongo;
 $mongo = new Mongo("mongodb://localhost:27017");
$dbExamen = $mongo->examen;
$usuarios = $dbExamen->usuarios->find();
 $pdf=new TCPDF();
$pdf->SetCreator('Mi Aplicacion');
$pdf->SetAuthor('Yo');
$pdf->SetTitle('Mi PDF');
$pdf->AddPage();
 $html = '<table style="width: 100%; border: 3px solid black; border-collapse: collapse;">';
$html .= '<tr style="border: 1px solid black; border-collapse: collapse;">
          <th>Foto</th> <th>Nombre</th> <th>Apellidos</th> 
       </tr>';
 foreach ($usuarios as $user) {
  $foto = $user['foto'];
  $nombre = $user['nombre'];
  $apellidos = $user['apellidos'];
  $html .= '<tr style="height: 50px; border: 1px solid black; border-collapse: collapse;">
              <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">
                  <div style="display: table-cell; vertical-align: middle; height: 100%;">
                      <img style="max-height: 40px; max-width: 40px; margin: auto;" src="' . $foto . '">
                  </div>
              </td>
              <td style="border: 1px solid black; border-collapse: collapse;">' . $nombre . '</td>
              <td style="border: 1px solid black; border-collapse: collapse;">' . $apellidos . '</td>
          </tr>';
}
 $html .= '</table>';
 $pdf->writeHTML($html);
$pdf->Output('datos_usuarios.pdf', 'I');