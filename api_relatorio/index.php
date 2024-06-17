<?php
// Conexão com o banco de dados Oracle
include './conexao/conexao.php';
// Inclui a biblioteca FPDF
require('../fpdf/fpdf.php');

// Verificar se é uma solicitação GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Query para selecionar todos os registros da tabela exemplo


$query = "SELECT 
ds_convenio as nome,
cd_convenio as id,
'testes' as email 
FROM convenio
union all
SELECT 
ds_convenio as nome,
cd_convenio as id,
'testes' as email 
FROM convenio
union all
SELECT 
ds_convenio as nome,
cd_convenio as id,
'testes' as email 
FROM convenio"; 
    
    // Preparar a query
    $stmt = oci_parse($conn, $query);

    if (!oci_execute($stmt)) {
    $e = oci_error($stmt);
    echo "Erro ao executar a consulta: " . $e['message'];
    exit;
}


	
	// Cria uma nova instância do FPDF *********************************
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);


// Adiciona cabeçalhos ao PDF *********************************
$pdf->Cell(80);
$pdf->Cell(20, 10, utf8_decode('Título do Relatório - Hospital Modelo'), 0, 1, 'C');
$pdf->Cell(20, 10, (''), 0, 1, 'C');


$pdf->Cell(40, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Nome', 1);
$pdf->Cell(40, 10, 'Email', 1);
//$pdf->Image('logo.png',160, 1, 35);
//(posição x, posição y , Width ,Height )
$pdf->Image('logo/logo.png',160,-5, 30, 40);
$pdf->Ln();

// Itera sobre os resultados da consulta e adiciona ao PDF*********************************
while ($row = oci_fetch_assoc($stmt)) {
	//(posição,altura,campo,opção 1 com borda e 0 sem)
    $pdf->Cell(40, 10, $row['ID'], 1);
    $pdf->Cell(60, 10, $row['NOME'], 1);
    $pdf->Cell(40, 10, $row['EMAIL'], 1);
    $pdf->Ln();
}


// Muda a cor da linha para verde e desenha outra linha
//$pdf->SetDrawColor(0, 255, 0); // Verde
//$pdf->Line(40, 10, 10, 1);

// Define o caminho para salvar o PDF
//$save_path = 'caminho/para/salvar/arquivo/';
$save_path = 'C:/temp/';
$filename = $save_path . 'resultado_consulta.pdf';

// Gera e salva o PDF
$pdf->Output('F', $filename);


 }else {
    // Se não for uma solicitação GET, retornar um erro
    header("HTTP/1.1 405 Method Not Allowed");
	
    echo json_encode(array("message" => "Método não permitido"));
} 

  
echo "PDF gerado e salvo com sucesso em: " . $filename;
  
// Fechar conexão com o banco de dados
oci_close($conn);


?>