<?php 
include('../../conexao.php');

$tipo = $_GET['tipo'];

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$query = $pdo->query("SELECT * from categorias_servicos where id = '$tipo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cat = @$res[0]['nome'];

$nome_tipo = "";
if($tipo != ""){
	$nome_tipo = 'Categoria: '.$nome_cat; 
}

?>
<!DOCTYPE html>
<html>
<head>

<style>

@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');
@page { margin: 145px 20px 25px 20px; }
#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }
#content {margin-top: 0px;}
#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 80px; }
#footer .page:after {content: counter(page, my-sec-counter);}
body {font-family: 'Tw Cen MT', sans-serif;}

.marca{
	position:fixed;
	left:50;
	top:100;
	width:80%;
	opacity:8%;
}

</style>

</head>
<body>
<?php 
if($marca_dagua == 'Sim'){ ?>
<img class="marca" src="<?php echo $url_sistema ?>img/logo.jpg">	
<?php } ?>


<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 50px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr>
				<td style="border: 1px; solid #000; width: 7%; text-align: left;">
					<img style="margin-top: 7px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="45px">
				</td>
				<td style="width: 33%; text-align: left; font-size: 13px;">
				<?php echo mb_strtoupper($nome_sistema) ?>	
				</td>
				<td style="width: 5%; text-align: center; font-size: 13px;">
				
				</td>
				<td style="width: 40%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>RELATÓRIO DE SERVIÇOS</big></b><br> <?php echo mb_strtoupper($nome_tipo) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 8px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:25%">SERVIÇO</td>
					<td style="width:43%">DESCRIÇÃO</td>
					<td style="width:10%">VALOR</td>					
					<td style="width:15%">CATEGORIA</td>
					<td style="width:7%">ATIVO</td>	
					
				</tr>
			</thead>
		</table>
</div>

<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%;">
			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?></td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
		</tr>
	</table>
</div>

<div id="content" style="margin-top: 0;">



		<table style="width: 100%; table-layout: fixed; font-size:8px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php 
$produtos_ativos = 0;
$produtos_inativos = 0;
$estoque_baixo = 0;
$query = $pdo->query("SELECT * from servicos where categoria LIKE '%$tipo%' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$descricao = $res[$i]['descricao'];
	$categoria = $res[$i]['categoria'];
	$valor = $res[$i]['valor'];
	
	$foto = $res[$i]['foto'];	
	$ativo = $res[$i]['ativo'];
	
	$valorF = number_format($valor, 2, ',', '.');  
	
	$descricaoF = mb_strimwidth($descricao, 0, 80, "...");

	if($ativo != 'Sim'){
		$classe_ativo = '#c2c2c2';
		$produtos_inativos += 1;
	}else{
		$classe_ativo = '';
		$produtos_ativos += 1;
	}
	
	
	$query2 = $pdo->query("SELECT * from categorias_servicos where id = '$categoria'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_categoria = $res2[0]['nome'];

	
  	 ?>

  	 
      <tr style="color:<?php echo $classe_ativo ?>">
<td style="width:25%"><?php echo $nome ?></td>
<td style="width:43%"><?php echo $descricao ?></td>
<td style="width:10%">R$ <?php echo $valorF ?></td>
<td style="width:15%"><?php echo $nome_categoria ?></td>
<td style="width:7%;"><?php echo $ativo ?></td>


    </tr>

<?php } } ?>
				</tbody>
	
			</thead>
		</table>
	


</div>
<hr>
		<table>
			<thead>
				<tbody>
					<tr>
						
						<td style="font-size: 10px; width:120px; text-align: right;"></td>
							<td style="font-size: 10px; width:120px; text-align: right;"></td>
								<td style="font-size: 10px; width:120px; text-align: right;"></td>
								<td style="font-size: 10px; width:120px; text-align: right;"></td>
						<td style="font-size: 10px; width:120px; text-align: right;"><b>Serviços Ativos:</b> <?php echo $produtos_ativos ?></td>

						<td style="font-size: 10px; width:120px; text-align: right;"><b>Serviços Inativos:</b> <?php echo $produtos_inativos ?></td>
						
						
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>


