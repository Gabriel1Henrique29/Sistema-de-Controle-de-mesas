<?php
include 'conexao.php';

// Obtém o número da mesa
$mesa = isset($_GET['mesa']) ? intval($_GET['mesa']) : 0;

// Verifica se a mesa é válida
if ($mesa == 0) {
    die("Erro: Mesa não especificada!");
}

// Processa a exclusão dos pedidos quando o botão de limpar é pressionado
if (isset($_POST['limpar'])) {
    $sqlLimpar = "DELETE FROM pedidos WHERE mesa = ?";
    $stmtLimpar = $conn->prepare($sqlLimpar);
    $stmtLimpar->bind_param("i", $mesa);
    if ($stmtLimpar->execute()) {
        echo "<p>Pedidos apagados com sucesso.</p>";
    } else {
        echo "<p>Erro ao apagar os pedidos.</p>";
    }
}

// Consulta os pedidos da mesa
$sqlPedidos = "SELECT pd.id, pr.nome AS item, pd.quantidade, pd.preco, pd.total 
               FROM pedidos pd 
               JOIN produtos pr ON pd.produto_id = pr.id
               WHERE pd.mesa = ?";
$stmtPedidos = $conn->prepare($sqlPedidos);
$stmtPedidos->bind_param("i", $mesa);
$stmtPedidos->execute();
$resultPedidos = $stmtPedidos->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Mesa <?= $mesa ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Pedidos da Mesa <?= $mesa ?></h1>

        <?php if ($resultPedidos->num_rows > 0) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalMesa = 0;
                    while ($row = $resultPedidos->fetch_assoc()) { 
                        $totalMesa += $row['total'];
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['item']) ?></td>
                        <td><?= $row['quantidade'] ?></td>
                        <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($row['total'], 2, ',', '.') ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h3>Total da Mesa: R$ <?= number_format($totalMesa, 2, ',', '.') ?></h3>
        <?php } else { ?>
            <p>Nenhum pedido para esta mesa.</p>
        <?php } ?>

        <form method="POST" action="">
            <button type="submit" name="limpar" class="btn btn-danger">Limpar Pedidos</button>
        </form>
        
        <a href="mesa.php" class="btn btn-primary mt-3">Voltar</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
