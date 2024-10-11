<?php
session_start(); // Inicie a sessão

// Verifique se há resultados
if (isset($_SESSION['resultados']) && !empty($_SESSION['resultados'])) {
    $resultados = $_SESSION['resultados'];
} else {
    $resultados = []; // Se não houver resultados, inicializa como um array vazio
}

// Função para formatar a data no formato brasileiro
function formatarData($data) {
    if (!empty($data)) {
        $dataFormatada = DateTime::createFromFormat('Y-m-d', $data);
        return $dataFormatada ? $dataFormatada->format('d/m/Y') : '';
    }
    return '';
}

// Função para calcular a idade com base na data de nascimento
function calcularIdade($data_nascimento) {
    if (!empty($data_nascimento)) {
        $data_nascimento = new DateTime($data_nascimento);
        $hoje = new DateTime(); // Data atual
        $idade = $hoje->diff($data_nascimento)->y; // Calcula a diferença em anos
        return $idade;
    }
    return '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Filtragem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include_once('../includes/header.html'); ?>
    <div class="container mt-5">
        <h2>Resultados da Filtragem</h2>
        <div class="mb-3">
            <!-- Botão Adicionar -->
            <a href="../view/adicionar.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> Adicionar novo registro</a>
            
            <!-- Botão Gerar PDF -->
            <a href="../model/gerar_pdf_filtrado.php<?php echo http_build_query($_GET); ?>" target="_blank" class="btn btn-danger ms-3"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a>

            <!-- Botão Voltar -->
            <a href="javascript:history.back()" class="btn btn-secondary ms-3"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
        </div>

        <?php if (empty($resultados)): ?>
            <p>Nenhum membro encontrado com os critérios informados.</p>
        <?php else: ?>
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>Idade</th>
                        <th>Número</th>
                        <th>Batismo</th>
                        <th>Gênero</th>
                        <th>Cargo</th>
                        <th>Data do Batismo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $membro): ?>
                        <tr>
                            <td><?= htmlspecialchars($membro['nome']) ?></td>
                            <td><?= htmlspecialchars(formatarData($membro['data_nascimento'])) ?></td>
                            <td><?= htmlspecialchars(calcularIdade($membro['data_nascimento'])) ?></td>
                            <td><?= htmlspecialchars($membro['numero']) ?></td>
                            <td><?= htmlspecialchars($membro['batismo']) ?></td>
                            <td><?= htmlspecialchars($membro['genero']) ?></td>
                            <td><?= htmlspecialchars($membro['cargo']) ?></td>
                            <td><?= htmlspecialchars(formatarData($membro['data_batismo'])) ?></td>
                            <td>
                                <!-- Link para editar -->
                                <a href="../view/editar.php?id=<?= $membro['id'] ?>" class="link-dark">
                                    <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                </a>

                                <!-- Botão para excluir -->
                                <form action="../controller/excluirController.php?id=<?= $membro['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Você tem certeza que deseja excluir este membro?');">
                                    <button type="submit" name="submit" class="btn btn-link link-dark" style="padding: 0;">
                                        <i class="fa-solid fa-trash fs-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
