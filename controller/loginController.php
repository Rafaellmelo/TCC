<?php
include_once('../model/login.php');
include_once('../includes/db.php');

class LoginController {
    public function validarLogin() {
        if (isset($_POST['submit'])) {
            // Sanitizar os inputs para evitar XSS
            $user = htmlspecialchars($_POST['user']) ?? '';
            $pass = htmlspecialchars($_POST['pass']) ?? '';
            
            // Instanciar o banco de dados e conectar
            $db = new DataBase();
            $conn = $db->conectar(); // Retorna a conexão para reutilização no login

            // Instanciar o objeto de Login
            $login = new Login($user, $pass);

            // Realizar o login com a conexão fornecida
            if ($login->login($conn)) {
                // Redirecionar para a página de boas-vindas em caso de sucesso
                header("Location: ../view/welcome.php");
                exit(); // Sempre que usar header(), use exit para parar a execução
            } else {
                // Exibir mensagem de erro e redirecionar para a página de login
                echo '<script>
                    alert("Usuário ou senha inválidos");
                    window.location.href="../index.php";
                </script>';
            }
        }
    }
}
$controller = new LoginController();
$controller->validarLogin();
?>
