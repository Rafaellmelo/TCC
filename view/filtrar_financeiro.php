<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Finanças</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('../includes/header_financeiro.html'); ?>
    <div class="container mt-5">
        <h2>Filtrar Finanças</h2>
        <form action="../view/resultado_financeiro.php" method="GET" class="mb-4" id="financeiroForm">
            <div class="row mb-3">
                <div class="col">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="number" class="form-control" id="ano" name="ano" placeholder="Digite o ano" min="2000" max="2100" onkeypress="validarNumero(event)">
                </div>
                <div class="col">
                    <label for="mes" class="form-label">Mês</label>
                    <select class="form-select" id="mes" name="mes">
                        <option value="">Selecione</option>
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
            </div>

            <!-- Campo Água -->
            <div class="row mb-3">
                <div class="col">
                    <label for="agua_min" class="form-label">Água (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="agua_min" min="0" name="agua_min" placeholder="Mínimo gasto com água">
                </div>
                <div class="col">
                    <label for="agua_max" class="form-label">Água (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="agua_max" min="0" name="agua_max" placeholder="Máximo gasto com água">
                </div>
            </div>

            <!-- Campo Luz -->
            <div class="row mb-3">
                <div class="col">
                    <label for="luz_min" class="form-label">Luz (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="luz_min" min="0" name="luz_min" placeholder="Mínimo gasto com luz">
                </div>
                <div class="col">
                    <label for="luz_max" class="form-label">Luz (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="luz_max" min="0" name="luz_max" placeholder="Máximo gasto com luz">
                </div>
            </div>

            <!-- Campo Doações -->
            <div class="row mb-3">
                <div class="col">
                    <label for="doacao_min" class="form-label">Doações (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="doacao_min" min="0" name="doacao_min" placeholder="Mínimo arrecadado com doações">
                </div>
                <div class="col">
                    <label for="doacao_max" class="form-label">Doações (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="doacao_max" min="0" name="doacao_max" placeholder="Máximo arrecadado com doações">
                </div>
            </div>

            <!-- Campo Eventos -->
            <div class="row mb-3">
                <div class="col">
                    <label for="eventos_min" class="form-label">Eventos (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="eventos_min" min="0" name="eventos_min" placeholder="Mínimo arrecadado com eventos">
                </div>
                <div class="col">
                    <label for="eventos_max" class="form-label">Eventos (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="eventos_max" min="0" name="eventos_max" placeholder="Máximo arrecadado com eventos">
                </div>
            </div>

            <!-- Campo Outros Lucros -->
            <div class="row mb-3">
                <div class="col">
                    <label for="outros_lucro_min" class="form-label">Outros Lucros (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="outros_lucro_min" min="0" name="outros_lucro_min" placeholder="Mínimo de outros lucros">
                </div>
                <div class="col">
                    <label for="outros_lucro_max" class="form-label">Outros Lucros (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="outros_lucro_max" min="0" name="outros_lucro_max" placeholder="Máximo de outros lucros">
                </div>
            </div>

            <!-- Campo Outras Despesas -->
            <div class="row mb-3">
                <div class="col">
                    <label for="outros_despesas_min" class="form-label">Outras Despesas (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="outros_despesas_min" min="0" name="outros_despesas_min" placeholder="Mínimo de outras despesas">
                </div>
                <div class="col">
                    <label for="outros_despesas_max" class="form-label">Outras Despesas (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="outros_despesas_max" min="0" name="outros_despesas_max" placeholder="Máximo de outras despesas">
                </div>
            </div>

            <!-- Campo Lucro Total -->
            <div class="row mb-3">
                <div class="col">
                    <label for="lucro_total_min" class="form-label">Lucro Total (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="lucro_total_min" min="0" name="lucro_total_min" placeholder="Mínimo lucro total">
                </div>
                <div class="col">
                    <label for="lucro_total_max" class="form-label">Lucro Total (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="lucro_total_max" min="0" name="lucro_total_max" placeholder="Máximo lucro total">
                </div>
            </div>

            <!-- Campo Saldo -->
            <div class="row mb-3">
                <div class="col">
                    <label for="saldo_min" class="form-label">Saldo (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="saldo_min" min="0" name="saldo_min" placeholder="Mínimo saldo">
                </div>
                <div class="col">
                    <label for="saldo_max" class="form-label">Saldo (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="saldo_max" min="0" name="saldo_max" placeholder="Máximo saldo">
                </div>
            </div>

            <!-- Campo Despesas Totais -->
            <div class="row mb-3">
                <div class="col">
                    <label for="despesas_total_min" class="form-label">Despesas Totais (Mín)</label>
                    <input type="number" step="0.01" class="form-control" id="despesas_total_min" min="0" name="despesas_total_min" placeholder="Mínimo despesas totais">
                </div>
                <div class="col">
                    <label for="despesas_total_max" class="form-label">Despesas Totais (Máx)</label>
                    <input type="number" step="0.01" class="form-control" id="despesas_total_max" min="0" name="despesas_total_max" placeholder="Máximo despesas totais">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>

    <script>
        function validarNumero(event) {
            const keyCode = event.keyCode || event.which;
            const isNumber = (keyCode >= 48 && keyCode <= 57) || keyCode === 8 || keyCode === 0;
            if (!isNumber) {
                event.preventDefault();
            }
        }

        function validarMinMax(minId, maxId) {
            const minValue = parseFloat(document.getElementById(minId).value);
            const maxValue = parseFloat(document.getElementById(maxId).value);

            if (minValue !== "" && maxValue !== "" && minValue > maxValue) {
                alert("O valor máximo deve ser maior que o valor mínimo.");
                document.getElementById(maxId).value = ""; // Limpa o campo máximo
            }
        }

        // Adiciona validadores aos campos
        document.getElementById("agua_min").addEventListener("change", () => validarMinMax("agua_min", "agua_max"));
        document.getElementById("agua_max").addEventListener("change", () => validarMinMax("agua_min", "agua_max"));
        document.getElementById("luz_min").addEventListener("change", () => validarMinMax("luz_min", "luz_max"));
        document.getElementById("luz_max").addEventListener("change", () => validarMinMax("luz_min", "luz_max"));
        document.getElementById("doacao_min").addEventListener("change", () => validarMinMax("doacao_min", "doacao_max"));
        document.getElementById("doacao_max").addEventListener("change", () => validarMinMax("doacao_min", "doacao_max"));
        document.getElementById("eventos_min").addEventListener("change", () => validarMinMax("eventos_min", "eventos_max"));
        document.getElementById("eventos_max").addEventListener("change", () => validarMinMax("eventos_min", "eventos_max"));
        document.getElementById("outros_lucro_min").addEventListener("change", () => validarMinMax("outros_lucro_min", "outros_lucro_max"));
        document.getElementById("outros_lucro_max").addEventListener("change", () => validarMinMax("outros_lucro_min", "outros_lucro_max"));
        document.getElementById("outros_despesas_min").addEventListener("change", () => validarMinMax("outros_despesas_min", "outros_despesas_max"));
        document.getElementById("outros_despesas_max").addEventListener("change", () => validarMinMax("outros_despesas_min", "outros_despesas_max"));
        document.getElementById("lucro_total_min").addEventListener("change", () => validarMinMax("lucro_total_min", "lucro_total_max"));
        document.getElementById("lucro_total_max").addEventListener("change", () => validarMinMax("lucro_total_min", "lucro_total_max"));
        document.getElementById("saldo_min").addEventListener("change", () => validarMinMax("saldo_min", "saldo_max"));
        document.getElementById("saldo_max").addEventListener("change", () => validarMinMax("saldo_min", "saldo_max"));
        document.getElementById("despesas_total_min").addEventListener("change", () => validarMinMax("despesas_total_min", "despesas_total_max"));
        document.getElementById("despesas_total_max").addEventListener("change", () => validarMinMax("despesas_total_min", "despesas_total_max"));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
