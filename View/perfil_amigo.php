<?php
session_start();
require_once("conexao.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: TelaAmigos.php");
    exit();
}

$id_amigo = (int)$_GET['id'];
$query = "SELECT nome, id AS matricula, curso, biografia, telefone, foto_perfil FROM usuarios WHERE id = $id_amigo";
$resultado = mysqli_query($conn, $query);

if (mysqli_num_rows($resultado) == 0) {
    header("Location: TelaAmigos.php");
    exit();
}

$amigo = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine Hacker - Perfil de <?php echo htmlspecialchars($amigo['nome']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background-color: #e0f2fe; 
        }
        .main-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .back-link {
            align-self: flex-start;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-top: 20px;
        }
        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #82c8fa;
            margin-bottom: 15px;
        }
        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin: 5px 0 0 0;
            color: #000;
        }
        .profile-matricula {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .info-section {
            margin-bottom: 15px;
        }
        .info-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 3px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        .info-value {
            font-style: italic;
            color: #555;
            font-size: 15px;
        }
        .btn-acao {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background-color: #4f46e5; 
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.2s;
        }
        .btn-acao:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <?php require_once("header.php"); ?>

    <main class="main-content">
        <a href="TelaAmigos.php" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>

        <div class="profile-card">
            
            <?php 
            // Usa exatamente a mesma regra que fizemos no header.php e na TelaBio
            if (!empty($amigo['foto_perfil']) && $amigo['foto_perfil'] !== 'default.png') {
                // Se ele tiver foto personalizada, puxa a foto dele
                $caminho_foto = $amigo['foto_perfil']; 
            } else {
                // Se não tiver foto ou for o padrão antigo, mostra o avatar de turbante
                $caminho_foto = '1.png';
            }
            ?>
            <img src="<?php echo $caminho_foto; ?>" alt="Avatar" class="profile-pic">
            
            <div class="profile-name"><?php echo htmlspecialchars($amigo['nome']); ?></div>
            <div class="profile-matricula">Matrícula: <?php echo $amigo['matricula']; ?></div>

            <div class="info-section">
                <div class="info-title"><i class="fa-solid fa-book"></i> Curso</div>
                <div class="info-value">
                    <?php echo !empty($amigo['curso']) ? htmlspecialchars($amigo['curso']) : 'Não informado'; ?>
                </div>
            </div>

            <div class="info-section">
                <div class="info-title"><i class="fa-solid fa-address-card"></i> Biografia</div>
                <div class="info-value">
                    <?php echo !empty($amigo['biografia']) ? htmlspecialchars($amigo['biografia']) : 'Nenhuma biografia disponível.'; ?>
                </div>
            </div>

            <div class="info-section">
                <div class="info-title"><i class="fa-solid fa-phone"></i> Telefone</div>
                <div class="info-value">
                    <?php echo !empty($amigo['telefone']) ? htmlspecialchars($amigo['telefone']) : 'Não informado'; ?>
                </div>
            </div>

            <a href="TelaAmigos.php" class="btn-acao">Voltar para a Busca</a>
        </div>
    </main>
</body>
</html>