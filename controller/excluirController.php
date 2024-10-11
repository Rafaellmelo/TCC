<?php
include_once("../includes/db.php");
include_once("../model/membro.php");

class ExcluirController {
    public function excluirController() {
        $db = new DataBase();
        $db->conectar();

        // Verifique se o ID foi passado na URL
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id']; // Cast para int para segurança
        } else {
            die("ID não encontrado");
        }

        // Verifique se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Tentar excluir o membro
            $membro = new Membros("", "", "", "", "", "", ""); // Cria um objeto vazio
            if ($membro->excluir($id)) {
                // Redireciona para a página de sucesso
                header("Location: ../view/welcome.php?msg=Excluído com sucesso");
                exit();
            } else {
                echo "Erro " . $db->getConexao()->error;
            }
        } else {
            echo "Erro: A operação de exclusão não foi iniciada.";
        }
    }
}

// Instância do controlador e chamada do método
$excluir = new ExcluirController();
$excluir->excluirController();
