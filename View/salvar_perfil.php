<?php
session_start();
require_once("conexao.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id_usuario'];
    $avatar = !empty($_POST['avatar_escolhido']) ? $_POST['avatar_escolhido'] : $_SESSION['foto_perfil'];
    $username = !empty($_POST['username']) ? $_POST['username'] : $_SESSION['nome_usuario'];
    $telefone = $_POST['telefone'];
    $biografia = $_POST['biografia'];
    $curso = $_POST['curso'];
    $sql = "UPDATE usuarios SET foto_perfil = ?, nome = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $avatar, $username, $id_usuario);
    
    if ($stmt->execute()) {
        $_SESSION['foto_perfil'] = $avatar;
        $_SESSION['nome_usuario'] = $username;
        
        echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href='TelaPerfil.php';</script>";
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
    $stmt->close();
}
?>