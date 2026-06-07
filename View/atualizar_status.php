<?php
session_start();
require_once("conexao.php"); 

header('Content-Type: application/json');

if (isset($_POST['id']) && isset($_POST['status']) && isset($_SESSION['id_usuario'])) {
    
    $id_tarefa = (int)$_POST['id'];
    $status = (int)$_POST['status'];
    $id_usuario = $_SESSION['id_usuario'];
    $sql = "UPDATE compromissos SET status = $status WHERE id = $id_tarefa AND id_usuario = $id_usuario";
    
    if (mysqli_query($conn, $sql)) {
        
        $recompensa_desbloqueada = false;

        if ($status == 1) {
            $hoje = date('Y-m-d');
            $query_count = "SELECT COUNT(*) as total FROM compromissos WHERE id_usuario = $id_usuario AND status = 1 AND DATE(data_hora) = '$hoje'";
            $resultado_count = mysqli_query($conn, $query_count);
            $row = mysqli_fetch_assoc($resultado_count);

            if ($row['total'] == 5) {
                $mensagem = "Parabéns! Você completou sua meta diária de 5 tarefas!";
                $query_check = "SELECT id FROM notificacoes WHERE id_usuario = $id_usuario AND mensagem = '$mensagem' AND DATE(data_criacao) = '$hoje'";
                $res_check = mysqli_query($conn, $query_check);
                
                if (mysqli_num_rows($res_check) == 0) {
                    $sql_insere = "INSERT INTO notificacoes (id_usuario, mensagem, lida) VALUES ($id_usuario, '$mensagem', 0)";
                    mysqli_query($conn, $sql_insere);
                    
                    $recompensa_desbloqueada = true;
                }
            }
        }

        echo json_encode(["status" => "sucesso", "recompensa" => $recompensa_desbloqueada]);
        
    } else {
        echo json_encode(["status" => "erro"]);
    }
}
?>