<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
if (isset($_GET['cancelar'])) {
    $acciones->quitarcita($_GET['cancelar']);
}
if (!isset($_SESSION['usuario'])) {
    header('Location:Errornoencontrado.html');
    exit();
} else {
    $acciones->traercitas();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver tus citas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/citas.css">
    
</head>
<body>
    <span id="regresar">&larr;</span>
    <div class="container-citas">
        <?php
        if (count($acciones->idcitas) > 0) {
            for ($i = 0; $i < count($acciones->idcitas); $i++) {
        ?>
            <div class="card">
                <div class="card-header">
                    Cita #<?php echo $acciones->idcitas[$i] ?>
                </div>
                <div class="card-body">
                    <p><strong>Usuario:</strong> <?php echo $acciones->usuariocita[$i] ?></p>
                    <p><strong>Fecha de la cita:</strong> <?php echo $acciones->fechacita[$i] ?></p>
                    <p><strong>Hora de la cita:</strong> <?php echo $acciones->hoarcita[$i] ?></p>
                    <p><strong>Fecha de creación:</strong> <?php echo $acciones->fechacreacioncita[$i] ?></p>
                </div>
                <div class="card-footer">
                    <form action="" method="get">
                        <button name="cancelar" value="<?php echo $acciones->idcitas[$i] ?>" class="cancel-button">Cancelar Cita</button>
                    </form>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p class='no-citas'>No tienes citas programadas.</p>";
        }
        ?>
    </div>
    <script>
        document.getElementById("regresar").addEventListener("click", function() {
            window.location.href = "pagusuario.php";
        });
    </script>
</body>
</html>
