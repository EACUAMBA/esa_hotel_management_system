<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$id = $_GET['id'];

$query = $pdo->query("SELECT * from reservas where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas == 0){
	echo 'Reserva não encontrada!';
	exit();
}else{
	$hospede = $res[0]['hospede'];
	$tipo_quarto = $res[0]['tipo_quarto'];
	$quarto = $res[0]['quarto'];
	$funcionario = $res[0]['funcionario'];
	$check_in = $res[0]['check_in'];
	$check_out = $res[0]['check_out'];
	$valor = $res[0]['valor'];
	$no_show = $res[0]['no_show'];
	$hospedes = $res[0]['hospedes'];
	$obs = $res[0]['obs'];
	$valor_diaria = $res[0]['valor_diaria'];
	$data = $res[0]['data'];
	$desconto = $res[0]['desconto'];
	$forma_pgto = $res[0]['forma_pgto'];
	
	$query2 = $pdo->query("SELECT * from quartos where id = '$quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$numero_quarto = @$res2[0]['numero'];

	
	$query2 = $pdo->query("SELECT * from hospedes where id = '$hospede'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_hospede = @$res2[0]['nome'];
	$bi = @$res2[0]['bi'];
	$telefone_hospede = @$res2[0]['telefone'];

	
}

$texto_filtro = 'HÓSPEDE RESPONSÁVEL: '.$nome_hospede;
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
						<b><big>DETALHAMENTO DE CONSUMO QUARTO <?php echo $numero_quarto ?></big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:27%">DESCRIÇÃO</td>
					<td style="width:10%">VALOR</td>
					<td style="width:9%">DATA</td>
					<td style="width:9%">HORA</td>
					<td style="width:22%">HÓSPEDE</td>
					<td style="width:22%">FUNCIONÁRIO</td>
					
					
					
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



		<table style="width: 100%; table-layout: fixed; font-size:9px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php 
$total_servicos = 0;
$total_consumo = 0;
$total_final = 0;
$total_servicosF = 0;
$total_consumoF = 0;
$total_finalF = 0;
$query = $pdo->query("SELECT * from receber where (referencia = 'Venda' or referencia = 'Serviço') and pago = 'Não' and id_ref = '$id' order by data_lanc asc, hora asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
$descricao = $res[$i]['descricao'];
$valor = $res[$i]['valor'];
$data_lanc = $res[$i]['data_lanc'];
$data_venc = $res[$i]['data_venc'];
$data_pgto = $res[$i]['data_pgto'];
$usuario_lanc = $res[$i]['usuario_lanc'];
$usuario_pgto = $res[$i]['usuario_pgto'];
$arquivo = $res[$i]['arquivo'];
$pago = $res[$i]['pago'];
$obs = $res[$i]['obs'];
$hospede = $res[$i]['hospede'];
$hora = $res[$i]['hora'];
$referencia = $res[$i]['referencia'];

$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
$valorF = number_format($valor, 2, ',', '.');
$horaF = date("H:i", strtotime($hora));

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}

$query2 = $pdo->query("SELECT * FROM hospedes where id = '$hospede'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_hospede = $res2[0]['nome'];
}else{
	$nome_hospede = '';
}

if($referencia == 'Venda'){
	$total_consumo += $valor;
}else{
	$total_servicos += $valor;
}

$total_final = $total_consumo + $total_servicos;

$total_consumoF = number_format($total_consumo, 2, ',', '.');
$total_servicosF = number_format($total_servicos, 2, ',', '.');
$total_finalF = number_format($total_final, 2, ',', '.');

  	 ?>

  	 
      <tr>
<td style="width:27%"><?php echo $descricao ?></td>
<td style="width:10%; color:red">R$ <?php echo $valorF ?></td>
<td style="width:9%"><?php echo $data_lancF ?></td>
<td style="width:9%; "><?php echo $horaF ?></td>
<td style="width:22%; "><?php echo $nome_hospede ?></td>
<td style="width:22%"><?php echo $nome_usu_lanc ?></td>

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
						<td style="font-size: 10px; width:340px; text-align: right;"></td>

						<td style="font-size: 10px; width:130px; text-align: right;"><b>Total Serviços:</b>R$ <?php echo $total_servicosF ?></td>

							<td style="font-size: 10px; width:140px; text-align: right;"><b>Total Consumo:</b> R$ <?php echo $total_consumoF ?></td>

						<td style="font-size: 10px; width:130px; text-align: right;"><b>Total Geral:</b><span style="color:red">R$ <?php echo $total_finalF ?></span></td>
						
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>


