<?php
require_once("conekta/lib/Conekta.php");
session_start();
include_once('conexion base de datos.php');
include_once('acciones.php');

$conexion = new conexionbd();
$conexion->conexion();
$acciones = new acciones($conexion);
if(isset($_SESSION['usuario'])){
$acciones->traerapartados();
\Conekta\Conekta::setApiKey("key_ke9Qz44dV9fD4pcKnDtMHC4");
\Conekta\Conekta::setApiVersion("2.0.0");

try {
    $line_items = [];
    for ($i = 0; $i < count($acciones->nombre); $i++) {
        $line_items[] = [
            "name" => $acciones->nombre[$i],
            "unit_price" => $acciones->ventaprecioc_u[$i] * 100,
            "quantity" => $acciones->ventacantidad_product2[$i],
        ];
    }
    $thirty_days_from_now = (new DateTime())->add(new DateInterval('P30D'))->getTimestamp();

    $order = \Conekta\Order::create([
        "line_items" => $line_items,
        "shipping_lines" => [
            [
                "amount" => 4000,
                "carrier" => "levi's cuts",
                "method" => "estandar",
                "tracking_number" => "JSHAG26E27WHIDS8",
                "carrier_service" => "ground"
            ]
        ],
        "currency" => "MXN",
        "customer_info" => [
            "name" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
            "phone" => $_POST['telefono'],
            "email" => $_SESSION['correo']
        ],
        "charges" => [
            [
                "payment_method" => [
                    "type" => "oxxo_cash",
                    "expires_at" => $thirty_days_from_now
                ]
            ]
        ],
        "metadata" => [
            "reference" => "1234",
            "more_info" => "Na",
            "more_info2" => "Na",
        ],
        "shipping_contact" => [
            "phone" => $_POST['telefono'],
            "receiver" =>  $_SESSION['nombre'] . " " . $_SESSION['apellido'],  
            "address" => [
                "street1" => $_POST['calle'] . " " . $_POST['numero_exterior'],
                "street2" => $_POST['numero_interior'],
                "colony" => $_POST['colonia'],  
                "municipality" => $_POST['municipio'],  
                "state" => $_POST['estado'], 
                "postal_code" => $_POST['codigo_postal'],
                "country" => "MX",
            ],
            "between_streets" => "Calle 1: " . $_POST['calle_1'] . " Calle 2: " . $_POST['calle_2']
        ]
    ]);
    $acciones->realizartiket();
    
    $acciones->enviodecorreovarios("¡Gracias por tu compra en Levi's Cutz!", "Tu compra se ha realizado con éxito. Agradecemos tu confianza en nosotros. Tus productos serán enviados con la mayor seguridad y calidad. ¡Esperamos que los disfrutes!", $_SESSION['correo']);
    $acciones->enviodecorreovarios("¡Nueva compra realizada en Levi's Cutz!", "El usuario " . $_SESSION['usuario'] . " ha realizado una nueva compra. Por favor, revisa los detalles del pedido y prepáralo para el envío. Gracias.", 'barberiagalaxia82@gmail.com');

} catch (\Conekta\ParameterValidationError $error) {
    echo $error->getMessage();
} catch (\Conekta\Handler $error) {
    echo $error->getMessage();
}
}else{
    header('Location: Errornoencontrado.html');
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="estilos/styles.css" media="all" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div id="opps" class="opps">
        <div class="opps-header">
            <div class="opps-reminder">Si es necesario puedes descargar este código de pago.</div>
            <div class="opps-info">
                <div class="opps-brand"><img src="imagenes/oxxopay_brand.png" alt="OXXOPay"></div>
                <div class="opps-ammount">
                    <h3>Monto a pagar</h3>
                    <h2><?php echo '$' . $order->amount / 100 ?> <sup>MXN</sup></h2>
                    <p>OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
                </div>
            </div>
            <div class="opps-reference">
                <h3>Referencia</h3>
                <h1><?php echo $order->charges[0]->payment_method->reference ?></h1>
            </div>
        </div>
        <div class="opps-instructions">
            <h3>Instrucciones</h3>
            <ol>
                <li>Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encuéntrala aquí</a>.</li>
                <li>Indica en caja que quieres realizar un pago de servicio<strong></strong>.</li>
                <li>Dicta al cajero el número de referencia en esta ficha para que tecleé directamente en la pantalla de venta.</li>
                <li>Realiza el pago correspondiente con dinero en efectivo.</li>
                <li>Al confirmar tu pago, el cajero te entregará un comprobante impreso. <strong>En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
            </ol>
            <div class="opps-footnote">Al completar estos pasos recibirás un correo de <strong>Nombre del negocio</strong> confirmando tu pago.</div>
        </div>
       
    </div>  
    <button title="Generar pdf" id="generarpdf"><i>Generar orden de pago en PDF</i></button>
    <script>
        document.getElementById('generarpdf').addEventListener('click', function() {
            var opps = document.getElementById('opps');
            html2pdf().from(opps).save('orden_de_pago.pdf');
        });
    </script>
</body>
</html>
