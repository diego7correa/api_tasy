<?php
// Conexão com o banco de dados Oracle
$usuario = "tasy";
$senha = "BL5B6020NKA45"; 
$banco_de_dados = '(DESCRIPTION=
      (ADDRESS=
        (PROTOCOL=TCP)
        (HOST=192.168.8.99)
        (PORT=1529))
      (CONNECT_DATA=
        (SERVER=DEDICATED)
        (SERVICE_NAME=tasytst.virviramos)
        (FAILOVER_MODE=
          (TYPE=select)
          (METHOD=basic) ) ) )';

$conn = oci_connect($usuario, $senha, $banco_de_dados);

if (!$conn) {
    $erro = oci_error();
	
    echo "Falha na conexão: " . $erro['message'];
    exit();
}



?>