<?php
// Iniciar a sessão
session_start();

include_once('../includes/db.php');

$db = new DataBase();
$db->conectar();

// Verifica a conexão
if (!$db->getConexao()) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Verifica se o formulário foi enviado e salva os dados na sessão
if (!empty($_GET)) {
    $_SESSION['filtros'] = $_GET; // Armazena os filtros na sessão
}

// Usa os filtros da sessão se estiverem definidos
$filtros = isset($_SESSION['filtros']) ? $_SESSION['filtros'] : [];

// Inicializa a consulta básica
$sql = "SELECT * FROM financeiro WHERE 1=1";
$params = [];
$types = "";

// Filtra pelo ano
if (!empty($filtros['ano'])) {
    $sql .= " AND ano = ?";
    $params[] = $filtros['ano'];
    $types .= "s";
}

// Filtra pelo mês
if (!empty($filtros['mes'])) {
    $sql .= " AND mes = ?";
    $params[] = $filtros['mes'];
    $types .= "s";
}

// Filtra pelo valor da água
if (!empty($filtros['agua_min']) || !empty($filtros['agua_max'])) {
    if (!empty($filtros['agua_min'])) {
        $sql .= " AND agua >= ?";
        $params[] = $filtros['agua_min'];
        $types .= "d";
    }
    if (!empty($filtros['agua_max'])) {
        $sql .= " AND agua <= ?";
        $params[] = $filtros['agua_max'];
        $types .= "d";
    }
}

// Filtra pelo valor da luz
if (!empty($filtros['luz_min']) || !empty($filtros['luz_max'])) {
    if (!empty($filtros['luz_min'])) {
        $sql .= " AND luz >= ?";
        $params[] = $filtros['luz_min'];
        $types .= "d";
    }
    if (!empty($filtros['luz_max'])) {
        $sql .= " AND luz <= ?";
        $params[] = $filtros['luz_max'];
        $types .= "d";
    }
}

// (Outros filtros da mesma forma...)

// Prepara a consulta
$stmt = $db->getConexao()->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se há resultados
if ($result && $result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Filtrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Resultados Filtrados</h2>
        <div class="mb-3">
            <a href="../view/adicionar_financeiro.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Adicionar novo registro</a>
            <!-- Botão Gerar PDF -->
            <a href="../model/gerar_pdf_filtrado_financeiro.php?" target="_blank" class="btn btn-danger ms-3"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a>
            <a href="javascript:history.back()" class="btn btn-secondary ms-3"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
        </div>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Ano</th>
                    <th>Mês</th>
                    <th>Lucro Total</th>
                    <th>Despesas Totais</th>
                    <th>Saldo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['ano']; ?></td>
                    <td><?php echo $row['mes']; ?></td>
                    <td><?php echo number_format($row['lucro_total'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['despesa_total'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($row['saldo'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="detalhes_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Ver Detalhes
                        </a>
                        <a href="../view/editar_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="../controller/excluirFinanceiroController.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?');">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    echo '<script>alert("Nenhum resultado encontrado!"); window.location.href="filtrar_financeiro.php";</script>';
}

// Fecha a conexão
$stmt->close();
$db->getConexao()->close();
?>
