<?php
session_start(); 

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (file_exists('conexao.php')) {
    require_once('conexao.php');
} else {
    die("ERRO FATAL: O arquivo conexao.php não foi encontrado na pasta View. Caminho atual: " . __DIR__);
}

if (!isset($conn)) {
    die("ERRO: A conexão foi incluída, mas a variável \$conn está vazia ou não existe.");
}

$matricula = $_POST['matricula'];
$senha = $_POST['senha'];


$sql = "SELECT * FROM usuarios WHERE matricula = '$matricula' AND senha = '$senha'";

$resultado = mysqli_query($conn, $sql);

if ($resultado) {

    if (mysqli_num_rows($resultado) > 0) {

        $usuario = mysqli_fetch_assoc($resultado);

        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nome_usuario'] = $usuario['nome'];

        header("Location: TelaPrincipal.html");
        exit();
        
    } else {

        echo "<script>
                alert('Matrícula ou senha incorretos!'); 
                window.location.href='TelaLogin.html';
              </script>";
    }
} else {

    echo "Erro ao consultar o banco: " . mysqli_error($conn);
}

mysqli_close($conn);
?>