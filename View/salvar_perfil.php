<?php
session_start();
require_once('conexao.php'); 

if (!isset($_SESSION['id_usuario'])) {
    header("Location: TelaLogin.html");
    exit();
}
if (!isset($conn)) {
    die("conexão incluída mas a variável \$conn está vazia ou não existe");
}

$id_usuario = $_SESSION['id_usuario'];
$avatar_escolhido = $_POST['avatar']; 
$telefone = $_POST['telefone'];
$username = $_POST['username'];
$compromissos = $_POST['compromissos'];
$biografia = $_POST['biografia'];
$curso = $_POST['curso'];

$sql = "UPDATE usuarios SET 
        foto_perfil = '$avatar_escolhido' 
        WHERE id = '$id_usuario'";
 $resultado = mysqli_query($conn, $sql);       

if ($resultado) {
    
    $_SESSION['foto_perfil'] = $avatar_escolhido;
    
    echo "<script>
            alert('Perfil atualizado com sucesso!');
            window.location.href='TelaPrincipal.php';
          </script>";
} else {
    echo "Erro ao atualizar: " . mysqli_error($conn);
}
?>