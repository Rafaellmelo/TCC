<?php
class DataBase {
    private $host = "localhost";
    private $user = "root";
    private $password = "020271mM#";
    private $db = "tcc";
    private $conn;

    // Método para conectar ao banco de dados com mysqli
    public function conectar() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db);

        // Verificar a conexão
        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    // Método para fechar a conexão
    public function desconectar() {
        if ($this->conn) {
            $this->conn->close(); // Fecha a conexão usando mysqli
            $this->conn = null; // Opcional: define a conexão como null
        }
    }

    // Getter para acessar a conexão
    public function getConexao() {
        return $this->conn;
    }
}
?>
