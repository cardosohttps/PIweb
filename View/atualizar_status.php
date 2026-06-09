<?php
session_start();
require_once("conexao.php");

header('Content-Type: application/json');

if (!isset($_POST['id']) || !isset($_POST['status']) || !isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'recompensa' => false]);
    exit();
}

$id_tarefa = (int)$_POST['id'];
$status = (int)$_POST['status'];
$id_usuario = (int)$_SESSION['id_usuario'];

$count_before = 0;
$count_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM compromissos WHERE id_usuario = $id_usuario AND status = 1"
);
if ($count_result) {
    $count_before = (int)mysqli_fetch_assoc($count_result)['total'];
}

$sql = "UPDATE compromissos SET status = $status WHERE id = $id_tarefa AND id_usuario = $id_usuario";
$sucesso = mysqli_query($conn, $sql);

$count_after = $count_before;
$count_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM compromissos WHERE id_usuario = $id_usuario AND status = 1"
);
if ($count_result) {
    $count_after = (int)mysqli_fetch_assoc($count_result)['total'];
}

$recompensa = $sucesso && $status === 1 && $count_before < 5 && $count_after >= 5;

if ($recompensa) {
    $mensagem = "Parabéns! Você completou 5 tarefas hoje!";
    
    // Verifica se já não existe uma notificação de recompensa para hoje para não duplicar
    $sql_check = "SELECT id FROM notificacoes WHERE id_usuario = ? AND mensagem = ? AND DATE(data_criacao) = CURDATE()";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("is", $id_usuario, $mensagem);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    // Se não existir, insere a nova notificação
    if ($result_check->num_rows === 0) {
        $sql_insert = "INSERT INTO notificacoes (id_usuario, mensagem, lida, data_criacao) VALUES (?, ?, 0, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("is", $id_usuario, $mensagem);
        $stmt_insert->execute();
    }
}

echo json_encode([
    'success' => (bool)$sucesso,
    'totalConcluidos' => $count_after,
    'recompensa' => $recompensa,
]);