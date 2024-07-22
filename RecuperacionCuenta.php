<?php
session_start();
include_once('acciones.php');


$acciones=new acciones(null);
if($_SERVER['REQUEST_METHOD']=="POST"&&isset($_POST['buscar'])){
if($acciones->enviodecorreo("Este es tu envio de recuperacion de contraseña", "Tu numero de recuperacion de contraseña es:", $_POST['correo'])){
    $_SESSION['buscarcorreo']=$_POST['correo'];
    header('Location:validaciondecorreo2.php ');
}else
{
    header('Location:Error.html');
}


}
if($_SERVER['REQUEST_METHOD']=="POST"&&isset($_POST['Buscartel'])){
    if($acciones->enviarwhtas($_POST['telefono'])){
        $_SESSION['buscartel']=$_POST['telefono'];
    header('Location:validaciondetel.php ');
    }else{
        header('Location:Error.html');
    }
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/EstilosRecuperacion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imagenes/lock_24dp_FILL0_wght400_GRAD0_opsz24.png" type="image/x-icon">
</head>
<body>
    <main>
    <form action="" method="POST"> 
        <span id="regresar">&larr;</span>
        <script>
            document.getElementById("regresar").addEventListener("click", function(){
                window.location.href="registro o sesion.php";
            });
        </script>
    <h2>¿Olvidaste tu Contraseña?</h2>
    <hr><br>
    <h1 id="h1">¿Perdio su contraseña?</h1>
    <p id="texto">Ingresa tu correo para enviarte un Gmail de recuperacion de contraseña</p>
    <input type="text"id="input" placeholder="Ingresa el correo" name="correo" required ><br><br>
    <input  name="buscar" id="buscar" class="Buscar"  type="submit" value="Enviar codigo">
    <img src="imagenes/herramientas.png" alt="herramientas">
    
    <br>
    <br>
    <br>
    </form>
    <div>
    <button id="cambiar" title="enviar codigo por numero celular">Enviar codigo mediante tu numero celular</button>
    </div>
    </main>
    <script>
        var contador=0;
        document.getElementById("cambiar").addEventListener("click", function(evento){
            var buscar=document.getElementById("buscar");
            var texto=document.getElementById("texto");
          
            var cambiar=document.getElementById("cambiar");
          
            var input=document.getElementById("input");
            
            if(contador==0){
                texto.textContent="Ingresa tu numero de telefono para enviarte un msanje de recuperacion de contraseña ";
                cambiar.textContent="Enviar codigo mediante tu correo electronico";
                input.placeholder="Ingresa tu numero de telefono";
            input.name="telefono";
            buscar.name="Buscartel";
            contador++;
            }else{3
                texto.textContent="Ingresa tu correo para enviarte un Gmail de recuperacion de contraseña";
                cambiar.textContent="Enviar codigo mediante tu numero celular";
                input.placeholder="Ingresa el correo";
            input.name="correo";
            buscar.name="buscar";
contador--;
            }
        });
    </script>
</body>
</html>