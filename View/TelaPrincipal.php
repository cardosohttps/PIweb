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
?>
 <div class="back-link" onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i> Voltar
</div>
    <nav class="nav-bar">
      <button class="activities-btn">
        
        Atividades
      </button>
    </nav>

    <main class="content-container">
      <section class="routine-section">
        <h2 class="section-title">Seus afazeres</h2>
        <div class="task-list-container">
          <div class="task-input-group">
            <input type="text" placeholder="Adicione nova tarefa:" />
          </div>
          <ul class="task-list">
            <li class="task-item">
              <div class="item-id">A</div>
              <span class="item-text">List item</span>
              <input type="checkbox" class="item-checkbox" checked />
            </li>
          </ul>
        </div>
      </section>

      <section class="routine-section">
        <h2 class="section-title">Seus compromissos</h2>
        <div class="task-list-container">
          <div class="task-input-group">
            <input type="text" placeholder="Adicione novo compromisso:" />
          </div>
          <ul class="task-list">
            <li class="task-item">
              <div class="item-id">A</div>
              <span class="item-text">List item</span>
              <input type="checkbox" class="item-checkbox" checked />
            </li>
          </ul>
        </div>
      </section>

      <section class="routine-section">
        <h2 class="section-title">
          Suas a<span class="truncate-fix">ulas</span>
        </h2>
        <div class="task-list-container">
          <div class="task-input-group">
            <input type="text" placeholder="Adicione suas novas aulas:" />
          </div>
          <ul class="task-list">
            <li class="task-item">
              <div class="item-id">A</div>
              <span class="item-text">List item</span>
              <input type="checkbox" class="item-checkbox" checked />
            </li>
          </ul>
        </div>
      </section>
    </main>

    <script>
      function toggleDropdown() {
        document.getElementById("myDropdown").classList.toggle("show");
      }

      
      window.onclick = function (event) {
        if (
          !event.target.matches(".menu-main-btn") &&
          !event.target.matches(".fa-ellipsis")
        ) {
          var dropdowns = document.getElementsByClassName("dropdown-menu");
          for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
              openDropdown.classList.remove("show");
            }
          }
        }
      };
    </script>
  </body>
</html>
