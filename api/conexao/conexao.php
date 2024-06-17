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



?>