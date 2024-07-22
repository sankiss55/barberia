<?php
session_start();
include_once('acciones.php');
include_once('conexion base de datos.php');
$conexion=new conexionbd();
$conexion->conexion();
$acciones=new acciones($conexion);
if($_SERVER['REQUEST_METHOD']=="POST")
{
if(isset($_POST['enviarreporte']) && isset($_SESSION['usuario']) ){
    if($_POST['correo']==$_SESSION['correo']){
        $acciones->resporteUsuario($_POST['Nom'],$_POST['ap'],$_POST['correo'],$_POST['prob'] );
    }else{
        ?>
        <script> alert("hola");</script>
       
        <?php
    }
            
        
    }

}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbería</title>
    <link rel="stylesheet" href="estilos/estilosdana.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="ventanacompleta">
    <header>
        <img src="imagenes/image.png" alt="logo" width="7%">
        <div>
        <?php
    if(isset($_SESSION['usuario'])){
        ?> <button id="botonarriba" title="registrar  ese o iniciar sesion"><img id="imagusuario"  src="imagenes/descarga.png" alt="registrate" width="50px" height="40px  " ></button> <?php
    }else{
       
    ?> <button id="botonarriba" title="registrar  ese o iniciar sesion"><img  src="imagenes/Pasted-20240305-155825_preview_rev_1 (1).png" alt="registrate" width="50px" height="40px  " ></button> <?php
    }
    ?>
            <script>
              <?php
    if(!isset($_SESSION['usuario'])){
        ?>
                var body=document.getElementById("ventanacompleta");

                var citaconfirmar=document.getElementById("botonarriba").addEventListener("click", function(){
                    var ventanaregistrosesion=document.getElementById("ventanaregistrosesion");
                    ventanaregistrosesion.style.display="block";
      var tache=document.getElementById("equis");
      tache.style.display="block";
                    
body.style.opacity = "0.2";
                });
                <?php
    }
                ?>
            </script>
        </div>
    </header>
    
    <nav>
        <ul>
            <li><a href="pagina1.php" title="CITAS">CITAS</a></li>
            <li><a href="Productos.php" title="PRODUCTOS">PRODUCTOS</a></li>
            <li><a href="Pagina4.php" title="UBICACIÓN">UBICACIÓN</a></li>
            <li><a href="pagina5.php" title="¿QUIENES SOMOS?">¿QUIENES SOMOS?</a></li>
            <li><a href="" title="SOPORTE" id="soporte">SOPORTE</a></li>
        </ul>
    </nav>
    
    <div class="divicion">
        <main>
            <section>
                <form method="post" >
                    <label for="Nom">NOMBRE*</label>
                    <input type="text" id="Nom" name="Nom" required>
                    
                    <br><br><br>
                    <label for="ap">APELLIDO*</label>
                    <input type="text" id="ap" name="ap" required="required">
                    
                    <br><br><br>
                    <label for="correo">CORREO INGRESADO CON LEVI'S CUTS WEB*</label>
                    <input type="email" id="correo" name="correo" required>

                    <br><br><br>
                    <label for="prob">CUENTANOS TU PROBLEMA*</label>
                    <textarea name="prob" id="prob" cols="30" rows="10" required placeholder="Escribe aqui tu problematica..." ></textarea>
                    <br><br>
                    


                    <button id="enviarreporte" type="submit" name="enviarreporte">ENVIAR</button>
                  
                </form>
                <div>
                <p class="Horario">Horario de atención 10 am - 10 pm <br>Días de atención: Lunes a Viernes</p>
                <br><br>
                <b>Número de atención a clientes: 08 566776</b>
            </div>
                
                
            </section>
        </main>
    </div>
    <footer>
       <div >
        <hr>
        <a href="" title="COntactanos mediante WhatsApp"> <button id="whats"><img src="imagenes/Pasted-20240414-004235_preview_rev_1.png" alt="" id="imagwats"></button></a>
        <a href="" title="Conocenos en Facebook"> <button id="face"><img src="imagenes/Pasted-20240414-004412_preview_rev_1.png" alt="" id="imagenface"></button></a>
        <a href="" title="Corre a ver nuestras historias en instagram"> <button id="ista"><img src="imagenes/Pasted-20240414-004542_preview_rev_2.png" alt="" id="imageninsta"></button></a>
        <script>
            var whats=document.getElementById("whats");
            var ista = document.getElementById("ista");
    var face = document.getElementById("face");
    var imagwats=document.getElementById("imagwats");
    var imagenface=document.getElementById("imagenface");
    var imageninsta=document.getElementById("imageninsta");
    animacion(whats,imagwats );
    animacion(ista, imageninsta);
    animacion(face,imagenface );
    
    function animacion(elemento, imagen) {
        elemento.addEventListener("click", function(evento) {
            evento.preventDefault();
            elemento.style.animation = "bounceOutUp 5s linear";
            imagen.style.filter= "grayscale(0%) brightness(100%)";
            setTimeout(() => {
                elemento.style.animation = ""; 
                imagen.style.filter = ""; 
                
            }, 5000);
        });
    }
    
        
    
        </script>
        <hr>
    </div>
        
            <section>
                <p>Cuidado profesional del cabello en Levy's Cutz</p>
            </section>
    </footer>
    </div>
    <div id="equis">
        <span >&timesbar;</span></div>
        <iframe id="ventanaregistrosesion" src="registro o sesion.php" frameborder="0"></iframe>
        <script>
                    
        var equis=document.getElementById("equis").addEventListener("click", function(){
            var ventanaregistrosesion=document.getElementById("ventanaregistrosesion");
    
            ventanaregistrosesion.style.display="none";
            var body =document.getElementById("ventanacompleta");
            body.style.opacity="1";
          this.style.display="none";
        });
        
    </script>
</div>
    </body>
    </html>