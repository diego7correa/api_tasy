<?php
// Conexão com o banco de dados Oracle
include '../conexao/conexao.php';
header('Content-Type: application/json; charset=utf-8');

$STATUS = 'false';
// Verificar se é uma solicitação GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query para selecionar todos os registros da tabela exemplo


$CPF = $_GET["CPF"];
$NOME = $_GET["NOME"];
$RG = $_GET["RG"];
$EMAIL = $_GET["EMAIL"];
$TEL = $_GET["TEL"];
$NASCIMENTO = $_GET["NASCIMENTO"];

//http://37.27.47.182/api/agenda/cadastro_pf.php?CPF=XXX&NOME=XXX&RG=XXX&EMAIL=XXX&TEL=XXX&NASCIMENTO=XXX

$query = "SELECT 
PESSOA_FISICA_seq.nextval SEQ_PESSOA_FISICA
  FROM DUAL"; 
    
    // Preparar a query
    $stmt = oci_parse($conn, $query);
    
    // Executar a query
    oci_execute($stmt);

    while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
    // Imprime o valor do campo
    $SEQ_PESSOA_FISICA = $row['SEQ_PESSOA_FISICA'];
}

// validar  DATA antes de inserir
$data = DateTime::createFromFormat("d/m/Y", $NASCIMENTO);

if ($data !== false && !array_sum($data::getLastErrors())) {
    $DATA_WHATS = 'true';
} else {
    $DATA_WHATS = 'false';
}
//Insere a pessoa fisica

if ($DATA_WHATS == 'true'){


$query = "INSERT INTO PESSOA_FISICA 
(CD_PESSOA_FISICA,NM_PESSOA_FISICA,NR_IDENTIDADE,NR_TELEFONE_CELULAR,NR_CPF,DT_NASCIMENTO,IE_TIPO_PESSOA,DT_ATUALIZACAO,NM_USUARIO,NM_USUARIO_ORIGINAL) 
VALUES ($SEQ_PESSOA_FISICA,'$NOME','$RG',substr(REGEXP_REPLACE('$TEL', '[^[:digit:]]', ''),3,20),substr('$CPF',1,11),TO_DATE('$NASCIMENTO', 'DD/MM/YYYY'),2,SYSDATE,'WHATSAPP','WHATSAPP')";

 $stmt = oci_parse($conn, $query);
 
 oci_execute($stmt);
 
 //Insere o email da pessoa fisica
 $query = "insert into COMPL_PESSOA_FISICA (CD_PESSOA_FISICA,NR_SEQUENCIA,DS_EMAIL,DT_ATUALIZACAO,NM_USUARIO,IE_TIPO_COMPLEMENTO)
 values($SEQ_PESSOA_FISICA,1,'$EMAIL',SYSDATE,'WHATSAPP',3)";

 $stmt = oci_parse($conn, $query);
 
 $result = oci_execute($stmt);
 
 $STATUS = 'true';
}else{
$STATUS = 'false';
   	
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