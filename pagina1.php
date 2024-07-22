<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');
$conexion=new conexionbd();
$conexion->conexion();
$acciones=new acciones($conexion);
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['horas']) &&isset($_GET['fecha']) ) {
        $uno=$_GET['1'];
        $uno= $uno.$_GET['2'];
        $uno= $uno.$_GET['3'];
        $uno= $uno.$_GET['4'];
        $uno= $uno.$_GET['5'];
        $uno= $uno.$_GET['6'];
        $uno= $uno.$_GET['7'];
        $uno= $uno.$_GET['8'];
        $uno= $uno.$_GET['9'];
        $uno= $uno.$_GET['10'];
        $hora = $_GET['horas'];
        $fecha = $_GET['fecha'];
        if($hora==null||$fecha ==null ){
    ?>

<script>
    alert("compreta la informacion que se te solicita");
</script>
<?php

        }else{
            
            if(strlen($uno)==0 ){
                $acciones->agregarcita($hora,$fecha, false, null);
               
            }else if(strlen($uno)!=10 ){
                ?>
                <script>
                  

                </script>
                <?php
            }elseif(strlen($uno)==10){
                $acciones->agregarcita($hora,$fecha, true,$uno);
                
            }
           
        }
    }
}  

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilopagina1.css">
    <title>Citas LEVY'S CUTS</title>
    <!-- ajax para busqueda automatica-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- ajax para busqueda automatica-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="shortcut icon" href="imagenes/calendar_add_on_40dp_FILL0_wght400_GRAD0_opsz40.png" type="image/x-icon">
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <!--alertas alertifyjs--->
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="divprincipal">
    <header>
        <?php
         if (isset($_SESSION['img']) &&$_SESSION['img']!="data:image/jpeg;base64,") {
             $img_src = $_SESSION['img'];
         } else {
             $img_src = 'imagenes/descarga.png';
         }
         if(isset($_SESSION['usuario'])){
            ?> <button title="Visualizar usuario">
            <img id="imagusuario" src="<?php echo $img_src; ?>" alt="Imagen de usuario" width="50px" height="40px">
        </button>

        <?php
        }else{
            ?>   <button title="Iniciar sesion o Registrarse" id="toque"> <img  src="imagenes/Pasted-20240305-155825_preview_rev_1 (1).png" alt="Usuario"></button>
           <?php
        }
        ?>
        <img src="imagenes/image.png" alt="logo">
    </header>
    <nav>
        
        <a href="" class="citas"><button > CITAS</button></a>
        <a href="Productos.php"><button> PRODUCTOS</button></a>
        <a href="Pagina4.php"><button> UBICACIÓN </button></a>
        <a href="pagina5.php"><button> QUIENES SOMOS </button></a>
    </nav>
    <div id="divmain">
    <main><div>
        
    <form  id="formulario" method="get">
        <p>¡AGENDA TU CITA!</p>
        <br>
        <p><img src="imagenes/R-2.png" alt="Referencia" id="Referencia">Sin disponibilidad </p>
        <br>
        <?php
        if(!isset($_SESSION['telefono'])){

        ?>
        <p>INGRESA TU NUMERO CELULAR 
            POR CUALQUIER ACLARACION</p>
            <?php }else{


$telefono = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : null;
if($telefono==""){
    ?>
    <p>INGRESA TU NUMERO CELULAR 
    POR CUALQUIER ACLARACION</p>
    <?php
}else{


?>
<b>TE LLAMAREMOS AL NÚMERO <?php echo '*****', $telefono ? substr($telefono, 5, 10) . '' : '' ?> O INGRESA UN NUEVO NÚMERO PARA CUALQUIER ACLARACIÓN</b>
<?php   
}         
}
            ?>
            <br>
            <input class="input" name="1" type="tel" maxlength="1"value="">
<input class="input" name="2" type="tel" maxlength="1" value="">
<input class="input" name="3" type="tel" maxlength="1"value="">
<input class="input" name="4" type="tel" maxlength="1"value="">
<input class="input" name="5" type="tel" maxlength="1"value="">
<input class="input" name="6" type="tel" maxlength="1"value="">
<input class="input" name="7" type="tel" maxlength="1"value="">
<input class="input" name="8" type="tel" maxlength="1"value="">
<input class="input" name="9" type="tel" maxlength="1"value="">
<input class="input" name="10" type="tel" maxlength="1"value="">
                <script>
                   var inputs = document.querySelectorAll('.input');
    inputs.forEach(function(elemento, numero, arreglo) {
        elemento.addEventListener("input", function(evento) {
            elemento.value = elemento.value.replace(/\D/g, '');
            if (elemento.value.length > 1) {
                elemento.value = elemento.value.slice(0, 1);
            }
            if (elemento.value.length > 0 && numero < arreglo.length - 1) {
                arreglo[numero + 1].focus();
            }
        });
    });

                </script>
                
    <br>
   
            
               
        </div>
        <div id="div2">
            
            <p for="fecha" id="calendario">Selecciona una fecha:</p>
            <input type="text" id="fecha" name="fecha" required>
            
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"  id="calendariocal"></script>
           
            <p class="selectorhora2">Seleccione la hora:</p>
            <select name="horas" id="selectorhora" required
            >
            <option name="hora" value="09:00:00" id="123">09:00</option>
<option name="hora" value="10:00:00" id="10:00:00">10:00</option>
<option name="hora" value="11:00:00" id="11:00:00">11:00</option>
<option name="hora" value="12:00:00" id="12:00:00">12:00</option>
<option name="hora" value="13:00:00" id="1:00:00">13:00</option>
<option name="hora" value="14:00:00" id="2:00:00">14:00</option>
<option name="hora" value="15:00:00" id="3:00:00">15:00</option>
<option name="hora" value="16:00:00" id="4:00:00">16:00</option>
<option name="hora" value="17:00:00" id="5:00:00">17:00</option>
<option name="hora" value="18:00:00" id="6:00:00">18:00</option>
<option name="hora" value="19:00:00" id="7:00:00">19:00</option>
<option name="hora" value="20:00:00" id="8:00:00">20:00</option>
<option name="hora" value="21:00:00" id="9:00:00">21:00</option>
<option name="hora" value="22:00:00" id="10:00:00">22:00</option>
            </select>
            
 <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
            <script>
            <?php 
$acciones->dias();?>
 var selectedDate;

 var selector=document.getElementById("selectorhora");
                    selector.size = 5;
        $(document).ready(function() {
            // Inicializar el calendario Flatpickr en modo inline
            $('#fecha').flatpickr({
                inline: true,
                dateFormat: "Y-m-d",
                defaultDate: "today",
                locale: "es",  
                minDate: "today",
                disable: [
                    <?php 
                    foreach ($acciones->diasrojos as $fecha) {
                        echo '"' . $fecha . '", ';
                    }
                    ?>
                ],
                onChange: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.querySelectorAll(".flatpickr-day").forEach(function(day) {
                        var date = instance.parseDate(day.dateObj, "Y-m-d");
                        <?php
                        foreach ($acciones->diasrojos as $fecha) {
                            $date = new DateTime($fecha);
                            echo "if (date.getFullYear() === " . $date->format('Y') . " && date.getMonth() === " . ($date->format('m') - 1) . " && date.getDate() === " . $date->format('d') . ") {";
                            echo "day.classList.add('highlighted');}";
                        }
                        ?>
                    });
                     selectedDate = dateStr;
                    if (selectedDate) {
                        $.ajax({
                            url: 'buscarfechas.php',
                            method: 'GET',
                            data: { date: selectedDate },
                            dataType: 'json',
                            success: function(data) {
                                var hoursSelect = $('#selectorhora');
                                hoursSelect.find('option').prop('disabled', false); // Habilitar todas las opciones

                                if (data.length > 0) {
                                    $.each(data, function(index, item) {
                                        var option = hoursSelect.find('option[value="' + item.hora + '"]');
                                        option.prop('disabled', true);
                                        option.addClass('disabled-option'); // Agregar clase CSS
                                    });
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert("Error: " + textStatus + " - " + errorThrown);
                            }
                        });
                    } else {
                        $('#selectorhora').find('option').prop('disabled', true); // Habilitar todas las opciones
                    }
                }
            });
        });
    </script>
        </div>
        <div id="div3">
           <p id="apertura"> HORA DE APERTURA:
            10:00 AM A 8:00 PM </p>
            <button id="confirmarcita" name="confirmarcita" title="Concluir cita">CONFIRMAR CITA
            </button>
            <script>
                var body=document.getElementById("divprincipal");
                var citaconfirmar=document.getElementById("toque").addEventListener("click", function(){
                    var ventanaregistrosesion=document.getElementById("ventanaregistrosesion");
                    ventanaregistrosesion.style.display="block";
      var tache=document.getElementById("equis");
      tache.style.display="block";
                    
body.style.opacity = "0.2";
                });
                
            </script>
        </div>
    </form>
    </main>
</div>
<footer>
   <div >
    <hr>
    <a href="" title="Contactanos mediante WhatsApp"> <button id="whats"><img  src="imagenes/Pasted-20240414-004235_preview_rev_1.png" alt="" id="imagwats"></button></a>
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
        var body =document.getElementById("divprincipal");
        body.style.opacity="1";
      this.style.display="none";
    });
        alertify.defaults.notifier.position = 'bottom-right';
        alertify.customWarning = function(message) {
            alertify.warning(message, 5);  
        };


        document.getElementById("confirmarcita").addEventListener("click", function(evento){
    
            <?php
                    if(!isset($_SESSION['usuario'])){
                        
                        ?>
                        evento.preventDefault(); 
                        ventanaregistrosesion.style.display="block";
       var tache=document.getElementById("equis");
       tache.style.display="block";
                     
 body.style.opacity = "0.2";
                         <?php

                    }else{
                    ?>
            var numeroscel = document.querySelectorAll(".input");
            var contador = 0;

            numeroscel.forEach(element => {
                if(element.value.trim() === "") {
                    contador++;
                }
            });
            if(contador > 0 && contador < 9) {
               
               alertify.customWarning("No has ingresado todos los dígitos del número telefónico");
               evento.preventDefault();
           }
           var error=0;
           var selectElement = document.getElementById("selectorhora");
           if (selectElement.selectedIndex !== -1) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    if (selectedOption.disabled) {
        alertify.customWarning("No has seleccionado ninguna hora para tu cita");
        error++;
        evento.preventDefault();
    }
} else {
    alertify.customWarning("No has seleccionado ninguna hora para tu cita");
    error++;
    evento.preventDefault();
}
           if (!selectedDate) {
    alertify.customWarning("Por favor, selecciona una fecha antes de confirmar la cita.");
    error++;
    evento.preventDefault(); 
}
if(error===0){
            <?php
                    
        if($_SESSION['telefono']==null||$_SESSION['telefono']==""){
            ?>
            if(contador==10){
                
evento.preventDefault();
                alertify.confirm(
                "No ha proporcionado un número telefónico. ¿Desea continuar? De lo contrario, le enviaremos un correo electrónico en caso de cualquier anomalía con su cita.",
                function() {
                    alertify.success('Continuando sin número telefónico.');
                    document.getElementById('formulario').submit();
                },
                function() {
                    
                }
            ).set({title: "Levi's cuts"});;
                            
            }
                          
                        
                        <?php
                    }?>
}
                    <?php
                    }
                        ?>
        
        });
</script>
<script>
    document.getElementById("imagusuario").addEventListener("click", function(){
       window.location.href="pagusuario.php";
    });
</script>  

</script>
    </body>
</html>