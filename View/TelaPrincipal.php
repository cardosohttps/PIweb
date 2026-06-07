<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Routine Hacker - Principal</title>
    <link rel="stylesheet" href="TelaPrincipal.css?v=<?php echo time(); ?>" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
  
<?php
require_once("header.php");
require_once("conexao.php");

if (isset($_GET['limpar_concluidos']) && isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    $sql_limpar = "DELETE FROM compromissos WHERE status = 1 AND id_usuario = $id_usuario";
    mysqli_query($conn, $sql_limpar);

    header("Location: TelaPrincipal.php");
    exit();
}
?>

    <div class="back-link" onclick="history.back()">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </div>

    <main class="layout-principal">

      <section class="coluna-esquerda">
        <a href="TelaAmigos.php" class="bloco-menu">
            <i class="fa-solid fa-users"></i>
            Encontrar Amigos
        </a>
        <a href="TelaHistorico.php" class="bloco-menu">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Ver Histórico
        </a>
        <a href="TelaRecompensas.php" class="bloco-menu">
            <i class="fa-solid fa-star"></i>
            Ver Recompensas
        </a>
      </section>

      <section class="coluna-direita">
        

        <div class="routine-section">
          <h2 class="section-title">Seus compromissos</h2>
          <div class="task-list-container">
            
            <form action="adicionar_compromisso.php" method="POST" class="task-input-group"
            style="display: flex; gap: 10px; width: 100%; margin-bottom: 20px;">
              <input type="text" name="descricao" placeholder="Adicione novo compromisso:" 
              required style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; outline: none;" />
              <input type="datetime-local" name="data_hora" 
              required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; outline: none;;" />
              <button type="submit" 
              style="padding: 10px 20px; background-color: #82c8fa; color: white; border: none; border-radius: 5px; font-weight: bold; transition: 0.2s;">
                  Salvar
              </button>
              <button type="button" class="btn-deletar-topo" onclick="if(confirm('Apagar todos os compromissos concluídos?')) window.location.href='TelaPrincipal.php?limpar_concluidos=1';">
                  Deletar
              </button>
            </form>

            <ul class="task-list">
              <?php
              if (isset($_SESSION['id_usuario'])) {
                  $id_usuario = $_SESSION['id_usuario'];
                  
                  $query = "SELECT * FROM compromissos WHERE id_usuario = '$id_usuario' ORDER BY data_hora ASC";
                  $resultado = mysqli_query($conn, $query);

                  while ($compromisso = mysqli_fetch_assoc($resultado)) {
                    $id_tarefa = $compromisso['id'];
                    $marcado = ($compromisso['status'] == 1) ? 'checked' : '';
                    $estilo_texto = ($compromisso['status'] == 1) ? 'text-decoration: line-through; color: #aaa;' : '';
                    echo '<li class="task-item">';
                    echo '  <span class="item-text" id="texto-tarefa-' . $id_tarefa . '" style="' . $estilo_texto . '">' . htmlspecialchars($compromisso['descricao']) . ' (' . $compromisso['data_hora'] . ')</span>';
                    echo '  <input type="checkbox" class="item-checkbox" ' . $marcado . ' onchange="atualizarStatus(' . $id_tarefa . ', this.checked)" />';
                    echo '</li>';
                  }
                  }
              ?>
            </ul>

          </div>
        </div>
      </section>

    </main>
    
    <script>
    function atualizarStatus(idTarefa, isChecked) {
        let novoStatus = isChecked ? 1 : 0;

        // Efeito visual imediato: risca o texto
        let textoTarefa = document.getElementById('texto-tarefa-' + idTarefa);
        if (textoTarefa) {
            textoTarefa.style.textDecoration = isChecked ? 'line-through' : 'none';
            textoTarefa.style.color = isChecked ? '#aaa' : '#000';
        }

        fetch('atualizar_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + idTarefa + '&status=' + novoStatus
        })
        .then(response => response.json()) // Agora processamos a resposta como JSON
        .then(data => {
            // Se a recompensa foi desbloqueada, mostra o modal
            if (data.recompensa === true) {
                document.getElementById('modal-recompensa').style.display = 'flex';
            }
        })
        .catch(error => {
            console.error("Erro:", error);
        });
    }

    // Função para o botão de fechar o pop-up
    function fecharModal() {
        document.getElementById('modal-recompensa').style.display = 'none';
    }
    </script>
    <div id="modal-recompensa" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center;">
        <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; max-width: 400px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); animation: pop 0.4s cubic-bezier(0.18, 0.89, 0.32, 1.28);">
            <i class="fa-solid fa-trophy" style="font-size: 60px; color: #fbbf24; margin-bottom: 15px;"></i>
            <h2 style="margin: 0 0 10px 0; color: #333; font-family: sans-serif;">Parabéns!</h2>
            <p style="margin: 0 0 25px 0; color: #666; font-family: sans-serif; font-size: 16px;">Você completou 5 tarefas hoje e desbloqueou uma nova recompensa!</p>
            <button onclick="fecharModal()" style="padding: 12px 25px; background-color: #82c8fa; color: white; border: none; border-radius: 8px; font-weight: bold; font-size: 16px; cursor: pointer; transition: 0.2s;">
                Incrível!
            </button>
        </div>
    </div>

    <style>
        @keyframes pop {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
  </body>
</html>
