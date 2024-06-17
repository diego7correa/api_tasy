<?php
// Definir o cabeçalho para permitir solicitações de qualquer origem (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Pausar a execução por 5 segundos
//sleep(5);
$sleep = $_GET["sleep"];

sleep($sleep);

// Resposta da API
$response = array(
    "status" => "success",
    "message" => "API chamada com sucesso após uma pausa de $sleep segundos"
);

// Retornar a resposta em formato JSON
echo json_encode($response);
?>