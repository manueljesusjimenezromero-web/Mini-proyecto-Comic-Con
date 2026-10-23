<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

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

function procesarInscripcion(string $tipo, array $talleres): int
{
    $total = calcularPrecioBase($tipo);

    foreach ($talleres as $taller => $precio) {
        $total += $precio;
    }

    return $total;
}

$exito = false;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre   = $_POST['nombre'] ?? "";
        $edad     = $_POST['edad'] ?? "";
        $tipo     = $_POST['tipoEntrada'] ?? "";
        $talleres = $_POST['talleres'] ?? [];

        $nombre = htmlspecialchars(trim($nombre), ENT_QUOTES, 'UTF-8');

        
        if (!is_numeric($edad) || $edad <= 0 || $edad >=120) {
            throw new Exception("La edad debe ser un número entero entre 1 y 120");
        }

        if (count($talleres) === 0) {
            throw new Exception("No ha marcado ningún taller");
        }

        if ($edad < 18 && $tipo === "VIP") {
            throw new Exception("La entrada VIP está restringida a mayores de edad");
        }

        $total = procesarInscripcion($tipo, $talleres);
        $exito = true;

        echo "<p>Total: " . $total . " euros</p>";
    }
} catch (Exception $e) {
    echo "Error capturado: " . htmlspecialchars($e->getMessage()) . "<br>";
} finally {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        error_log("[" . date('Y-m-d H:i:s') . "] Operación finalizada: " . ($exito ? "éxito" : "fallo"));
    }
}
?>