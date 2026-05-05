<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (file_exists('conexao.php')) {
    require_once('conexao.php');
    echo "";
} else {
    die("O arquivo conexao.php deu erro Caminho atual: " . __DIR__);
}


if (!isset($conn)) {
    die("conexão incluída mas a variável \$conn está vazia ou não existe");
}


require_once('conexao.php');


$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$senha = $_POST['senha'];


$sql = "INSERT INTO usuarios (nome, matricula, senha) VALUES ('$nome', '$matricula', '$senha')";


if (mysqli_query($conn, $sql)) {
    
    header("Location: TelaLogin.html");
    exit();
} else {
  
    echo "Erro ao cadastrar: " . mysqli_error($conn);
}


mysqli_close($conn);
?>