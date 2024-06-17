<?php

// Defina o cabeçalho para indicar que o conteúdo é JSON
header('Content-Type: application/json');

// Obtém a data atual
$date = date('Y-m-d H:i:s');

// Monta a resposta da API em um array
$response = array(
    'status' => 'success',
    'message' => 'Data atual obtida com sucesso',
    'data' => $date
);

// Converte o array para JSON e imprime
echo json_encode($response);
?>