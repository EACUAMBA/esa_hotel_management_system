<?php 
require_once("cabecalho.php");
$url = $_GET['nome'];
$query = $pdo->query("SELECT * from categorias_quartos where nome_url = '$url'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
$id = $res[0]['id'];
  $nome = $res[0]['nome'];
  $nome_url = $res[0]['nome_url'];
  $descricao = $res[0]['descricao'];
  $especificacoes = $res[0]['especificacoes'];
  $valor = $res[0]['valor'];
  $foto = $res[0]['foto']; 
  $ativo = $res[0]['ativo'];
  
  $valorF = number_format($valor, 2, ',', '.');  
  $descricaoF = mb_strimwidth($descricao, 0, 100, "...");

  $especificacoesF = str_replace('**', '<br><i class="fa fa-check" style="color:#383838"></i> ', $especificacoes);
}else{
  echo 'Esse quarto não existe!';
  exit();
}
 ?>
     
 
  <!--Indoor Pool-->
      <section class="section section-md bg-secondary-4 text-center text-sm-left">
        <div class="shell">
          <div class="range range-50 range-md-justify range-sm-middle">
            <div class="cell-sm-6 cell-md-5">
              <h3><?php echo $nome ?></h3>
              <p style="color:#707070"><?php echo $descricao ?></p>
              <h6>Especificações</h6>
              <p style="color:#707070"><i class="fa fa-check" style="color:#383838"></i> <?php echo $especificacoesF ?></p>
             
            </div>
            <div class="cell-sm-6">
              <div class="box-outline box-outline__mod-1">
                <figure><img src="sistema/painel/images/quartos/<?php echo $foto ?>" alt="" width="546" height="546"/>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </section>


      <?php 
               $query = $pdo->query("SELECT * from fotos_quartos where quarto = '$id' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
             ?>

      <!-- Portfolio-->
      <section class="section section-md bg-white text-center text-sm-left">
        <div class="shell-wide">
          
          <div class="isotope-wrap">
            <!-- Isotope Content-->
            <div class="row isotope" data-isotope-layout="masonry" data-isotope-group="gallery" data-lightgallery="group">
              <div class="col-xs-12 col-sm-6 col-md-3 grid-sizer"></div>

               <?php 
              for($i=0; $i<$linhas; $i++){
  $id_foto = $res[$i]['id'];
  $foto = $res[$i]['foto'];
  ?>
              <div class="col-xs-12 col-sm-6 col-md-3 isotope-item wow fadeInUp" data-filter="Category 1" data-wow-delay=".1s"><a class="portfolio-item thumbnail-classic" href="sistema/painel/images/quartos/<?php echo $foto ?>" data-size="1199x800" data-lightgallery="item"><img src="sistema/painel/images/quartos/<?php echo $foto ?>" alt="" style="width:370px; height:280px"/>
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

        
