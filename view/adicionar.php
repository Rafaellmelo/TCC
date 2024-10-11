<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Membros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('../includes/header.html'); ?>
    <div class="container">
        <h2>Cadastro de Membros</h2>
        <form action="../controller/adicionarController.php" method="POST" onsubmit="return validarCelular()">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required onkeypress="validarTexto(event)">
            </div>
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Número de Celular</label>
                <input type="tel" class="form-control" id="numero" name="numero" placeholder="(99) 99999-9999" required>
                <div id="mensagem" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="batismo" class="form-label">Batismo</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="batismo" id="batismo_sim" value="Sim" required onclick="toggleDataBatismo(true)">
                    <label class="form-check-label" for="batismo_sim">Sim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="batismo" id="batismo_nao" value="Não" required onclick="toggleDataBatismo(false)">
                    <label class="form-check-label" for="batismo_nao">Não</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="data_batismo" class="form-label">Data de Batismo</label>
                <input type="date" class="form-control" id="data_batismo" name="data_batismo" disabled>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Gênero</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genero" id="genero_homem" value="Homem" required>
                    <label class="form-check-label" for="genero_homem">Homem</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genero" id="genero_mulher" value="Mulher" required>
                    <label class="form-check-label" for="genero_mulher">Mulher</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <select class="form-select" id="cargo" name="cargo">
                    <option value="">Selecione</option>
                    <option value="Membro">Membro</option>
                    <option value="Diácono">Diácono</option>
                    <option value="Pastor">Pastor</option>
                    <option value="Pastora">Pastora</option>
                    <option value="Visitante">Visitante</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
            <a href="../view/welcome.php" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validarCelular() {
            const celular = document.getElementById('numero').value;
            const regexCelular = /^\(\d{2}\) \d{5}-\d{4}$|^\(\d{2}\) \d{4}-\d{4}$/;

            if (!regexCelular.test(celular)) {
                document.getElementById('mensagem').innerText = 'Número de celular inválido! Use o formato (99) 99999-9999 ou (99) 9999-9999.';
                return false; // Impede o envio do formulário
            } else {
                document.getElementById('mensagem').innerText = '';
            }
            return true; // Permite o envio do formulário
        }

        function validarTexto(event) {
            const char = String.fromCharCode(event.keyCode);
            const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ ]$/; // Permitir letras e espaços

            if (!regex.test(char)) {
                event.preventDefault(); // Impede a inserção de caracteres não permitidos
            }
        }

        function toggleDataBatismo(enable) {
            const dataBatismo = document.getElementById('data_batismo');
            dataBatismo.disabled = !enable;  // Habilita ou desabilita o campo de data
        }
    </script>
</body>
</html>
