<?php

include_once('conexion base de datos.php');
include_once('acciones.php');
session_start();
$conexion = new conexionbd();
$conexion->conexion();

$acciones = new acciones($conexion);
$producto_id = $_GET['producto'];
$respuesta=$acciones->traerproductossionusuario2($producto_id + 1);
if($respuesta==true){
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['comprar'])) {
        if ($acciones->descuento == true) {
            header("location: terminardatosdepago2.php?producto=" . $acciones->nombre . "&precio=" . ($acciones->precio - $acciones->precio * ($acciones->cantidad_descuento / 100)) . "&cantidad=1");
        } else {
            header("location: terminardatosdepago2.php?producto=" . $acciones->nombre . "&precio=" . ($acciones->precio) . "&cantidad=1");
        }   
    } elseif (isset($_POST['enviar']) && isset($_SESSION['usuario'])) {
        if ($acciones->descuento == true) {
            $acciones->ventausuario($producto_id + 1, $acciones->precio - $acciones->precio * ($acciones->cantidad_descuento / 100));
        } else {
            $acciones->ventausuario($producto_id + 1, $acciones->precio);
        }
    }else if(isset($_POST['comprartar'])){
        if ($acciones->descuento == true) {
            header("location: terminardatosdepagotarjeta2.php?producto=" . $acciones->nombre . "&precio=" . ($acciones->precio - $acciones->precio * ($acciones->cantidad_descuento / 100)) . "&cantidad=1");
        } else {
            header("location: terminardatosdepagotarjeta2.php?producto=" . $acciones->nombre . "&precio=" . ($acciones->precio) . "&cantidad=1");
        }   
    }
}
}else{
    header("location:Errornoencontrado.html");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilosproductos.css">
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
<div id="divtodo">
<div id="divprincipal">
<header>
    <img class="imgLogo" src="imagenes/image.png" alt="logo" width="90px" height="7%" >
    <?php
    if (isset($_SESSION['img']) &&$_SESSION['img']!="data:image/jpeg;base64,") {
        $img_src = $_SESSION['img'];
    } else {
        $img_src = 'imagenes/descarga.png';
    }   
         if(isset($_SESSION['usuario'])){
            ?> <button title="Visualizar usuario"  id="imgre">
            <img id="imagusuario" src="<?php echo $img_src; ?>"alt="Imagen de usuario" width="50px" height="40px">
        </button>

        <?php
        }else{
            ?>   <button title="Iniciar sesion o Registrarse" id="imgre"> <img  src="imagenes/Pasted-20240305-155825_preview_rev_1 (1).png" alt="Usuario"></button>
           <?php
        }
        ?>
                <script>
                    <?php
                     if(!isset($_SESSION['usuario'])){
        ?>
                    var body=document.getElementById("divprincipal");
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
    <br><br>
  </header>
  

    <nav>
      
        <ul>
          <li><a href="pagina1.php" title="CITAS">CITAS</a></li>
          <li class="productos"><a href="Productos.php">PRODUCTOS</a></li>
          <li><a href="Pagina4.php" title="UBICACION">UBICACION</a></li>
          <li><a href="pagina5.php" title="¿QUIENES SOMOS?">¿QUIENES SOMOS?</a></li>
     
        </ul>
    </nav>
    <div class="divicionarriba">
    <main>
       <!--solo acomoda las etiquetas p, cada una tiene distinta informacion, ahi se dice que informacion traee
    --> 
    <div id="divimag">
    <img id="foto" width="100" src="data:image/jpeg;base64,<?php echo base64_encode($acciones->imagen); ?>"></div>
    <aside>
        <br><br>
        <form action="" method="post">
    <p ><?php echo $acciones->descripcion. "<br>"; ?></p>
    <br><br>
    <?php if($acciones->descuento==true){
 ?><p id="" name="precio" value="<?php echo "$ ",$acciones->precio."<br>"; ?>"><?php echo "$ ",$acciones->precio-$acciones->precio*($acciones->cantidad_descuento/100)."<br>"; ?></p> <?php
    }else{?>
<p id="" name="precio" value="<?php echo "$ ",$acciones->precio."<br>"; ?>"><?php echo "$ ",$acciones->precio."<br>"; ?></p>
<?php
    }?>
    <br><br>
    <p id=""><?php echo $acciones->marca."® " ,"<br>"; ?></p>
    <br><br>
    <p id="" name="nombre" value="<?php echo "''",$acciones->nombre."''", "<br>";?>"><?php echo "''",$acciones->nombre."''", "<br>"; ?></p>
    <br><br>
    <p id=""><?php echo "⭐",$acciones->calificacion. "<br>"; ?></p>
    <br><br>
    <br>
    <br>
    <button class="pro" id="enviar" name="enviar" >Agregar a la cesta</button>
    <br><br><br>
    <button class="pro"id="comprar" >Comprar</button>
    <div id="payment-container" class="payment-container">
        <span id="quitarven">&times;</span>
        <h2>Selecciona tu método de pago</h2>
        <div class="payment-option">
            <button  name="comprar"class="oxxo">
                <img src="data:image/png;base64,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" alt="OXXO Pay">
                <p>OXXO Pay</p>
            </button>
            <button class="tarjeta" name="comprartar">
                <img  src="data:image/jpeg;base64,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" alt="Tarjeta">
                <p>Tarjeta</p>
            </button>
        </div>
    </div>
    
    </form>
    </aside>
    </main>
</div>
<footer>
    <p>hsa</p>
</footer>
    </div>
    
<div id="equis">
    <span >&timesbar;</span></div>
    <iframe id="ventanaregistrosesion" src="registro o sesion.php" frameborder="0"></iframe>
    <script>
        var ventanaregistrosesion=document.getElementById("ventanaregistrosesion");
    var equis=document.getElementById("equis").addEventListener("click", function(){
        
        ventanaregistrosesion.style.display="none";
        var body =document.getElementById("divprincipal");
        body.style.opacity="1";
      this.style.display="none";
    });
    document.getElementById("enviar").addEventListener("click", function(evento){
        
        <?php
                    if(!isset($_SESSION['usuario'])){
                        
                        ?>
                        evento.preventDefault(); 
                        ventanaregistrosesion.style.display="block";
       var tache=document.getElementById("equis");
       tache.style.display="block";
                     
 body.style.opacity = "0.2";
                         <?php

                    }
                    ?>
                });
                document.getElementById("comprar").addEventListener("click", function(evento){
        
        <?php
                    if(!isset($_SESSION['usuario'])){
                        
                        ?>
                        evento.preventDefault(); 
                        ventanaregistrosesion.style.display="block";
       var tache=document.getElementById("equis");
       tache.style.display="block";
                     
 body.style.opacity = "0.2";
                         <?php

                    }
                    if(isset($_SESSION['usuario'])){
                        ?>
                        evento.preventDefault();
                        var payment_container=document.getElementById("payment-container");
                        payment_container.style.display="block";
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
    <script>
          
            document.getElementById("quitarven").addEventListener("click", function(){
var divtodo=document.getElementById("divtodo");
divtodo.style.opacity="1";
var payment_container=document.getElementById("payment-container");
payment_container.style.display="none";
            });
          
        </script>
    </div>
    </body>

</html>