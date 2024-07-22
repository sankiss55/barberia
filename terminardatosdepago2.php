<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("location:Errornoencontrado.html");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos/terminardatosdepago.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Completa esta informacion para finalizar la compra </h1>
    
    <form action="pagooxxoinmediato.php" method="post" >
<br>
<label for="codigo_postal">Código Postal</label>
<input type="number" name="codigo_postal" id="codigo_postal" required>
<br>
<label for="estado">Estado</label>
<input type="text" name="estado" id="estado" required>
<br>
<label for="municipio">Municipio/Alcaldía</label>
<input type="text" name="municipio" id="municipio" required>
<br>
<label for="colonia">Colonia</label>
<input type="text" name="colonia" id="colonia" required>
<br>
<label for="calle">Calle</label>
<input type="text" name="calle" id="calle" required>
<br>
<label for="numero_exterior">Número Exterior</label>
<input type="text" name="numero_exterior" id="numero_exterior" required>
<br>
<label for="numero_interior">N° Interior/Depto (opcional)</label>
<input type="text" name="numero_interior" id="numero_interior" >
<br>
<label for="entre_calles">¿Entre qué calles está? </label>
<label for="calle_1">Calle 1</label>
<input type="text" name="calle_1" id="calle_1" >
<br>
<label for="calle_2">Calle 2</label>
<input type="text" name="calle_2" id="calle_2">
<br>
<label for="telefono">Teléfono de Contacto</label>
<input type="number"  name="telefono" id="telefono" required>

<br>
<label for="indicaciones">Indicaciones de esta Dirección</label>
<input type="text" name="indicaciones" id="indicaciones" required>
<br>
<input type="hidden" name="producto" value="<?php echo $_GET['producto'] ?>">
<input type="hidden" name="precio" value="<?php echo $_GET['precio'] ?>">
<input type="submit" id="enviarinfo" value="Continuar">
    </form>
    <script>
    document.getElementById("telefono").addEventListener("keypress", function(evento){
if(this.value.length>9){
    evento.preventDefault();
}
    });
    document.getElementById("codigo_postal").addEventListener("keypress", function(evento){
        if(this.value.length>4){
    evento.preventDefault();
}
    });
    document.getElementById("enviarinfo").addEventListener("click", function(evento){
            if (telefono.value.length < 10 || codigo_postal.value.length < 5) {
                evento.preventDefault();
                if (telefono.value.length < 10) {
                    alert("El teléfono debe ser de 10 dígitos");
                }
                if (codigo_postal.value.length < 5) {
                    alert("El código postal debe ser de 5 dígitos");
                }
            }
        
    });
</script>
</body>
</html>