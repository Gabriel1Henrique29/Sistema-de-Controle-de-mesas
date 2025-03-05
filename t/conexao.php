<?php
$servername = "localhost";
$username = "root"; // Altere se necessário
$password = "root"; // Altere se necessário
$database = "petiscaria"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
