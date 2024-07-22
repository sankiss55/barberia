<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="estilos/estilohome.css">
</head>
<body>
    <div id="divventana">
    <header>
        <h1>Bienvenido a Barberia <br>Levy'z Cutz </h1>
        <img src="Imagenes/Imagen_de_WhatsApp_2024-05-18_a_las_18.48.17_1dfe7b91-removebg-preview.png" alt="" class="Logo" >
    </header>
    <div class="Contenedor">
        <img src="Imagenes/R.jpg" alt="" class="Img">
        <div class="Texto">VIVE LA VERDADERA</div>
        <div class="Text">RELAJACION</div>
    </div>
    <section>
        <div class="Sa"><h1>Salon de Barberia</h1></div>
        <div class="Am"><h1>Y Peluqueria</h1></div>
        <img src="Imagenes/circ-servicios-Mr-Barber-shop.webp" alt="" class="Barber">
        <article>
        <ul>
    <li>Afeitado de Cabeza: $45</li>
    <li>Corte de Cabeza: $60</li>
    <li>Grecas: $30</li>
    <li>Afeitado de Barba: $36</li>
    <li>Arreglo de Barba: $45</li>
    <li>SPA de Barba: $90</li>
    <li>Teñido de Barba: $75</li>
    <li>Limpieza Facial: $90</li>
    <li>Limpieza de Ceja: $30</li>
    <li>Exfoliación de Rostro: $75</li>
    <li>Mascarilla Negra: $60</li>
    <li>Alta Frecuencia (barba y cabello): $75</li>
</ul>
        </article>
    </section>
    <aside>
        <div class="Agenda"><h1>Agenda con Nosotros!!</h1></div>
        <div class="Slogan"><p>Nosotros de Brinadremos un servicio unico y especial! <br>Ven y agenda con nostros te esperamos!</p></div>
        <a href="pagina1.php"><button onclick="Cita" class="Button" >Agendar cita</button></a>
    </aside>
    <aside class="Cuenta">
        <div class="Anuncio"><h1>Ya obtuviste tu Cuenta?? <br> Inicia sesion o crea tu cuenta  </h1></div>
        <?php

        if(!isset($_SESSION['usuario'])){

            ?>
<button id="Sesion" class="Sesion">Haz click aqui. </button>
<?php
        }else{
            ?>
            <br>
            <i>Listo <?php echo $_SESSION['usuario']?> ya puedes hacer tu super corte en Levy'z Cutz, ve y ajenda tu cita :)</i>
            <?php
        }
        ?>
        
        <br>
        <br>
        <br>
        <div class="Contacto"><h5>Tel: 56 3582 2410</h5></div>
    </aside>
    <footer>
        <div class="social-btn">
            <a href="https://wa.me/5635842410" target="_blank" class="whatsapp-btn"><button><img src="Imagenes/th-removebg-preview.png" alt=""> Contactar por WhatsApp</button></a>
            <a href="https://www.facebook.com/Kaleb Diaz" target="_blank" class="facebook-btn"><button><img src="Imagenes/descarga-removebg-preview.png" alt=""> Seguir en Facebook</button></a>
            <a href="https://www.instagram.com/_kaleb_diaz_" target="_blank" class="instagram-btn"><button><img src="Imagenes/descarga__1_-removebg-preview.png" alt=""> Seguir en Instagram</button></a>
          </div>
    </footer>
</div>
<div id="equis">
    <span >&timesbar;</span></div>
    <iframe id="ventanaregistrosesion" src="registro o sesion.php" frameborder="0"></iframe>
    <script>
        var divventana=document.getElementById("divventana");
        var ventana=document.getElementById("ventanaregistrosesion");
        var equis=document.getElementById("equis");
       document.getElementById("equis").addEventListener("click", function(){ 
            ventana.style.display="none";
            this.style.display="none";
            divventana.style.opacity="1";
        });
        document.getElementById("Sesion").addEventListener("click", function(){
            ventana.style.display="block";
            equis.style.display="block";
            
            divventana.style.opacity="0.4";
        });
    </script>
</body>
</html>