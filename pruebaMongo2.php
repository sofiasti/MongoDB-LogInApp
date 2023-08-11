<?php
require 'autoload.php';
use MongoDB\Client as Mongo;
use MongoDB\Driver\Exception\Exception as MongoDBException;

try {
    $mongo = new Mongo("mongodb://localhost:27017");
    $dbPruebas = $mongo->prueba;
    $usuarios = $dbPruebas->usuarios;

    // Insert a new document if the user does not exist
    $newUser = ["usuario" => "antonio", "pass" => "123456"];
    $existingUser = $usuarios->findOne(['usuario' => 'antonio']);

    if (!$existingUser) {
        $usuarios->insertOne($newUser);
        echo "Usuario 'antonio' insertado correctamente";
    } else {
        echo "El usuario 'antonio' ya existe en la base de datos";
    }

    // Find and print all documents in the "usuarios" collection
    $cursor = $usuarios->find();
    foreach ($cursor as $usuario) {
        print_r($usuario);
    }

    // Update the password for the user with "usuario" = "antonio"
    $filter = ['usuario' => 'antonio'];
    $update = ['$set' => ['pass' => 'nuevacontrasena']];
    $result = $usuarios->updateOne($filter, $update);
    $updatedCount = $result->getModifiedCount();
    echo "El número de usuarios actualizados: " . $updatedCount;

    // Delete the user with "usuario" = "antonio"
    $usuarios->deleteOne(['usuario' => 'antonio']);
} catch (MongoDBException $e) {
    echo "Error: " . $e->getMessage();
}
?>
