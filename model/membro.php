<?php
include_once("../includes/db.php");

class Membros {
    private $nome;
    private $data_nascimento;
    private $numero;
    private $batismo;
    private $genero;
    private $cargo;
    private $data_batismo;
    private $db; // Para armazenar a conexão com o banco de dados

    // Getters
    public function getNome() {
        return $this->nome;
    }

    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBatismo() {
        return $this->batismo;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getDataBatismo() {
        return $this->data_batismo;
    }
   

    public function __construct($nome, $data_nascimento, $numero, $batismo, $genero, $cargo, $data_batismo) {
        $this->nome = $nome;
        $this->data_nascimento = $data_nascimento;
        $this->numero = $numero;
        $this->batismo = $batismo;
        $this->genero = $genero;
        $this->cargo = $cargo;
        $this->data_batismo = $data_batismo;

        // Conectar ao banco de dados uma única vez
        $this->db = new DataBase();
        $this->db->conectar();
    }

    public function adicionar(): bool {
        // Preparar a consulta SQL para inserir os dados
        $stmt = $this->db->getConexao()->prepare("INSERT INTO membros (nome, data_nascimento, numero, batismo, data_batismo, genero, cargo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Verificar se a preparação da consulta falhou
        if (!$stmt) {
            echo "Erro ao preparar a consulta: " . $this->db->getConexao()->error;
            return false;
        }

        // Fazer o bind dos parâmetros
        $stmt->bind_param("sssssss", $this->nome, $this->data_nascimento, $this->numero, $this->batismo, $this->data_batismo, $this->genero, $this->cargo);

        // Tentar executar a consulta e verificar o resultado
        if ($stmt->execute()) {
            return true; // Sucesso
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error; // Mostrar erro
            return false; // Falha
        }
    }

    public function editar($id): bool {
        $stmt = $this->db->getConexao()->prepare("UPDATE membros SET nome = ?, data_nascimento = ?, numero = ?, batismo = ?, data_batismo = ?, genero = ?, cargo = ? WHERE id = ?");
        
        if (!$stmt) {
            echo "Erro ao preparar a consulta: " . $this->db->getConexao()->error;
            return false;
        }

        // Fazer o bind dos parâmetros, incluindo data_batismo e cargo
        $stmt->bind_param("sssssssi", $this->nome, $this->data_nascimento, $this->numero, $this->batismo, $this->data_batismo, $this->genero, $this->cargo, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Sucesso
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error;
            $stmt->close();
            return false; // Falha
        }
    }

    public function excluir($id): bool {
        $stmt = $this->db->getConexao()->prepare("DELETE FROM membros WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function filtrar($nome, $genero, $idade_min, $idade_max, $numero, $batismo, $data_batismo, $cargo, $data_nascimento): array {
        $filters = [];
        $params = [];
    
        // Montando a query inicial
        $query = "SELECT * FROM membros WHERE 1=1";
    
        if (!empty($nome)) {
            $filters[] = "nome LIKE ?";
            $params[] = "%" . $nome . "%";
        }
    
        if (!empty($genero)) {
            $filters[] = "genero = ?";
            $params[] = $genero;
        }
    
        if (!empty($idade_min) || !empty($idade_max)) {
            $hoje = new DateTime(); 
    
            if (!empty($idade_min)) {
                $data_nasc_minima = $hoje->sub(new DateInterval('P' . $idade_min . 'Y'))->format('Y-m-d');
                $filters[] = "data_nascimento <= ?";
                $params[] = $data_nasc_minima;
            }
    
            $hoje = new DateTime(); // Reseta a data
    
            if (!empty($idade_max)) {
                $data_nasc_maxima = $hoje->sub(new DateInterval('P' . $idade_max . 'Y'))->format('Y-m-d');
                $filters[] = "data_nascimento >= ?";
                $params[] = $data_nasc_maxima;
            }
        }
    
        if (!empty($numero)) {
            $filters[] = "numero LIKE ?";
            $params[] = "%" . $numero . "%";
        }
    
        if (!empty($batismo)) {
            $filters[] = "batismo = ?";
            $params[] = $batismo;
        }
    
        if (!empty($data_batismo)) {
            $filters[] = "data_batismo = ?";
            $params[] = $data_batismo;
        }
    
        if (!empty($cargo)) {
            $filters[] = "cargo = ?";
            $params[] = $cargo;
        }
    
        if (!empty($data_nascimento)) {
            $filters[] = "data_nascimento = ?";
            $params[] = $data_nascimento;
        }
    
        // Se houver filtros, os adiciona na query
        if (count($filters) > 0) {
            $query .= " AND " . implode(" AND ", $filters);
        }
    
        // Prepara a consulta SQL
        $stmt = $this->db->getConexao()->prepare($query);
    
        if (!$stmt) {
            echo "Erro ao preparar a consulta: " . $this->db->getConexao()->error;
            return [];
        }
    
        // Bind dos parâmetros
        if (count($params) > 0) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
    
        if (!$stmt->execute()) {
            echo "Erro ao executar a consulta: " . $stmt->error;
            return [];
        }
    
        $result = $stmt->get_result();
        $dados = $result->fetch_all(MYSQLI_ASSOC);
    
        return $dados;
    }
    public function atualizarUser($novo_usuario): bool {
        $db = new DataBase();
        $db->conectar();
        $sql = "UPDATE login SET username = ?";
        $stmt = $db->getConexao()->prepare($sql);
        $stmt->bind_param('s', $novo_usuario);
        return $stmt->execute();
    }
    public function trocarSenha($_nova_senha):bool {
        $db = new DataBase();
        $db->conectar();
        $sql = "UPDATE login SET password = ?";
        $stmt = $db->getConexao()->prepare($sql);
        $stmt->bind_param('s', $_nova_senha);
        return $stmt->execute();
    }
    
}
?>
