<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$tipo = $_GET['tipo'];
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));	

$nome_tipo = "";
if($tipo == "check_in"){
	$nome_tipo = 'CHECK-IN'; 
}else if($tipo == "check_out"){
	$nome_tipo = 'CHECK-OUT';
}else{
	$nome_tipo = 'DATA DA VENDA RESERVA';
}

$datas = "";
if($dataInicial == $dataFinal){
	$datas = $dataInicialF;
}else{
	$datas = $dataInicialF.' à '.$dataFinalF;
}

$texto_filtro = "PERÍODO DA APURAÇÃO : ".$datas;



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
						<b><big>RELATÓRIO DE <?php echo $nome_tipo ?></big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 8px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:17%">HÓSPEDE</td>
					<td style="width:14%">TIPO QUARTO</td>
					<td style="width:7%">QUARTO</td>
					<td style="width:9%">CHECK-IN</td>
					<td style="width:9%">CHECK-OUT</td>
					<td style="width:9%">DATA RESERVA</td>	
					<td style="width:9%">VALOR</td>	
					<td style="width:11%">NO-SHOW</td>				
					<td style="width:15%">FUNCIONÁRIO</td>	
					
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



		<table style="width: 100%; table-layout: fixed; font-size:7px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php 
$query = $pdo->query("SELECT * from reservas where $tipo >= '$dataInicial' and $tipo <= '$dataFinal' order by $tipo asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$hospede = $res[$i]['hospede'];
	$tipo_quarto = $res[$i]['tipo_quarto'];
	$quarto = $res[$i]['quarto'];
	$funcionario = $res[$i]['funcionario'];
	$check_in = $res[$i]['check_in'];
	$check_out = $res[$i]['check_out'];
	$valor = $res[$i]['valor'];
	$no_show = $res[$i]['no_show'];
	$hospedes = $res[$i]['hospedes'];
	$obs = $res[$i]['obs'];
	$valor_diaria = $res[$i]['valor_diaria'];
	$data = $res[$i]['data'];
	$desconto = $res[$i]['desconto'];
	$forma_pgto = $res[$i]['forma_pgto'];

	$query2 = $pdo->query("SELECT * from categorias_quartos where id = '$tipo_quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_tipo = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from quartos where id = '$quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$numero_quarto = @$res2[0]['numero'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from hospedes where id = '$hospede'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_hospede = @$res2[0]['nome'];
	$bi = @$res2[0]['bi'];
	$telefone_hospede = @$res2[0]['telefone'];

	$query2 = $pdo->query("SELECT * from formas_pgto where id = '$forma_pgto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$forma_pgto_nome = @$res2[0]['nome'];

	$nome_hospedeF = mb_strimwidth($nome_hospede, 0, 20, "...");
	$check_inF = implode('/', array_reverse(explode('-', $check_in)));
	$check_outF = implode('/', array_reverse(explode('-', $check_out)));
	$dataF = implode('/', array_reverse(explode('-', $data)));

	$restante = $valor - $no_show;

	$valorF = number_format($valor, 2, ',', '.');  
	$no_showF = number_format($no_show, 2, ',', '.');
	$restanteF = number_format($restante, 2, ',', '.');

	if($obs != ""){
		$classe_obs = '';
	}else{
		$classe_obs = 'ocultar';
	}
	
  	 ?>

  	 
      <tr>
<td style="width:17%"><?php echo $nome_hospede ?></td>
<td style="width:14%"><?php echo $nome_tipo ?></td>
<td style="width:7%"><?php echo $numero_quarto ?></td>
<td style="width:9%; color:green"><?php echo $check_inF ?></td>
<td style="width:9%; color:red"><?php echo $check_outF ?></td>
<td style="width:9%"><?php echo $dataF ?></td>
<td style="width:9%">R$ <?php echo $valorF ?></td>
<td style="width:11%">R$ <?php echo $no_showF ?> <span style="color:red">(R$ <?php echo $restanteF ?>)</span></td>
<td style="width:15%"><?php echo $nome_func ?></td>
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
						<td style="font-size: 10px; width:750px; text-align: right;"><b>Total de Reservas: <?php echo $linhas ?></td>
						
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>


