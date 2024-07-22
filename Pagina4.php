<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barbería</title>
<link rel="stylesheet" href="estilos/estilos_diego.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="shortcut icon" href="imagenes/explore_nearby_40dp_FILL0_wght400_GRAD0_opsz40.png" type="image/x-icon">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="ventanacompleta">
    <header>
    <?php
         if (isset($_SESSION['img']) &&$_SESSION['img']!="data:image/jpeg;base64,") {
             $img_src = $_SESSION['img'];
         } else {
             $img_src = 'imagenes/descarga.png';
         }
         if(isset($_SESSION['usuario'])){
            ?> <button title="Visualizar usuario">
            <img id="imagusuario" src="<?php echo $img_src; ?>"alt="Imagen de usuario" width="50px" height="40px">
        </button>

        <?php
        }else{
            ?>   <button title="Iniciar sesion o Registrarse" id="toque"> <img  src="imagenes/Pasted-20240305-155825_preview_rev_1 (1).png" alt="Usuario"></button>
           <?php
        }
        ?>
                <img src="imagenes/image.png" alt="logo" width="7%">
                <script>
                    <?php
                     if(!isset($_SESSION['usuario'])){
        ?>
                    var body=document.getElementById("ventanacompleta");
                    var citaconfirmar=document.getElementById("toque").addEventListener("click", function(){
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
        </header>
        
        <nav>
            <ul>
                <li><a href="pagina1.php" title="CITAS">CITAS</a></li>
<li><a href="Productos.php" title="PRODUCTOS">PRODUCTOS</a></li>
<li class="ubicacion" title="UBICACIÓN">UBICACIÓN</li>
<li><a href="pagina5.php" title="¿QUIENES SOMOS?">¿QUIENES SOMOS?</a></li>
            </ul>
        </nav>
    <div class="divicion">
    <main>
        <section>
            
            <br><br><br>
            <h1>¡VEN Y VISÍTANOS!</h1>
            <b>Dirección: Estrella Fraccionamiento Galaxia, 54840 Cuautitlán, Méx.</b>
            <br>
            <b>Teléfono: 55 1368 1405</b>
            <br><br>
            <b>UBICACIÓN EN GOOGLE MAPS</b>
        </section>
        
        <aside>
            <br>
        <a id="ubi" href="https://www.google.com.mx/maps/place/LEVY'S+CUTZ+BARBER/@19.6883755,-99.1662817,16.41z/data=!4m6!3m5!1s0x85d1f5e78f837489:0x8b300b26e8982ce2!8m2!3d19.6895811!4d-99.1666503!16s%2Fg%2F11sctsn870?entry=ttu" target="_blank">Ver en Google Maps</a>
             
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5649.966148903116!2d-99.16628169166776!3d19.688375504790994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f5e78f837489%3A0x8b300b26e8982ce2!2sLEVY&#39;S%20CUTZ%20BARBER!5e0!3m2!1ses-419!2smx!4v1715830965491!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </aside>
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
        whats.addEventListener("click", function(){
            setTimeout(() => {
            window.location.href="https://wa.link/mqglhe";
        }, 2500);
           
        });
        var ista = document.getElementById("ista");
var face = document.getElementById("face");
face.addEventListener("click", function(){
    setTimeout(() => {
window.location.href="https://www.facebook.com/people/Levys-Cutz-barber/100083054445979/?mibextid=ZbWKwL";
}, 2500);

});
ista.addEventListener("click", function(){
            setTimeout(() => {
window.location.href="https://www.instagram.com/levyscutz?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==";
}, 2500);

        });
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
     <iframe id="ventanaregistrosesion" src="pagusuario.php" frameborder="0"></iframe>
     <script>
     var equis=document.getElementById("equis").addEventListener("click", function(){
         var ventanaregistrosesion=document.getElementById("ventanaregistrosesion");
 
         ventanaregistrosesion.style.display="none";
         var body =document.getElementById("ventanacompleta");
         body.style.opacity="1";
       this.style.display="none";
     });
 </script>
 <script>
    document.getElementById("imagusuario").addEventListener("click", function(){
       window.location.href="pagusuario.php";
    });
</script>  

</body>
</html>