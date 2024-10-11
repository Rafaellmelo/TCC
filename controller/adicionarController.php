<?php
include_once("../includes/db.php");
include("../model/membro.php");

class AdicionarController
{
    public function adicionar()
    {
        // Verifica se o formulário foi enviado
        if (isset($_POST['submit'])) {
            // Coleta os dados do formulário
            $nome = $_POST['nome'];
            $data_nascimento = $_POST['data_nascimento'];
            $numero = $_POST['numero'];
            $batismo = $_POST['batismo'];
            $genero = $_POST['genero'];
            $cargo = $_POST['cargo'];
            $data_batismo = isset($_POST['data_batismo']) ? $_POST['data_batismo'] : null;

            // Exibe os dados recebidos para verificação (apenas para debug, remova isso em produção)
            echo "Dados recebidos:<br>";
            echo "Nome: $nome<br>";
            echo "Data de Nascimento: $data_nascimento<br>";
            echo "Número: $numero<br>";
            echo "Batismo: $batismo<br>";
            echo "Gênero: $genero<br>";
            echo "Cargo: $cargo<br>";
            echo "Data de Batismo: $data_batismo<br>";

            // Validação básica dos campos (pode ser mais elaborada se necessário)
            if (empty($nome) || empty($data_nascimento) || empty($numero) || empty($batismo) || empty($genero) || empty($cargo)) {
                echo "Todos os campos obrigatórios devem ser preenchidos!";
                return;
            }

            // Cria uma instância da classe Membros
            $membros = new Membros($nome, $data_nascimento, $numero, $batismo, $genero, $cargo, $data_batismo);
       
            // Tenta adicionar o membro ao banco de dados
            if ($membros->adicionar()) {
                // Redireciona para a página de sucesso com mensagem
                header("Location: ../includes/lista_membros.php?msg=Adicionado com sucesso");
                exit(); // Impede a execução de código adicional após o redirecionamento
            } else {
                echo "Erro ao adicionar o membro!";
            }
        }
    }
}

// Instancia o controlador e executa o método adicionar
$adicionar = new AdicionarController();
$adicionar->adicionar();
?>
