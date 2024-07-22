<?php
//TOKEN QUE NOS DA FACEBOOK
$token = 'EAALkIHOiCmgBOxsrJYnCUZC45ZAt8EsKP3bac2f2mZCL3faJ8w23DukvWLPpVucjDGzAHrnszygixhhUPBbhCFKgSqellk0A48Vd4aZCLJNg0XLSqmTxz1HTQIoS4ijmJJEgDg81hK5ZAEK4EoVRIP8b4E94Pv9p8FQZBhulOit5ZACDMgnW7pa5hNG9QvHQ221ZCXftwq5NjgHFbHlGUdsZD';
//NUESTRO TELEFONO
$telefono = '525514110235';
//URL A DONDE SE MANDARA EL MENSAJE
$url = 'https://graph.facebook.com/v19.0/303075636225612/messages';
//CONFIGURACION DEL MENSAJE
$mensaje = ''
        . '{'
        . '"messaging_product": "whatsapp", '
        . '"to": "'.$telefono.'", '
        . '"type": "template", '
        . '"template": '
        . '{'
        . '     "name": "hello_world",'
        . '     "language":{ "code": "en_US" } '
        . '} '
        . '}';
//DECLARAMOS LAS CABECERAS
$header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
//INICIAMOS EL CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
$response = json_decode(curl_exec($curl), true);
//IMPRIMIMOS LA RESPUESTA 
print_r($response);
//OBTENEMOS EL CODIGO DE LA RESPUESTA
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//CERRAMOS EL CURL
curl_close($curl);