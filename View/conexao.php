<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "routine";
$porta = 3307; // porta do MySQL

$conn = mysqli_connect($host, $usuario, $senha, $banco, $porta);

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}
?>