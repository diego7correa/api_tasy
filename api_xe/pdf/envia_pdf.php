<?php

// referenciando o namespace do dompdf

use Dompdf\Dompdf;

// include autoloader
require_once 'dompdf/vendor/autoload.php';


// instanciando o dompdf

$Dompdf = new Dompdf();

//lendo o arquivo HTML correspondente

$html = file_get_contents('relatorios/exemplo.html');

//inserindo o HTML que queremos converter

$Dompdf->loadHtml($html);

// Definindo o papel e a orientação

$Dompdf->setPaper('A4', 'landscape');

// Renderizando o HTML como PDF

$Dompdf->render();

//imprime o pdf
//header('Content-Type: application/pdf');
//echo $Dompdf->output();

// Enviando o PDF para o browser

//$Dompdf->stream();

//salvar arquivo

file_put_contents(__DIR__.'/temp/arquivo.pdf',$Dompdf->output());
?>