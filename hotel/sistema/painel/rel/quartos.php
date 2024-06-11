<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));	


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
						<b><big>RELATÓRIO DE QUARTOS DISPONÍVEIS</big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 12px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					
					
					<td style="width:10%">QUARTO</td>
					<td style="width:50%">TIPO QUARTO</td>	
					<td style="width:40%">VALOR</td>	
					
					
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



		<table style="width: 100%; table-layout: fixed; font-size:11px; text-transform: uppercase;">
			<thead>
				<tbody>
					
					<?php 
						$quartos_disponiveis = 0;
$quartos_ocupados = 0;
$query = $pdo->query("SELECT * from quartos where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_quartos = @count($res);
if($total_quartos > 0){
	for($i=0; $i<$total_quartos; $i++){
		$id_quarto = $res[$i]['id'];
		$tipo_quarto = $res[$i]['tipo'];

		//verificar se o quarto tem checkin no dia
		$query3 = $pdo->query("SELECT * from reservas where quarto = '$id_quarto' and check_in = '$dataInicial' and hora_checkout is null order by id desc");
		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res3) == 0){
		
		//verificar se nesta data já possui reserva para o quarto
		$query2 = $pdo->query("SELECT * from reservas where (quarto = '$id_quarto' and check_in <= '$dataInicial' and check_out > '$dataInicial') or (quarto = '$id_quarto' and check_in < '$dataFinal' and check_out > '$dataFinal') order by id desc");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

		if(@count($res2) > 0){
			$quartos_ocupados += 1;
		}else{
			$quartos_disponiveis += 1;

			$query2 = $pdo->query("SELECT * from categorias_quartos where id = '$tipo_quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_tipo = @$res2[0]['nome'];
	$valor_tipo = @$res2[0]['valor'];

	$valor_tipoF = number_format($valor_tipo, 2, ',', '.');  
	
	$query2 = $pdo->query("SELECT * from quartos where id = '$id_quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$numero_quarto = @$res2[0]['numero'];
		
		

					 ?>

  	 
      <tr>
<td style="width:10%"><?php echo $numero_quarto ?></td>
<td style="width:50%"><?php echo $nome_tipo ?></td>
<td style="width:40%">R$ <?php echo $valor_tipoF ?></td>
    </tr>

<?php } } } } 

if($total_quartos > 0 and $quartos_disponiveis > 0){
    $porcentagemQuartos = ($quartos_disponiveis / $total_quartos) * 100;
}else{
    $porcentagemQuartos = 0;
}
?>
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


