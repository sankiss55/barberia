<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
$acciones->traerproductossionusuario();


if ($_SERVER['REQUEST_METHOD'] == "GET" ) {
    $array= array();
    $array2= array();
    for ($i = 0; $i < $acciones->contador; $i++) {
            if(isset($_GET['marca'.$i])){
                $array[]=$_GET['marca'.$i];
            }
            if(isset($_GET['product'.$i])){
                $array2[]=$_GET['product'.$i];
            }
    }
if (isset($_GET['cal1'])||isset($_GET['cal2'])||isset($_GET['cal3'])||isset($_GET['cal4'])||isset($_GET['cal5']) || isset($_GET['busquedapor']) || !empty( $array2)||!empty( $array) ) {
    $max = isset($_GET['rangoMinimo']) ? $_GET['rangoMinimo'] : "";
$min = isset($_GET['rangoMaximo']) ? $_GET['rangoMaximo'] : "";
$cal1 = isset($_GET['cal1']) ? $_GET['cal1'] : "";
$cal2 = isset($_GET['cal2']) ? $_GET['cal2'] : "";
$cal3 = isset($_GET['cal3']) ? $_GET['cal3'] : "";
$cal4 = isset($_GET['cal4']) ? $_GET['cal4'] : "";
$cal5 = isset($_GET['cal5']) ? $_GET['cal5'] : "";

$marca= isset($_GET['marca']) ? $_GET['marca'] : "";
$busquedapor = isset($_GET['busquedapor']) ? $_GET['busquedapor'] : "";

    $acciones->busquedapor($max, $min, $cal1, $cal2, $cal3, $cal4, $cal5, $busquedapor, $array,$array2);
}
       
        
    
    if(isset($_SESSION['usuario'])){
    
    for ($i = 0; $i < $acciones->contador; $i++){
        if(isset($_GET[''. $i]) ){
            if($acciones->descuento[$i]==1){
            $acciones->ventausuario($acciones->id_productos[$i],$acciones->precio[$i]-($acciones->precio[$i]*(0.01*$acciones->cantidad_descuento[$i])));
            }else{
                $acciones->ventausuario($acciones->id_productos[$i],$acciones->precio[$i]);
            }
            break;
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
    <link rel="stylesheet" href="estilos/Estilos_calev.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="imagenes/category_40dp_FILL0_wght400_GRAD0_opsz40.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Incluir un tema para alertify.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <title>Compra de Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
</head>
<body>
   

  <div id="ventanacompleta">
  <header>
    <img class="imgLogo" src="imagenes/image.png" alt="logo" width="90px" height="7%" >
    <?php
     if (isset($_SESSION['img']) &&$_SESSION['img']!="data:image/jpeg;base64,") {
        $img_src = $_SESSION['img'];
    } else {
        $img_src = 'imagenes/descarga.png';
    }   
    if(isset($_SESSION['usuario'])){

        ?> <button id="imgre"  title="visulizar usuario"><img id="imagusuario"  src="<?php echo $img_src; ?>" alt="registrate" width="50px" height="40px  " ></button> <?php
    }else{
       
    ?> <button id="imgre" title="registrar  ese o iniciar sesion"><img  src="imagenes/Pasted-20240305-155825_preview_rev_1 (1).png" alt="registrate" width="50px" height="40px  " ></button> <?php
    }   
    ?>
    <br><br> <script>
         <?php
    if(!isset($_SESSION['usuario'])){

        ?>
      var body=document.getElementById("ventanacompleta");
      var citaconfirmar=document.getElementById("imgre").addEventListener("click", function(){
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
          <li class="productos">PRODUCTOS</li>
          <li><a href="Pagina4.php" title="UBICACION">UBICACION</a></li>
          <li><a href="pagina5.php" title="¿QUIENES SOMOS?">¿QUIENES SOMOS?</a></li>
           
        </ul>
    </nav>
    
    <div class="divicionarriba">
        
    <form  method="get">
        <div id="barradebusqueda"><input type="search" name="busquedapor" id="" value="<?php echo isset($_GET['busquedapor']) ? $_GET['busquedapor'] : ""; ?>">
        <button type="submit"> <img src="imagenes/search_FILL0_wght400_GRAD0_opsz48.png" alt="lupita"></button></div>
        <main>
        <section id="filtracion">
        <button id="carritodeconpras" title="Ver arrito de compra"></button>

        <button id="filtrar">Filtrar datos</button>
            
                <script>
                document.getElementById("carritodeconpras").addEventListener("click", function(evento){
                    evento.preventDefault();
<?php
            if(!isset($_SESSION['usuario'])){?>
var ventanaregistrosesion=document.getElementById("ventanaregistrosesion");
          ventanaregistrosesion.style.display="block";
var tache=document.getElementById("equis");
tache.style.display="block";
          
body.style.opacity = "0.2";
<?php
 }else{
    
        ?>
        
        window.location.href= "productosapartados.php";
        <?php
 }?>
                });
            </script>
           <div class="diferentesfiltraciones">
    <button id="botonprecio" class="botonfiltracion" > Precio <p class="rotacion">&gt;</p></button>
    <div id="rangoprecio">

        <input type="range" name="rangoMinimo"  id="rangoMinimo"class="min"min="0" max="1000" value="<?php echo isset($_GET['rangoMinimo']) ? $_GET['rangoMinimo'] : 0; ?>" oninput="checkRanges()">

        <input type="range"  id="rangoMaximo"  name="rangoMaximo"  min="0"  max="1000"  class="min"  value="<?php echo isset($_GET['rangoMaximo']) ? $_GET['rangoMaximo'] : 1000; ?>"  oninput="checkRanges()">
        <br>

        <span id="span1">&dollar; 
            <input id="rangoMinimoValue"  class="rangodinero" type="number" min="0"  max="1000" value="<?php echo isset($_GET['rangoMinimo']) ? $_GET['rangoMinimo'] : 0; ?>">
        </span>
        <br>
        <p>a</p><br>
        <span id="span1">&dollar; 
            <input id="rangoMaximoValue" class="rangodinero" type="number" min="0" max="1000" value="<?php echo isset($_GET['rangoMaximo']) ? $_GET['rangoMaximo'] : 1000; ?>">
        </span>

        <script>
            function checkRanges() {
                let rangoMinimo = document.getElementById('rangoMinimo');
                let rangoMaximo = document.getElementById('rangoMaximo');
                let rangoMinimoValue = document.getElementById('rangoMinimoValue');
                let rangoMaximoValue = document.getElementById('rangoMaximoValue');
                rangoMinimoValue.value = rangoMinimo.value;
                rangoMaximoValue.value = rangoMaximo.value;
                if (parseInt(rangoMinimo.value) > parseInt(rangoMaximo.value)) {
                    rangoMinimo.value = rangoMaximo.value;
                    rangoMinimoValue.value = rangoMaximo.value;
                }
                rangoMinimoValue.addEventListener('input', function() {
                    if (parseInt(rangoMinimoValue.value) > parseInt(rangoMaximoValue.value)) {
                        rangoMinimoValue.value = rangoMaximoValue.value;
                    }
                    rangoMinimo.value = rangoMinimoValue.value;
                });
                if (parseInt(rangoMaximo.value) < parseInt(rangoMinimo.value)) {
                    rangoMaximo.value = rangoMinimo.value;
                    rangoMaximoValue.value = rangoMinimo.value;
                }
                rangoMaximoValue.addEventListener('input', function() {
                    if (parseInt(rangoMaximoValue.value) < parseInt(rangoMinimoValue.value)) {
                        rangoMaximoValue.value = rangoMinimoValue.value;
                    }
                    rangoMaximo.value = rangoMaximoValue.value;
                });
            }
            document.addEventListener('DOMContentLoaded', function() {
                checkRanges();
            });
        </script>
    </div>
</div>

        <br>
        <div class="diferentesfiltraciones">
        <button id="botonmarca" class="botonfiltracion">marca <p class="rotacion">&gt;</p></button>
        <div id="divmarca">
          <?php
$palabras = $acciones->marca2;
for ($i = 0; $i < count( $acciones->marca2); $i++) {
    $encontrado = false;
    for ($j = 0; $j < $i; $j++) {
        if ($palabras[$j] == $acciones->marca2[$i]) {
            $encontrado = true;
            break;
        }
    }
    if (!$encontrado) {
?>
       <input type="checkbox" id="<?php echo "marca".$i ?>" name=<?php echo "marca".$i; ?> <?php if(isset($_GET["marca".$i])) echo "checked"; ?> value="<?php echo $acciones->marca2[$i]?>" onchange="clicksi()">
<label><?php echo $acciones->marca2[$i] . "( " . $acciones->cantidad2[$i] . " )" ?></label><br><br>


<?php
    }
}
?>
<br> 
        </div>
        </div>
        
        <br>
        <div class="diferentesfiltraciones">
            
        <button id="botonfiltracionn" class="botonfiltracionn">opiniones <p class="rotacion">&gt;</p></button>
        <div id="divopiniones">
            <div id="divestrellas">
            <input type="checkbox" <?php if(isset($_GET['cal1'])) echo "checked"; ?> onchange="clicksi()" name="cal1" value="5" id="1"><label for="1">&#9733;&#9733;&#9733;&#9733;&#9733;</label><br>
    <input type="checkbox" <?php if(isset($_GET['cal2'])) echo "checked"; ?> onchange="clicksi()" name="cal2" value="4" id="2"><label for="2">&#9733;&#9733;&#9733;&#9733;&#9734;</label><br>
    <input type="checkbox" <?php if(isset($_GET['cal3'])) echo "checked"; ?> onchange="clicksi()" name="cal3" value="3" id="3"><label for="3">&#9733;&#9733;&#9733;&#9734;&#9734;</label><br>
    <input type="checkbox" <?php if(isset($_GET['cal4'])) echo "checked"; ?> onchange="clicksi()"name="cal4" value="2" id="4"><label for="4">&#9733;&#9733;&#9734;&#9734;&#9734;</label><br>
    <input type="checkbox"<?php if(isset($_GET['cal5'])) echo "checked"; ?> onchange="clicksi()"name="cal5" value="1" id="5"><label for="5">&#9733;&#9734;&#9734;&#9734;&#9734;</label><br>
 


       </div>
            
            
        </div>
        <br>
        </div>
        <script>
</script>
        <br>
        <div  class="diferentesfiltraciones">
        <button id="tipodeproducto" class="botonfiltracion">Tipo de producto <p class="rotacion">&gt;</p></button>
        <div id="divtipodeproducto">
          <?php
$palabras = $acciones->tipo_de_producto2;
for ($i = 0; $i < count($acciones->tipo_de_producto2); $i++) {
    $encontrado = false;
    for ($j = 0; $j < $i; $j++) {
        if ($palabras[$j] == $acciones->tipo_de_producto2[$i]) {
            $encontrado = true;
            break;
        }
    }
   if(!$encontrado) {
?>
      <input class="tipcroduct" id="tipcroduct_<?php echo $i; ?>" type="checkbox" value="<?php echo $acciones->tipo_de_producto2[$i]; ?>" name="<?php echo "product".$i ?>" <?php if(isset($_GET["product".$i])) echo "checked"; ?> onchange="clicksi()">
<label for="tipcroduct_<?php echo $i; ?>"><?php echo $acciones->tipo_de_producto2[$i]; ?></label>
<br><br>
<?php
    }
}
?>

            <br>
            
        </div>  
        </div>
      </section>
      <script>
    var botones = document.querySelectorAll(".botonfiltracion");
    var contador=0;
    var contadorprecio=0;
    var rangoprecio=document.getElementById("rangoprecio");
    var divmarca=document.getElementById("divmarca");
    var contadormarca=0;
     var divtipodeproducto=document.getElementById("divtipodeproducto");
     var contadordivopiniones=0;
    var contadordivtipodeproducto=0;
 
    document.getElementById("tipodeproducto").addEventListener("click", function(event0){
        event0.preventDefault();
        if(contadordivtipodeproducto==0){
            divtipodeproducto.style.display="block";
            contadordivtipodeproducto++;
        }else{
            divtipodeproducto.style.display="";
            contadordivtipodeproducto--;
        }
    });
    document.getElementById("botonmarca").addEventListener("click", function(evento){
        evento.preventDefault();
        if(contadormarca==0){
            divmarca.style.display="block";
            contadormarca++;
        }else{
            divmarca.style.display="";
            contadormarca--;
        }
    });
    document.getElementById("botonprecio").addEventListener("click", function(evento){
        evento.preventDefault();
    if(contadorprecio==0){
               
            rangoprecio.style.display="flex";
            
            contadorprecio++;
            }else{
                
                rangoprecio.style.display="";
                contadorprecio--;
            }
           
});
    botones.forEach(function(boton) {
        boton.addEventListener("click", function(evento) {
            if(contador==0){
                var rotacion = boton.querySelector(".rotacion");
            rotacion.style.transform = "rotate(270deg)";
            
            contador++;
            }else{
                var rotacion = boton.querySelector(".rotacion");
                rotacion.style.transform = "rotate(90deg)";
            contador--;
            }
           
        });
    });
    var divopiniones=document.getElementById("divopiniones");
    document.getElementById("botonfiltracionn").addEventListener("click", function(evento){
        evento.preventDefault();
        if(contadordivopiniones==0){
            divopiniones.style.display="block";
            contadordivopiniones++;
        }else{
            divopiniones.style.display="";
            contadordivopiniones--;
        }
    });

</script>
      <section>
    <?php
    
    for ($i = 0; $i < $acciones->contador; $i++) {
        if ($i % 2 == 0 &&  $acciones->activoonoactivo[$i]==true) {
            ?>

                <div class="divprin1" >
                <div class="div1productos" id="<?php echo $acciones->id_productos[$i] ?>">
              <img width="100" src="data:image/jpeg;base64,<?php echo base64_encode($acciones->imagen[$i]); ?>">
              
            
              <?php
if ($acciones->cantidad[$i] <= 0) {
?>
<script>
    
        var botones = document.getElementById("<?php echo $i ?>");
            botones.disabled = true;
            botones.style.backgroundColor = "gray";
</script>
<?php
}
?>
            <p class="tipo_de_producto"><?php echo $acciones->nombre[$i] . "<br>"; ?></p>
            <p class="marca"><?php echo $acciones->marca[$i] . "<br>"; ?></p>
            <?php
            if($acciones->descuento[$i]==1){
                ?>
                 <p class="precio"><?php echo "$". $acciones->precio[$i]-($acciones->precio[$i]*(0.01*$acciones->cantidad_descuento[$i])). "&nbsp; &nbsp; &nbsp; &nbsp;<del>$".$acciones->precio[$i]."</del>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; Ahorra: $".$acciones->precio[$i]*(0.01*$acciones->cantidad_descuento[$i]) . "<br>"; ?></p>
                 <?php
            }else{
            ?>
            <p class="precio" ><?php echo"$". $acciones->precio[$i] . "<br>"; ?></p>
            <?php
            }
            ?>
            

        </div>   
        <?php
        if(isset($_SESSION['usuario'])){

        }
            ?>
            
                   
                <button class="boton cinco" name="<?php echo $i ?>" value="<?php  echo $acciones->id_productos[$i] ?>"><div class="icono">
					AGREGAR
				</div>
				<span>&plus;</span></button>
                </div>
            <?php

        } else if ($i % 2 == 1 &&  $acciones->activoonoactivo[$i]==true) {
            ?>
             <div class="divprin1" >
               
             <div class="div2productos" id="<?php echo $acciones->id_productos[$i] ?>">
           <img width="100" src="data:image/jpeg;base64,<?php echo base64_encode($acciones->imagen[$i]); ?>">
<br>
           
           <?php
if($acciones->cantidad[$i]==0){
?>
<script>
    var boton=document.querySelectorAll(".agregararticulo");
    boton.forEach(function(evento) {
        boton.disabled=false;
        boton.style.backgroundColor = "gray";
    });
</script>
<?php
}
           ?>
   <p class="tipo_de_producto"><?php echo $acciones->nombre[$i] . "<br>"; ?></p>
            <p class="marca"><?php echo $acciones->marca[$i] . "<br>"; ?></p>
            <?php
            if($acciones->descuento[$i]==1){
                ?>
                  <p class="precio"><?php echo "$". $acciones->precio[$i]-($acciones->precio[$i]*(0.01*$acciones->cantidad_descuento[$i])). "&nbsp; &nbsp; &nbsp; &nbsp;<del>$".$acciones->precio[$i]."</del>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; Ahorra: $".$acciones->precio[$i]*(0.01*$acciones->cantidad_descuento[$i]) . "<br>"; ?></p>
                 <?php
            }else{
            ?>
                 <p class="precio"><?php echo "$". $acciones->precio[$i] . "<br>"; ?></p>
                 
            <?php
            }
            ?>
            
           
</div>
<?php
               if(isset($_SESSION['usuario'])){

            ?>
            <?php
        }
            ?>
            
            <button class="boton cinco" name="<?php echo $i ?>"  value="<?php echo isset($_GET[''.$i]) ? $_GET[''.$i] : 0; ?>"><div class="icono">
					AGREGAR
				</div>
				<span>&plus;</span></button>

</div>
        <?php
        }
        
    }
    ?>
    
</section>
    </main>
    
</form>
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
        ista.addEventListener("click", function(){
            setTimeout(() => {
window.location.href="https://www.instagram.com/levyscutz?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==";
}, 2500);

        });
var face = document.getElementById("face");
face.addEventListener("click", function(){
    setTimeout(() => {
window.location.href="https://www.facebook.com/people/Levys-Cutz-barber/100083054445979/?mibextid=ZbWKwL";
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
    var carrito = document.getElementById("carritodeconpras");
var botonagregar = document.querySelectorAll(".boton.cinco");

botonagregar.forEach(function(boton) {
    boton.addEventListener("click", function(evento) {
        <?php if(isset($_SESSION['usuario'])){
            ?>
            carrito.style.animation = 'none';
            carrito.offsetHeight;
            carrito.style.animation = "lightSpeedInRight 0.8s forwards";

        <?php } else { ?>
            
            evento.preventDefault();
            var ventanaregistrosesion = parent.document.getElementById("ventanaregistrosesion");
            ventanaregistrosesion.style.display = "block";
            var tache = parent.document.getElementById("equis");
            tache.style.display = "block";
            body.style.opacity = "0.2";
        <?php } ?>
    });
});

    var div1productos = document.querySelectorAll(".div1productos");
div1productos.forEach(elemento => {
    elemento.addEventListener("click", function(){
        
        var idelement = parseInt(elemento.id); 
        idelement = idelement -1; 
        window.location.href = "paginadelproducto.php?producto=" + idelement;
        
    });
});var div2productos = document.querySelectorAll(".div2productos");
div2productos.forEach(elemento => {
    elemento.addEventListener("click", function(){
     
        var idelement = parseInt(elemento.id); 
        idelement = idelement -1; 
        window.location.href = "paginadelproducto.php?producto=" + idelement;
        
    });
});

</script>

<script>
    document.getElementById("imagusuario").addEventListener("click", function(){
       window.location.href="pagusuario.php";
    });

    /*function clicksi(){
        document.getElementById("filtrar").click();
        for(var i = 0; i < <?php echo $acciones->contador - 2 ?>; i++) {
    var check = document.getElementById("marca" + i);
    if(check.checked) {
        // Aquí puedes hacer algo cuando el checkbox está marcado
        console.log("El checkbox " + i + " está marcado");
        
        // Por ejemplo, hacer clic en otro checkbox
        var otroCheckbox = document.getElementById("botonmarca");
        otroCheckbox.click(); // Simular clic en otro checkbox
    }else{
        alert("nsja");
    }
}
console.log("El checkbox    está marcado");
    }*/
</script>   

</body>
</html>