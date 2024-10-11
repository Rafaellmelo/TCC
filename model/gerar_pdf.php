<?php
require('../fpdf/fpdf.php');
include('../includes/db.php');

// Função para converter texto de UTF-8 para ISO-8859-1
function utf8_to_iso($text) {
    return mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
}

// Função para calcular idade a partir da data de nascimento
function calculaIdade($dataNascimento) {
    $dataNascimento = new DateTime($dataNascimento);
    $dataAtual = new DateTime();
    $idade = $dataAtual->diff($dataNascimento);
    return $idade->y;
}

// Conecta ao banco de dados
$db = new DataBase();
$conn = $db->conectar(); // Certifique-se que isso retorna uma conexão mysqli

// Instancia o PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Título
$pdf->Cell(190, 10, utf8_to_iso('Lista de Membros'), 0, 1, 'C');
$pdf->Ln(10);

// Cabeçalho da tabela
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, utf8_to_iso('Nome'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_to_iso('Data Nasc.'), 1, 0, 'C');
$pdf->Cell(10, 10, 'Idade', 1, 0, 'C');
$pdf->Cell(30, 10, utf8_to_iso('Número'), 1, 0, 'C');
$pdf->Cell(14, 10, utf8_to_iso('Batismo'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_to_iso('Data Batismo'), 1, 0, 'C');
$pdf->Cell(20, 10, utf8_to_iso('Cargo'), 1, 0, 'C');
$pdf->Cell(15, 10, utf8_to_iso('Gênero'), 1, 1, 'C');

// Prepara a query
$query = "SELECT id, nome, data_nascimento, numero, batismo, data_batismo, cargo, genero FROM membros";
if ($stmt = $db->getConexao()->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($id, $nome, $data_nascimento, $numero, $batismo, $data_batismo, $cargo, $genero);

    // Exibe os dados na tabela
    $pdf->SetFont('Arial', '', 10);
    while ($stmt->fetch()) {
        $pdf->Cell(40, 10, utf8_to_iso($nome), 1, 0, 'C');
        $pdf->Cell(30, 10, date('d/m/Y', strtotime($data_nascimento)), 1, 0, 'C');
        $pdf->Cell(10, 10, calculaIdade($data_nascimento), 1, 0, 'C');
        $pdf->Cell(30, 10, utf8_to_iso($numero), 1, 0, 'C');
        $pdf->Cell(14, 10, utf8_to_iso($batismo), 1, 0, 'C');
        $pdf->Cell(30, 10, !empty($data_batismo) ? date('d/m/Y', strtotime($data_batismo)) : '', 1, 0, 'C');
        $pdf->Cell(20, 10, utf8_to_iso($cargo), 1, 0, 'C');
        $pdf->Cell(15, 10, utf8_to_iso($genero), 1, 1, 'C');
    }
    $stmt->close();
} else {
    echo 'Erro ao preparar a consulta: ' . $db->getConexao()->error;
}

// Saída do PDF
$pdf->Output('D', 'membros.pdf');
?>
