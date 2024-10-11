<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Membros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('../includes/header.html'); ?>
    <div class="container mt-5">
        <h2>Filtrar Membros</h2>
        <form action="../controller/filtrarController.php" method="GET" class="mb-4" id="filterForm">
            <div class="row mb-3">
                <div class="col">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" onkeypress="validarTexto(event)">
                </div>
                <div class="col">
                    <label for="genero" class="form-label">Gênero</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="">Selecione</option>
                        <option value="Homem">Homem</option>
                        <option value="Mulher">Mulher</option>
                    </select>
                </div>
                <div class="col">
                    <label for="idade_min" class="form-label">Idade Mínima</label>
                    <input type="number" class="form-control" id="idade_min" name="idade_min" placeholder="Idade mínima" onkeypress="validarNumero(event)" min="0">
                </div>
                <div class="col">
                    <label for="idade_max" class="form-label">Idade Máxima</label>
                    <input type="number" class="form-control" id="idade_max" name="idade_max" placeholder="Idade máxima" onkeypress="validarNumero(event)" min="0">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Digite o número">
                </div>
                <div class="col">
                    <label for="batismo" class="form-label">Batismo</label>
                    <select class="form-select" id="batismo" name="batismo">
                        <option value="">Selecione</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
                <div class="col">
                    <label for="data_batismo" class="form-label">Data do Batismo</label>
                    <input type="date" class="form-control" id="data_batismo" name="data_batismo">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" id="cargo" name="cargo">
                        <option value="">Selecione</option>
                        <option value="Pastor">Pastor</option>
                        <option value="Pastora">Pastora</option>
                        <option value="Diácono">Diácono</option>
                        <option value="Membro">Membro</option>
                        <option value="Visitante">Visitante</option>
                    </select>
                </div>
                <div class="col">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Filtrar</button>
            <a href="../view/welcome.php" class="btn btn-secondary ms-2">Voltar</a>
        </form>
    </div>
    
    <script>
        // Validação de caracteres no campo "Nome"
        function validarTexto(event) {
            const char = String.fromCharCode(event.keyCode);
            const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ ]$/; // Permitir letras e espaços

            if (!regex.test(char)) {
                event.preventDefault(); // Impede a inserção de caracteres não permitidos
            }
        }

        // Validação para permitir apenas números nos campos de "Idade Mínima" e "Idade Máxima"
        function validarNumero(event) {
            const char = String.fromCharCode(event.keyCode);
            const regex = /^[0-9]$/; // Permitir apenas números

            if (!regex.test(char)) {
                event.preventDefault(); // Impede a inserção de caracteres não numéricos
            }
        }

        // Validação de idade mínima e máxima
        document.getElementById('filterForm').addEventListener('submit', function(event) {
            const idadeMin = document.getElementById('idade_min').value;
            const idadeMax = document.getElementById('idade_max').value;

            if (idadeMin && idadeMax) {
                if (Number(idadeMin) > Number(idadeMax)) {
                    event.preventDefault(); // Impede o envio do formulário
                    alert('A idade mínima não pode ser maior que a idade máxima.');
                } else if (Number(idadeMin) === Number(idadeMax)) {
                    event.preventDefault(); // Impede o envio do formulário
                    alert('A idade mínima não pode ser igual à idade máxima.');
                }
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
