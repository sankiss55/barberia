<?php
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
if (isset($_SESSION['usuario'])){ 
if (isset($_POST['cambiar'])) {
    if ($_FILES['profile-pic']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile-pic'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $allowedExtensions = array('png', 'jpg', 'jpeg');
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo "<script>alert('Formato de archivo no permitido. Por favor selecciona un archivo PNG, JPG o JPEG.');</script>";

        }else{
            $fileContent = file_get_contents($fileTmpName);
            if ($fileContent !== false) {
                $acciones->cambiarimg($fileContent);
            } else {
                echo "<script>alert('Error al leer el contenido del archivo.');</script>";
            }
        }

       
    } else {
        echo "<script>alert('Error al subir el archivo.');</script>";
    }
}
}else{
    header("Location:Errornoencontrado.html ");
}
    
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - Barbería</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="estilos/pagusuario.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    
<span id="regresar">&larr;</span>
    <div class="container">
        <div class="header">
            <h1>Tu Perfil de Usuario</h1>
        </div>
        <div class="content">
            <form id="profile-form" enctype="multipart/form-data" method="post" action="">
                <div class="profile-pic-container">
                    <label for="file-input" class="profile-pic-container">
                    <?php
                    if (isset($_SESSION['img']) &&$_SESSION['img']!="data:image/jpeg;base64,") {
                        $img_src = $_SESSION['img'];
                    } else {
                        $img_src = 'imagenes/descarga.png';
                    }
?>

<img src="<?php echo $img_src; ?>" alt="Foto de perfil" id="profile-pic">

                        <div class="overlay">
                            <span>Cambiar Imagen</span>
                        </div>
                    </label>
                    <input type="file" id="file-input" name="profile-pic" onchange="updateProfilePic(event)">
                </div>
                <div class="user-info">
                    <p><strong>Usuario:</strong><?php echo $_SESSION['usuario']?></p>
                    <p><strong>Email:</strong> <?php echo '******', substr($_SESSION['correo'], -13); ?></p>

                    <p><strong>NOMBRE:</strong><?php echo $_SESSION['nombre']?></p>
                    <p><strong>APELLIDOS:</strong><?php echo $_SESSION['apellido'] ?></p>
                </div>
                <div class="buttons">
                   <a href="cambiartelefono.php"> <button type="button" class="btn btn-custom">Cambiar telefono</button></a>
                    <a href="cambiarcontraseña.php"><button type="button" class="btn btn-custom">Cambiar Contraseña</button></a>
                    <a href="cambiarcorreo.php"><button type="button" class="btn btn-custom">Cambiar Correo</button></a>
                    
                    <a href="soporte.php"><button type="button" class="btn btn-custom">Soporte</button></a>
                    <a href="vercitas.php"><button type="button" class="btn btn-custom">Ver citas</button></a>
                    <button type="button" id="cerrarsesion" class="btn btn-custom">Cerrar Sesión</button>
                </div>
                <button type="submit" id="cambiar" name="cambiar" class="btn btn-custom">Guardar Cambios</button>

            </form>
        </div>
    </div>
    
<script>
    function updateProfilePic(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-pic').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
        document.getElementById("cambiar").click();
    }
</script>

<script>
    document.getElementById("regresar").addEventListener("click", function(){
        window.location.href="pagina1.php";
    });
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
