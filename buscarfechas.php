<?php
include_once 'conexion base de datos.php';
if (isset($_GET['date'])) {
    $date = $_GET['date'];

    try {
        $conexion = new conexionbd();
        $conn = $conexion->conexion();
        $comando = $conn->prepare("SELECT hora FROM citas WHERE fecha = ?");
        $comando->execute([$date]);
        $hours = $comando->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($hours);
    } catch(PDOException $e) {
        echo json_encode(array("error" => "Error en la conexión: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("error" => "No se recibió la fecha."));
}
?>
