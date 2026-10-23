<?php
declare(strict_types=1);
session_start();

//detector de errores
ini_set('display_errors', '1');
error_reporting(E_ALL);

//funcion calcula el tipo de entrada
function calcularPrecioBase(string $tipo): int
{
    switch ($tipo) {
        case "General":
            return 30;
        case "VIP":
            return 60;
        case "Infantil":
            return 10;
        default:
            throw new Exception("Tipo de entrada no válido");
    }
}
//funcion que suma el valor del la entrada y el taller a los que accedera
function procesarInscripcion(string $tipo, array $talleres): int
{
    //LLamo a la funcion calcularpreciobase para darme el total de cada entrada para luego sumarla con los talleres
    $total = calcularPrecioBase($tipo);

    foreach ($talleres as $taller => $precio) {
        $total += $precio;
    }

    return $total;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comic-Con</title>
    <link rel="icon" href="data:,">
</head>
<body>

    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad">
        <br>

        <label for="tipEnt">Tipo de Entrada:</label>
        <select id="tipEnt" name="tipoEntrada">
            <option value="General">General</option>
            <option value="VIP">VIP</option>
            <option value="Infantil">Infantil</option>
        </select>
        <br>

        <p>Talleres Especiales:</p>
        <input type="checkbox" name="talleres[Torneo de Videojuegos]" id="Torneo de Videojuegos" value="10">
        <label for="torneo">Torneo de Videojuegos (10 euros)</label>
        <br>
        <input type="checkbox" name="talleres[Taller de Cosplay]" id="Taller de Cosplay" value="15">
        <label for="cosplay">Taller de Cosplay (15 euros)</label>
        <br>
        <input type="checkbox" name="talleres[Zona de Rol en Vivo]" id="Zona de Rol en Vivo" value="5">
        <label for="rol">Zona de Rol en Vivo (5 euros)</label>
        <br>

        <button type="submit" name="enviar">Enviar</button>
    </form>

<?php

// if que deja acceder al try cach si el usuario se lo permite con el boton 
if (isset($_POST['enviar'])){
    try {
        //verificamos que usamos el method post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //creamos las variables y les asigna el valor del html
            $nombre   = $_POST['nombre'] ?? "";
            $edad     = $_POST['edad'] ?? "";
            $tipo     = $_POST['tipoEntrada'] ?? "";
            $talleres = $_POST['talleres'] ?? [];

            //saneamiento
            $nombre = htmlspecialchars(trim($nombre), ENT_QUOTES, 'UTF-8');

            //verificamos que los campos esten seleccionados 
                if ($nombre !== "" && $edad !== "" && $tipo !== "") {
                // verifica si edad es numerico que no sea mayor que 120 y menor que 0
                    if (!is_numeric($edad) || $edad < 0 || $edad >= 120) {
                        throw new Exception("La edad debe ser un número entre 0 y 120");
                    }
                //verifica si hemos seleccionado algun taller
                    if (!is_array($talleres) || count($talleres) === 0) {
                        throw new Exception("No ha marcado ningún taller");
                    }
                //no se puedee comprar entradas vip con menos de 18 años
                    if ($edad < 18 && $tipo === "VIP") {
                        throw new Exception("La entrada VIP está restringida a menores de edad");
                    }
                //llamamos a la funcion procesarInscripcion donde nos devuelve el valor total de entrada y talleres ya sumados
                    $total = procesarInscripcion($tipo, $talleres);
                    
                //Se muestra los datos colocados abajo del formulario si hay error no llegan a salir debido a que salta el error
                    echo "<h2>Resguardo de inscripción</h2>";
                    echo "<p><strong>Asistente:</strong> " . $nombre . "</p>";
                    echo "<p><strong>Entrada:</strong> " . $tipo . " (" . calcularPrecioBase($tipo) . " euros)</p>";

                    echo "<p><strong>Talleres:</strong></p>";
                    echo "<ul>";
                    //recorre una lista de los talleres añadiendo su key y su valor dentro del array
                    foreach ($talleres as $taller => $precio) {
                        echo "<li>" . $taller . ": " . $precio . " euros</li>";
                    }
                    echo "</ul>";
                    //valores sumados
                    echo "<p><strong>Total a pagar:</strong> " . $total . " euros</p>";

                } else {
                    throw new Exception("Rellene todos los campos");
                }
            }
                    
        //Aqui salta el error que queramos de los ifs anteriores haciendo que se muestre error capturado: y luego cada throw exception
    } catch (Exception $e) {
        echo "Error capturado: " . htmlspecialchars($e->getMessage()) . "<br>";
    } finally {
        //Sale si funciona o no el codigo
            echo "Finalizando el script... (Guardando traza en el servidor)<br>";
            error_log("[" . date('Y-m-d H:i:s') . "] Operación finalizada.");
    
    } 
}
    

?>
</body>
</html>