<?php

// Conexão com o banco de dados Oracle
$usuario = "tasy";
$senha = "haoc_teste"; 
$banco_de_dados = '(DESCRIPTION=
      (ADDRESS=
        (PROTOCOL=TCP)
        (HOST=scan-dbhtml5.oswaldocruz.intranet)
        (PORT=1521))
      (CONNECT_DATA=
        (SERVER=DEDICATED)
        (SERVICE_NAME=dbhtml5.oswaldocruz.intranet)
        (FAILOVER_MODE=
          (TYPE=select)
          (METHOD=basic) ) ) )';

$conn = oci_connect($usuario, $senha, $banco_de_dados);

if (!$conn) {
    $erro = oci_error();
    echo "Falha na conexão: " . $erro['message'];
    exit();
}

// Verificar se é uma solicitação GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query para selecionar todos os registros da tabela exemplo
    $query = "SELECT rownum sequencia,ds_convenio CONVENIO
FROM convenio where cd_convenio in (267,340,733,136,1327)";
    
    // Preparar a query
    $stmt = oci_parse($conn, $query);
    
    // Executar a query
    oci_execute($stmt);

    // Array para armazenar os resultados da consulta
    $resultados = array();

    // Loop através dos resultados da consulta
    while ($row = oci_fetch_assoc($stmt)) {
        $resultados[] = $row;
    }
	

    // Retornar os resultados como JSON
    header('Content-Type: application/json');
    echo json_encode($resultados);
} else {
    // Se não for uma solicitação GET, retornar um erro
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(array("message" => "Método não permitido"));
}

// Fechar conexão com o banco de dados
oci_close($conn);

?>