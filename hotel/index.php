<?php 
require_once("cabecalho.php");
 ?>
      <section class="section">
        <div class="shell-wide">
          <div class="range range-30 range-xs-center">
            <div class="cell-lg-8 cell-xl-9">

              <?php 
                $query = $pdo->query("SELECT * from banners_site where ativo = 'Sim' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
               ?>
              <!-- Classic slider-->
              <section class="section">

                <div class="mostrar-mobile">
                  <img width="100%" src="sistema/img/<?php echo $foto_banner_mobile ?>">
                </div>
                <!-- Swiper -->
                <div class="swiper-container swiper-slider swiper-style-2 ocultar-mobile" data-loop="false" data-autoplay="5500" data-simulate-touch="false" data-slide-effect="slide" data-direction="vertical">
                  <div class="swiper-wrapper">

                    <?php 
                      for($i=0; $i<$linhas; $i++){
  $id = $res[$i]['id'];
  $titulo = $res[$i]['titulo'];
  $descricao = $res[$i]['descricao'];
  $subtitulo = $res[$i]['subtitulo'];
  $link = $res[$i]['link'];
  $foto = $res[$i]['foto']; 

  $ocultar_link = '';
  if($link == ""){
    $ocultar_link = 'none';
  }

  $ocultar_textos = '';
  if($descricao == "" and $subtitulo == ""){
    $ocultar_textos = 'none';
  }
                     ?>
                    <div class="swiper-slide" data-slide-bg="sistema/painel/images/banners/<?php echo $foto ?>">
                      <div class="swiper-slide-caption">
                        <div class="shell text-sm-left">
                          <h1 data-caption-animate="slideInDown" data-caption-delay="100"><?php echo $titulo ?></h1>
                          <div class="slider-subtitle-group" style="display:<?php echo $ocultar_textos ?>">
                            <div class="decoration-line" data-caption-animate="slideInDown" data-caption-delay="400"></div>
                            <h4 data-caption-animate="slideInLeft" data-caption-delay="700"><?php echo $descricao ?></h4>
                            <h3 data-caption-animate="slideInLeft" data-caption-delay="800"><?php echo $subtitulo ?></h3>
                          </div>
                          <a class="button button-effect-ujarak button-lg button-white-outline button-square" href="<?php echo $link ?>" data-caption-animate="slideInLeft" data-caption-delay="1150" style="display:<?php echo $ocultar_link ?>"><span>Veja Mais</span></a>
                        </div>
                      </div>
                    </div>

                  <?php } ?>

                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </section>
            <?php } ?>
            </div>
            <div class="cell-lg-4 cell-xl-3 reveal-lg-flex">
              <div class="hotel-booking-form">
                <h3>Reserve Já</h3>
                <!-- RD Mailform-->
                <form  method="post" id="form_reserva">
                  <div class="range range-sm-bottom spacing-20">
                    <div class="cell-lg-12 cell-md-4">
                      <p class="text-uppercase">Seu Telefone</p>
                      <div class="form-wrap">
                        <input class="form-input" id="telefone" type="text" name="telefone" placeholder="(00) 00000-0000" required>
                        
                      </div>
                    </div>
                    <div class="cell-lg-12 cell-md-4 cell-sm-6">
                      <p class="text-uppercase">Check-In</p>
                      <div class="form-wrap">
                       
                        <input class="form-input" type="date" name="checkin" id="checkin" required>
                      </div>
                    </div>
                    <div class="cell-lg-12 cell-md-4 cell-sm-6">
                      <p class="text-uppercase">Check-Out</p>
                      <div class="form-wrap">
                       
                        <input class="form-input" type="date" name="checkout" id="checkout" required>
                      </div>
                    </div>
                    <div class="cell-lg-6 cell-md-4 cell-xs-6">
                      <p class="text-uppercase">Adultos</p>
                      <div class="form-wrap form-wrap-validation">
                        <!--Select 2-->
                        <select class="form-input select-filter" name="adultos">                          
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="cell-lg-6 cell-md-4 cell-xs-6">
                      <p class="text-uppercase">Crianças</p>
                      <div class="form-wrap form-wrap-validation">
                        <!--Select 2-->
                        <select class="form-input select-filter"  data-placeholder="0" name="criancas">
                         
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                    </div>
                    <div class="cell-lg-12 cell-md-4">
                      <button class="button button-steel-blue5 button-square button-block button-effect-ujarak" type="submit" ><span >Solicitar Reserva</span></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- About us-->
      <section class="section section-md bg-white text-center text-sm-left">
        <div class="shell-wide">
          <div class="range range-50 range-xs-center overflow-hidden">
            <div class="cell-sm-10 cell-md-8 cell-lg-7 wow fadeInUp" data-wow-delay=".1s">
             
              <div class="post-video post-video-border">
                <div class="post-video__image"><img src="sistema/img/<?php echo $foto_sobre_pagina ?>" alt="" width="1020" height="525"/>
                </div>
                 <?php if($foto_video_sobre == "Vídeo"){ ?>
                <div class="post-video__body"><a class="link-control post-video__control" data-lightgallery="item" href="<?php echo $video_sobre_index ?>"></a></div>
                <?php } ?>
              </div>
            
            </div>
            <div class="cell-sm-10 cell-md-8 cell-lg-5 reveal-flex wow fadeInUp" data-wow-delay=".3s" >
              <div class="bg-primary section-wrap-content-var-1" style="background: #053582;">
                <div class="section-wrap-content-var-1-inner">
                  <?php if($titulo_sobre != ""){ ?><h2><?php echo $titulo_sobre ?></h2><?php } ?>
                   <?php if($descricao_sobre1 != ""){ ?><p><?php echo $descricao_sobre1 ?></p><?php } ?>
                  <div class="group">
                   <?php if($descricao_sobre2 != ""){ ?><p><?php echo $descricao_sobre2 ?></p><?php } ?>
                  </div><a class="button button-effect-ujarak button-lg button-secondary-outline button-square" href="sobre.php"><span>Veja Mais</span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


<?php 
               $query = $pdo->query("SELECT * from especificacoes order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
             ?>
      <!--Indoor Pool-->
       <div class="range range-30 range-middle" data-lightgallery="group" style="margin:5px; padding:5px; color:#707070;">

        <?php 
             for($i=0; $i<$linhas; $i++){
  $id = $res[$i]['id'];
  $nome = $res[$i]['nome'];
  $foto = $res[$i]['foto'];
         ?>
          <div class="col-md-3 ">
              <div class="divmobile" style="display: inline-block;">
              <img width="60px" src="sistema/painel/images/especificacoes/<?php echo $foto ?>"> <span><?php echo $nome ?></span>
              </div>
          </div>
         <?php } ?>

        </div>
      <?php } ?>





<?php 
               $query = $pdo->query("SELECT * from categorias_quartos where ativo = 'Sim' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
             ?>
      <section class="section section-md">
        <div class="shell">
          <h3>Nossos Quartos</h3>
         
          <div class="range range-30" data-lightgallery="group">

            <?php 
              for($i=0; $i<$linhas; $i++){
  $id = $res[$i]['id'];
  $nome = $res[$i]['nome'];
  $nome_url = $res[$i]['nome_url'];
  $descricao = $res[$i]['descricao'];
  $especificacoes = $res[$i]['especificacoes'];
  $valor = $res[$i]['valor'];
  $foto = $res[$i]['foto']; 
  $ativo = $res[$i]['ativo'];
  
  $valorF = number_format($valor, 2, ',', '.');  
  $descricaoF = mb_strimwidth($descricao, 0, 100, "...");

  $especificacoesF = str_replace('**', ', ', $especificacoes);

  if($linhas < 5){
    $col = 'cell-md-6';
    $heig = '320px';
  }else{
    $col = 'cell-md-4';
    $heig = '276px';
  }
             ?>
            <div class="cell-sm-6 <?php echo $col ?>"><a class="thumbnail-classic" href="especificacoes.php?nome=<?php echo $nome_url ?>" target="_blank">
                <figure><img src="sistema/painel/images/quartos/<?php echo $foto ?>" alt="" style="width:370px; height:<?php echo $heig ?>"/>
                </figure>
                <div class="caption">
                  <p class="caption-title"><?php echo $nome ?></p>
                  <p class="caption-text"><?php echo $especificacoesF ?></p>
                </div></a>
            </div>
          <?php } ?>
           
          </div>
        </div>
      </section>    
  <?php } ?>
    
     

       <?php 
               $query = $pdo->query("SELECT * from galeria_site order by id desc limit 18");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
             ?>

      <!-- Portfolio-->
      <section class="section section-md bg-white text-center text-sm-left">
        <div class="shell-wide">
           <div class="range range-10 range-middle">
            <div class="cell-sm-6">
              <h3>Galeria de Fotos</h3>
            </div>
            
          </div>
          <hr>
          
          <div class="isotope-wrap">
            <!-- Isotope Content-->
            <div class="row isotope" data-isotope-layout="masonry" data-isotope-group="gallery" data-lightgallery="group">
              <div class="col-xs-6 col-sm-6 col-md-2 grid-sizer"></div>

               <?php 
              for($i=0; $i<$linhas; $i++){
  $id_foto = $res[$i]['id'];
  $foto = $res[$i]['foto'];
  ?>
              <div class="col-xs-6 col-sm-6 col-md-2 isotope-item wow fadeInUp" data-filter="Category 1" data-wow-delay=".1s"><a class="portfolio-item thumbnail-classic" href="sistema/painel/images/galeria/<?php echo $foto ?>" data-size="1199x800" data-lightgallery="item"><img src="sistema/painel/images/galeria/<?php echo $foto ?>" alt="" style="width:160px; height:130px"/>
                  <figure></figure>
                  </a>
              </div>

<?php } ?>
             
            </div>
          </div>
        </div>
      </section>
      <?php } ?>


      
      
      <?php require_once("rodape.php") ?>


      <script type="text/javascript">
        

$("#form_reserva").submit(function () {

   event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'mensagem_reserva.php',
        type: 'POST',
        data: formData,

        success: function (mensagem) {          
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Enviado") {
              alert('Mensagem Enviada no Whatsapp')
            } else {
              window.open(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});



      </script>












<style type="text/css">
    .alerta{
      background-color: #060d54; color:#FFF; padding:15px; font-family: Arial; text-align:center; position:fixed; bottom:0; width:80%; opacity: 80%; z-index: 200;
    }

     .alerta.hide{
       display:none !important;
    }

    .link-alerta{
      color:#f2f2f2; 
    }

    .link-alerta:hover{
      text-decoration: underline;
      color:#FFF;
    }

    .botao-aceitar{
      background-color: #e3e3e3; padding:7px; margin-left: 15px; border-radius: 5px; border: none; margin-top:3px;
    }

    .botao-aceitar:hover{
      background-color: #f7f7f7;
      text-decoration: none;

    }

  </style>

<div class="alerta hide">
  A gente guarda estatísticas de visitas para melhorar sua experiência de navegação, saiba mais em nossa  <a class="link-alerta" title="Ver as políticas de privacidade" data-toggle="modal" href="#modalTermosCondicoes" >política de privacidade.</a>
  <a class="botao-aceitar text-dark" href="#">Aceitar</a>
</div>


<script>
        if (!localStorage.meuCookie) {
            document.querySelector(".alerta").classList.remove('hide');
        }

        const acceptCookies = () => {
            document.querySelector(".alerta").classList.add('hide');
            localStorage.setItem("meuCookie", "accept");
        };

        const btnCookies = document.querySelector(".botao-aceitar");

        btnCookies.addEventListener('click', acceptCookies);
    </script>

