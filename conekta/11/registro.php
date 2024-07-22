
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['regis'])){
    $CURP = $_POST['CURP'];
    $NOMBRE = $_POST['NOMBRE'];
    $APATERNO = $_POST['AP'];
    $AMATERNO = $_POST['AM']; 
    $GRUPO = $_POST['GRUPO']; 
    $EMAIL = $_POST['EMAIL'];

    //CONEXION A LA BASE DE DATOS
    $dsn = "mysql:host=localhost;dbname=cecypape;charset=utf8";
    $usuario="root";
    $contrasena="";

    try{
        $pdo = new PDO($dsn, $usuario, $contrasena);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //CONSULTA PARA INSERTAR EL REGISTRO
        $sql = "INSERT INTO alumnos(Curp, Nombre, APaterno, AMaterno, Grupo, Email) VALUES(?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$CURP, $NOMBRE, $APATERNO, $AMATERNO, $GRUPO, $EMAIL]);

        echo "<h1>Registro guardado correctamente.</h1>";
        header('Location: login.php');
        
    }catch(PDOException $e){
        echo "Error al guardar el registro:" . $e->getMessage();
    }
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO</title>
    <link rel="stylesheet" href="css/regis.css">
</head>
<body>
<img src="imagenes/logcecy.jpg" width="100px">
    <center>
    <div class="regist">
        <span title="Regresar a la pagina anterior" id="regresar">&larr;</span>
            <script>
                document.getElementById("regresar").addEventListener("click", function(){
                window.open('login.php', '_blanck');
                });
            </script>
        <form action="" method="post">
        <h2>Formulario de Registro</h2>
        <label for="">Curp: </label>
        <input type="text" name="CURP" placeholder="Ingrese Curp"><br><br>
        <label for="">Nombre: </label>
        <input type="text" name="NOMBRE" placeholder="Ingrese Nombre"><br><br>
        <label for="">Apellido Paterno: </label>
        <input type="text" name="AP" placeholder="Ingrese APaterno"><br><br>
        <label for="">Apellido Materno: </label>
        <input type="text" name="AM" placeholder="Ingrese AMaterno"><br><br>
        <label for="">Grupo: </label>
        <input type="text" name="GRUPO" placeholder="Ingrese Grupo"><br><br>
        <label for="">Email: </label>
        <input type="email" name="EMAIL" placeholder="Ingrese Email"><br>
        <br>
        <button  name="regis" class="btn">REGISTRAR</button>
        <br>
        </form>
    </div>
    </center>

</body>
</html>