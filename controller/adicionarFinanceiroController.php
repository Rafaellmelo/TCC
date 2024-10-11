<?php
include_once('../model/financeiro.php');
include_once('../includes/db.php');

class AdicionarFinanceiroController {
    public function adicionarFinanceiro() {
        $financeiro = new Financeiro();

        // Verifica se os dados necessários estão definidos
        if (isset($_POST['ano'], $_POST['mes'], $_POST['agua'], $_POST['luz'], $_POST['doacao'], $_POST['eventos'], $_POST['outros_lucro'], $_POST['outros_despesas'])) {
            // Chama o método para adicionar o registro financeiro
            if ($financeiro->adicionarFinanceiro(
                $_POST['ano'],
                $_POST['mes'],
                $_POST['agua'],
                $_POST['luz'],
                $_POST['doacao'],
                $_POST['eventos'],
                $_POST['outros_lucro'],
                $_POST['outros_despesas']
            )) {
                // Redireciona em caso de sucesso
                header("Location: ../view/financeiro.php?msg=Financeiro adicionado com sucesso");
                exit; // Certifique-se de usar exit após o redirecionamento
            } else {
                // Exibe mensagem de erro se o registro já existir
                header("Location: ../view/financeiro.php?msg=Erro: Já existe um registro para o ano {$_POST['ano']} e mês {$_POST['mes']}.");
                exit; // Certifique-se de usar exit após o redirecionamento
            }
        } else {
            // Redireciona se os dados não foram enviados corretamente
            header("Location: ../view/financeiro.php?msg=Erro: Dados não enviados.");
            exit; // Certifique-se de usar exit após o redirecionamento
        }
    }
}

// Instância e chamada do controlador
$adicionarFinanceiro = new AdicionarFinanceiroController();
$adicionarFinanceiro->adicionarFinanceiro();
