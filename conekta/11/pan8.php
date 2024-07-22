<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copias blanco y negro</title>
    <link rel="stylesheet" href="css/pan8.css">
</head>
<body>
    <center>

        <br>
        <h1>COPIAS</h1>
        <br><br>
            <img src="imagenes/cpbc.jpg" width="200px">
        <br>
        <br>
        <h1>Escribe tu texto</h1>
    <textarea id="texto"></textarea>
    <br>
    <button onclick="imprimirTexto()">Imprimir</button>
    <br>
    <script>
        function imprimirTexto() {
            var contenido = document.getElementById('texto').value;
            var ventanaImpresion = window.open('', '', 'height=600,width=800');
            ventanaImpresion.document.write('<html><head><title>Imprimir</title>');
            ventanaImpresion.document.write('</head><body >');
            ventanaImpresion.document.write('<pre>' + contenido + '</pre>');
            ventanaImpresion.document.write('</body></html>');
            ventanaImpresion.document.close();
            ventanaImpresion.print();
        }
    </script>
        <br>
        <table style="width:50%">  
        <tr>
            <th>PRECIO: $1</th>
        </tr>
        </table>
    </center>
</body>
</html>