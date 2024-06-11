<?php require_once("sistema/conexao.php"); 

$query = $pdo->query("SELECT * FROM dados_site order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$logo_site = @$res[0]['logo_site'];
$titulo_sobre = @$res[0]['titulo_sobre'];
$descricao_sobre1 = @$res[0]['descricao_sobre1'];
$descricao_sobre2 = @$res[0]['descricao_sobre2'];
$descricao_sobre3 = @$res[0]['descricao_sobre3'];
$foto_sobre_index = @$res[0]['foto_sobre_index'];
$foto_sobre_pagina = @$res[0]['foto_sobre_pagina'];
$video_sobre_index = @$res[0]['video_sobre_index'];
$foto_video_sobre = @$res[0]['foto_video_sobre'];
$foto_banner_mobile = @$res[0]['foto_banner_mobile'];
?>
<!-- icon list--><!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <!-- Site Title-->
    <title><?php echo $nome_sistema ?></title>
    <meta name="description" content="Ao escrever uma meta tag, use entre 140 e 160 caracteres para que o Google possa exibir toda a sua mensagem. Não se esqueça de incluir sua palavra-chave!">
    <meta name="keywords" content="hotéis, pousadas, descanso, etc">

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="sistema/img/icone.png" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700,400italic%7CPoppins:300,400,500,700">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>

     
  </head>
  <body>
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <!-- Page-->
    <div class="text-center page">
     
      <!-- Page Header-->
      <header class="page-header" style="padding-bottom: 24px">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-default-with-top-panel" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fullwidth" data-lg-device-layout="rd-navbar-fullwidth" data-md-stick-up-offset="90px" data-lg-stick-up-offset="150px" data-stick-up="true" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true">
            <div class="rd-navbar-top-panel rd-navbar-collapse">
              <div class="rd-navbar-top-panel-inner">
                <div class="left-side">
                  <?php if($instagram_sistema != ""){ ?>
                  <div class="group"><span class="text-italic">Siga-nos:</span>
                    <ul class="list-inline">
                      <li><a title="Ir para o Instagram" target="_blank" class="icon icon-sm icon-secondary-5 fa fa-instagram" href="<?php echo $instagram_sistema ?>" style="color:#e31751"></a></li>
                     
                    </ul>
                  </div>
                <?php } ?>
                </div>
                <div class="center-side">
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand fullwidth-brand"><a class="brand-name" href="index.php"><img src="sistema/img/<?php echo $logo_site ?>" alt="" width="170" height="48"/></a></div>
                </div>
                <div class="right-side">
                  <!-- Contact Info-->
                  <div class="contact-info">
                    <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                      <div class="unit__left"><span class="icon icon-primary text-middle mdi mdi-whatsapp" style="color:green"></span></div>
                      <div class="unit__body"><a target="_blank" class="text-middle" href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_sistema ?>&text=Gostaria de Mais informações sobre as reservas"><?php echo $telefone_sistema ?></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <!-- RD Navbar collapse toggle-->
                <button class="rd-navbar-collapse-toggle" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand mobile-brand"><a class="brand-name" href="index.php"><img src="sistema/img/<?php echo $logo_site ?>" alt="" width="120" height="48"/></a></div>
              </div>
              <div class="rd-navbar-aside-right">
                <div class="rd-navbar-nav-wrap">
                  <div class="rd-navbar-nav-scroll-holder">
                    <ul class="rd-navbar-nav">
                      <li class="active"><a href="index.php">Home</a>
                      </li>
                      <li><a href="sobre.php">Sobre</a>
                      </li>
                      <li><a href="contatos.php">Contatos</a>
                      </li>
                      <li><a href="sistema">Sistema</a>
                      </li>
                     
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      