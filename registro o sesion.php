
<?php

include_once('conexion base de datos.php');

include_once('acciones.php');
$conexion=new conexionbd();
$conexion->conexion();
$iniciarsesion=new acciones($conexion);
session_start();
$mal=false;
$contrasenanoigual=true;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $ip=$_SERVER['REMOTE_ADDR'];
    $captcha=$_POST['g-recaptcha-response'];
    $secreto="6LfXZNMpAAAAAFqHpOtfFs7Oka47nvpnRtLDMNvM";
    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secreto&response=$captcha&remotip=$ip");
    $atributos=json_decode($respuesta,true);
    if(isset($_POST['ingresar'])){
        $usuarioiniciodesesion=$_POST['usuarioiniciodesesion'];
        $contrasenainiciodesesion=$_POST['contrasenainiciodesesion'];
       
        if($atributos['success']==true){
        if(!empty($usuarioiniciodesesion)&&!empty($contrasenainiciodesesion) ){
           

          if( $iniciarsesion->iniciarsesion($usuarioiniciodesesion,$contrasenainiciodesesion)==true){
            ?>
            <script>
                
               parent.location.reload();
               
            </script>
            <?php
           }
        
           } 
       
        }else{
            ?>
            <script>
                alert("No se ha resuelto el reCAPTCHA");
            </script>
            <?php
        }
    }
    }
    if(isset($_POST['crearusuario'])){
        $contrasena=$_POST['contrasena'];
        $usuario=$_POST['usuario'];
        $nombre=$_POST['nombre'];
        $correo=$_POST['correo'];
        $contrasena2=$_POST['contrasena2'];
        $apellido=$_POST['apellido'];
        $_SESSION['contrasenavali'] = $contrasena;
$_SESSION['usuariovali'] = $usuario;
$_SESSION['correovali'] = $correo;
$_SESSION['nombresvali'] = $nombre;
$_SESSION['apellidosvali'] = $apellido;

        $iniciarsesion->buscarcorreo($correo);
        $iniciarsesion->buscarusuario($usuario);
        if($iniciarsesion->correorepetido==false&& $iniciarsesion->usuariorepetido==false && $iniciarsesion->telefonoencontrado==false){
        if($contrasena2==$contrasena){
           
        if($atributos['success']==true){
            $_SESSION['correocofi']=$correo;
header('Location: validaciondecorreo.php');
           $iniciarsesion->enviodecorreo("Por favor, valida tu correo electrónico","Tu número de validación es:", $correo );
        }else{
            ?>
            <script>
            alert("No se ha resuelto el reCAPTCHA");
        </script>
        <?php
        }
        }else{
            $contrasenanoigual=false;
        }
    }
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="estilos/estiloregiistro.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <main>
        <section id="seccion1">
            <div id="segundoclick">
                
                <b>CREA TU USUARIO</b>
                <br>
                <br>
                
                <a href="" title="COntactanos mediante WhatsApp"> <button class="whats"><img src="imagenes/Pasted-20240414-004235_preview_rev_1.png" alt="" id="imagwats"></button></a>
     <a href="" title="Conocenos en Facebook"> <button class="face"><img src="imagenes/Pasted-20240414-004412_preview_rev_1.png" alt="" id="imagenface"></button></a>
     <a href="" title="Corre a ver nuestras historias en instagram"> <button class="ista"><img src="imagenes/Pasted-20240414-004542_preview_rev_2.png" alt="" id="imageninsta"></button></a>
     
                <form action="" method="post" id="formulariosecundario">
                
                    <div>
                    
                    <input  required type="text" placeholder=" " id="usuario" name="usuario" value="<?php if(isset($_POST['usuario'])) echo htmlspecialchars($_POST['usuario']); ?>">
                    <label for="usuario">Ingresa tu usuario</label>
                </div>
                <p id="errorusuario" class="errores"></p>
                <script>
                    document.getElementById("usuario").addEventListener("input", function() {
    var valor = this.value;

    if (valor.length > 1) {
        var espaciosencontrados = valor.substring(1).trim().length === 0;
        if (espaciosencontrados ) {
            document.getElementById("errorusuario").innerHTML="&#10005; Ingresa un nombre de usuario valido";
            
        }else{
            document.getElementById("errorusuario").innerHTML="";
            
        }
    }else{
        document.getElementById("errornombre").innerHTML="";
    }
});
                </script>
                <?php
                    if($iniciarsesion->usuariorepetido==true){
                        ?>
                        <p class="trues"> <img src="imagenes/Pasted-20240110-165916_preview_rev_1.png" alt="">El usuario ya esta existente, ingresa otro</p>
                       
                        <?php
                    }
                    ?>
                <div>
                    <input required type="email" id="correo"placeholder=" " name="correo" value="<?php if(isset($_POST['correo'])) echo htmlspecialchars($_POST['correo']); ?>">
                    <label for="correo">Ingresa tu correo</label>
                </div>
                <p id="errorsintaxis"class="errores" ></p>
                <script>
        var correoinput = document.getElementById("correo");
        var errorsintaxis = document.getElementById("errorsintaxis");
        const formato = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        correoinput.addEventListener("input", function(){
            var correo = correoinput.value;
            if (correo === "") {
                errorsintaxis.innerText = "";
                errorsintaxis.style.display = "none";
            }else if (formato.test(correo)) {
                errorsintaxis.innerText="";
                errorsintaxis.style.display = "none";
            } else if(!formato.test(correo)) {
                errorsintaxis.innerHTML="&#10005; Ingresa un correo válido";
                errorsintaxis.style.display = "block";
            }
        });
        correoinput.addEventListener("keydown", function(event) {
            if (event.key === " ") {
                event.preventDefault();
            }
        });
    </script>
                <?php
                    if($iniciarsesion->correorepetido==true){
                        ?>
                        <p class="trues"> <img src="imagenes/Pasted-20240110-165916_preview_rev_1.png" alt="">El correo ya existe en una cuenta, ingresa otro diferente </p>
                        
                        <?php
                    }
                    ?>
                    <div>
                    <input id="nombreres" required type="text" placeholder=" " name="nombre" value="<?php if(isset($_POST['nombre'])) echo htmlspecialchars($_POST['nombre']); ?>" >

                    <label for="contrasena" placeholder=" ">Ingresa tu nombre</label>
                </div>
                <p id="errornombre" class="errores"></p>
                <script>
                    const formatonap = /^[A-Za-z\s]+$/;
                   
                        document.getElementById("nombreres").addEventListener("keydown", function(evento){
                            if(!formatonap.test(evento.key)){
                                evento.preventDefault();
                            }
                        });
                        document.getElementById("nombreres").addEventListener("input", function() {
    var valor = this.value;

    if (valor.length > 1) {
        var espaciosencontrados = valor.substring(1).trim().length === 0;
        if (espaciosencontrados ) {
            document.getElementById("errornombre").innerHTML="&#10005; Ingresa un nombre valido";
        }else{
            document.getElementById("errornombre").innerHTML="";
        }
    }else{
        document.getElementById("errornombre").innerHTML="";
    }
});
                    </script>
                <div>
                    <input required type="text" id="apellidosres" placeholder=" " name="apellido" value="<?php if(isset($_POST['apellido'])) echo htmlspecialchars($_POST['apellido']); ?>">
                    <label for="contrasena" placeholder=" ">Ingresa tu(s) apellido(s)</label>
                </div>
                <p id="errorenapellodo" class="errores"></p>
                <script>
                        document.getElementById("apellidosres").addEventListener("keydown", function(evento){
                            if(!formatonap.test(evento.key)){
                                evento.preventDefault();
                            }
                        });
                        document.getElementById("apellidosres").addEventListener("input", function() {
    var valor = this.value;

    if (valor.length > 1) {
        var espaciosencontrados = valor.substring(1).trim().length === 0;
        if (espaciosencontrados ) {
            document.getElementById("errorenapellodo").innerHTML="&#10005; Ingresa un(os) apellidos valido(s)";
        }else{
            document.getElementById("errorenapellodo").innerHTML="";
        }
    }else{
        document.getElementById("errorenapellodo").innerHTML="";
    }
});
                    </script>
                <div>
                    <input required type="password" placeholder=" " id="contrasenares" name="contrasena" value="<?php if(isset($_POST['contrasena'])) echo htmlspecialchars($_POST['contrasena']); ?>">
                    <label for="contrasena" placeholder=" ">Ingresa tu contraseña</label>
                    
                </div>
                <p id="mayus" class="errores2">&#10005;Al menos una mayuscula A-Z</p>
                <p id="minus" class="errores2">&#10005;Al menos una minuscula a-z</p>
                <p id="0al9" class="errores2">&#10005;Al menos un numero 0-9</p>
                <p id="especial" class="errores2">&#10005;Al menos un caracter especial</p>
                <p id="caracteres" class="errores2">&#10005;Al menos 8 caracteres</p>
                <script>

                   const almenosunnum = /(?=.*[0-9])/;
const especial = /(?=.*[!@#\$%\^&\*])/;
const mayus = /(?=.*[A-Z])/;
const mini = /(?=.*[a-z])/;
                    document.getElementById("contrasenares").addEventListener("input", function() {
                        var nums=document.getElementById("0al9");
                       var especial2= document.getElementById("especial");
                       var mayus2= document.getElementById("mayus");
                       var minus2= document.getElementById("minus");
                       var caracteres = document.getElementById("caracteres");

            if (this.value.length > 7) {  
                caracteres.innerHTML = "&#10004; Al menos 8 caracteres";
                caracteres.className = "true"; 
                
                caracteres.style.color="greenyellow";
            } else {
                caracteres.innerHTML = "&#10005;Al menos 8 caracteres";
                caracteres.className = "errores2"; 
                
                caracteres.style.color="red";
            }
    if (!almenosunnum.test(this.value)) {
        nums.innerHTML="&#10005;Al menos un numero 0-9";
        nums.class="errores2";
        nums.style.color="red";
    } else {
        nums.innerHTML="&#10004;Al menos un numero 0-9";
        nums.class="true";
        nums.style.color="greenyellow";
    }
    if (!especial.test(this.value)) {
        especial2.style.color="red";
        especial2.innerHTML="&#10005;Al menos un caracter especial";
        especial2.class="errores2";
    } else {
        especial2.innerHTML="&#10004;Al menos un caracter especial";
        especial2.class="true";
        especial2.style.color="greenyellow";
    }
    if (!mayus.test(this.value)) {
        mayus2.style.color="red";
        mayus2.innerHTML="&#10005;Al menos una mayuscula A-Z";
        mayus2.class="errores2";
    } else {
        mayus2.innerHTML="&#10004;Al menos una mayuscula A-Z";
        mayus2.class="true";
        mayus2.style.color="greenyellow";
    }
    if (!mini.test(this.value)) {
        minus2.style.color="red";
        minus2.innerHTML="&#10005;Al menos una minuscula a-z";
        minus2.class="errores2";
    } else {
        minus2.innerHTML="&#10004;Al menos una minuscula a-z";
        minus2.class="true";
        minus2.style.color="greenyellow";
    }
});
                        document.getElementById("contrasenares").addEventListener("keydown", function(evento){
                            if (this.value.length >= 20 && evento.key !== 'Backspace') {
        evento.preventDefault();
    }
    
                           
                        });
                    </script>
                <div>
                    <input required type="password" placeholder=" " id="contra2"  name="contrasena2" value="<?php if(isset($_POST['contrasena2'])) echo htmlspecialchars($_POST['contrasena2']); ?>">
                    <label for="confirmacioncontrasena">Confirma tu contraseña</label>
                    <script>
                          document.getElementById("contra2").addEventListener("keydown", function(evento){
                            if(this.value.length>19){
                                evento.preventDefault();
                            }

                        });
                    </script>
                </div>
                <?php
                if($contrasenanoigual==false){
                    
                    ?>
<script>
    var contrasenanoigual=false;
</script>
                        <p class="trues"> <img src="imagenes/Pasted-20240110-165916_preview_rev_1.png" alt=""> las contraseñas no coiciden  </p>
                        
                        <?php
                }
                ?>
               <div class="g-recaptcha" data-sitekey="6LfXZNMpAAAAAJY0MY5b8bVeDOAolVSo-aKePraj">
                    
                    </div>
                    <br>
                    <input type="submit" name="crearusuario" value="CREAR USUARIO" id="hola">
                    <script>
                        var registro=document.getElementById("hola");
                        registro.addEventListener("click", function(evento) {
    var nombrusuario = document.getElementById("usuario").value;
    var correo = document.getElementById("correo").value;
    var nombreres = document.getElementById("nombreres").value;
    var apellidosres = document.getElementById("apellidosres").value;
    var contrasenares = document.getElementById("contrasenares").value;
    var contra2 = document.getElementById("contra2").value;
    var erroresarray = document.querySelectorAll(".errores");
    var errorcontrasenaformat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,20}$/;
    if (nombrusuario === "" || correo === "" || nombreres === "" || apellidosres === "" || contrasenares === "" || contra2 === "") {
        alertify.defaults.notifier.position = 'bottom-right';
        alertify.customError = function(message) {
            alertify.error(message, 5);
        };
        alertify.customError("No has rellenado todos los campos");
        evento.preventDefault();
    } else if (!errorcontrasenaformat.test(contrasenares)) {
        alertify.defaults.notifier.position = 'bottom-right';
        alertify.customError = function(message) {
            alertify.error(message, 5);
        };
        alertify.customError("La contraseña no cumple con el formato requerido");
        evento.preventDefault();
    } else {
        for (var i = 0; i < erroresarray.length; i++) {
            var elemento = erroresarray[i];
            if (elemento.textContent.trim() !== "") {
                alertify.defaults.notifier.position = 'bottom-right';
                alertify.customError = function(message) {
                    alertify.error(message, 5);
                };
                alertify.customError("Hay errores en el formulario");
                evento.preventDefault();
                break;
            }
        }
    }
});
</script>
                </form>
            </div>
            <div id="iniciarsesion" >
                <br><br><br><br>
            <b>INICIO DE SESION</b>
            <br>
            <br>
            <a href="" title="COntactanos mediante WhatsApp"> <button class="whats"><img src="imagenes/Pasted-20240414-004235_preview_rev_1.png" alt="" id="imagwats"></button></a>
     <a href="" title="Conocenos en Facebook"> <button class="face"><img src="imagenes/Pasted-20240414-004412_preview_rev_1.png" alt="" id="imagenface"></button></a>
     <a href="" title="Corre a ver nuestras historias en instagram"> <button class="ista"><img src="imagenes/Pasted-20240414-004542_preview_rev_2.png" alt="" id="imageninsta"></button></a>
     
            
            <form action="" method="post">
                
                <div><input type="text" placeholder=" " required name="usuarioiniciodesesion">
                    <label for="usuario">Ingresa tu usuario</label></div>
                    <?php
                    if($iniciarsesion->usuarionoencontrado=="no usuario"){
                        ?> <p class="trues"><img src="imagenes/Pasted-20240110-165916_preview_rev_1.png" alt="">Usuario no encontrado </p><?php
                    }
                    ?>
                <div>
                    <input   type="password" placeholder=" " required name="contrasenainiciodesesion">
                    <label for="contrasena">Ingresa tu contraseña</label>
                    
                </div>
                
                <?php
                    if($iniciarsesion->contrasenainvalida=="no contrasena"){
                        ?> <p class="trues" ><img src="imagenes/Pasted-20240110-165916_preview_rev_1.png" alt="">Contraseña no reconocida  </p><?php
                    }
                    ?>
                <br>
                <div class="g-recaptcha" data-sitekey="6LfXZNMpAAAAAJY0MY5b8bVeDOAolVSo-aKePraj">
                    
                    </div>
                    
                    
                    
                <br>
                <br>
                <br>
                <br>
                <br>
                <input type="submit" value="Ingresar"    name="ingresar" >
                
                <br>
                <br>
            </form>

            <input id="olvidada" type="submit" required value="¿Olvidaste tu contraseña? Recuperala aqui.">
            <script>
                document.getElementById("olvidada").addEventListener("click", function(){
                    window.location.href = "RecuperacionCuenta.php";
                });
            </script>
        </div>
        </section>
        <section id="seccion2">
            <div id="div1section2"  >
<b>Hola amigo</b>
<br><br>
<p>Registrate para poder disfrutar de todo lo que te ofrecemos </p>
<br>
<button id="registro"><b>REGISTRATE AHORA</b></button>
</div>
<div id="crearusuario">
    <b>HOLA QUE BUENO VERTE</b>
    <br>
    <p> Inicia secion para poder hacer tus compras y hacer citas para que nuestros asombrsos barberos realicen tu corte favorito</p>
    <br>
    <button id="ingresardos">Ingresar</button>
</div><script>
    var seccion2 = document.getElementById("seccion2");
    var seccion1 = document.getElementById("seccion1");
    var crearusuario = document.getElementById("crearusuario");
    var div1section2 = document.getElementById("div1section2");
    var segundoclick = document.getElementById("segundoclick");
    var iniciarsesion = document.getElementById("iniciarsesion");

    var registro = document.getElementById("registro").addEventListener("click", function(){
        seccion1.style.transition = "0.5s";
        seccion1.style.order = "2";
        seccion2.style.animation = " backInRight 1s ";
        seccion2.style.zIndex = "2";
        div1section2.style.display = "none";
        iniciarsesion.style.display = "none";

        segundoclick.style.display = "block";

        seccion2.style.height="120vh";
        crearusuario.style.display = "flex";
        seccion2.style.order = "1";
        seccion2.style.transition = "0.5s";
        seccion1.style.animation = "backInLeft 1s ";
    });
    var trues=document.querySelectorAll(".trues");
        var ingresardos = document.getElementById("ingresardos").addEventListener("click", function(){
            div1section2.style.display = "flex";
            iniciarsesion.style.display = "block";
            seccion2.style.height="100vh";
            seccion2.style.animation = "backInLeft 1s ";
            seccion1.style.animation = "backInRight 1s ";
            segundoclick.style.display = "none";
            crearusuario.style.display = "none";
            seccion1.style.order = "1";
            seccion2.style.order = "2";
            trues.forEach(element => {
                element.style.display="none";
            });
            

        });
        
       
</script>
<script>
     if(contrasenanoigual==false){seccion1.style.transition = "0.5s";
        seccion1.style.order = "2";
        seccion2.style.animation = " backInRight 1s ";
        seccion2.style.zIndex = "2";
        div1section2.style.display = "none";
        iniciarsesion.style.display = "none";

        segundoclick.style.display = "block";

        crearusuario.style.display = "flex";
        seccion2.style.order = "1";
        seccion2.style.transition = "0.5s";
        seccion1.style.animation = "backInLeft 1s ";
    
     }
</script>
<?php

 if($iniciarsesion->usuariorepetido==true || $iniciarsesion->correorepetido==true ||$iniciarsesion->telefonoencontrado==true ||$contrasenanoigual2=false ){

    ?> 
    <script>
    seccion1.style.transition = "0.5s";
        seccion1.style.order = "2";
        seccion2.style.animation = " backInRight 1s ";
        seccion2.style.zIndex = "2";
        div1section2.style.display = "none";
        iniciarsesion.style.display = "none";
        seccion2.style.height="125vh";
        segundoclick.style.display = "block";

        crearusuario.style.display = "flex";
        seccion2.style.order = "1";
        seccion2.style.transition = "0.5s";
        seccion1.style.animation = "backInLeft 1s ";

        </script>

    <?php
 }
?>
<script>
                var whats=document.querySelectorAll(".whats");
                whats.forEach(element => {
                    element.addEventListener("click", function(evento){
            window.open('https://wa.link/mqglhe', '_blank');
            evento.preventDefault();
});
                });
              
        var ista = document.querySelectorAll(".ista");
        ista.forEach(element => {
            element.addEventListener("click", function(evento){
           evento.preventDefault();
           window.open('https://www.instagram.com/levyscutz?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==', '_blank');
           
           
                   });
        });
var face = document.querySelectorAll(".face");

face.forEach(element => {
            element.addEventListener("click", function(evento){
           evento.preventDefault();
window.open('https://www.facebook.com/people/Levys-Cutz-barber/100083054445979/?mibextid=ZbWKwL','_blank') ;
           
                   });
        });
            </script>
</body>
</html>