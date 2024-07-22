<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');
$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
if(isset($_SESSION['usuario'])){
if (isset($_POST['confcont'])) {
    if ($_POST['cont'] == $_SESSION['contrasena']) {
        $acciones->cambiarcontraseña($_POST['contra']);
    } else {
        ?>
        <script>
            alert("La contraseña no es igual a la actual");
        </script>
        <?php
    }
}}else{
    header('Location: Errornoencontrado.html');
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
    <link rel="stylesheet" href="estilos/cambiarcontraseña.css">
</head>
<body>
    
    <span id="regresar">&larr;</span>
    <div class="container">
        <img src="imagenes/levys.png" alt="">
        <form id="passwordForm" action="" method="post">
            <h2>Cambio de contraseña</h2>
            <input type="password" name="cont" id="cont" placeholder="Ingresa tu anterior contraseña" required><br><br>
            <input type="password" name="contra" id="contra" placeholder="Ingresa tu nueva contraseña" required><br><br>
            <div id="requisitos">
                <div id="minimo">Entre 8 y 20 caracteres</div>
                <div id="mayuscula">Al menos una mayúscula</div>
                <div id="minuscula">Al menos una minúscula</div>
                <div id="numero">Al menos un número</div>
                <div id="especial">Al menos un carácter especial</div>
            </div>
            <input type="password" name="confir" id="confir" placeholder="Confirma tu nueva contraseña" required><br><br>
            
            <input type="submit" name="confcont" id="confcont" value="Cambiar contraseña" class="btn-disabled" disabled>
        </form>
    </div>
    <script>
        document.getElementById("regresar").addEventListener("click", function() {
            window.location.href = "pagusuario.php";
        });

        document.getElementById("passwordForm").addEventListener("input", function() {
            var cont = document.getElementById("cont").value;
            var contra = document.getElementById("contra").value;
            var confir = document.getElementById("confir").value;
            var btnCambiarContraseña = document.getElementById("confcont");

            var minimo = document.getElementById("minimo");
            var mayuscula = document.getElementById("mayuscula");
            var minuscula = document.getElementById("minuscula");
            var numero = document.getElementById("numero");
            var especial = document.getElementById("especial");

            var formato = {
                minimo: /^.{8,20}$/,
                mayuscula: /[A-Z]/,
                minuscula: /[a-z]/,
                numero: /\d/,
                especial: /[@$!%*?&]/
            };

            if (formato.minimo.test(contra)) {
                minimo.classList.add("strikethrough");
            } else {
                minimo.classList.remove("strikethrough");
            }

            if (formato.mayuscula.test(contra)) {
                mayuscula.classList.add("strikethrough");
            } else {
                mayuscula.classList.remove("strikethrough");
            }

            if (formato.minuscula.test(contra)) {
                minuscula.classList.add("strikethrough");
            } else {
                minuscula.classList.remove("strikethrough");
            }

            if (formato.numero.test(contra)) {
                numero.classList.add("strikethrough");
            } else {
                numero.classList.remove("strikethrough");
            }

            if (formato.especial.test(contra)) {
                especial.classList.add("strikethrough");
            } else {
                especial.classList.remove("strikethrough");
            }

            if (cont !== "" && formato.minimo.test(contra) && formato.mayuscula.test(contra) &&
                formato.minuscula.test(contra) && formato.numero.test(contra) &&
                formato.especial.test(contra) && contra === confir) {
                btnCambiarContraseña.disabled = false;
                btnCambiarContraseña.classList.remove("btn-disabled");
                btnCambiarContraseña.classList.add("btn-enabled");
            } else {
                btnCambiarContraseña.disabled = true;
                btnCambiarContraseña.classList.remove("btn-enabled");
                btnCambiarContraseña.classList.add("btn-disabled");
            }
        });

        document.getElementById("passwordForm").addEventListener("submit", function(evento) {
            var cont = document.getElementById("cont").value;
            var contra = document.getElementById("contra").value;
            var confir = document.getElementById("confir").value;
            var formato = {
                minimo: /^.{8,20}$/,
                mayuscula: /[A-Z]/,
                minuscula: /[a-z]/,
                numero: /\d/,
                especial: /[@$!%*?&]/
            };

            if (contra !== confir) {
                alert("Las contraseñas no coinciden");
                evento.preventDefault();
            } else if (!formato.minimo.test(contra) || !formato.mayuscula.test(contra) ||
                       !formato.minuscula.test(contra) || !formato.numero.test(contra) ||
                       !formato.especial.test(contra)) {
                alert("La nueva contraseña debe cumplir con todos los requisitos.");
                evento.preventDefault();
            }
        });
    </script>
</body>
</html>
