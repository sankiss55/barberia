<?php
class conexionbd{
    private $url="mysql:host=localhost; dbname=barberia; charset=utf8mb4";
    private $usuario="root";
    private $contrasena="";
    private $pdo=null;
    public function __construct(){
    }
    public function conexion(){
        try{
            $this->pdo=new PDO($this->url, $this->usuario, $this->contrasena);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            header('Location: error.html');
    }
    
    return $this->pdo;
}
public function getPdo(){
    return $this->pdo;
}
    public function desconectar(){
        $this->pdo=null;
    }
}

?>