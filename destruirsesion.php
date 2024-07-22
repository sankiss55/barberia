<?php
// Iniciar la sesión
session_start();

// Destruir toda la sesión
session_destroy();

// Redirigir al usuario a la página principal (home)
header("Location: Home.php");
exit();
?>