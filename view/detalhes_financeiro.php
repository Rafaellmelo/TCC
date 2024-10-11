<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include_once('../includes/header_financeiro.html'); ?>
    <div class="container">
    <h1 class="mt-4">Detalhes Financeiros</h1>
    
    <?php
    include_once('../includes/db.php');
    $db = new DataBase();
    $db->conectar();

    // Obter ano e mês da URL
    $ano = isset($_GET['ano']) ? intval($_GET['ano']) : 0;
    $mes = isset($_GET['mes']) ? htmlspecialchars($_GET['mes']) : '';

    // Consultar os detalhes do registro
    $sql = "SELECT * FROM financeiro WHERE ano = ? AND mes = ?";
    $stmt = $db->getConexao()->prepare($sql);
    $stmt->bind_param('is', $ano, $mes);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0):
        $row = $result->fetch_assoc();
    ?>
        <a href="../model/gerar_pdf_detalhes_financeiro.php?ano=<?php echo $ano; ?>&mes=<?php echo $mes; ?>" class="btn btn-secondary mb-3">
            <i class="fa-solid fa-file-pdf"></i> Gerar PDF Detalhes
        </a>
        <table class="table table-striped">
            <tr>
                <th>Ano</th>
                <td><?php echo htmlspecialchars($row['ano']); ?></td>
            </tr>
            <tr>
                <th>Mês</th>
                <td><?php echo htmlspecialchars($row['mes']); ?></td>
            </tr>
            <tr>
                <th>Água</th>
                <td><?php echo number_format($row['agua'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Luz</th>
                <td><?php echo number_format($row['luz'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Doação</th>
                <td><?php echo number_format($row['doacao'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Eventos</th>
                <td><?php echo number_format($row['eventos'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Outros(Lucro)</th>
                <td><?php echo number_format($row['outros_lucro'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Outros(Despesas)</th>
                <td><?php echo number_format($row['outros_despesas'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Lucro Total</th>
                <td><?php echo number_format($row['lucro_total'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Despesas Totais</th>
                <td><?php echo number_format($row['despesa_total'], 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Saldo</th>
                <td><?php echo number_format($row['saldo'], 2, ',', '.'); ?></td>
            </tr>
            <!-- Adicione mais campos conforme necessário -->
        </table>
        
        <a href="../view/editar_financeiro.php?ano=<?php echo htmlspecialchars($row['ano']); ?>&mes=<?php echo htmlspecialchars($row['mes']); ?>" class="btn btn-warning">Editar</a>
        <a href="financeiro.php" class="btn btn-secondary">Voltar</a> <!-- Botão de voltar -->
        
    <?php else: ?>
        <div class="alert alert-warning">Nenhum registro encontrado para o ano <?php echo htmlspecialchars($ano); ?> e mês <?php echo htmlspecialchars($mes); ?>.</div>
        <a href="financeiro.php" class="btn btn-secondary">Voltar</a> <!-- Botão de voltar caso não haja registros -->
    <?php endif; ?>
</div>
</body>
</html>