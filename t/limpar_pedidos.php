<?php
include 'conexao.php';

// Verifica se a variável mesa foi passada corretamente via GET
if (isset($_GET['mesa']) && is_numeric($_GET['mesa'])) {
    $mesa = intval($_GET['mesa']);

    // Preparando a consulta para excluir os pedidos da mesa
    $sql = "DELETE FROM pedidos WHERE mesa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mesa);

    if ($stmt->execute()) {
        // Redireciona de volta para a página de pedidos após limpar
        header("Location: pedidos.php?mesa=$mesa");
        exit;
    } else {
        echo "Erro ao limpar os pedidos!";
    }
    
    $stmt->close();
} else {
    echo "Mesa inválida!";
}

$conn->close();
?>
