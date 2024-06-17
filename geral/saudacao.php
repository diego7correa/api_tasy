<?php
header('Content-Type: application/json');
 date_default_timezone_set('America/Sao_Paulo');

// Função para determinar a saudação com base na hora atual
function getSaudacao() {
    $hora = date('H'); // Obtém a hora atual no formato de 24 horas
    
    if ($hora >= 0 && $hora < 12) {
        return "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}

// Retorna a saudação como um JSON
echo json_encode(array("saudacao" => getSaudacao()));


?>