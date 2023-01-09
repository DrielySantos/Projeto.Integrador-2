<nav class="nav">
      <ul>
         <li><a href="home" title="Página inicial" class="dropable"><span>Início</span></a>
         <li class="drop"><a href="about" title="Opções de Tratamentos" class="dropable"><span>Tratamentos</span></a>
            <ul class="dropdown">
              <li><a href="#">Diagnósticos</a></li>
              <li><a href="#">Tratamento facial</a></li>
              <li><a href="#">Tratamento corporal</a></li>
            </ul>
         </li>
         <li><a href="vlog" title="Estéticas em Vlog" class="dropable"><span>Vlog</span></a>
         <li><a href="contacts" title="Faça contato" class="dropable"><span>Contatos</span></a>
      </ul>

      <?php
      // Se o usuário está logado...
      if (isset($user['uid'])) :

      ?>

        <a href="/?profile" title="Perfil de <?php echo $user['name'] ?>" class="dropable profile">
          <img src="<?php echo $user['photo'] ?>" alt="Perfil de <?php echo $user['name'] ?>">
          <span>Perfil</span>
        </a>

      <?php
      // Se não está logado...
      else :
      ?>

        <a href="/?login" title="Login de usuário" class="dropable">
          <i class="fa-solid fa-right-to-bracket fa-fw"></i>
          <span>Login</span>
        </a>

      <?php
      endif;
      ?>
      <a href="/?menu" id="btnMenu" title="Abre/fecha menu">
        <i class="fa-solid fa-ellipsis-vertical fa-fw"></i>
      </a>
    </nav>

    <div id="dropable">
      <nav>
        <?php if (isset($user['uid'])) : ?>
          <a href="/?profile" title="Perfil de <?php echo $user['name'] ?>" class="profile">
            <img src="<?php echo $user['photo'] ?>" alt="Perfil de <?php echo $user['name'] ?>">
            <span>Perfil</span>
          </a>
        <?php else : ?>
          <a href="/?login" title="Login de usuário">
            <i class="fa-solid fa-right-to-bracket fa-fw"></i>
            <span>Login</span>
          </a>
        <?php endif; ?>
        <hr>
        <a href="/?search" title="Procurar no site"><i class="fa-solid fa-magnifying-glass fa-fw"></i><span>Procurar</span></a>
        <hr>
        <a href="/?contacts" title="Faça contato"><i class="fa-solid fa-comments fa-fw"></i><span>Contatos</span></a>
        <a href="/?about" title="Sobre a gente..."><i class="fa-solid fa-circle-info fa-fw"></i><span>Sobre</span></a>
        <a href="/?site" title="Sobre o site..."><i class="fa-solid fa-globe fa-fw"></i><span>Sobre o site</span></a>
        <a href="/?team" title="Quem somos..."><i class="fa-solid fa-users fa-fw"></i><span>Quem somos</span></a>
        <a href="/?policies" title="Políticas de Privacidade"><i class="fa-solid fa-user-lock fa-fw"></i><span>Sua privacidade</span></a>
      </nav>
    </div>