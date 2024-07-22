<?php
// Reemplaza estos valores con tus propias credenciales y detalles de mensaje
$token = "YOUR_API_TOKEN";
$phoneNumber = "PHONE_NUMBER_TO_SEND_TO";
$message = "Hello, this is a test message from PHP!";

// URL de la API de ChatAPI
$url = "https://api.chat-api.com/instance12345/message";

// Datos para enviar
$data = [
    "phone" => $phoneNumber,
    "body" => $message
];

// Codifica los datos para la solicitud
$postData = json_encode($data);

// Configura la solicitud HTTP
$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\n" .
                     "Authorization: Token $token\r\n",
        'method'  => 'POST',
        'content' => $postData
    ]
];

// Realiza la solicitud
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Muestra el resultado de la solicitud
echo $result;
?>
