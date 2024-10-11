<?php
include_once('../includes/db.php');
include_once('../model/financeiro.php');

class EditarFinanceiroController {

    public function editarFinanceiro() {
        $db = new DataBase();
        $db->conectar();
    
        $financeiro = new Financeiro();
    
        // Verificar se todos os campos necessários estão definidos
        if (empty($_POST['ano']) || empty($_POST['mes']) || empty($_POST['agua']) || empty($_POST['luz']) || empty($_POST['doacao']) || empty($_POST['eventos']) || empty($_POST['outros_lucro']) || empty($_POST['outros_despesas'])) {
            echo "Preencha todos os campos.";
            exit;
        }
    
        // Converter para tipo numérico
        $ano = (int)$_POST['ano'];
        $mes = trim($_POST['mes']);
        $agua = (float)$_POST['agua'];
        $luz = (float)$_POST['luz'];
        $doacao = (float)$_POST['doacao'];
        $eventos = (float)$_POST['eventos'];
        $outros_lucro = (float)$_POST['outros_lucro'];
        $outros_despesas = (float)$_POST['outros_despesas'];
    
        // Chamar o método para editar no modelo
        if ($financeiro->editarFinanceiro($ano, $mes, $agua, $luz, $doacao, $eventos, $outros_lucro, $outros_despesas)) {
            // Redirecionar para a página de detalhes financeiros
            header('Location: ../view/financeiro.php?msg=Registro editado com sucesso');
            exit;
        } else {
            // Exibir mensagem de erro com detalhes
            echo "Erro ao editar o financeiro: " . $db->getConexao()->error; // Mostrando o erro específico
            exit;
        }
    }
    
    }
    

// Criar uma instância do controlador e chamar o método de edição
$editar = new EditarFinanceiroController();
$editar->editarFinanceiro();
?>
