<?php
/* Codificação Json */
header('Content-Type: application/json');

$arquivo = file_get_contents("./swagger.json");
    echo ($arquivo);
?>