<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine Hacker - Encontrar Amigos</title>
    <link rel="stylesheet" href="TelaAmigos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php require_once("header.php"); ?>

    <main class="main-content">
        <div class="back-link" onclick="history.back()" style="cursor: pointer; margin-bottom: 20px;">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </div>

        <h2 class="page-title">Encontre o perfil de seus amigos</h2>

        <div class="search-container">
            <div class="search-box">
                
                <form action="TelaAmigos.php" method="GET" class="search-header" style="display: flex; gap: 10px; width: 100%; margin-bottom: 20px;">
                    <input type="text" name="busca" placeholder="Digite o nome do amigo..." class="search-input" style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc; outline: none;">
                    <button type="submit" style="padding: 10px 20px; background-color: #82c8fa; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.2s;">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                </form>

                <ul class="results-list" style="list-style: none; padding: 0;">
                    <?php
                    if (isset($_GET['busca']) && trim($_GET['busca']) != '') {
                        
                        $termo_busca = mysqli_real_escape_string($conn, trim($_GET['busca']));
                        $id_logado = $_SESSION['id_usuario'];
                        $sql_busca = "SELECT id, nome FROM usuarios WHERE nome LIKE '%$termo_busca%' AND id != $id_logado";
                        $resultado = mysqli_query($conn, $sql_busca);

                        if (mysqli_num_rows($resultado) > 0) {
                            while ($amigo = mysqli_fetch_assoc($resultado)) {
                                echo '<li class="result-item" style="padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">';
                                echo '  <span style="font-weight: bold;"> <i class="fa-solid fa-user" style="color: #ccc; margin-right: 10px;"></i> ' . htmlspecialchars($amigo['nome']) . '</span>';
                                echo '  <a href="perfil_amigo.php?id=' . $amigo['id'] . '" style="padding: 5px 15px; background-color: #f3f4f6; color: #333; text-decoration: none; border-radius: 5px; font-size: 14px;">Ver Perfil</a>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="result-item" style="padding: 15px; text-align: center; color: #666;">Nenhum usuário encontrado com esse nome.</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

        <div class="friend-notification">
            <h3 class="notif-title"><i class="fa-solid fa-bell" style="color: #f59e0b;"></i> Notificação de amizade</h3>
            <div style="background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-top: 10px;">
                <p class="notif-text" style="margin: 0 0 10px 0;"><strong>Gustavo</strong> visitou seu perfil.</p>
                <div class="notif-actions" style="display: flex; gap: 10px;">
                    <a href="#" class="notif-link" style="color: #82c8fa; text-decoration: none; font-weight: bold; font-size: 14px;">Ver perfil</a>
                    <a href="#" class="notif-link" style="color: #ef4444; text-decoration: none; font-weight: bold; font-size: 14px;">Ignorar</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>