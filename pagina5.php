<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilos_criss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="imagenes/groups_40dp_FILL0_wght400_GRAD0_opsz40.png" type="image/x-icon">
</head>
<body>
    <div id="ventanacompleta">
    <header id="parte_de_arriba">
        
        <div class="contenedor_logo">
         <img id="logo" src="imagenes/image.png" alt="logo" width="75">
     <div>
         <div class="contenedor_registro"><?php
         if (isset($_SESSION['img']) &&$_SESSION['img']!="data:image/jpeg;base64,") {
             $img_src = $_SESSION['img'];
         } else {
             $img_src = 'imagenes/descarga.png';
         }
          if(isset($_SESSION['usuario'])){
            ?>  <button title="Registrate o ingresa", id="usuario_boton"> <img  id="imagusuario" src="<?php echo $img_src; ?>" alt="usuario" width="50"></button> <?php
        }else{
            ?>  <button title="Registrate o ingresa", id="usuario_boton"> <img src="imagenes/Pasted-20240305-155825_preview_rev_1 (1).png" alt="usuario" width="50"></button> <?php
        }
         ?>
         <script>
             <?php
                     if(!isset($_SESSION['usuario'])){
        ?>
            var body=document.getElementById("ventanacompleta");
            var citaconfirmar=document.getElementById("usuario_boton").addEventListener("click", function(){
                var ventanaregistrosesion=document.getElementById("ventanaregistrosesion");
                ventanaregistrosesion.style.display="block";
  var tache=document.getElementById("equis");
  tache.style.display="block";
                
body.style.opacity = "0.2";
            });
            <?php
                     }?>
        </script>
        </div>
 </header>
 <nav id="navegacion" >
         <a href="pagina1.php"><button title="Crea una nueva Citas" id="boton1"class="boton">CITAS</button></a>
         <a href="Productos.php"><button title="Compra productos" id="boton2"class="boton">PRODUCTOS</button></a>
         <a href="Pagina4.php"><button title="Conoce donde nos ubicamos" id="boton3"class="boton">UBICACION</button></a>
         <button title="Descuble quienes somos" class="boton" id="botonsomos"> ¿QUIENES SOMOS?</button>
     
     </nav>
     <div class="divicion">
     <main>
        <section>
            <p class="parrafo1">En nuestra barbería, nos
                comprometemos a proporcionar
                servicios de barbería
                excepcionales, utilizando
                técnicas modernas y productos
                de calidad para satisfacer las
                necesidades de nuestros clientes.
                Nos esforzamos por crear un
                ambiente relajado y amigable
                donde los clientes puedan
                disfrutar de una experiencia
                única de cuidado personal y salir
                luciendo y sintiéndose mejor que
                nunca.</p>
              
                <p class="parrafo2">  <b>¿Quienes somos? </b>
                    <br>no solo nos dedicamos a cortar
                    cabello, sino que también nos
                    esforzamos por crear conexiones
                    significativas con nuestros
                    clientes. Nuestro equipo está
                    formado por profesionales
                    apasionados que no solo
                    dominan su oficio, sino que
                    también se comprometen a
                    brindar un servicio personalizado
                    y atención individualizada a
                    cada cliente que cruza nuestras
                    puertas.</p>
                   <img class="corte" src="imagenes/corte-de-pelo-desvanecido-377x566.jpg" alt="corte de cabello">
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
<script>
    document.getElementById("imagusuario").addEventListener("click", function(){
       window.location.href="pagusuario.php";
    });
</script>  

</div>
</body>
</html>