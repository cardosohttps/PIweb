<?php 
session_start();

$nome="";
$matricula="";
if(isset($_SESSION['id_usuario'])){ 
    $nome = $_SESSION['nome_usuario'] ?? 'Usuário';
if(isset($_SESSION['matricula'])){
        $matricula = $_SESSION['matricula'];
    } else {
        $matricula = "Matrícula não encontrada";
    }
} else {
    header("Location: TelaLogin.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="header.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
</head>
<body>
<header class="header">
      <div class="user-profile">
        <div class="user-avatar">
          <?php 
          if(isset($_SESSION['foto_perfil']) && !empty($_SESSION['foto_perfil']) && $_SESSION['foto_perfil'] !== 'default.png'): ?>
          <a href="TelaBio.php" style="display: contents;">
          <img src="<?php echo $_SESSION['foto_perfil']; ?>" alt="Foto de Perfil" class="avatar-img-header">
          </a>
          <?php else: ?>
          <i class="fa-solid fa-user"></i>
          <?php endif; ?>
        </div>
        <div class="user-info">
          <span class="user-name"><div>Nome: <?php echo $nome; ?></div></span>
          <span class="user-matricula"><div>Matrícula: <?php echo $matricula; ?></div></span>
        </div>
      </div>
      <h1 class="main-logo-text">ROUTINE HACKER</h1>
      
      <div class="menu-action-container">
        <button class="menu-main-btn" onclick="toggleDropdown()">
          <i class="fa-solid fa-ellipsis"></i>
        </button>

        <div class="dropdown-menu" id="myDropdown">
          <a href="TelaPerfil.php" class="dropdown-item"> <i class="fa-solid fa-pencil"></i>
         
         
          Editar Perfil
          <i class="fa-solid fa-chevron-right arrow-right"></i>
          </a>
          <a href="TelaAmigos.php" class="dropdown-item"> <i class="fa-solid fa-magnifying-glass"></i>
         
         
          Encontrar Amigos
          <i class="fa-solid fa-chevron-right arrow-right"></i>
          </a>
          <a href="TelaHistorico.php" class="dropdown-item"> <i class="fa-regular fa-clock"></i>
          
          
          Ver histórico
          <i class="fa-solid fa-chevron-right arrow-right"></i>
          </a>
          <a href="TelaRecompensas.php" class="dropdown-item"> <i class="fa-regular fa-star"></i>
         
         
          Ver recompensas
          <i class="fa-solid fa-chevron-right arrow-right"></i>
          </a>
          <a href="logout.php" class="dropdown-item" style=> 
          <i class="fa-solid fa-right-from-bracket"></i> Sair
          <i class="fa-solid fa-chevron-right arrow-right"></i>
          </a>     
        </div>
      </div>
    </header>
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