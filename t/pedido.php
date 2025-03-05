<?php
include 'conexao.php';
$mesa = isset($_GET['mesa']) ? intval($_GET['mesa']) : 1;

// Busca os produtos para preencher o select
$sqlProdutos = "SELECT id, nome, preco FROM produtos";
$resultProdutos = $conn->query($sqlProdutos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido - Mesa <?= $mesa ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Atualiza o valor do campo 'item' com o nome do produto selecionado
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('produto').addEventListener('change', function() {
                var produtoSelecionado = this.options[this.selectedIndex];
                var nomeProduto = produtoSelecionado.getAttribute('data-nome');
                var precoProduto = produtoSelecionado.getAttribute('data-preco');
                document.getElementById('item').value = nomeProduto;
                document.getElementById('preco').value = precoProduto;
                calcularTotal();
            });

            // Atualiza o total quando a quantidade for alterada
            document.getElementById('quantidade').addEventListener('input', function() {
                calcularTotal();
            });

            // Função para calcular o total
            function calcularTotal() {
                var preco = parseFloat(document.getElementById('preco').value);
                var quantidade = parseInt(document.getElementById('quantidade').value);
                var total = preco * quantidade;
                document.getElementById('total').value = total.toFixed(2);
            }
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <a href="mesa.php" class="btn btn-primary mb-3">Voltar</a>
        <h1 class="text-center mb-4">Adicionar Pedido - Mesa <?= $mesa ?></h1>

        <form id="pedido-form" method="POST" action="processar_pedido.php">
            <input type="hidden" name="mesa" value="<?= $mesa ?>">

            <div class="mb-3">
                <label for="produto" class="form-label">Produto:</label>
                <select id="produto" name="produto" class="form-select" required>
                    <option value="">Selecione um produto</option>
                    <?php while ($produto = $resultProdutos->fetch_assoc()) { ?>
                        <option value="<?= $produto['id'] ?>" data-preco="<?= $produto['preco'] ?>" data-nome="<?= $produto['nome'] ?>">
                            <?= htmlspecialchars($produto['nome']) ?> - R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" value="1" min="1" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço Unitário (R$):</label>
                <input type="text" id="preco" name="preco" class="form-control" readonly>
            </div>

            <!-- Campo oculto para armazenar o nome do produto (item) -->
            <input type="hidden" id="item" name="item">

            <div class="mb-3">
                <label for="total" class="form-label">Total (R$):</label>
                <input type="text" id="total" name="total" class="form-control" readonly>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Adicionar Item</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
