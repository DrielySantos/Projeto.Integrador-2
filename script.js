function runApp() {
    resize();
    $(window).resize(resize);
  
    if (getCookie('cookieAccept') != '') {
      $('#acCookies').hide();

    } else {
      $('#acCookies').show();
    }

    $(document).on('click', '#accept', function () {
      setCookie('cookieAccept', 'accept', 365);
      $('#acCookies').hide();
    });
  
  }

  function routerLink() {

    hideMenu();

    var href = $(this).attr('href');
  
    if (href == 'menu') {
  
      toggleMenu();
  
      return false;
    }

    if (
      href.substr(0, 7) == 'http://' ||
      href.substr(0, 8) == 'https://' ||
      href.substr(0, 1) == '#'
    ) {
      return true;
    }

    loadPage(href);

    return false;
  }

  function loadPage(href) {

    var page = {
      "html": `/pages/${href}/index.html`,
      "css": `/pages/${href}/style.css`,
      "js": `/pages/${href}/script.js`
    }

    $.get(page.html, function (content) {
  
      $('#pageCSS').attr('href', page.css);

      $('#content').html(content);

      $.getScript(page.js);
  
    });
  
  }

  function setTitle(title = '') {
    if (title == '') {
      $('title').html("Absoluta&Bela .:. Sua estética e beleza");
  
    } else {

      $('title').html("Absoluta&Bela .:. " + title);
  
    }
  
  }

  function resize() {
    $('#dropable').hide('fast');

    if (window.innerWidth > 574) {
      $('#btnMenu').hide(0);
      $('.dropable').show(0);
    } else {
      $('.dropable').hide(0);
      $('#btnMenu').show(0);
  
    }
  }
 
  function toggleMenu() {
    if ($('#dropable').is(":visible")) {
      hideMenu();

    } else {
      showMenu();
    }
  }

  function hideMenu() {
    $('#dropable').hide('fast');
    $('#btnMenu i').removeClass('fa-rotate-90');
  }

  function showMenu() {
    $('#dropable').show('fast');
    $('#btnMenu i').addClass('fa-rotate-90');
  }

  function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  var aboutMenu = `
  <a href="site"><i class="fa-solid fa-globe fa-fw"></i><span>Sobre o site</span></a>
  <a href="team"><i class="fa-solid fa-users fa-fw"></i><span>Quem somos</span></a>
  <a href="policies"><i class="fa-solid fa-user-lock fa-fw"></i><span>Sua privacidade</span></a>
  <a href="contacts"><i class="fa-solid fa-comments fa-fw"></i><span>Contatos</span></a>
  `;

  $(document).ready(runApp);