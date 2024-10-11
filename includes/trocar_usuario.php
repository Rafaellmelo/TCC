<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('../includes/header.html'); ?>
    <div class="container mt-5">
        <h2>Atualizar Usuário</h2>
        <form method="POST" action="../controller/atualizarUserController.php">
            <div class="mb-3">
                <label for="novo_usuario" class="form-label">Novo Nome de Usuário</label>
                <input type="text" class="form-control" id="novo_usuario" name="novo_usuario" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Atualizar Usuário</button>
        </form>
        <a href="../view/welcome.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>