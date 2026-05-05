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
?>
    <main class="main-content">
        <div class="back-link" onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i> Voltar
</div>

        <h2 class="page-title">Histórico de afazeres</h2>

        <div class="history-grid">
            
            <div class="history-card">
                <div class="card-header">
                    <span class="date">13/11/2025</span>
                    <i class="fa-solid fa-square-check check-icon"></i>
                </div>
                <ul class="task-list">
                    <li>Fazer exercícios</li>
                    <li>Fazer PI</li>
                    <li>Estudar</li>
                    <li>Tomar água</li>
                    <li>Trabalho de Física</li>
                    <li>Telas PDS</li>
                </ul>
            </div>

            <div class="history-card">
                <div class="card-header">
                    <span class="date">14/11/2025</span>
                    <i class="fa-solid fa-square-check check-icon"></i>
                </div>
                <ul class="task-list">
                    <li>Trabalho de Química</li>
                    <li>Tomar água</li>
                    <li>Fazer exercícios</li>
                    <li>Estudar</li>
                    <li>Telas PDS</li>
                    <li>Trabalho Sistemas Operacionais</li>
                    <li>Fazer Redação</li>
                    <li>Fazer Diagrama</li>
                </ul>
            </div>

            <div class="history-card">
                <div class="card-header">
                    <span class="date">15/11/2025</span>
                    <i class="fa-solid fa-square-check check-icon"></i>
                </div>
                <ul class="task-list">
                    <li>Tomar água</li>
                    <li>Fazer exercícios</li>
                    <li>Fazer PI</li>
                    <li>Telas PDS</li>
                    <li>Estudar</li>
                    <li>Trabalho de jogos</li>
                </ul>
            </div>

        </div>
    </main>
</body>
</html>