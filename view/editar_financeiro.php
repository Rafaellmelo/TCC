<?php
include("../includes/db.php");
$db = new DataBase();
$db->conectar();

// Obter ano e mês da URL
$ano = isset($_GET['ano']) ? intval($_GET['ano']) : 0;
$mes = isset($_GET['mes']) ? $_GET['mes'] : '';

// Consultar o registro existente
$sql = "SELECT * FROM financeiro WHERE ano = ? AND mes = ?";
$stmt = $db->getConexao()->prepare($sql);
$stmt->bind_param('is', $ano, $mes);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se o registro existe
if ($result->num_rows == 0) {
    header("Location: financeiro.php?msg=Registro não encontrado!");
    exit;
}

$registro = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include_once('../includes/header_financeiro.html'); ?>
<div class="container">
    <h2 class="mt-5">Editar Registro Financeiro</h2>
    <form action="../controller/editarFinanceiroController.php" method="post">
    <input type="hidden" name="ano" value="<?php echo htmlspecialchars($registro['ano']); ?>">
    <input type="hidden" name="mes" value="<?php echo htmlspecialchars($registro['mes']); ?>">

        <div class="mb-3">
            <label for="agua" class="form-label">Água:</label>
            <input type="number" step="0.01" class="form-control" name="agua" min="0" value="<?php echo htmlspecialchars($registro['agua']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="luz" class="form-label">Luz:</label>
            <input type="number" step="0.01" class="form-control" name="luz" min="0" value="<?php echo htmlspecialchars($registro['luz']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="doacao" class="form-label">Doação:</label>
            <input type="number" step="0.01" class="form-control" name="doacao" min="0" value="<?php echo htmlspecialchars($registro['doacao']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="eventos" class="form-label">Eventos:</label>
            <input type="number" step="0.01" class="form-control" name="eventos" min="0" value="<?php echo htmlspecialchars($registro['eventos']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="outros_lucro" class="form-label">Outros (Lucro):</label>
            <input type="number" step="0.01" class="form-control" name="outros_lucro" min="0" value="<?php echo htmlspecialchars($registro['outros_lucro']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="outros_despesas" class="form-label">Outros (Despesas):</label>
            <input type="number" step="0.01" class="form-control" name="outros_despesas" min="0" value="<?php echo htmlspecialchars($registro['outros_despesas']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="../view/financeiro.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
