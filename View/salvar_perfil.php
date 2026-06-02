<?php
session_start();
require_once('conexao.php'); 


if (isset($_SESSION['id_usuario']) && isset($_POST['avatar'])) {
    
    $id_usuario = $_SESSION['id_usuario'];
    $avatar_escolhido = $_POST['avatar']; /

    
    $sql = "UPDATE usuarios SET foto_perfil = '$avatar_escolhido' WHERE id = '$id_usuario'";
    mysqli_query($conn, $sql);

    
    $_SESSION['foto_perfil'] = $avatar_escolhido;
}


header("Location: TelaPrincipal.php");
exit();
?>