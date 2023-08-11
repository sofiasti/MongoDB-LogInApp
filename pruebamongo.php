<?php
require 'autoload.php';
use MongoDB\Client as Mongo;

$mongo = new Mongo("mongodb://localhost:27017");
$dbPruebas = $mongo->prueba;
$usuarios = $dbPruebas->usuarios;

// Insert a new document
$usuarios->insertOne(["usuario" => "antonio", "pass" => "123456"]);

// Find and print all documents in the "usuarios" collection
$cursor = $usuarios->find();
foreach ($cursor as $usuario) {
    print_r($usuario);
}

// Update the password for the user with "usuario" = "antonio"
$filter = ['usuario' => 'antonio'];
$update = ['$set' => ['pass' => 'nuevacontrasena']];
$usuarios->updateOne($filter, $update);

// Delete the user with "usuario" = "antonio"
$usuarios->deleteOne(['usuario' => 'antonio']);
?>
