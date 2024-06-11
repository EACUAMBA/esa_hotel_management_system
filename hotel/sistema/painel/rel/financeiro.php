<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$filtro_data = $_GET['filtro_data'];
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$filtro_tipo = $_GET['filtro_tipo'];
$filtro_lancamento = $_GET['filtro_lancamento'];
$filtro_pendentes = $_GET['filtro_pendentes'];

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));	

$filtro_tipoF = "";
if($filtro_tipo == "receber"){
	$filtro_tipoF = 'ENTRADAS / GANHOS';
	$classe_entradas = 'green'; 
}else{
	$filtro_tipoF = 'SAÍDAS / DESPESAS';
	$classe_entradas = 'red'; 
}


$filtro_dataF = "";
if($filtro_data == "data_lanc"){
	$filtro_dataF = 'DATA DE LANÇAMENTO'; 
}else if($filtro_data == "data_venc"){
	$filtro_dataF = 'DATA DE VENCIMENTO';
}else{
	$filtro_dataF = "DATA DE PAGAMENTO";
}


$filtro_lancamentoF = "";
if($filtro_lancamento != ""){
	if($filtro_lancamento == 'Conta'){
		if($filtro_tipo == 'receber'){
			$filtro_lancamentoF = 'Recebimentos';
		}else{
			$filtro_lancamentoF = 'Contas / Despesas';
		}
	}else{
		if($filtro_lancamento == 'Entrada'){
			$filtro_lancamentoF = 'NO-SHOW';
		}else if($filtro_lancamento == 'Restante'){
			$filtro_lancamentoF = 'RESTANTE RESERVA';
		}else{
			$filtro_lancamentoF = $filtro_lancamento;
		}
		
	}
	
}

$filtro_pendentesF = "";
if($filtro_pendentes == "Não"){
	$filtro_pendentesF = 'PENDENTES'; 
}else if($filtro_pendentes == "Sim"){
	$filtro_pendentesF = 'PAGAS';
}else{
	$filtro_pendentesF = "";
}


$datas = "";
if($dataInicial == $dataFinal){
	$datas = $dataInicialF;
}else{
	$datas = $dataInicialF.' à '.$dataFinalF;
}

$texto_filtro = $filtro_dataF.' : '.$datas.' '.$filtro_pendentesF;



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
				<td style="width: 30%; text-align: left; font-size: 13px;">
				<?php echo mb_strtoupper($nome_sistema) ?>	
				</td>
				<td style="width: 1%; text-align: center; font-size: 13px;">
				
				</td>
				<td style="width: 47%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>RELATÓRIO DE <span style="color:<?php echo $classe_entradas ?>"><?php echo $filtro_tipoF ?> <?php if($filtro_lancamentoF != ""){ echo '('. mb_strtoupper($filtro_lancamentoF).')'; } ?></span></big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 8px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:22%">DESCRIÇÃO</td>
					<td style="width:10%">VALOR</td>
					<td style="width:12%">DATA LANÇAMENTO</td>
					<td style="width:12%">DATA VENCIMENTO</td>
					<td style="width:12%">DATA PAGAMENTO</td>
					<td style="width:17%">RECEBIDO POR</td>	
					<td style="width:15%">REFERÊNCIA</td>		
					
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

$total_valor = 0;
$total_valorF = 0;
$total_pendentes = 0;
$total_pendentesF = 0;
$total_pagas = 0;
$total_pagasF = 0;
$pendentes = 0;
$pagas = 0;

$query = $pdo->query("SELECT * from $filtro_tipo where $filtro_data >= '$dataInicial' and $filtro_data <= '$dataFinal' and pago LIKE '%$filtro_pendentes%' and referencia LIKE '%$filtro_lancamento%' order by $filtro_data asc");
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
$referencia = $res[$i]['referencia'];
	

	$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
$valorF = number_format($valor, 2, ',', '.');


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_pgto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_pgto = $res2[0]['nome'];
}else{
	$nome_usu_pgto = '';
}


if($pago == 'Sim'){
	$classe_pago = 'verde.jpg';	
	$total_pagas += $valor;
	$pagas += 1;
}else{
	$classe_pago = 'vermelho.jpg';	
	$total_pendentes += $valor;
	$pendentes += 1;
}


$total_pagasF = number_format($total_pagas, 2, ',', '.');
$total_pendentesF = number_format($total_pendentes, 2, ',', '.');
  	 ?>

  	 
      <tr>
<td style="width:22%">
<img style="margin-top: 0px" src="<?php echo $url_sistema ?>painel/images/<?php echo $classe_pago ?>" width="8px">
	<?php echo $descricao ?></td>
<td style="width:10%">R$ <?php echo $valorF ?></td>
<td style="width:12%"><?php echo $data_lancF ?></td>
<td style="width:12%"><?php echo $data_vencF ?></td>
<td style="width:12%"><?php echo $data_pgtoF ?></td>
<td style="width:17%"><?php echo $nome_usu_pgto ?></td>
<td style="width:15%"><?php echo $referencia ?></td>

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

						<td style="font-size: 10px; width:300px; text-align: right;"></td>

						

						<td style="font-size: 10px; width:70px; text-align: right;"><b>Pendentes: <span style="color:red"><?php echo $pendentes ?></span></td>

							<td style="font-size: 10px; width:70px; text-align: right;"><b>Pagas: <span style="color:green"><?php echo $pagas ?></span></td>


								<td style="font-size: 10px; width:140px; text-align: right;"><b>Pendentes: <span style="color:red">R$ <?php echo $total_pendentesF ?></span></td>

									<td style="font-size: 10px; width:120px; text-align: right;"><b>Pagas: <span style="color:green">R$ <?php echo $total_pagasF ?></span></td>
						
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>


