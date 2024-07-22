
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class acciones{
    private $respuesta_conexion;
    public function __construct($respuesta){
        $this->respuesta_conexion=$respuesta;
    }
    public $usuarionoencontrado=" ";
    public $contrasenainvalida=" ";
    public function enviarwhtas($numero) {
        
        require 'vendor/autoload.php';
    
        $token = "GA240602153214";
        $num = rand(100000, 1000000);
        $client = new GuzzleHttp\Client(['verify' => false]);
    
        $payload = array(
            "op" => "registermessage",
            "token_qr" => $token,
            "mensajes" => array(
                array(
                    "numero" => "521".$numero,
                    "mensaje" => "Tu numero de recuperacion de contraseña es: $num"
                )
            )
        );
        $_SESSION['numram']=$num;
        try {
            $res = $client->request('POST', 'https://script.google.com/macros/s/AKfycbyoBhxuklU5D3LTguTcYAS85klwFINHxxd-FroauC4CmFVvS0ua/exec', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $payload
            ]);
            if ($res->getStatusCode() == 200) {
                echo $res->getBody();
                
                return true;
                
            } else {
                echo "Error al enviar el mensaje. Código de estado: " . $res->getStatusCode() . "<br>";
                return false;
            }
            
        } catch (GuzzleHttp\Exception\RequestException $e) {
            echo "Error de red o HTTP: " . $e->getMessage() . "<br>";
            return false;
        } catch (Exception $e) {
            echo "Error inesperado: " . $e->getMessage() . "<br>";
            return false;
        }
    }
    
public function enviodecorreo($texto_a_enviar, $textosecundario,$correo){
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
     require 'PHPMailer/SMTP.php';
     include_once('conexion base de datos.php');
     include_once('acciones.php');
    try {
$mail = new PHPMailer(true);
       $mail->isSMTP();
       $mail->SMTPDebug=0;
       $mail->Host='smtp.gmail.com';
       $mail->Port=465;
       $mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
       $mail->SMTPAuth=true;
       $email='barberiagalaxia82@gmail.com';
       $mail->Username=$email;
       $mail->Password="syei posu lejf dstq";
       $mail->setFrom($email, 'santiago');
       $mail->addReplyto('barberiagalaxia82@gmail.com','santiago');
       $mail->addAddress($correo, 'santiago');
       $mail->Subject='validación de correo';
       $mail->isHTML(true);
       $mail->CharSet='UTF-8';
       $num=rand(100000, 1000000) ;
      
       $_SESSION['numram']=$num;
    $mail->Body = '
    <html>
    <body style="background-color: #F5F5DC; margin: 0; padding: 0; font-family: Arial, sans-serif;">
        <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #FFF; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        
            <h1 style="color: #8B4513; text-align: center;">'. $texto_a_enviar .'</h1>
            
            <img src="cid:identificador_imagen" style="width: 15%; max-width: 100px; display: block; margin: 0 auto;">
            <p style="color: #333;">'. $textosecundario .'<strong>'.$num.'</strong></p>
            <footer style="background-color: #DFDFDF; margin-top: 20px; text-align: center; color: #555;">Cuidado profesional del cabello en Levy\'s Cutz</footer>
        </div>
    </body>
    </html>
';
$mail->AddEmbeddedImage('imagenes/image.png', 'identificador_imagen', 'nombre_mostrado');

       
       $mail->send();
       return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        
        echo 'enviado mal';
        return false;
    }
}
public function enviodecorreovarios($texto_a_enviar, $textosecundario,$correo){
    require_once 'PHPMailer/Exception.php';
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/SMTP.php';
    include_once('conexion base de datos.php');
    include_once('acciones.php');
    try {
$mail = new PHPMailer(true);
       $mail->isSMTP();
       $mail->SMTPDebug=0;
       $mail->Host='smtp.gmail.com';
       $mail->Port=465;
       $mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
       $mail->SMTPAuth=true;
       $email='barberiagalaxia82@gmail.com';
       $mail->Username=$email;
       $mail->Password="syei posu lejf dstq";
       $mail->setFrom($email, 'santiago');
       $mail->addReplyto('barberiagalaxia82@gmail.com','santiago');
       $mail->addAddress($correo, 'santiago');
       $mail->Subject='validación de correo';
       $mail->isHTML(true);
       $mail->CharSet='UTF-8';
    $mail->Body = '
    <html>
    <body style="background-color: #F5F5DC; margin: 0; padding: 0; font-family: Arial, sans-serif;">
        <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #FFF; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        
            <h1 style="color: #8B4513; text-align: center;">'. $texto_a_enviar .'</h1>
            
            <img src="cid:identificador_imagen" style="width: 15%; max-width: 100px; display: block; margin: 0 auto;">
            <p style="color: #333;">'. $textosecundario .'</p>
            <footer style="background-color: #DFDFDF; margin-top: 20px; text-align: center; color: #555;">Cuidado profesional del cabello en Levy\'s Cutz</footer>
        </div>
    </body>
    </html>
';
$mail->AddEmbeddedImage('imagenes/image.png', 'identificador_imagen', 'nombre_mostrado');

       
       $mail->send();
       return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        
        echo 'enviado mal';
        return false;
    }
}
    public function iniciarsesion($usuario, $contrasena){
    
    try {
        $pdo = $this->respuesta_conexion->getPdo();
        $sql = "SELECT * FROM usuario WHERE usuario=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$usuario]);
        if($comando->rowCount() > 0) {
        $sql = "SELECT * FROM usuario WHERE usuario=? AND contrasena=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$usuario, $contrasena]);
        
        if($comando->rowCount() > 0) {
            while($informacion=$comando->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['usuario']=$informacion['usuario'];
            $_SESSION['contrasena']=$informacion['contrasena'];
            $_SESSION['telefono']=$informacion['telefono'];
            $_SESSION['nombre']= $informacion['nombre'];
            $_SESSION['apellido']= $informacion['apellidos'];
            $_SESSION['correo']= $informacion['coreo'];
             $_SESSION['img'] = 'data:image/jpeg;base64,' . base64_encode($informacion['img']);
            }
           
            return true;
        } else {
            $this->contrasenainvalida="no contrasena";
           
        }
    }else{
        $this->usuarionoencontrado="no usuario";
    }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
   
}
public $usuariorepetido=false;
public $correorepetido=false;

public function crear_nuevo_usuario($contrasena, $usuario, $email, $nombre, $apellido){
    try{
        $sql="INSERT INTO usuario(contrasena, coreo, usuario, nombre, apellidos) VALUES (?,?, ?, ?,?)";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([$contrasena,$email,$usuario,$nombre, $apellido]);
        
    }catch(PDOException $e){
        echo "el erroe esta en: ". $e->getMessage();
    }
}
public function buscarcorreo($correo){
    try{
        $sql="SELECT coreo FROM usuario WHERE coreo=?";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([$correo]);
        if($comando->rowCount()>0){
            $this->correorepetido=true;
        }
    }catch(PDOException $e){
        echo "el erroe esta en: ". $e->getMessage();
    }
} 
public function buscarusuario($usuario){
    try{
        $sql="SELECT usuario FROM usuario WHERE usuario=?";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([$usuario ]);
        if($comando->rowCount()>0){
            $this->usuariorepetido= true;
        }
    }catch(PDOException $e){
        echo "el erroe esta en: ". $e->getMessage();
    }
} 
public $telefonoencontrado=false;
public function buscar_telefono($telefono){
    try{
        $sql="SELECT telefono FROM usuario WHERE telefono=?";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([$telefono]);
        if($comando->rowCount()>0){
            $this->telefonoencontrado=true;
        }
    }catch(PDOException $e){
        echo "el erroe esta en: ". $e->getMessage();
    }

}
public function resporteUsuario($problematica){
    try{

            $sql="SELECT * FROM reportesusuarios WHERE dia=? AND usuario_reports=? ";
            $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([date("y-m-d"), $_SESSION['usuario']]);
        
        if($comando->rowCount()>=3){
            ?>
            <script>alert("ya no puedes hacer nada ")</script>
            <?php
           
        }else{
            
             $sql="INSERT INTO reportesusuarios(correo,usuario_reports,dia, ploblematica) VALUES(?,?,?,?) ";
             $pdo=$this->respuesta_conexion->getPdo();
             $comando=$pdo->prepare($sql);
             $comando->execute([$_SESSION['correo'],$_SESSION['usuario'], date("Y-m-d"), $problematica]);
             if( $comando->rowCount() > 0) {
                 ?>
                 <script>alert("reporte incertado")</script>
                 <?php
             }
        }
        
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
public $precio;
public $contador=0;
public $marca;
public $imagen;
public $descripcion;
public $cantidad;

public $marca2;
public $cantidad2;
public $descuento;
public $cantidad_descuento;

public $tipo_de_producto2;
public $tipo_de_producto;
public $nombre;
public $id_productos;
public $activoonoactivo=array();
public $calificacion=array();
public function traerproductossionusuario(){
    try{
        $sql="SELECT * FROM productos";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute();
        $this->precio=array();
        $this->marca=array();
        $this->imagen=array();
        $this->descripcion=array();
        
        $this->cantidad=array();
        $this->marca2=array();
        $this->cantidad2=array();
        $this->tipo_de_producto2=array();
        $this->descuento=array();
        $this->nombre=array();
        $this->cantidad_descuento=array();
        $this->tipo_de_producto=array();
        $this->id_productos=array();
        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            $this->nombre[]=$row['nombre'];
            $this->marca[] = $row['marca'];
            $this->marca2[] = $row['marca'];
            $this->precio[] = $row['precio'];
            $this->imagen[]=$row['imagen'];
            $this->descripcion[]=$row['descripcion'];
            
            $this->cantidad2[]=$row['cantidad'];
            $this->cantidad[]=$row['cantidad'];
            $this->descuento[]=$row['descuento'];
            
            $this->tipo_de_producto2[]=$row['tipo_de_producto'];
            $this->tipo_de_producto[]=$row['tipo_de_producto'];
            $this->cantidad_descuento[]=$row['cantidad_de_descuento'];
            $this->id_productos[]=$row['id_producto'];
            $this->activoonoactivo[]=$row['activo'];
            $this->calificacion[]=$row['calificacion'];
            $this->contador+=1;
        }
    }catch(PDOException $e){
            echo $e->getMessage();
            header('Location: error.html');
    }
}

public function traerproductossionusuario2($id){
    try{
        $sql="SELECT * FROM productos where id_producto=?";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([$id]);
        if($comando->rowCount()){

        
        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            $this->nombre=$row['nombre'];
            $this->marca= $row['marca'];
            $this->precio = $row['precio'];
            $this->imagen=$row['imagen'];
            $this->descripcion=$row['descripcion'];
            $this->cantidad=$row['cantidad'];
            $this->descuento=$row['descuento'];
            $this->tipo_de_producto=$row['tipo_de_producto'];
            $this->cantidad_descuento=$row['cantidad_de_descuento'];
            $this->id_productos=$row['id_producto'];
            $this->activoonoactivo=$row['activo'];
            $this->calificacion=$row['calificacion'];
            $this->contador+=1;
           
        }
        return true; 
    }else{
        return false;
    }
    }catch(PDOException $e){
            echo $e->getMessage();
    }
}

public function agregarcita($hora, $dia, $condicion, $telefono){
try{
    if($condicion==true){
        
        $sql="UPDATE usuario SET telefono=? WHERE usuario=?";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([$telefono, $_SESSION['usuario'] ]);
        $this->insertardatoscita($hora, $dia);
        $_SESSION['telefono']=$telefono;
        
    }else{
        $this->insertardatoscita($hora, $dia);
}

}catch(PDOException $e){
    echo $e->getMessage();
            header('Location: error.html');
}
}
public function insertardatoscita($hora, $dia){
    try{
        $sql="INSERT INTO citas(usuario, fecha, hora) VALUES (?,?,?)";
        $pdo=$this->respuesta_conexion->getPdo();
        $comando=$pdo->prepare($sql);
        $comando->execute([$_SESSION['usuario'], $dia, $hora ]);
        if($comando->rowCount()>0){
            
            $this->enviodecorreovarios("TIENES UNA NUEVA CITA", "Tienes una nueva cita del usuario:".$_SESSION['usuario']."<br>El dia: $dia <br>A las Hora: $hora <br>Te invitamos a verificar la cita con el usuario.",'barberiagalaxia82@gmail.com');
            $this->enviodecorreovarios("Has agregado una nueva cita", "Tu cita se ha agendado exitosamente. <br>Día: $dia <br>Hora: $hora <br>Te invitamos a ver el apartado de citas para verificar tu cita o, en su caso, cancelarla.", $_SESSION['correo']);
            ?>
            <script>alert("LA CITA SE HA AGENDADO EXITOSAMENTE");
         window.location.href = "pagina1.php";</script>
            <?php
        }
    }catch(PDOException $e){
        echo($e->getMessage());
        
            header('Location: error.html');
    }
}
public $diasrojos ;
public function dias(){
    try{
        $sql = "SELECT fecha, COUNT(*) AS cantidad FROM citas GROUP BY fecha HAVING COUNT(*) >= 3";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute();
        
        $this->diasrojos = array();
        while ($fila = $comando->fetch(PDO::FETCH_ASSOC)) {
            $this->diasrojos[] = $fila['fecha'];
        }
        
        
    } catch(PDOException $e) {
        echo $e->getMessage();
        
            header('Location: error.html');
    }
}
public $horasdeldia;

public function horass($fecha){
    try{
        $sql = "SELECT hora FROM citas where fecha=?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$fecha]);
        
        $this->horasdeldia = array();
        while ($fila = $comando->fetch(PDO::FETCH_ASSOC)) {
            $this->horasdeldia[] = $fila['hora'];
             
        }

        
    } catch(PDOException $e) {
        echo $e->getMessage();
        
            header('Location: error.html');
    }
}public function busquedapor($max, $min, $cal1, $cal2, $cal3, $cal4, $cal5, $busquedapor, $arraymarca, $arrayproductos){
    try {
        $consultaMarca = '';
        $placeholdersMarca = '';
        $paramsMarca = [];

        for ($i = 0; $i < count($arraymarca); $i++) {
            $consultaMarca .= ($i > 0 ? " OR " : "") . "marca = ?";
            $placeholdersMarca .= ($i > 0 ? ", " : "") . "?";
            $paramsMarca[] = $arraymarca[$i];
        }
        if (empty($arraymarca)) {
            $consultaMarca .= "marca = ''";
        }

        $consultaProducto = '';
        $placeholdersProducto = '';
        $paramsProducto = [];

        for ($i = 0; $i < count($arrayproductos); $i++) {
            $consultaProducto .= ($i > 0 ? " OR " : "") . "tipo_de_producto = ?";
            $placeholdersProducto .= ($i > 0 ? ", " : "") . "?";
            $paramsProducto[] = $arrayproductos[$i];
        }
        if (empty($arrayproductos)) {
            $consultaProducto .= "tipo_de_producto = ''";
        }



        









         if(!empty($cal1)||!empty($cal2) ||!empty($cal3) ||!empty($cal4) ||!empty($cal5)){ 
            $sql = "SELECT * FROM productos WHERE  calificacion IN (?, ?, ?, ?, ?) or nombre = ? OR ($consultaMarca) OR ($consultaProducto)AND activo = 1"; $params = array_merge([$cal1, $cal2, $cal3, $cal4, $cal5,$busquedapor ], $paramsMarca, $paramsProducto);
        }else if(!empty($cal1)||!empty($cal2) ||!empty($cal3) ||!empty($cal4) ||!empty($cal5) &&!empty($max) &&!empty($min) &&!empty($busquedapor)){ 
            $sql = "SELECT * FROM productos WHERE (precio BETWEEN ? AND ? AND nombre = ?  and  (calificacion IN (?, ?, ?, ?, ?) )OR ($consultaMarca) OR ($consultaProducto)) AND activo = 1";
             $params = array_merge([$max, $min,$busquedapor ,$cal1, $cal2, $cal3, $cal4, $cal5], $paramsMarca, $paramsProducto);
        }elseif(!empty($max) &&!empty($min) &&!empty($busquedapor)){
    $sql = "SELECT * FROM productos WHERE (precio BETWEEN ? AND ? and nombre = ?  )or  (calificacion IN (?, ?, ?, ?, ?) OR ($consultaMarca) OR ($consultaProducto)) AND activo = 1";
     $params = array_merge([$max, $min,$busquedapor ,$cal1, $cal2, $cal3, $cal4, $cal5], $paramsMarca, $paramsProducto);
}else if(empty($cal1)&&empty($cal2)&&empty($cal3) &&empty($cal4) &&empty($cal5) &&!empty($busquedapor)){
            $sql = "SELECT * FROM productos WHERE (precio BETWEEN ? AND ? AND nombre = ?  )or  (calificacion IN (?, ?, ?, ?, ?) OR ($consultaMarca) OR ($consultaProducto)) AND activo = 1";
             $params = array_merge([$max, $min,$busquedapor ,$cal1, $cal2, $cal3, $cal4, $cal5], $paramsMarca, $paramsProducto);
        }else if(!empty($busquedapor)){
        $sql = "SELECT * FROM productos WHERE (precio BETWEEN ? AND ? AND nombre = ?  )and  (calificacion IN (?, ?, ?, ?, ?) OR ($consultaMarca) OR ($consultaProducto)) AND activo = 1";
         $params = array_merge([$max, $min,$busquedapor ,$cal1, $cal2, $cal3, $cal4, $cal5], $paramsMarca, $paramsProducto);
        }else if(empty($busquedapor)){
            $sql = "SELECT * FROM productos WHERE precio BETWEEN ? AND ?  OR (calificacion IN (?, ?, ?, ?, ?) and ($consultaMarca) and ($consultaProducto)) AND activo = 1";  
             $params = array_merge([$max, $min ,$cal1, $cal2, $cal3, $cal4, $cal5], $paramsMarca, $paramsProducto);
        }

        $pdo = $this->respuesta_conexion->getPdo();
        $stmt = $pdo->prepare($sql);

        for ($i = 0; $i < count($params); $i++) {
            $stmt->bindValue($i + 1, $params[$i]);
        }
        $stmt->execute();
        if(!empty($busquedapor)){
    
            $this->marca2=array();
            $this->cantidad2=array();
            $this->tipo_de_producto2=array();
        }
        $this->precio=array();
        $this->marca=array();
        $this->imagen=array();
        $this->descripcion=array();
        $this->cantidad=array();
        $this->descuento=array();
        $this->nombre=array();
        $this->cantidad_descuento=array();
        $this->tipo_de_producto=array();
        $this->id_productos=array();
        $this->contador=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(!empty($busquedapor)){
    
                $this->marca2[]=$row['marca'];
                $this->cantidad2[]=$row['cantidad'];
                $this->tipo_de_producto2[]=$row['tipo_de_producto'];
            }
            $this->nombre[]=$row['nombre'];
            $this->marca[] = $row['marca'];
            $this->precio[] = $row['precio'];
            $this->imagen[]=$row['imagen'];
            $this->descripcion[]=$row['descripcion'];
            $this->cantidad[]=$row['cantidad'];
            $this->descuento[]=$row['descuento'];
            $this->tipo_de_producto[]=$row['tipo_de_producto'];
            $this->cantidad_descuento[]=$row['cantidad_de_descuento'];
            $this->id_productos[]=$row['id_producto'];
            $this->calificacion[]=$row['calificacion'];
            $this->contador+=1;
           
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
        
           // header('Location: error.html');
    }

}
public function ventausuario($nombre_del_producto, $precio){
    try{
        
        $sql = "SELECT * FROM venta where usuario=? and id_productos=? and pagado_si_no=0";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$_SESSION['usuario'],$nombre_del_producto]);
        
        if($comando->rowCount()>0){
            $sql = "UPDATE venta SET cantidadderoductos=cantidadderoductos+1,preciocadu=?, cantidad_a_pagar=cantidad_a_pagar+preciocadu   WHERE usuario=? and id_productos=?  ";
            $pdo = $this->respuesta_conexion->getPdo();
            $comando = $pdo->prepare($sql);
            $comando->execute([$precio,$_SESSION['usuario'], $nombre_del_producto]);

        }else{

           
            $sql = "INSERT INTO venta (cantidad_a_pagar,preciocadu,cantidadderoductos,usuario,id_productos,	
            pagado_si_no) VALUE(?,?,?,?,?,0)";
            $pdo = $this->respuesta_conexion->getPdo();
            $comando = $pdo->prepare($sql);
            $comando->execute([$precio,$precio,1,$_SESSION['usuario'],$nombre_del_producto]);
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
        
           
    }
    
}
public function buscarContrasena($correo) {
    try {
        $sql = "SELECT contrasena FROM usuario WHERE coreo = ?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$correo]);
        
        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <script>
                alert("Tu contraseña es: <?php echo $row['contrasena']; ?>");
                window.location.href="registro o sesion.php";
            </script>
            <?php
        }
}catch(PDOException $e){
    echo $e->getMessage();
        
    header('Location: error.html');
}
}
public function buscarContrasenatel($tel) {
    try {
        $sql = "SELECT contrasena FROM usuario WHERE telefono = ?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$tel]);
        
        if ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <script>
                alert("Tu contraseña es: <?php echo $row['contrasena']; ?>");
                window.location.href="registro o sesion.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("No se encontró el número de teléfono.");
                window.location.href="registro o sesion.php";
            </script>
            <?php
        }
    } catch (PDOException $e) {
        ?>
        <script>
            alert("Error: <?php echo $e->getMessage(); ?>");
            window.location.href="error.html";
        </script>
        <?php
    }
}
public $venta_cantida;
public $ventaprecioc_u;
public $ventacantidad_product=0;
public $imga_pro;
public $product_id;
public $id_compra;
public $subtotal;
public $ventacantidad_product2;
public function traerapartados(){
    try {
        $sql = "SELECT * FROM venta WHERE usuario = ? and pagado_si_no=0";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$_SESSION['usuario']]);
        $this->venta_cantida = array();
        $this->imga_pro = array();
        $this->id_compra=array();
        $this->ventacantidad_product2=array();
        $this->ventaprecioc_u = array();
        $this->product_id = array();
        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            $this->venta_cantida[] = $row['cantidad_a_pagar'];
            $this->subtotal+= $row['cantidad_a_pagar'];
            $this->ventaprecioc_u[] = $row['preciocadu'];
            $this->ventacantidad_product += $row['cantidadderoductos'];
            $this->ventacantidad_product2[] = $row['cantidadderoductos'];
            $this->product_id[] = $row['id_productos'];
            $this->id_compra[] = $row['id_compra'];
            $sql = "SELECT * FROM productos WHERE id_producto = ?";
            $comando_producto = $pdo->prepare($sql);
            $comando_producto->execute([$row['id_productos']]);
            while ($row_producto = $comando_producto->fetch(PDO::FETCH_ASSOC)) {
                $this->imga_pro[] = $row_producto['imagen'];
                $this->nombre[] = $row_producto['nombre'];
            }
            $this->contador++;
        }
           
            
        
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}
public function realizartiket(){
    try{
        $sql = "SELECT * FROM venta WHERE usuario = ?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$_SESSION['usuario']]);
        $this->venta_cantida = array();
        $this->ventacantidad_product2=array();
        $id_productos=array();
        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
            $this->venta_cantida[] = $row['cantidad_a_pagar'];
            $this->ventacantidad_product2[] = $row['cantidadderoductos'];
            $id_productos[]=$row['id_productos'];
        }
        for($i=0;$i<count($this->ventacantidad_product2);$i++){
            $sql="INSERT INTO  ticket(usuario,fecha,productos,cantidad_a_pagar) VALUES (?,?,?,?)";
            $pdo=$this->respuesta_conexion->getPdo();
            $comando = $pdo->prepare($sql);
            $comando->execute([$_SESSION['usuario'],date("Y-m-d"), $id_productos[$i],$this->venta_cantida[$i]]);
            $sql="INSERT INTO  tiket_producto(id_producto,cantidad) VALUES (?,?)";
            $pdo=$this->respuesta_conexion->getPdo();
            $comando = $pdo->prepare($sql);
            $comando->execute([$id_productos[$i],$this->ventacantidad_product2[$i]]);
        }
        $sql = "UPDATE venta SET pagado_si_no=1 WHERE usuario = ?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$_SESSION['usuario']]);
        }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
public function cambiartelefono($nuevotelefono){
    try{
        $sql = "UPDATE usuario SET telefono=? where usuario=?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$nuevotelefono,$_SESSION['usuario']]);
        if($comando->rowCount()>0){
            $_SESSION['telefono']=$nuevotelefono;
?>
<script>alert("Se ha modificado correctamente su telefono");
</script>
<?php
        }else{
            ?>
<script>alert("Lo sentimo hubo errores al cambiar su informacion, intenetelo despues");</script>
<?php
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
public function cambiarcorreo($nuevocorreo){
    try{
        $sql = "UPDATE usuario SET coreo=? where usuario=?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$nuevocorreo,$_SESSION['usuario']]);
        if($comando->rowCount()>0){
            $_SESSION['correo']=$nuevocorreo;
            ?>
<script>alert("se cambio exitosamente tu correo");</script>
<?php
        }else{
            ?>
<script>alert("Lo sentimo hubo errores al cambiar su informacion, intenetelo despues");</script>
<?php
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
public function cambiarcontraseña($nuevacontrasena){
    try{
        $sql = "UPDATE usuario SET contrasena=? where usuario=?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$nuevacontrasena,$_SESSION['usuario']]);
        if($comando->rowCount()>0){
            $_SESSION['contrasena']=$nuevacontrasena;
?>
<script>alert("Se ha modificado correctamente su contraseña");
</script>
<?php
        }else{
            ?>
<script>alert("Lo sentimo hubo errores al cambiar su informacion, intenetelo despues");</script>
<?php
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}public function cambiarimg($img) {
    try {
        $sql = "UPDATE usuario SET img = ? WHERE usuario = ?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$img, $_SESSION['usuario']]);

        if ($comando->rowCount() > 0) {
            echo "<script>alert('Se cambió la imagen');</script>";

            // Determinar el tipo de imagen desde el contenido
            $imgInfo = getimagesizefromstring($img);
            if ($imgInfo === false) {
                echo "<script>alert('No se pudo determinar el tipo de imagen');</script>";
                return;
            }

            $mimeType = $imgInfo['mime']; // Obtén el tipo MIME de la imagen
            $base64Img = base64_encode($img);
            $imgData = 'data:' . $mimeType . ';base64,' . $base64Img;
            $_SESSION['img'] = $imgData;
        } else {
            echo "<script>alert('No se pudo cambiar la imagen');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error en la base de datos: " . $e->getMessage() . "');</script>";
    }
}
public $idcitas=array();
public $usuariocita=array();
public $fechacita=array();
public $hoarcita=array();
public $fechacreacioncita=array();
public function traercitas() {
    try {
        $sql = "SELECT * FROM citas WHERE usuario = ? AND fecha >= CURDATE()";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$_SESSION['usuario']]);
        if ($comando->rowCount()) {
            while ($resultado = $comando->fetch(PDO::FETCH_ASSOC)) {
                $this->idcitas[] = $resultado['id_cita'];
                $this->usuariocita[] = $resultado['usuario'];
                $this->fechacita[] = $resultado['fecha'];
                $this->hoarcita[] = $resultado['hora']; 
                $this->fechacreacioncita[] = $resultado['fechacreacion'];
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public function quitarcita($id){
    try {
        $sql = "DELETE FROM citas WHERE id_cita=?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$id]);
        if (!$comando->rowCount()>0) {
           ?>
           <script>
            alert("Lo sentimos no pudimos eliminar la cita, intentelo despues ")
           </script>
           <?php
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
public function vericorreo($correo){
    try {
        $sql = "SELECT * FROM usuario WHERE coreo=?";
        $pdo = $this->respuesta_conexion->getPdo();
        $comando = $pdo->prepare($sql);
        $comando->execute([$correo]);
        if (!$comando->rowCount()>0) {
          return false;
        }else{
            return true;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
}

?>