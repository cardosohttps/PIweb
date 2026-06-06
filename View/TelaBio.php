<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine Hacker - Visão do Perfil</title>
    <link rel="stylesheet" href="TelaPerfil.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        min-height: calc(100vh - 110px); /* 110px é a altura do seu header */
    }

    .bio-container {
        width: 100%;
        max-width: 600px; /* Aumentei um pouco para ficar mais elegante */
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px;
        text-align: center;
    }
    
    .back-link {
        align-self: flex-start;
        margin-bottom: 20px;
        font-weight: bold;
        cursor: pointer;
    }
    </style>
</head>
<body>
    <?php
    require_once("conexao.php");
    require_once("header.php");
    
    $id_perfil = $_GET['id'] ?? $_SESSION['id_usuario'] ?? 0;

    if ($id_perfil > 0) {
        $sql = "SELECT nome, matricula, foto_perfil, telefone, biografia, curso FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_perfil);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $dados = $resultado->fetch_assoc();
            $foto = (!empty($dados['foto_perfil']) && $dados['foto_perfil'] !== 'default.png') ? $dados['foto_perfil'] : '1.png';
            ?>

            <main class="main-content">
                <div class="back-link" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </div>

                <div class="bio-container">
                    <img src="<?php echo htmlspecialchars($foto); ?>" alt="Foto de Perfil" class="bio-avatar">
                    <h2 class="bio-name"><?php echo htmlspecialchars($dados['nome']); ?></h2>
                    <p class="bio-matricula">Matrícula: <?php echo htmlspecialchars($dados['matricula']); ?></p>

                    <div class="bio-info-box">
                        <h4><i class="fa-solid fa-book"></i> Curso</h4>
                        <p><?php echo !empty($dados['curso']) ? htmlspecialchars($dados['curso']) : "<em>Não informado</em>"; ?></p>
                    </div>

                    <div class="bio-info-box">
                        <h4><i class="fa-solid fa-address-card"></i> Biografia</h4>
                        <p><?php echo !empty($dados['biografia']) ? htmlspecialchars($dados['biografia']) : "<em>Nenhuma biografia disponível.</em>"; ?></p>
                    </div>

                    <div class="bio-info-box">
                        <h4><i class="fa-solid fa-phone"></i> Telefone</h4>
                        <p><?php echo !empty($dados['telefone']) ? htmlspecialchars($dados['telefone']) : "<em>Não informado</em>"; ?></p>
                    </div>

                    <?php 
                    if ($id_perfil == ($_SESSION['id_usuario'] ?? 0)) { 
                    ?>
                        <div style="margin-top: 25px;">
                            <a href="TelaPerfil.php" class="action-btn" style="text-decoration: none; display: inline-block; padding: 10px 20px; background-color: #3f51b5; color: white; border-radius: 4px;">Editar Meu Perfil</a>
                        </div>
                    <?php } ?>
                </div>
            </main>

            <?php
        } else {
            echo "<p style='text-align: center; margin-top: 50px;'>Usuário não encontrado.</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='text-align: center; margin-top: 50px;'>Erro de identificação.</p>";
    }
    ?>
</body>
</html>