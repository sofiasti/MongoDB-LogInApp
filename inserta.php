<?php
require 'autoload.php';
use MongoDB\Client as Mongo;
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mongo = new Mongo("mongodb://localhost:27017");
    $dbExamen = $mongo->examen;
    $usuarios = $dbExamen->usuarios;
     // hago referencia a mi formulario
    $nombreValue = $_POST['nombre'];
    $apellidosValue = $_POST['apellidos'];
    $fotoValue = $_POST['foto'];
     //Inserto la informacion en MongoDB
    $usuarios->insertOne([
        "nombre" => $nombreValue,
        "apellidos" => $apellidosValue,
        "foto" => $fotoValue
    ]);
     // Redirecciono a la página que muestre los datos con el header
    header("Location: pdf4.php");
    exit();
}
?>