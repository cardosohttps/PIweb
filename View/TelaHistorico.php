<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine Hacker - Histórico de Afazeres</title>
    <link rel="stylesheet" href="TelaHistorico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
    require_once("header.php");
    require_once("conexao.php"); 
    ?>
    
    <main class="main-content">
        <div class="back-link" onclick="history.back()">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </div>

        <h2 class="page-title">Histórico de afazeres</h2>

        <div class="history-grid">
            <?php
            $id_usuario = $_SESSION['id_usuario'] ?? 0; 

            if ($id_usuario > 0) {
                $sql = "SELECT data_hora, descricao 
                        FROM compromissos 
                        WHERE id_usuario = ? AND status = 1 
                        ORDER BY data_hora DESC";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                $historico = [];
                while ($linha = $resultado->fetch_assoc()) {
                    $data_formatada = date('d/m/Y', strtotime($linha['data_hora']));
                    $historico[$data_formatada][] = $linha['descricao'];
                }
                
                $stmt->close();
                if (empty($historico)) {
                    echo "<p style='text-align: center; width: 100%; color: #666; margin-top: 20px;'>
                            Nenhum histórico encontrado. Você ainda não concluiu nenhum compromisso.
                          </p>";
                } else {
                    foreach ($historico as $data => $tarefas) {
                        ?>
                        <div class="history-card">
                            <div class="card-header">
                                <span class="date"><?php echo htmlspecialchars($data); ?></span>
                                <i class="fa-solid fa-square-check check-icon"></i>
                            </div>
                            <ul class="task-list">
                                <?php 
                                foreach ($tarefas as $tarefa_descricao) { 
                                    echo "<li>" . htmlspecialchars($tarefa_descricao) . "</li>";
                                } 
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                }
            } else {
                echo "<p style='text-align: center; width: 100%; color: red;'>Erro: Usuário não identificado. Faça login novamente.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>