<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);

if(isset($_SESSION['usuario'])){
    $telefonoActual = $_SESSION['telefono'];

    if (isset($_POST['Actu'])) {
        $nuevoTelefono = $_POST['telefono'];
            $acciones->cambiartelefono($nuevoTelefono);
        
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
    <title>Cambiar Número de Teléfono</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/cambiartelefono.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        var telefonoActualPHP = "<?php echo $_SESSION['telefono'];?>";
    </script>
</head>
<body>
    <span id="regresar">&larr;</span>
    <div class="container">
        <form action="" method="post">
            <div id="titulo" class="text-center">
                <img src="imagenes/image.png" alt="telefono" id="telefono2" class="img-fluid">
                <h1>Cambiar número de teléfono 
                <img src="imagenes/images-removebg-preview.png" id="telefonoh1" alt="telefono" class="img-fluid"></h1>
            </div>
            <br>
            <div class="input-container">
                <input type="tel" id="telefonoviejo" name="telefonoviejo" class="form-control" placeholder="Ingresa tu anterior número" maxlength="10" pattern="\d{10}" required>
                <br>
                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Ingresa tu nuevo número telefónico" maxlength="10" pattern="\d{10}" required>
            </div>
            <input type="submit" id="Actu" name="Actu" value="Cambiar teléfono" class="btn btn-disabled btn-block" disabled>
        </form>
    </div>
    <script>
        document.getElementById("regresar").addEventListener("click", function() {
            window.location.href = "pagusuario.php";
        });

        function validateInputs() {
            var telefonoViejo = document.getElementById("telefonoviejo").value.replace(/\D/g, '');
            var telefonoNuevo = document.getElementById("telefono").value.replace(/\D/g, '');
            var Actu = document.getElementById("Actu");
            if (telefonoNuevo.length === 10 && telefonoViejo === telefonoActualPHP) {
                Actu.disabled = false;
                Actu.classList.remove("btn-disabled");
                Actu.classList.add("btn-enabled");
            } else {
                Actu.disabled = true;
                Actu.classList.remove("btn-enabled");
                Actu.classList.add("btn-disabled");
            }
        }

        document.getElementById("telefono").addEventListener("input", validateInputs);
        document.getElementById("telefonoviejo").addEventListener("input", validateInputs);

        document.getElementById("Actu").addEventListener("click", function(event) {
            var telefonoViejo = document.getElementById("telefonoviejo").value.replace(/\D/g, '');
            var telefonoNuevo = document.getElementById("telefono").value.replace(/\D/g, '');

            if (telefonoViejo !== telefonoActualPHP) {
                event.preventDefault();
                alert("El número de teléfono ingresado no coincide con el registrado en la sesión.");
            } 
        });
    </script>
</body>
</html>
