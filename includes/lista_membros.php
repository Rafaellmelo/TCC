<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($msg) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <a href="../view/adicionar.php" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Adicionar novo registro</a>
    <a href="../model/gerar_pdf.php" class="btn btn-primary mb-3"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a>
    <a href="../view/filtrar.php" class="btn btn-warning mb-3"><i class="fa-solid fa-filter"></i> Filtrar</a>
    <table class="table table-hover text-center">
    <thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>Idade</th>
        <th>Número</th>
        <th>Batismo</th>
        <th>Data do Batismo</th>
        <th>Gênero</th>
        <th>Cargo</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
        <?php
        include('../includes/db.php');
        $db = new DataBase();
        $db->conectar();
        $sql = "SELECT * FROM membros";
        $result = mysqli_query($db->getConexao(), $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td>
                <?php
                // Convertendo a data de nascimento para o formato brasileiro (DD/MM/YYYY)
                $data_nascimento = new DateTime($row['data_nascimento']);
                echo $data_nascimento->format('d/m/Y'); // Exibe a data no formato brasileiro
                ?>
            </td>
            <?php
                $date = new DateTime($row['data_nascimento']);
                $now = new DateTime();
                $interval = $now->diff($date);
                $idade = $interval->format('%y');
                ?>
            <td><?= $idade ?></td>
            <td><?= $row['numero'] ?></td>
            <td><?= $row['batismo'] ?></td>
            <td>
                <?php
                // Convertendo a data de batismo para o formato brasileiro (DD/MM/YYYY)
                $data_batismo = new DateTime($row['data_batismo']);
                echo $data_batismo->format('d/m/Y'); // Exibe a data no formato brasileiro
                ?>
            </td>
            <td><?= $row['genero'] ?></td>
            <td><?= $row['cargo'] ?></td>
            <td>
            <a href="../view/editar.php?id=<?= $row['id'] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                
                <form action="../controller/excluirController.php?id=<?= $row['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Você tem certeza que deseja excluir este membro?');">
                    <button type="submit" name="submit" class="btn btn-link link-dark" style="padding: 0;">
                        <i class="fa-solid fa-trash fs-5"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>