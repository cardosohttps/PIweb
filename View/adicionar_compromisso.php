<?php
session_start();
require_once('conexao.php'); 
if (isset($_SESSION['id_usuario']) && isset($_POST['descricao']) && isset($_POST['data_hora'])) {
    
    $id_usuario = $_SESSION['id_usuario'];
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']); 
    $data_hora = $_POST['data_hora'];
    $sql = "INSERT INTO compromissos (id_usuario, descricao, data_hora) VALUES ('$id_usuario', '$descricao', '$data_hora')";
    mysqli_query($conn, $sql);
}


header("Location: TelaPrincipal.php");
exit();
?>