<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        function validarAno(event) {
            const input = event.target;
            // Substitui todos os caracteres que não são dígitos
            input.value = input.value.replace(/\D/g, '');
        }
    </script>
</head>
<body>
    <?php include_once('../includes/header_financeiro.html'); ?>
    
    <div class="container mt-5">
        <h2>Adicionar Dados Financeiros</h2>
        <form action="../controller/adicionarFinanceiroController.php" method="POST">
            <!-- Ano -->
            <div class="mb-3">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" class="form-control" id="ano" name="ano" placeholder="Ex: 2024" required min="2000" max="2100" oninput="validarAno(event)">
            </div>

            <!-- Mês -->
            <div class="mb-3">
                <label for="mes" class="form-label">Mês</label>
                <select class="form-select" id="mes" name="mes" required>
                    <option selected disabled value="">Escolha o mês...</option>
                    <option value="Janeiro">Janeiro</option>
                    <option value="Fevereiro">Fevereiro</option>
                    <option value="Março">Março</option>
                    <option value="Abril">Abril</option>
                    <option value="Maio">Maio</option>
                    <option value="Junho">Junho</option>
                    <option value="Julho">Julho</option>
                    <option value="Agosto">Agosto</option>
                    <option value="Setembro">Setembro</option>
                    <option value="Outubro">Outubro</option>
                    <option value="Novembro">Novembro</option>
                    <option value="Dezembro">Dezembro</option>
                </select>
            </div>

            <!-- Água -->
            <div class="mb-3">
                <label for="agua" class="form-label">Gasto com Água (R$)</label>
                <input type="number" step="0.01" class="form-control" id="agua" name="agua" placeholder="Ex: 100.50" min="0" required>
            </div>

            <!-- Luz -->
            <div class="mb-3">
                <label for="luz" class="form-label">Gasto com Luz (R$)</label>
                <input type="number" step="0.01" class="form-control" id="luz" name="luz" placeholder="Ex: 150.75" min="0" required>
            </div>

            <!-- Doações -->
            <div class="mb-3">
                <label for="doacao" class="form-label">Total de Doações (R$)</label>
                <input type="number" step="0.01" class="form-control" id="doacao" name="doacao" placeholder="Ex: 500.00" min="0" required>
            </div>

            <!-- Eventos -->
            <div class="mb-3">
                <label for="eventos" class="form-label">Lucro de Eventos (R$)</label>
                <input type="number" step="0.01" class="form-control" id="eventos" name="eventos" placeholder="Ex: 300.00" min="0" required>
            </div>

            <!-- Outros Lucros -->
            <div class="mb-3">
                <label for="outros_lucro" class="form-label">Outros Lucros (R$)</label>
                <input type="number" step="0.01" class="form-control" id="outros_lucro" name="outros_lucro" placeholder="Ex: 200.00" min="0" required>
            </div>

            <!-- Outras Despesas -->
            <div class="mb-3">
                <label for="outros_despesas" class="form-label">Outras Despesas (R$)</label>
                <input type="number" step="0.01" class="form-control" id="outros_despesas" name="outros_despesas" placeholder="Ex: 50.00" min="0" required>
            </div>

            <!-- Botão de Envio -->
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="../view/financeiro.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
