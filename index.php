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
        'php' => "pages/404/index.php",
        'css' => "pages/404/index.css",
        'js' => "pages/404/index.js",
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

  ?>
  
  <a href="/?menu" id="menu__box" tiltle="Abre/fecha menu"></a>
  </nav>

  <div id="dropable">
   <nav>
    <a href="/?search" title="Pesquisar no site">
    <i class="fa-solid fa-magnifying-glass fa-fw"></i>
    <span>Procurar</span></a>
    <hr>
    <a href="/?home" title="In">
    <span>Contatos</span>
    </a>
   </nav>