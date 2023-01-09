<?php

/**
 * Importa as configurações do site:
 * Referências:
 *  • https://www.w3schools.com/php/php_includes.asp
 **/
require('includes/config.php');

// Se usuário já está logado...
if (isset($_COOKIE[$c['ucookie']]))

  // Extrai os dados do usuário:
  $user = json_decode($_COOKIE[$c['ucookie']], true);

/**
 * Obtém e filtra o nome da página da URL:
 * Referências:
 *  • https://www.w3schools.com/jsref/jsref_trim_string.asp
 *  • https://www.php.net/manual/en/function.urldecode.php
 *  • https://www.w3schools.com/php/func_string_htmlentities.asp
 *  • https://www.w3schools.com/php/php_superglobals.asp
 *  • https://www.w3schools.com/php/php_superglobals_server.asp
 **/
$route = trim(htmlentities($_SERVER['QUERY_STRING']));

// Se não solicitou uma rota, usa a rota da página inicial:
if ($route == '') $route = 'home';

// Remove coisas depois da "/" caso exista:
$route = explode('/', $route)[0];

/**
 * Monta todos os caminhos dos arquivos da página em uma coleção:
 * Referências:
 *  • https://www.w3schools.com/php/php_arrays.asp
 *  • https://www.w3schools.com/php/func_array.asp
 **/
$page = array(
  'php' => "pages/{$route}/index.php",
  'css' => "pages/{$route}/index.css",
  'js' => "pages/{$route}/index.js",
);

/**
 * Verifica se a rota solicitada para o arquivo PHP existe:
 * Referências:
 *  • https://www.w3schools.com/php/func_filesystem_file_exists.asp
 **/
if (!file_exists($page['php'])) :

  // Se não existe, carrega, explicitamente, a rota da página 404:
  $page = array(
    'php' => "pages/error/index.php",
    'css' => "pages/error/index.css",
    'js' => "pages/error/index.js",
  );
endif;

// Carrega a página PHP solicitada pela rota:
require($page['php']);

// Carrega o CSS da página solicitada, somente se ele existe:
if (file_exists($page['css']))
  // Gera a tag que carrega o CSS da página:
  $page_css = "<link rel=\"stylesheet\" href=\"/{$page['css']}\">";

// Carrega o JavaScript da página solicitada, somente se ele existe:
if (file_exists($page['js']))
  // Gera a tag que carrega o JavaScript da página:
  $page_js = "<script src=\"/{$page['js']}\"></script>";

if ($page_title == '')
  // Se não definiu um título, usa o slogan do site para compor o título:
  $title = "{$c['sitename']} {$c['titlesep']} {$c['siteslogan']}";
else
  // Se definiu um título, usa o título da página na composição do título:
  $title = "{$c['sitename']} {$c['titlesep']} {$page_title}";

// Inicializa a lista de redes sociais do rodapé:
$fsocial = '<nav>
  <h4>Redes sociais:</h4>';

for ($i = 0; $i < count($s); $i++) : // Adiciona cada rede social na lista: 
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
  <link rel="icon" href="">
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
   
<?php
require_once 'head.php';
require_once 'menu.php';
?>

    <main id="content">
      <?php
      // Exibe o conteúdo dinâmico da página:
      echo $page_content;
      ?>
    </main>

<?php
require_once 'footer.php';
?>

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