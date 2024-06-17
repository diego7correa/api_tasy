<?php
// Conexão com o banco de dados Oracle
include '../conexao/conexao.php';

// Verificar se é uma solicitação GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query para selecionar todos os registros da tabela exemplo


$CPF = $_GET["CPF"];


$query = "SELECT 
CD_PESSOA_FISICA VERIFICA_CAD,
NM_PESSOA_FISICA NOME
FROM PESSOA_FISICA
WHERE NR_CPF = $CPF"; 
    
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
	
	// Loop através dos resultados da consulta
    while ($row = oci_fetch_assoc($stmt)) {
        $resultados[] = $row;
    }



    // Retornar os resultados como JSON
    header('Content-Type: application/json');
	
	echo json_encode($resultados);
   // echo json_encode($json_resultados);


 }else {
    // Se não for uma solicitação GET, retornar um erro
    header("HTTP/1.1 405 Method Not Allowed");
	
    echo json_encode(array("message" => "Método não permitido"));
} 


// Fechar conexão com o banco de dados
oci_close($conn);


?>