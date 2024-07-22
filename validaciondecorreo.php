<?php

session_start();
     include_once('conexion base de datos.php');
     include_once('acciones.php');
     
     $conexion = new conexionbd();
     $conexion->conexion();
     $acciones = new acciones($conexion);
     
if($_SERVER['REQUEST_METHOD']=="POST"&& isset($_POST['validar'])){
    if($_POST['num']==$_SESSION['numram']){
         $acciones->crear_nuevo_usuario($_SESSION['contrasenavali'], $_SESSION['usuariovali'], $_SESSION['correovali'], $_SESSION['nombresvali'], $_SESSION['apellidosvali']); 
         header('Location: registro o sesion.php');
        }else{
        ?>
           <script>
            alert("Datos mal puestos ");
           </script>
           <?php
    }
    }
    if(isset($_POST['reenviar'])){
        if($acciones->enviodecorreo("Este es tu envio de validacion de correo", "Tu numero de validacion es :", $_SESSION['correovali'])){
            
            header('Location:validaciondecorreo2.php ');
        }else
        {
            header('Location:Error.html');
        }
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estiloscorreos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Luxurious+Roman&display=swap" rel="stylesheet">
    <title>Valida tu correo</title>
</head>
<body>
    <span id="regresar">&larr;</span>
    <h1>HOLA, te enviamos un Gmail para verificar tu correo <img src="imagenes/Pasted-20240511-151242_preview_rev_1.png" alt="envio de correo"> </h1>
    <b><img src="imagenes/Pasted-20240511-145946_preview_rev_1.png" alt="Recordatorio">Recuerda revisar la opcion de span</b>
    <p id="texto">Ingresa tu codigo aqui...</p>
    <form action="" method="post" >
    <input type="number" id="num" name="num" placeholder="ingresa el dijito">
    <input type="submit" value="Validar correo" id="enviar" name="validar">
    </form>
    <p>¿No te llego el Gmail? <a href="validaciondecorreo.php" id="reenviar">reenviar </a></p>
    <script> 
    var click=0;
document.getElementById("reenviar").addEventListener("click", function(){
click++;
if(click>=1){
   // this.textContent="La cantidad de renvio se ha acabado, intentalo despues ";
    
}

});
     var enviar =document.getElementById("enviar");
     enviar.disabled=true;
    document.getElementById("regresar").addEventListener("click", function(){
        window.location.href="registro o sesion.php";
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