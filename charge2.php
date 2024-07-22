<?php
require_once 'vendor/autoload.php';
require_once("conekta/lib/Conekta.php");
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
$stripe = new \Stripe\StripeClient('sk_test_51PGwJHRuEDur0E7WKg2KF3S8gvQyrZsB4C5NX9CaU7TONnxOaROx3anqS1Y9dmBCIURvcMTQyYUxZZhFINSlPZ4Z00MjGNrPFf');

$acciones->traerapartados();
try {
    if (isset($_POST['stripeToken'])) {
        $token = $_POST['stripeToken'];
        $precio = $_POST['precio'];
        $charge = $stripe->charges->create([
            'amount' => $_POST['precio']*100 , 
            'currency' => 'mxn',
            'source' => $token, 
            'description' => 'user payment',
            'capture' => true
        ]);
        if ($charge['status'] === 'succeeded') {
            $message = "¡Pago Aprobado!";
            $image = "data:image/jpeg;base64,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";
            
    $acciones->realizartiket();
    $acciones->enviodecorreovarios("¡Gracias por tu compra en Levi's Cutz!", "Tu compra se ha realizado con éxito. Agradecemos tu confianza en nosotros. Tus productos serán enviados con la mayor seguridad y calidad. ¡Esperamos que los disfrutes!", $_SESSION['correo']);

    $acciones->enviodecorreovarios("¡Nueva compra realizada en Levi's Cutz!", "El usuario " . $_SESSION['usuario'] . " ha realizado una nueva compra. Por favor, revisa los detalles del pedido y prepáralo para el envío. Gracias.", 'barberiagalaxia82@gmail.com');
        } else {
            $message = "¡Pago NO Aprobado!";
            $image = "https://media.istockphoto.com/id/1324329378/es/vector/expresi%C3%B3n-negativa-de-las-mujeres.jpg?s=612x612&w=0&k=20&c=B0y-4Kq7jNRqiuMhqIZ4sCFUnF9qx98PQJmtdPXsB_A="; 
        }
    } else {
        $message = "No se recibió el token de Stripe.";
        $image = "https://media.istockphoto.com/id/1324329378/es/vector/expresi%C3%B3n-negativa-de-las-mujeres.jpg?s=612x612&w=0&k=20&c=B0y-4Kq7jNRqiuMhqIZ4sCFUnF9qx98PQJmtdPXsB_A=";
    }
} catch (\Stripe\Exception\ApiErrorException $e) {
    $message = 'Error al crear el cargo: ' . $e->getMessage();
    $image = "https://media.istockphoto.com/id/1324329378/es/vector/expresi%C3%B3n-negativa-de-las-mujeres.jpg?s=612x612&w=0&k=20&c=B0y-4Kq7jNRqiuMhqIZ4sCFUnF9qx98PQJmtdPXsB_A=";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Pago</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            max-width: 400px;
            width: 100%;
        }
        .message-container img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .btn-finalizar {
            display: block;
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <img src="<?php echo $image; ?>" alt="Estado del Pago">
        <h1><?php echo $message; ?></h1>
        <a href="productosapartados.php" class="btn btn-primary btn-finalizar">Finalizar</a>

    </div>
</body>
</html>
