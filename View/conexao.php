<?php
$host = "localhost";
$usuario = "root";
$senha = ""; 
$banco = "routine"; 

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("erro de conexao: " . mysqli_connect_error());
}
?>