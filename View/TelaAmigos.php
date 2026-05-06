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
    <?php
require_once("header.php");
?>

    <main class="main-content">
        <div class="back-link" onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i> Voltar
</div>

        <h2 class="page-title">Encontre o perfil de seus amigos</h2>

        <div class="search-container">
            <div class="search-box">
                <header class="search-header">
                    <i class="fa-solid fa-arrow-left"></i>
                    <input type="text" placeholder="" class="search-input">
                    <i class="fa-solid fa-xmark"></i>
                </header>
                <ul class="results-list">
                    <li class="result-item"></li>
                    <li class="result-item"></li>
                    <li class="result-item"></li>
                </ul>
            </div>
        </div>

        <div class="friend-notification">
            <h3 class="notif-title">Notificação de amizade</h3>
            <p class="notif-text">Gustavo visitou seu perfil.</p>
            <div class="notif-actions">
                <span class="notif-link">Ver perfil</span>
                <span class="notif-link">Ignorar</span>
            </div>
        </div>
    </main>
</body>
</html>