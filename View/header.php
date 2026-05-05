<?php 
session_start();

$nome="";
if(isset($_SESSION['id_usuario'])  &&  (isset($_SESSION['nome_usuario']))){
    $nome = $_SESSION['nome_usuario'];
}else{
   header("Location: TelaLogin.html");
        exit();
        
}
?>

<header class="header">
      <div class="user-profile">
        <div class="user-avatar">
          <i class="fa-solid fa-user"></i>
        </div>
        <div class="user-info">
          <span class="user-name"><?php echo $nome; ?></span>
          <span class="user-email">fulano@gmail.com</span>
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
        </div>
      </div>
    </header>