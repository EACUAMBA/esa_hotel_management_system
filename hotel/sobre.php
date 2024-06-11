<?php 
require_once("cabecalho.php");
 ?>
     
 <section class="section section-md bg-secondary-4 text-center text-sm-left">
        <div class="shell">
          <div class="range range-50 range-md-justify range-sm-middle">
            <div class="cell-sm-6 wow fadeInUp" data-wow-delay=".1s">
              <div class="box-outline box-outline__mod-1">
                <figure><img src="sistema/img/<?php echo $foto_sobre_pagina ?>" alt="" width="546" height="516"/>
                </figure>
              </div>
            </div>
            <div class="cell-sm-6 cell-md-5 wow fadeInUp" data-wow-delay=".2s">
              <h3><?php echo $nome_sistema ?></h3>
              <p style="color:#707070"><?php echo $descricao_sobre1 ?></p>
              <p style="color:#707070"><?php echo $descricao_sobre2 ?></p>
              <p style="color:#707070"><?php echo $descricao_sobre3 ?></p>
              
            </div>
          </div>
        </div>
      </section>  


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

<?php require_once("rodape.php") ?>

        
