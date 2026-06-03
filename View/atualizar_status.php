<?php
session_start();
require_once("conexao.php"); 

if (isset($_POST['id']) && isset($_POST['status']) && isset($_SESSION['id_usuario'])) {
    
    $id_tarefa = (int)$_POST['id'];
    $status = (int)$_POST['status'];
    $id_usuario = $_SESSION['id_usuario'];
    $sql = "UPDATE compromissos SET status = $status WHERE id = $id_tarefa AND id_usuario = $id_usuario";
    
    mysqli_query($conn, $sql);
}
?>