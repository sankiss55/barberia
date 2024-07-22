<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // Aquí puedes agregar la lógica para enviar el correo electrónico, almacenar en una base de datos, etc.
    
    // Redireccionar después del envío del formulario (opcional)
    header("Location: Contacto.html");
    exit;
}
?>
 