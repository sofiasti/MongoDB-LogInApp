<!doctype html>
<html>
    <body>
        <h1>
            Inserta tu perfil 
        </h1>
        <!--En este caso utilizaré el método post para llevar los datos a mi base de datos-->
        <form action="inserta.php" method="POST">
            Nombre:<input type="text" name="nombre"></br>
            Apellidos:<input type="text" name="apellidos"></br>
            URL de la foto de perfil:<input type="text" name="foto"></br>
            <input type="submit" name="enviar">
        </form>
    </body>
</html>



