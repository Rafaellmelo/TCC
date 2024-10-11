<?php
session_start(); // Inicie a sessão

include_once("../model/membro.php");

class FiltrarController {
    public function filtrar() {
        // Capturando os dados do filtro com validação básica
        $nome = isset($_GET['nome']) ? htmlspecialchars(trim($_GET['nome'])) : '';
        $genero = isset($_GET['genero']) ? htmlspecialchars(trim($_GET['genero'])) : '';
        $idade_min = isset($_GET['idade_min']) ? intval(trim($_GET['idade_min'])) : '';
        $idade_max = isset($_GET['idade_max']) ? intval(trim($_GET['idade_max'])) : '';
        $numero = isset($_GET['numero']) ? htmlspecialchars(trim($_GET['numero'])) : '';
        $batismo = isset($_GET['batismo']) ? htmlspecialchars(trim($_GET['batismo'])) : '';
        $data_batismo = isset($_GET['data_batismo']) ? htmlspecialchars(trim($_GET['data_batismo'])) : '';
        $cargo = isset($_GET['cargo']) ? htmlspecialchars(trim($_GET['cargo'])) : '';
        $data_nascimento = isset($_GET['data_nascimento']) ? htmlspecialchars(trim($_GET['data_nascimento'])) : '';

        // Criar uma nova instância da classe Membros
        $membros = new Membros('', '', '', '', '', '', ''); // Inicializar com valores vazios

        // Chamar o método de filtragem
        $resultados = $membros->filtrar($nome, $genero, $idade_min, $idade_max, $numero, $batismo, $data_batismo, $cargo, $data_nascimento);

        // Verifica se houve erro e trata
        if ($resultados === false) {
            $_SESSION['mensagem'] = "Erro ao filtrar os membros."; // Armazenar mensagem de erro
        } else {
            // Armazenar resultados na sessão
            $_SESSION['resultados'] = $resultados;
        }

        // Redirecionar para a página de resultados
        header("Location: ../view/resultado.php");
        exit(); // Sempre chame exit após header
    }
}

// Exemplo de como chamar o controlador
$controller = new FiltrarController();
$controller->filtrar();
