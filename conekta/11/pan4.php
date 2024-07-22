<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pan4.css">
</head>
<body>
    <center>
        <span title="Regresar a la pagina anterior" id="regresar">&larr;</span>
        <script>
            document.getElementById("regresar").addEventListener("click", function(){
                window.open('Servicios.php', '_blanck');
            });
        </script>
        <h1>BIENVENIDO</h1>
        <br>
        <br>
        <form action="views/Index.php" method="post">
            <button class="btn">AGREGAR</button>
        </form>
        <div class="loader">
            <div class="square" id="sq1"></div>
            <div class="square" id="sq2"></div>
            <div class="square" id="sq3"></div>
            <div class="square" id="sq4"></div>
            <div class="square" id="sq5"></div>
            <div class="square" id="sq6"></div>
            <div class="square" id="sq7"></div>
            <div class="square" id="sq8"></div>
            <div class="square" id="sq9"></div>
        </div>
        <br><br><br><br><br><br><br>
        
        <table style="width:50%">  
        <tr>
            <th>TIPO DE DOCUMENTO</th>
            <th>PRECIO</th>
        </tr>
        <tr>
            <td>ACTA DE NACIMIENTO</td>
            <td>$25</td>
        </tr>
        <tr>
            <td>CURP</td>
            <td>$10</td>
        </tr>
        <tr>
            <td>RFC</td>
            <td>$15</td>
        </tr>
        <tr>
            <td>SEGURO SOCIAL</td>
            <td>$30</td>
        </tr>
        </table>
        <br><br><br>
    </center>    
</body>
</html>