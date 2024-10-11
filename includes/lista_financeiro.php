<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Financeiro</title>
</head>
<body>
    <div class="container">
        <?php
        include_once('../includes/db.php');

        $db = new DataBase();
        $db->conectar();

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . htmlspecialchars($msg) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        // Consultar os dados da tabela financeiro
        $sql = "SELECT * FROM financeiro ORDER BY ano DESC, mes DESC";
        $result = $db->getConexao()->query($sql);
        ?>
        <a href="../view/adicionar_financeiro.php" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Novo registro financeiro</a>
        <a href="../model/gerar_pdf_financeiro.php" class="btn btn-primary mb-3"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a>
        <a href="../view/filtrar_financeiro.php" class="btn btn-warning mb-3"><i class="fa-solid fa-filter"></i> Filtrar</a>
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
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ano']; ?></td>
                        <td><?php echo $row['mes']; ?></td>
                        <td><?php echo number_format($row['lucro_total'], 2, ',', '.'); ?></td>
                        <td><?php echo number_format($row['despesa_total'], 2, ',', '.'); ?></td>
                        <td><?php echo number_format($row['saldo'], 2, ',', '.'); ?></td>
                        <td>
                        <a href="../view/detalhes_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i> Ver Detalhes</a>
                            <a href="../view/editar_financeiro.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Editar</a>
                            <a href="../controller/excluirFinanceiroController.php?ano=<?php echo $row['ano']; ?>&mes=<?php echo $row['mes']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este registro?');"><i class="fa-solid fa-trash"></i> Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
    <!-- Adicione o script do Bootstrap JS aqui -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
