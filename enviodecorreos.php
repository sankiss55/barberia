<?php

session_start();
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
     require 'PHPMailer/Exception.php';
     require 'PHPMailer/PHPMailer.php';
     require 'PHPMailer/SMTP.php';
     include_once('conexion base de datos.php');
     include_once('acciones.php');
     
     $conexion = new conexionbd();
     $conexion->conexion();
     $acciones = new acciones($conexion);
     
if($_SERVER['REQUEST_METHOD']=="POST"&& isset($_POST['validar'])){
    if($_POST['num']==$_SESSION['numram']){
         $acciones->crear_nuevo_usuario($_SESSION['contrasenavali'], $_SESSION['usuariovali'], $_SESSION['correovali'], $_SESSION['nombresvali'], $_SESSION['apellidosvali']); 
         header('Location: registro o sesion.php');
        }else{
        ?>
           <script>
            alert("El numero es incorrecto");
           </script>
           <?php
    }
    }else{
    try {
       
$mail = new PHPMailer(true);
       $mail->isSMTP();
       $mail->SMTPDebug=3;
       $mail->Host='smtp.gmail.com';
       $mail->Port=465;
       $mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
       $mail->SMTPAuth=true;
       $email='barberiagalaxia82@gmail.com';
       $mail->Username=$email;
       $mail->Password="syei posu lejf dstq";
       $mail->setFrom($email, 'santiago');
       $mail->addReplyto('barberiagalaxia82@gmail.com','santiago');
       $mail->addAddress(''.$_SESSION['correocofi'], 'santiago');
       $mail->Subject='validación de correo';
       $mail->isHTML(true);
       $mail->CharSet='UTF-8';
       $num=rand(100000, 1000000) ;
       $_SESSION['numram']=$num;
      
    $mail->Body = '
    <html>
    <body style="background-color: #F5F5DC; margin: 0; padding: 0; font-family: Arial, sans-serif;">
        <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #FFF; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        
            <h1 style="color: #8B4513; text-align: center;">Por favor, valida tu correo electrónico</h1>
            
            <img src="cid:identificador_imagen" style="width: 15%; max-width: 100px; display: block; margin: 0 auto;">
            <p style="color: #333;">Tu número de validación es: <strong>'.$num.'</strong></p>
            <footer style="background-color: #DFDFDF; margin-top: 20px; text-align: center; color: #555;">Cuidado profesional del cabello en Levy\'s Cutz</footer>
        </div>
    </body>
    </html>
';
$mail->AddEmbeddedImage('imagenes/image.png', 'identificador_imagen', 'nombre_mostrado');

       
       $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        
        echo 'enviado mal';
    }
}
?>