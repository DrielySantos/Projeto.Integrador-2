<?php
require('includes/config.php');

if (isset($_COOKIE[$c['ucookie']]))
  $user = json_decode($_COOKIE[$c['ucookie']], true);
  $route = trim(htmlentities($_SERVER['QUERY_STRING']));

if ($route == '') $route = 'home';
  $route = explode('/', $route)[0];
  $page = array(
    'php' => "pages/{$route}/index.php",
    'css' => "pages/{$route}/index.css",
    'js' => "pages/{$route}/index.js",
);

if (!file_exists($page['php'])) :
  $page = array(
    'php' => "pages/error/index.php",
    'css' => "pages/error/index.css",
    'js' => "pages/error/index.js",
);
endif;
require($page['php']);

    if (file_exists($page['css']))
    $page_css = "<link rel=\"stylesheet\" href=\"/{$page['css']}\">";

    if (file_exists($page['js']))
    $page_js = "<script src=\"/{$page['js']}\"></script>";

    if ($page_title == '')
      $title = "{$c['sitename']} {$c['titlesep']} {$c['siteslogan']}";
    else
      $title = "{$c['sitename']} {$c['titlesep']} {$page_title}";

    $fsocial = '<nav>
      <h4>Redes sociais:</h4>';

      for ($i = 0; $i < count($s); $i++) :

    $fsocial .= <<<HTML
        <a href="{$s[$i]['link']}" target="_blank" title="Acesse nosso {$s[$i]['name']}">
  <i class="fa-brands {$s[$i]['icon']} fa-fw"></i>
  <span>{$s[$i]['name']}</span>
</a>

HTML;
endfor;
// Conclui a lista de redes sociais do rodapé:
$fsocial .= '
</nav>';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="<?php echo $c['sitefavicon'] ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/style.css" />
  <?php
  // Carrega as folhas de estilo da página solicitada:
  echo $page_css;
  ?>
  <title><?php echo $title ?></title>
</head>

<body>
  <a id="top"></a>
  <div id="wrap">

    <header>
      <a href="/" title="Página inicial">
        <?php echo $c['sitelogo'] ?>
      </a>
      <h1>
        <?php echo $c['sitename'] ?>
        <small><?php echo $c['siteslogan'] ?></small>
      </h1>
    </header>

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

      endif; // if(isset($user['uid'])):

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

    <main id="content">
      <?php
      // Exibe o conteúdo dinâmico da página:
      echo $page_content;
      ?>
    </main>

    <footer>

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
    </footer>
    <span>&nbsp;</span>

  </div>

  <div id="acCookies">
    <div class="cookieBody">
      <div class="cookieBox">
        <div>
          Usamos cookies para lhe fornecer uma experiência de navegação melhor e mais segura.
          Não se preocupe, todos os seus dados pessoais estão protegidos.
        </div>
        <button id="accept">Entendi!</button>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="/script.js"></script>
  
  <?php
  // Carrega o javaScript da página solicitada:
  echo $page_js;
  ?>
</body>

</html>