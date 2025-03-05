<?php
$host = "localhost";
$usuario = "root";  // Senha padrão do MAMP: "root"
$senha = "root";    
$banco = "petiscaria";

// Conectar ao banco
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Insere um pedido de teste
$sql = "INSERT INTO pedidos (mesa, item, quantidade, preco, total) VALUES (2, 'Cerveja', 3, 5.00, 15.00)";
if ($conn->query($sql) === TRUE) {
    echo "Pedido adicionado com sucesso!";
} else {
    echo "Erro ao adicionar pedido: " . $conn->error;
}

$conn->close();
?>
