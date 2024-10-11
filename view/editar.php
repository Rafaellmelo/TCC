<?php
include_once("../includes/db.php");
include_once("../model/membro.php");

$db = new DataBase();
$db->conectar();

// Verificar se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consultar o membro pelo ID para pré-preencher o formulário
    $sql = "SELECT * FROM membros WHERE id = ?";
    $stmt = $db->getConexao()->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $membro = $result->fetch_assoc();
    
    // Verificar se o membro existe
    if (!$membro) {
        echo "Membro não encontrado!";
        exit;
    }
} else {
    echo "ID do membro não fornecido!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Membro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once("../includes/header.html");?>
<div class="container mt-5">
    <h2>Editar Membro</h2>
    <form action="../controller/editarController.php?id=<?php echo $id; ?>" method="POST" onsubmit="return validarCelular()">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $membro['nome']; ?>" required onkeypress="validarTexto(event)">
        </div>

        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $membro['data_nascimento']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="numero" class="form-label">Número de Telefone</label>
            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $membro['numero']; ?>">
        </div>

        <div class="mb-3">
            <label for="batismo" class="form-label">Batismo</label>
            <select class="form-select" id="batismo" name="batismo" required onchange="toggleDataBatismo()">
                <option value="Sim" <?php if($membro['batismo'] == 'Sim') echo 'selected'; ?>>Sim</option>
                <option value="Não" <?php if($membro['batismo'] == 'Não') echo 'selected'; ?>>Não</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="data_batismo" class="form-label">Data do Batismo</label>
            <input type="date" class="form-control" id="data_batismo" name="data_batismo" value="<?php echo $membro['data_batismo']; ?>" <?php if($membro['batismo'] == 'Não') echo 'disabled'; ?>>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Gênero</label>
            <select class="form-select" id="genero" name="genero" required>
                <option value="Homem" <?php if($membro['genero'] == 'Homem') echo 'selected'; ?>>Homem</option>
                <option value="Mulher" <?php if($membro['genero'] == 'Masculino') echo 'selected'; ?>>Mulher</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <select class="form-select" id="cargo" name="cargo" required>
                <option value="Membro" <?php if($membro['cargo'] == 'Membro') echo 'selected'; ?>>Membro</option>
                <option value="Diácono" <?php if($membro['cargo'] == 'Diácono') echo 'selected'; ?>>Diácono</option>
                <option value="Pastor" <?php if($membro['cargo'] == 'Pastor') echo 'selected'; ?>>Pastor</option>
                <option value="Pastora" <?php if($membro['cargo'] == 'Pastora') echo 'selected'; ?>>Pastora</option>
                <option value="Visitante" <?php if($membro['cargo'] == 'Visitante') echo 'selected'; ?>>Visitante</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Atualizar Membro</button>
        <a href="../view/welcome.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

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
    // Função para desabilitar ou habilitar o campo de Data do Batismo
    function toggleDataBatismo() {
        const batismo = document.getElementById('batismo').value;
        const dataBatismo = document.getElementById('data_batismo');
        
        if (batismo === 'Não') {
            dataBatismo.disabled = true;
            dataBatismo.value = '';  // Define valor vazio
        } else {
            dataBatismo.disabled = false;
        }
    }

    // Chama a função ao carregar a página, para garantir que o campo esteja corretamente configurado
    window.onload = function() {
        toggleDataBatismo();
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
