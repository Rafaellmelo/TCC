<?php
include_once('../model/financeiro.php');
include_once('../includes/db.php');

class excluirFinanceiroController{
    public function excluirFinanceiro(){
        $db = new DataBase();
        $db->conectar();
        if(isset($_GET['ano']) && isset($_GET['mes'])){
            $ano = intval($_GET['ano']);
            $mes = $_GET['mes'];
            $financeiro = new Financeiro();
            $financeiro->excluirFinanceiro($ano, $mes);
            header("Location: ../view/financeiro.php?msg=Registro excluído com sucesso");
        }
    }
}
$excluir = new excluirFinanceiroController();
$excluir->excluirFinanceiro();