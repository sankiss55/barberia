<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
if (!isset($_SESSION['usuario'])) {
    header('Location: Errornoencontrado.html');
} else {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['enviarreporte'])) {
            $problematica = $_POST['prob']; 
            $acciones->resporteUsuario($problematica); 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar problema</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/estilosoporte.css">
</head>
<body>
    
<span id="regresar">&larr;</span>
    <div class="container">
        <label for="prob">CUÉNTANOS TU PROBLEMA*</label>
        <form action="" method="POST">
            <textarea name="prob" id="prob" cols="30" rows="10" required placeholder="Escribe aquí tu problemática..."></textarea>
            <br><br>
            <button id="enviarreporte" type="submit" name="enviarreporte" class="btn btn-success btn-block">ENVIAR</button>
        </form>
    </div>
    <script>
        document.getElementById("regresar").addEventListener("click", function() {
            window.location.href = "pagusuario.php";
        });
    </script>
</body>
</html>
