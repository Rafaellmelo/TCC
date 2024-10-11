<?php
include_once('../includes/db.php');

class Financeiro {
    private $ano;
    private $mes;
    private $agua;
    private $luz;
    private $doacoes;
    private $eventos;
    private $outros_lucro;
    private $outros_despesas;
    private $saldo;
    private $lucro_total;
    private $despesa_total;

    public function __construct()
    {
        $db = new DataBase();
        $db->conectar();
    }
    public function setarAno($ano) {
        $this->ano = $ano;
    }
    public function getAno() {
        return $this->ano;
    }

    public function setarMes($mes) {
        $this->mes = $mes;
    }

    public function getMes() {
        return $this->mes;
    }

    public function adicionarFinanceiro($ano, $mes, $agua, $luz, $doacao, $eventos, $outros_lucro, $outros_despesas): bool {
        $db = new DataBase();
        $db->conectar();
        $count = 0;
        $this->setarAno($ano);
        $this->setarMes($mes);
        // Verifica se já existe um registro com o mesmo ano e mês
        $stmt = $db->getConexao()->prepare("SELECT COUNT(*) FROM financeiro WHERE ano = ? AND mes = ?");
        $stmt->bind_param("is", $ano, $mes);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        
        // Se o registro já existir, retorna false
        if ($count > 0) {
            return false;
        }
    
        $lucro_total = $doacao + $eventos + $outros_lucro;
        $despesa_total = $agua + $luz + $outros_despesas;
        $saldo = $lucro_total - $despesa_total;
    
        // Prepara a consulta SQL
        $stmt = $db->getConexao()->prepare(
            "INSERT INTO financeiro (ano, mes, agua, luz, doacao, eventos, outros_lucro, outros_despesas, saldo, lucro_total, despesa_total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
    
        // Liga os parâmetros (ano como inteiro, mes como string e os valores decimais)
        $stmt->bind_param("isddddddddd", $ano, $mes, $agua, $luz, $doacao, $eventos, $outros_lucro, $outros_despesas, $saldo, $lucro_total, $despesa_total);
    
        return $stmt->execute();
    }
    
    public function excluirFinanceiro($ano, $mes): bool {
        $db = new DataBase();
        $db->conectar();
    
        // Prepara a consulta SQL
        $stmt = $db->getConexao()->prepare(
            "DELETE FROM financeiro WHERE ano = ? AND mes = ?"
        );
    
        // Liga os parâmetros (ano como inteiro e mes como string)
        $stmt->bind_param("is", $ano, $mes);
    
        // Executa a query
        $stmt->execute();
        return $stmt->get_result();
    }
    
    public function editarFinanceiro($ano, $mes, $agua, $luz, $doacao, $eventos, $outros_lucro, $outros_despesas): bool {
        $db = new DataBase();
        $db->conectar();
        
        // Calcular lucro total e despesa total
        $lucro_total = $doacao + $eventos + $outros_lucro;
        $despesa_total = $agua + $luz + $outros_despesas;
        $saldo = $lucro_total - $despesa_total; // Calcular o saldo
    
        // Executa a consulta SQL em uma única linha
        $stmt = $db->getConexao()->prepare("UPDATE financeiro SET agua = ?, luz = ?, doacao = ?, eventos = ?, outros_lucro = ?, outros_despesas = ?, saldo = ?, lucro_total = ?, despesa_total = ? WHERE ano = ? AND mes = ?");
        
        // Agora todas as variáveis estão calculadas e podem ser passadas por referência
        $stmt->bind_param("dddddddsdis", $agua, $luz, $doacao, $eventos, $outros_lucro, $outros_despesas, $saldo, $lucro_total, $despesa_total, $ano, $mes);
        
        $stmt->execute();
    
        // Verifica se a atualização foi bem-sucedida
        return $stmt->affected_rows > 0;
    }
    
    
    
    }
    
    

?>

