<?php
// Conexão com o banco de dados Oracle
include '../conexao/conexao.php';
header('Content-Type: application/json; charset=utf-8');

$STATUS = 'true';
// Verificar se é uma solicitação GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Query para selecionar todos os registros da tabela exemplo


$CD_ESP = $_GET["CD_ESP"];
$CD_PF_MEDICO = $_GET["CD_PF_MEDICO"];
$SEQ_AGENDA = $_GET["SEQ_AGENDA"];
$CPF_PAC = $_GET["CPF_PAC"];
$NR_CARTEIRA = $_GET["NR_CARTEIRA"];
$CD_CONVENIO = $_GET["CD_CONVENIO"];

try{

$query = "Begin API_STF_AGENDAMENTO_CONS ($CD_ESP,$CD_PF_MEDICO,$SEQ_AGENDA,'$CPF_PAC',$NR_CARTEIRA,$CD_CONVENIO); end;";
//$query = "select 1 from dual"; 
    
	echo "Begin API_STF_AGENDAMENTO_CONS ($CD_ESP,$CD_PF_MEDICO,$SEQ_AGENDA,'$CPF_PAC',$NR_CARTEIRA,$CD_CONVENIO); end;"; 
    // Preparar a query
    $stmt = oci_parse($conn, $query);
    
     if (!$stmt) {
        $e = oci_error($conn);
        throw new Exception("Erro ao preparar a instrução SQL: " . htmlentities($e['message'], ENT_QUOTES));
    }
 
   // Executar a instrução SQL
    if (!oci_execute($stmt)) {
        $e = oci_error($stmt);
        throw new Exception("Erro ao executar a instrução SQL: " . htmlentities($e['message'], ENT_QUOTES));
    }
	
	
}catch (Exception $e) {
    // Tratar erros
    //echo "Ocorreu um erro: " . $e->getMessage();
	$STATUS = 'false';
	//echo json_encode(array("status" => $STATUS));	
   
	
	
}
 }else {
    // Se não for uma solicitação GET, retornar um erro
    header("HTTP/1.1 405 Method Not Allowed");	
     //echo json_encode(array("message" => "Método não permitido"));
	 $STATUS = 'false';
	echo json_encode(array("status" =>  "Método não permitido"));
} 

  echo json_encode(array("status" => $STATUS));	
// Fechar conexão com o banco de dados
oci_close($conn);


?>