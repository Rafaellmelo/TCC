
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h1 class="text-center mb-4">Login</h1>
            <form action="controller/loginController.php" method="post" name="form">
                <!-- Campo Usuário -->
                <div class="mb-3">
                    <label for="user" class="form-label">Usuário:</label>
                    <input type="text" id="user" name="user" class="form-control" placeholder="Digite seu usuário" required>
                </div>

                <!-- Campo Senha -->
                <div class="mb-3">
                    <label for="pass" class="form-label">Senha:</label>
                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Digite sua senha" required>
                </div>

                <!-- Botão de Enviar -->
                <div class="d-grid">
                    <button type="submit" id="btn" class="btn btn-primary" name="submit">Entrar</button>
                </div>
            </form>
        </div>
    </div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>