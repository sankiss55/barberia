<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['regis'])){
    $cur = $_POST['usuario'];
    $emai = $_POST['pass'];

    //CONEXION A LA BASE DE DATOS
    $dsn = "mysql:host=localhost;dbname=cecypape;charset=utf8";
    $usuario="root";
    $contrasena="";
 
    try{
        $pdo = new PDO($dsn, $usuario, $contrasena);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //CONSULTA PARA INSERTAR EL REGISTRO
        $sql = "SELECT * FROM alumnos WHERE Curp = '$cur' AND Email = '$emai'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user, $pass]);
        if ($result->num_rows > 0) {
            echo "success"; // Usuario y contraseña válidos
        } else {
            echo "error"; // Usuario o contraseña inválidos
        }
    }catch(PDOException $e){
        echo "error" . $e->getMessage();
    }
}
}
?>