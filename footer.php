<div id="fsup">
        <a href="/" title="Página inicial">
          <i class="fa-solid fa-house-chimney fa-fw"></i>
        </a>
        <div id="copy">&copy; 2022 <?php echo $c['sitename'] ?></div>
        <a href="#top" title="Topo da página">
          <i class="fa-solid fa-circle-up fa-fw"></i>
        </a>
      </div>

      <div id="finf">
        <?php
        // Exibe a lista de redes sociais:
        echo $fsocial;
        ?>
        <nav>
          <h4>Acesso rápido:</h4>
          <a href="/?contacts">
            <i class="fa-solid fa-comments fa-fw"></i>
            <span>Contatos</span>
          </a>
          <a href="/?about">
            <i class="fa-solid fa-circle-info fa-fw"></i>
            <span>Sobre</span>
          </a>
          <a href="/?policies">
            <i class="fa-solid fa-user-lock fa-fw"></i>
            <span>Sua privacidade</span>
          </a>
        </nav>
</div>