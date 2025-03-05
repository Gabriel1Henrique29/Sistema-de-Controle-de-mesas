<?php
$conn = new mysqli("localhost", "root", "root", "petiscaria");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

$conn->close();
?>
