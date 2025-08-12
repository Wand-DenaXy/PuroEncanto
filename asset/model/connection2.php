<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "puroencanto";

// Criar ligação
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar ligação
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>