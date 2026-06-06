<?php
session_start();
require_once("conexao.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id_usuario'];
    if (!empty($_POST['avatar_escolhido'])) {
        $avatar = $_POST['avatar_escolhido']; 
    } else {
        $avatar = $_SESSION['foto_perfil'] ?? 'default.png'; 
    }
    $username = !empty($_POST['username']) ? $_POST['username'] : $_SESSION['nome_usuario'];
    $telefone = $_POST['telefone'];
    $biografia = $_POST['biografia'];
    $curso = $_POST['curso'];
    $sql = "UPDATE usuarios SET foto_perfil = ?, nome = ?, telefone = ?, biografia = ?, curso = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $avatar, $username, $telefone, $biografia, $curso, $id_usuario);
    
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