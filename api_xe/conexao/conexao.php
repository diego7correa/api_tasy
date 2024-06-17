<?php
// Conexão com o banco de dados Oracle
$usuario = "system";
$senha = "etimologia"; 
$banco_de_dados = 'localhost/XE';

$conn = oci_connect($usuario, $senha, $banco_de_dados);

if (!$conn) {
    $erro = oci_error();
	
    echo "Falha na conexão: " . $erro['message'];
    exit();
}



?>