<?php
require_once("tcpdf/tcpdf.php");

// Comprobar si se ha enviado el formulario
if (isset($_POST['submit'])) {
    // Obtener el número de chicos y chicas ingresados en el formulario
    $numChicos = $_POST['num_chicos'];
    $numChicas = $_POST['num_chicas'];

    // Obtener los datos de la API de RandomUser para chicos
    $urlChicos = "https://randomuser.me/api/?gender=male&results=" . $numChicos;
    $dataChicos = file_get_contents($urlChicos);
    $chicos = json_decode($dataChicos)->results;

    // Obtener los datos de la API de RandomUser para chicas
    $urlChicas = "https://randomuser.me/api/?gender=female&results=" . $numChicas;
    $dataChicas = file_get_contents($urlChicas);
    $chicas = json_decode($dataChicas)->results;

    $usuarios = array_merge($chicos, $chicas);

    // Crear una nueva instancia de TCPDF
    $pdf = new TCPDF();

    // Establecer la información básica del documento PDF
    $pdf->SetCreator('Mi Aplicación');
    $pdf->SetAuthor('Yo');
    $pdf->SetTitle('Datos de Usuarios');

    // Agregar una página al documento
    $pdf->AddPage();

    // Crear la tabla HTML con los datos de los usuarios
    $html = '<table style="width: 100%; border: 3px solid black; border-collapse: collapse;">';
    $html .= '<tr style="border: 1px solid black; border-collapse: collapse;">
                <th>Foto</th> <th>Sexo</th> <th>Nombre</th> <th>Apellidos</th> <th>Ciudad</th> <th>Teléfono</th>
             </tr>';

    foreach ($usuarios as $user) {
        $foto = $user->picture->thumbnail;
        $sexo = $user->gender;
        $nombre = $user->name->first;
        $apellidos = $user->name->last;
        $ciudad = $user->location->city;
        $telefono = $user->phone;

        $html .= '<tr style="height: 50px; border: 1px solid black; border-collapse: collapse;">
                    <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">
                        <div style="display: table-cell; vertical-align: middle; height: 100%;">
                            <img style="max-height: 40px; max-width: 40px; margin: auto;" src="' . $foto . '">
                        </div>
                    </td>
                    <td style="border: 1px solid black; border-collapse: collapse;">' . $sexo . '</td>
                    <td style="border: 1px solid black; border-collapse: collapse;">' . $nombre . '</td>
                    <td style="border: 1px solid black; border-collapse: collapse;">' . $apellidos . '</td>
                    <td style="border: 1px solid black; border-collapse: collapse;">' . $ciudad . '</td>
                    <td style="border: 1px solid black; border-collapse: collapse;">' . $telefono . '</td>
                </tr>';
    }

    $html .= '</table>';

    // Escribir el contenido HTML en el PDF
    $pdf->writeHTML($html);

    // Generar la salida del PDF al navegador
    $pdf->Output('datos_usuarios.pdf', 'I');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generar PDF con Datos de Usuarios</title>
</head>
<body>
    <h1>Generar PDF con Datos de Usuarios</h1>
    <form method="POST" action="">
        <label for="num_chicos">Número de Chicos:</label>
        <input type="number" name="num_chicos" id="num_chicos" required><br>

        <label for="num_chicas">Número de Chicas:</label>
        <input type="number" name="num_chicas" id="num_chicas" required><br>

        <input type="submit" name="submit" value="Genera PDF">
    </form>
</body>
</html>
