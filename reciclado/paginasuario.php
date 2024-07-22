<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: Errornoencontrado.html');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/usuarioventana.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <br>
    <b>Información del usuario</b>
    <br>
    <img src="imagenes/descarga.png" alt="persona">
    <div id="opciones">
    
    <div><a href="cambiartelefono.php">
    <button>Cambia tu número de teléfono </button></a>
    </div>
    <div>
    <a href="cambiarcorreo.php"><button>Cambia tu correo electrónico</button></a>
    </div>
    <div>
    <a href="cambiarcontraseña.php"><button>Cambia tu contraseña </button></a>
    </div>
    <div>
    <a href="soporte.php"><button>soporte </button></a>
    </div>
    <div> <button id="cerrarsesion">Cerrar sesión </button></div>
    
    </div>
    <br>
    <script>
        document.getElementById("cerrarsesion").addEventListener("click", function(){
            
            window.top.Swal.fire({
  title: "¿quieres cerrar sesion?",
  text: "confirma la accion",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "si, vamos a hacerlo"
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "destruirsesion.php";
            window.top.location.reload();
            window.top.location.href = "Home.php";
    Swal.fire({
      title: "listo",
      text: "se ha cerrado sesion",
      icon: "success"
    });
  }
});
        });
       
    </script>
</body>
</html>
