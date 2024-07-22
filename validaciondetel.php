<?php

session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');
$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
     if($_SERVER['REQUEST_METHOD']=="POST"&& isset($_POST['validar'])){
        if($_POST['num']==$_SESSION['numram']){
           $acciones->buscarContrasenatel($_SESSION['buscartel']);
            }else{
            ?>
               <script>
                alert("El numero ingresado no es correcto");
               </script>
               <?php
        }
    }
    if(isset($_POST['reenviar'])){
        if($acciones->enviarwhtas($_SESSION['buscartel'])){
        header('Location:validaciondetel.php ');
        }else{
            header('Location:Error.html');
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estiloscorreos2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Luxurious+Roman&display=swap" rel="stylesheet">
    <title>Valida tu correo</title>
</head>
<body>
    <span id="regresar">&larr;</span>
    <h1>HOLA, te enviamos un WhatsApp para recuperar tu contraseña <img src="imagenes/Pasted-20240511-151242_preview_rev_1.png" alt="envio de correo"> </h1>
    <p id="texto">Ingresa tu codigo aqui...</p>
    <form action="" method="post" >
    <input type="number" id="num" name="num" placeholder="ingresa el dijito">
    <input type="submit" value="Validar correo" id="enviar" name="validar">
    </form>
    <form action="" method="post" >
    <p>¿No te llego el mensaje?   <input id="reenviar"name="reenviar" type="submit" value=" reenviar "> </p>
    </form>
    <script> 
     

        document.getElementById("reenviar").addEventListener("click", function(evento){
            alert("Se ha enviado el mensaje");
});
     var enviar =document.getElementById("enviar");
     enviar.disabled=true;
    document.getElementById("regresar").addEventListener("click", function(){
        window.location.href="RecuperacionCuenta.php";
    });
    var contador=0;
    document.getElementById("num").addEventListener("input", function(evento){
        var inputValor = event.target.value; 
    var cantidadCaracteres = inputValor.length;
    if(cantidadCaracteres > 7) {
        event.target.value = inputValor.substring(0, 7); 
        cantidadCaracteres = 7; 
    }
    if(cantidadCaracteres >= 6 && cantidadCaracteres <= 7){
        enviar.disabled = false;
        enviar.style.cursor="pointer"; 
    } else {
        enviar.disabled = true;
        
        enviar.style.cursor="not-allowed"; 
    }
    });
</script>
</body>
</html>