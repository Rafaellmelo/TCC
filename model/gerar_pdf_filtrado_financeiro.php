<?php
// Inicia a sessão
session_start();

include_once('../includes/db.php');
require('../fpdf/fpdf.php');

// Verifica se há filtros armazenados na sessão
if (!isset($_SESSION['filtros'])) {
    echo "Nenhum dado filtrado encontrado!";
    exit;
}

$filtros = $_SESSION['filtros'];

$db = new DataBase();
$db->conectar();

// Verifica a conexão
if (!$db->getConexao()) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Consulta baseada nos filtros armazenados na sessão
$sql = "SELECT * FROM financeiro WHERE 1=1";
$params = [];
$types = "";

// Filtros de ano e mês
if (!empty($filtros['ano'])) {
    $sql .= " AND ano = ?";
    $params[] = $filtros['ano'];
    $types .= "s";
}
if (!empty($filtros['mes'])) {
    $sql .= " AND mes = ?";
    $params[] = $filtros['mes'];
    $types .= "s";
}

// Filtros de valor de água
if (!empty($filtros['agua_min']) || !empty($filtros['agua_max'])) {
    if (!empty($filtros['agua_min'])) {
        $sql .= " AND agua >= ?";
        $params[] = $filtros['agua_min'];
        $types .= "d";
    }
    if (!empty($filtros['agua_max'])) {
        $sql .= " AND agua <= ?";
        $params[] = $filtros['agua_max'];
        $types .= "d";
    }
}

// Filtros de valor de luz
if (!empty($filtros['luz_min']) || !empty($filtros['luz_max'])) {
    if (!empty($filtros['luz_min'])) {
        $sql .= " AND luz >= ?";
        $params[] = $filtros['luz_min'];
        $types .= "d";
    }
    if (!empty($filtros['luz_max'])) {
        $sql .= " AND luz <= ?";
        $params[] = $filtros['luz_max'];
        $types .= "d";
    }
}

// (Outros filtros podem ser adicionados conforme necessário...)

$stmt = $db->getConexao()->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Cria uma nova instância do FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Define a fonte e o título do PDF
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, 'Relatorio Financeiro Filtrado', 0, 1, 'C');

// Espaço
$pdf->Ln(10);

// Cabeçalhos da tabela
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Ano', 1);
$pdf->Cell(30, 10, 'Mes', 1);
$pdf->Cell(40, 10, 'Lucro Total', 1);
$pdf->Cell(40, 10, 'Despesas Totais', 1);
$pdf->Cell(40, 10, 'Saldo', 1);
$pdf->Ln();

// Verifica se há resultados na consulta
if ($result && $result->num_rows > 0) {
    // Define a fonte para o conteúdo da tabela
    $pdf->SetFont('Arial', '', 12);

    while ($row = $result->fetch_assoc()) {
        // Dados das colunas
        $pdf->Cell(30, 10, $row['ano'], 1);
        $pdf->Cell(30, 10, $row['mes'], 1);
        $pdf->Cell(40, 10, number_format($row['lucro_total'], 2, ',', '.'), 1);
        $pdf->Cell(40, 10, number_format($row['despesa_total'], 2, ',', '.'), 1);
        $pdf->Cell(40, 10, number_format($row['saldo'], 2, ',', '.'), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(190, 10, 'Nenhum resultado encontrado!', 1, 1, 'C');
}

// Saída do PDF gerado
$pdf->Output('D', 'relatorio_financeiro_filtrado.pdf');

// Fecha a conexão
$stmt->close();
$db->getConexao()->close();
