<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine Hacker - Personalize o seu perfil</title>
    <link rel="stylesheet" href="TelaPerfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
require_once("header.php");
$nome = $_SESSION['nome_usuario'];
$matricula = $_SESSION['matricula'];

?>

    <main class="main-content">
        <div class="back-link" onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i> Voltar
</div>

        <h2 class="page-title">Personalize o seu perfil</h2>

        <div class="profile-container">
            <div class="left-column">
                <div class="current-user-info">
                    <div class="avatar-wrapper">
                        <div class="main-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="edit-icon">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?php echo $nome;?></span>
                        <span class="user-matricula"><?php echo $matricula;?></span>
                    </div>
                </div>

                <hr class="divider">

                <div class="avatar-selection-grid">
                    <img src="1.png" alt="Avatar 1" class="avatar-option" onclick="selecionarAvatar(this, '1.png')">
                    <img src="20.png" alt="Avatar 2" class="avatar-option" onclick="selecionarAvatar(this, '20.png')">
                    <img src="18.png" alt="Avatar 3" class="avatar-option" onclick="selecionarAvatar(this, '18.png')">
                    <img src="26.png" alt="Avatar 4" class="avatar-option" onclick="selecionarAvatar(this, '26.png')">
                    <img src="3.png" alt="Avatar 5" class="avatar-option" onclick="selecionarAvatar(this, '3.png')">
                    <img src="13.png" alt="Avatar 6" class="avatar-option" onclick="selecionarAvatar(this, '13.png')">
                </div>

                <hr class="divider">
            </div>

            <div class="right-column">
        <form class="profile-form" action="salvar_perfil.php" method="POST">
        <input type="hidden" name="avatar_escolhido" id="input_avatar" value="">
        
        <div class="input-group">
            <input type="text" id="username" name="username" placeholder="Username:">
        </div>
        <div class="input-group">
            <input type="text" id="telefone" name="telefone" placeholder="Telefone:">
        </div>
        <div class="input-group">
            <input type="text" id="compromissos" name="compromissos" placeholder="Compromissos:">
        </div>
        <div class="input-group">
            <input type="text" id="biografia" name="biografia" placeholder="Biografia:">
        </div>
        <div class="input-group">
            <input type="text" id="curso" name="curso" placeholder="Curso:">
        </div>
                    

        <div class="action-container">
            <button type="submit" class="action-btn">Salvar</button>
        </div>
    </main>
    <script>
    function selecionarAvatar(elementoImg, nomeArquivo) {

        let avatares = document.querySelectorAll('.avatar-option');
        avatares.forEach(av => av.style.border = "none"); 
        elementoImg.style.border = "3px solid #3f51b5";
        elementoImg.style.borderRadius = "50%";
        document.getElementById('input_avatar').value = nomeArquivo;
    }
    </script>
</body>
</html>