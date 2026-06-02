<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Routine Hacker - Principal</title>
    <link rel="stylesheet" href="TelaPrincipal.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
  
<?php

require_once("header.php");
require_once("conexao.php"); 
?>

    <div class="back-link" onclick="history.back()">
        Voltar
    </div>

    <nav class="nav-bar">
      <button class="activities-btn" onclick="window.location.reload();">
        Atualizar
      </button>
    </nav>

    <main class="content-container">

      <section class="routine-section">
        <h2 class="section-title">Seus compromissos</h2>
        <div class="task-list-container">
          
          <form action="adicionar_compromisso.php" method="POST" class="task-input-group">
            <input type="text" name="descricao" placeholder="Adicione novo compromisso:" required />
            <input type="datetime-local" name="data_hora" required />
            <button type="submit">Salvar</button>
          </form>

          <ul class="task-list">
            <?php
            if (isset($_SESSION['id_usuario'])) {
                $id_usuario = $_SESSION['id_usuario'];
                
                $query = "SELECT * FROM compromissos WHERE id_usuario = '$id_usuario' ORDER BY data_hora ASC";
                $resultado = mysqli_query($conn, $query);

                while ($compromisso = mysqli_fetch_assoc($resultado)) {
                    echo '<li class="task-item">';
                    echo '  <span class="item-text">' . htmlspecialchars($compromisso['descricao']) . ' (' . $compromisso['data_hora'] . ')</span>';
                    echo '  <input type="checkbox" class="item-checkbox" />';
                    echo '</li>';
                }
            }
            ?>
          </ul>

        </div>
      </section>

    </main>
  </body>
</html>
