<?php
// Habilitar exibição de erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluir arquivo de conexão com o banco de dados
include 'conexao.php';

// Verificar se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar os dados do pedido
    $mesa = isset($_POST['mesa']) ? intval($_POST['mesa']) : 0;
    $produto_id = isset($_POST['produto']) ? intval($_POST['produto']) : 0;
    $preco = isset($_POST['preco']) ? floatval($_POST['preco']) : 0.0;
    $item = isset($_POST['item']) ? $_POST['item'] : '';
    $quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;
    $total = isset($_POST['total']) ? floatval($_POST['total']) : 0.0;
    $data_pedido = date('Y-m-d H:i:s'); // Data e hora atual do pedido

    // Validar os dados
    if ($mesa > 0 && $produto_id > 0 && $preco > 0 && !empty($item) && $quantidade > 0) {
        // Inserir o pedido no banco de dados
        $sql = "INSERT INTO pedidos (mesa, produto_id, item, quantidade, preco, total, data_pedido) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind e execução
            $stmt->bind_param("iisddss", $mesa, $produto_id, $item, $quantidade, $preco, $total, $data_pedido);

            if ($stmt->execute()) {
                // Redirecionar para a página de pedidos da mesa com sucesso
                header("Location: pedido.php?mesa=$mesa");
                exit(); // Sempre usar exit após header para garantir que o script pare de executar
            } else {
                // Exibir erro ao tentar inserir
                echo "Erro ao inserir pedido: " . $stmt->error;
            }
        } else {
            // Exibir erro na preparação da consulta
            echo "Erro na preparação da consulta: " . $conn->error;
        }
    } else {
        echo "Dados inválidos.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>
