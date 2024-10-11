<?php
session_start();
require('../fpdf/fpdf.php'); // Inclua o arquivo da biblioteca FPDF
include_once('../includes/db.php');
include_once('../model/membro.php');

// Função para converter texto de UTF-8 para ISO-8859-1
function utf8_to_iso($text) {
    return mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
}// Função para calcular idade a partir da data de nascimento
function calcularIdade($data_nascimento) {
    $nascimento = new DateTime($data_nascimento);
    $hoje = new DateTime();
    $idade = $hoje->diff($nascimento);
    return $idade->y; // Retorna a idade em anos
}

// Função para formatar datas no formato dd/mm/yyyy
function formatarData($data) {
    return date('d/m/Y', strtotime($data));
}

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $this->utf8_to_iso('Relatório de Membros Filtrados'), 0, 1, 'C');
        $this->Ln(10); // Adicione uma linha em branco
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->utf8_to_iso('Página ' . $this->PageNo()), 0, 0, 'C');
    }

    function utf8_to_iso($text) {
        return mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
    }
}

$pdf = new PDF();

// Verifique se existem resultados armazenados na sessão
if (isset($_SESSION['resultados']) && !empty($_SESSION['resultados'])) {
    $pdf->AddPage();
    
    // Defina a fonte Arial
    $pdf->SetFont('Arial', 'B', 10);

    // Cabeçalhos da tabela
    $pdf->Cell(40, 10, $pdf->utf8_to_iso('Nome'), 1, 0, 'C');
    $pdf->Cell(30, 10, $pdf->utf8_to_iso('Data Nasc.'), 1, 0, 'C');
    $pdf->Cell(10, 10, 'Idade', 1, 0, 'C');
    $pdf->Cell(30, 10, $pdf->utf8_to_iso('Número'), 1, 0, 'C');
    $pdf->Cell(14, 10, $pdf->utf8_to_iso('Batismo'), 1, 0, 'C');
    $pdf->Cell(30, 10, $pdf->utf8_to_iso('Data Batismo'), 1, 0, 'C');
    $pdf->Cell(20, 10, $pdf->utf8_to_iso('Cargo'), 1, 0, 'C');
    $pdf->Cell(15, 10, $pdf->utf8_to_iso('Gênero'), 1, 1, 'C');

    // Adicione os dados dos membros filtrados
    $pdf->SetFont('Arial', '', 10);
    foreach ($_SESSION['resultados'] as $dataMembro) {
        $membro = new Membros($dataMembro['nome'], $dataMembro['data_nascimento'], $dataMembro['numero'], $dataMembro['batismo'], $dataMembro['genero'], $dataMembro['cargo'], $dataMembro['data_batismo']);
        
        $numero = $membro->getNumero(); // Acessa a propriedade do número
        $nome = $membro->getNome(); // Acessa a propriedade do objeto
        $idade = calcularIdade($membro->getDataNascimento()); // Chama a função de cálculo de idade
        $data_nascimento = formatarData($membro->getDataNascimento()); // Formata a data de nascimento
        $cargo = $membro->getCargo(); // Acessa a propriedade do objeto
        $genero = $membro->getGenero(); // Acessa a propriedade do gênero

        // Lógica para determinar se o batismo foi realizado
        if (!empty($membro->getDataBatismo())) {
            $batismo = 'Sim';
            $data_batismo = formatarData($membro->getDataBatismo()); // Data do batismo se existir
        } else {
            $batismo = 'Não';
            $data_batismo = 'N/A'; // Se não houver data, exibe 'N/A'
        }

        // Adicione os dados do membro à tabela
        $pdf->Cell(40, 10, $pdf->utf8_to_iso($nome), 1, 0, 'C');
        $pdf->Cell(30, 10, $pdf->utf8_to_iso($data_nascimento), 1, 0, 'C');
        $pdf->Cell(10, 10, $idade, 1, 0, 'C');
        $pdf->Cell(30, 10, $pdf->utf8_to_iso($numero), 1, 0, 'C');
        $pdf->Cell(14, 10, $pdf->utf8_to_iso($batismo), 1, 0, 'C');
        $pdf->Cell(30, 10, $pdf->utf8_to_iso($data_batismo), 1, 0, 'C');
        $pdf->Cell(20, 10, $pdf->utf8_to_iso($cargo), 1, 0, 'C');
        $pdf->Cell(15, 10, $pdf->utf8_to_iso($genero), 1, 1, 'C');
    }

    // Limpa os resultados da sessão após gerar o PDF
    unset($_SESSION['resultados']);
    
    // Envie o PDF para o navegador
    $pdf->Output('D', 'relatorio_membros_filtrados.pdf'); // D para download
} else {
    echo "Nenhum resultado encontrado para gerar o PDF.";
}
