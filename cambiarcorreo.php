<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);

if (isset($_SESSION['usuario'])) {
   
    $correoActual = $_SESSION['correo'];

    if (isset($_POST['subir'])) {
        $correoAnterior = $_POST['correoanterior'];
        $correoNuevo = $_POST['correo'];

        if ($correoAnterior === $correoActual) {
            if( $acciones->vericorreo($correoNuevo)==false){
                $acciones->cambiarcorreo($correoNuevo);
            }else{
                echo "<script>alert('El correo electrónico ya existe en cotra cuenta');</script>";
            }
            
        } else {
            echo "<script>alert('El correo electrónico anterior no coincide con el registrado en la sesión.');</script>";
        }
    }
} else {
    header('Location: Errornoencontrado.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Correo Electrónico</title>
    <link rel="stylesheet" href="estilos/cambiarcorreo.css">
</head>
<body>
<span id="regresar">&larr;</span>
    <div class="container">
        <img src="imagenes/image.png" alt="logo">
        <h2>ACTUALIZACIÓN DE CORREO</h2>
        
        <form id="correoForm" action="" method="post">
            <input type="email" name="correoanterior" id="correoanterior" placeholder="Ingresa tu correo anterior" required>
            <input type="email" name="correo" id="correo" placeholder="Ingresa el nuevo correo" required><br><br>
            <input type="submit" name="subir" id="cambiar" value="Cambiar correo" class="btn-disabled" disabled>
        </form>
    </div>
    <script>

        var correoActualPHP = "<?php echo $_SESSION['correo']; ?>";

        function validateEmails() {
            var correoAnterior = document.getElementById("correoanterior").value;
            var correoNuevo = document.getElementById("correo").value;
            var btnCambiarCorreo =document.getElementById("cambiar");
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (regex.test(correoAnterior) && regex.test(correoNuevo) && correoAnterior === correoActualPHP) {
                btnCambiarCorreo.disabled = false;
                btnCambiarCorreo.classList.remove("btn-disabled");
                btnCambiarCorreo.classList.add("btn-enabled");
            } else {
                btnCambiarCorreo.disabled = true;
                btnCambiarCorreo.classList.remove("btn-enabled");
                btnCambiarCorreo.classList.add("btn-disabled");
            }
        }

        document.getElementById("correoanterior").addEventListener("input", validateEmails);
        document.getElementById("correo").addEventListener("input", validateEmails);
document.getElementById("regresar").addEventListener("click", function(){
window.location.href="pagusuario.php";
});
    </script>
</body>
</html>
