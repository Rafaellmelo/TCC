<?php
include_once('../includes/db.php');
include('../fpdf/fpdf.php');

class PDF extends FPDF {
    // Cabeçalho
    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, $this->utf8_to_iso('Relatório de Finanças'), 0, 1, 'C');
        // Linha abaixo do título
        $this->Ln(10);
    }

    // Rodapé
    function Footer() {
        // Posiciona a 1,5 cm do final da página
        $this->SetY(-15);
        // Arial itálico 8
        $this->SetFont('Arial', 'I', 8);
        // Número da página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Função para converter caracteres UTF-8 para ISO-8859-1 (para o FPDF)
    function utf8_to_iso($string) {
        return mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');
    }
}

// Instancia a classe do banco de dados e conecta
$db = new DataBase();
$db->conectar();

// Busca os dados financeiros do banco
$sql = "SELECT * FROM financeiro ORDER BY ano DESC, mes DESC";
$result = $db->getConexao()->query($sql);

// Instancia a classe PDF
$pdf = new PDF();
$pdf->AddPage();

// Define o cabeçalho da tabela
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Ano', 1);
$pdf->Cell(30, 10, 'Mes', 1);
$pdf->Cell(30, 10, 'Lucro total', 1);
$pdf->Cell(30, 10, 'Despesas total', 1);
$pdf->Cell(30, 10, 'Saldo', 1);
$pdf->Ln(); // Nova linha para começar a tabela

// Define a fonte para o corpo da tabela
$pdf->SetFont('Arial', '', 10);

// Preenche a tabela com os dados do banco
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['ano'], 1);
    $pdf->Cell(30, 10, $pdf->utf8_to_iso($row['mes']), 1);
    $pdf->Cell(30, 10, number_format($row['lucro_total'], 2, ',', '.'), 1);
    $pdf->Cell(30, 10, number_format($row['despesa_total'], 2, ',', '.'), 1);
    $pdf->Cell(30, 10, number_format($row['saldo'], 2, ',', '.'), 1);
    $pdf->Ln(); // Nova linha para cada registro
}

// Gera e exibe o PDF no navegador
$pdf->Output('D', 'relatorio_financeiro.pdf');
?>
