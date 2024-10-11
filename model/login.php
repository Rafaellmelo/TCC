<?php
include_once('../includes/db.php');

class Login {
    private $user;
    private $pass;
    private $result;
    private $row;
    private $count;

    public function __construct($user, $pass) {
        $this->user = $user;
        $this->pass = $pass;
    }

    public function login() {
        $db = new DataBase();
        $db->conectar();

        // Preparar a consulta para evitar injeção de SQL
        $sql = "SELECT * FROM login WHERE username = ?";
        $stmt = $db->getConexao()->prepare($sql);  // Preparar a consulta
        $stmt->bind_param("s", $this->user);  // Vincular o parâmetro de usuário
        $stmt->execute();  // Executar a consulta
        $this->result = $stmt->get_result();  // Obter o resultado

        if ($this->result->num_rows === 1) {
            $this->row = $this->result->fetch_assoc();  // Buscar os dados como array associativo

            // Verificar a senha (considerando que esteja armazenada com hash)
            if ($this->pass === $this->row['password']) {
                return true;  // Login bem-sucedido
            } else {
                return false;  // Senha incorreta
            }
        } else {
            return false;  // Usuário não encontrado
        }

        $stmt->close();  // Fechar a instrução preparada
    }
    public function logout():void {
        session_start();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
}

?>
