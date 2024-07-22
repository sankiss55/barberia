<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
<header>
    <audio autoplay preload="auto" volume>
        <source src="imagenes/ylang-ylang.mp3">
    </audio>
</header>
</br>
</br>
</br>
<center>
        <div class="conter">
            <h2>Inicio de Sesion</h2>
            <img src="imagenes/cecylogo.jpg" width="100px"></br>
            <br>
        <form action="validar.php" method="post">
            <label for="">EMAIL</label><br>
            <input type="Email" name="usuario" placeholder="Ingrse Email:"><br>
            <label for="">CURP</label><br>
            <input type="password" name="pass" placeholder="Ingrse Curp:"><br>
            <br>
            <input type="submit" value="INICIAR" class="btn">
        </form>
        <p id="Error" style="color:red"></p>
    </br>
    <p>Olvido su registro <a href="registro.php">Registrarme</a></p>
        </div>
</center>
</body>
</html>