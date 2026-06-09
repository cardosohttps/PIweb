<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("header.php");
require_once("conexao.php");

$id_usuario = $_SESSION['id_usuario'];
$query_notificacoes = "SELECT * FROM notificacoes WHERE id_usuario = ? AND lida = 0 ORDER BY data_criacao DESC";
$stmt_busca = $conn->prepare($query_notificacoes);
$stmt_busca->bind_param("i", $id_usuario);
$stmt_busca->execute();
$notificacoes = $stmt_busca->get_result();
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Routine Hacker - Recompensas</title>
    <style>
      .container-recompensas {
          max-width: 800px;
          margin: 40px auto;
          background: white;
          padding: 20px;
          border-radius: 10px;
          box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      }
      .notificacao-card {
          background-color: #fef9c3;
          border-left: 5px solid #eab308;
          padding: 15px;
          margin-bottom: 15px;
          border-radius: 5px;
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
      .btn-lida {
          background-color: #82c8fa;
          color: white;
          border: none;
          padding: 8px 15px;
          border-radius: 5px;
          cursor: pointer;
          font-weight: bold;
          text-decoration: none;
      }
      .btn-lida:hover { background-color: #65b5f6; }
      .sem-notificacao { text-align: center; color: #666; font-style: italic; }
    </style>
  </head>
  <body>
    
    <div class="back-link" onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i> Voltar
</div>

    <main class="container-recompensas">
        <h2><i class="fa-solid fa-star" style="color: #eab308;"></i> Suas Recompensas e Avisos</h2>
        <hr style="margin-bottom: 20px; border: 0; border-top: 1px solid #eee;">

        <?php if ($notificacoes->num_rows > 0): ?>
            
            <?php while ($notificacao = $notificacoes->fetch_assoc()): ?>
                <div class="notificacao-card">
                    <div>
                        <strong>Nova Conquista!</strong><br>
                        <span><?php echo htmlspecialchars($notificacao['mensagem']); ?></span>
                        <br><small style="color: #888;"><?php echo date('d/m/Y H:i', strtotime($notificacao['data_criacao'])); ?></small>
                    </div>
                    
                    <form action="marcar_lida.php" method="POST" style="margin: 0;">
                        <input type="hidden" name="id_notificacao" value="<?php echo $notificacao['id']; ?>">
                        <button type="submit" class="btn-lida">Marcar como lida <i class="fa-solid fa-check"></i></button>
                    </form>
                </div>
            <?php endwhile; ?>

        <?php else: ?>
            <p class="sem-notificacao">Você não tem novas notificações no momento. Cumpra seus compromissos para ganhar recompensas!</p>
        <?php endif; ?>

    </main>

  </body>
</html>