<?php
include_once("../includes/db.php");
include_once("../model/membro.php");

class EditarController {
    public function editarController() {
        $db = new DataBase();
        $db->conectar();

        // Verifique se o ID foi passado na URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            die("ID não encontrado.");
        }

        // Verifique se o formulário foi submetido
        if (isset($_POST['submit'])) {
            // Coleta de dados do formulário
            $nome = $_POST['nome'];
            $data_nascimento = $_POST['data_nascimento'];
            $numero = $_POST['numero'];
            $batismo = $_POST['batismo'];
            $genero = $_POST['genero'];
            $cargo = $_POST['cargo'];
            $data_batismo = $_POST['data_batismo'];

            // Criação do objeto Membros
            $membro = new Membros($nome, $data_nascimento, $numero, $batismo, $genero, $cargo, $data_batismo);

            // Tentativa de edição
            if ($membro->editar($id)) {
                // Redireciona para a página de sucesso com uma mensagem
                header("Location: ../view/welcome.php?msg=Editado com sucesso");
                exit(); // Importante para evitar que o script continue executando
            } else {
                echo "Erro ao editar o membro.";
            }
        }
    }
}

// Instância do controlador e chamada do método
$editarController = new EditarController();
$editarController->editarController();
