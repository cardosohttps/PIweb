<?php
session_start();
require_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_notificacao']) && isset($_SESSION['id_usuario'])) {
    
    $id_notificacao = $_POST['id_notificacao'];
    $id_usuario = $_SESSION['id_usuario'];
    $query = "UPDATE notificacoes SET lida = 1 WHERE id = ? AND id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_notificacao, $id_usuario);
    
    if ($stmt->execute()) {
        header("Location: TelaRecompensas.php");
        exit();
    } else {
        echo "Erro ao atualizar a notificação.";
    }
} else {
    header("Location: TelaPrincipal.php");
    exit();
}
?>