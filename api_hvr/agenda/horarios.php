<?php
// Conexão com o banco de dados Oracle
include '../conexao/conexao.php';
header('Content-Type: application/json; charset=utf-8');

    $cd_especialidade = $_GET["cd_esp"];
    $cd_pessoa_fisica = $_GET["cd_pf_med"];
	$remoteJid = $_GET["remoteJid"];
	$baseUrl =   $_GET["baseUrl"];
	$instancia = $_GET["instancia"];
	$apikey =    $_GET["apikey"];

// Verificar se é uma solicitação GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Query para selecionar todos os registros da tabela exemplo


$query = "select distinct dt_agenda as ".'"title"'.",
NR_SEQ_DT_AGENDA  as ".'"rowId"'." 
from STF_AGENDAMENTO_CONS
where 1=1
and cd_especialidade = $cd_especialidade
and cd_pessoa_fisica = $cd_pessoa_fisica
order by 2";
    
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
	
	// Loop através dos resultados e imprime na tela

	
	$json_resultados = array(
    "number" => $remoteJid,
    "options" => array(
        "delay" => 1200,
        "presence" => "composing"
    ),
    "listMessage" => array(
        "title" => "Selecione o Horário da sua preferencia",
        "description" => "Você vai deve  selecionar  o dia que deseja realizar sua consulta",
        "buttonText" => "Clique Aqui!",
        "sections" => array(
            array(
                "title" => "Opções",
                "rows" => $resultados
            )
        )
    )
);



    // Retornar os resultados como JSON
	$json_resultados = mb_convert_encoding($json_resultados, 'UTF-8', 'auto');
	
	$json_response = json_encode($json_resultados);
   // echo json_encode($json_resultados);


 }else {
    // Se não for uma solicitação GET, retornar um erro
    header("HTTP/1.1 405 Method Not Allowed");
	
    echo json_encode(array("message" => "Método não permitido"));
} 

  
// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
  $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, $baseUrl.'/message/sendList/'.$instancia);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS,$json_response);


 $headers = array();
 $headers[] = 'Accept: application/json';
 $headers[] = 'Apikey: '.$apikey;
 $headers[] = 'Content-Type: application/json';
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

 $result = curl_exec($ch);
 if (curl_errno($ch)) {
     echo 'Error:' . curl_error($ch);
 }
 curl_close($ch);  
  
//echo "<script>alert('$result');</script>"; */
// Fechar conexão com o banco de dados
oci_close($conn);


?>