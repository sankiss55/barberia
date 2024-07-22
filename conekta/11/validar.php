<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $usuario = $_POST['usuario'];
    $contraseña = $_POST['pass'];


    $conexion = mysqli_connect("localhost", "root", "", "cecypape");

    $consulta = "SELECT*FROM alumnos WHERE Email = '$usuario' AND Curp = '$contraseña'";
    $resultado = mysqli_query($conexion, $consulta);

    $fillas = mysqli_num_rows($resultado);
    if ($fillas) {
        session_start();
        $_SESSION['usuario'] = $usuario;

        header("location:index.php");
    } else {
        ?>
        <?php
        include ("login.php");
        ?>
        <script>document.getElementById('Error').innerText = "Error de inicio de sesion"</script>
        <?php
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
}
?>