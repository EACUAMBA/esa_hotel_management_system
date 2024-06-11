<?php 

//verificar se ele tem a permissão de estar nessa página
if(@$home == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$query = $pdo->query("SELECT * from reservas where check_in = '$data_atual'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_checkin = @count($res);

$query = $pdo->query("SELECT * from reservas where check_out = '$data_atual'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_checkout = @count($res);

$query = $pdo->query("SELECT * from reservas where data = '$data_atual'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$reservas_hoje = @count($res);

$query = $pdo->query("SELECT * from produtos where estoque < nivel_estoque and ativo = 'Sim' and tem_estoque = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque_baixo = @count($res);

$query = $pdo->query("SELECT * from hospedes");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_hospedes = @count($res);

$quartos_disponiveis = 0;
$quartos_ocupados = 0;
$query = $pdo->query("SELECT * from quartos where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_quartos = @count($res);
if($total_quartos > 0){
	for($i=0; $i<$total_quartos; $i++){
		$id_quarto = $res[$i]['id'];

		//verificar se o quarto tem checkin no dia
		$query3 = $pdo->query("SELECT * from reservas where quarto = '$id_quarto' and check_in = curDate() and hora_checkout is null order by id desc");
		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res3) == 0){
		
		//verificar se nesta data já possui reserva para o quarto
		$query2 = $pdo->query("SELECT * from reservas where (quarto = '$id_quarto' and check_in <= curDate() and check_out > curDate()) or (quarto = '$id_quarto' and check_in < curDate() and check_out > curDate())");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$quartos_ocupados += 1;
		}else{
			$quartos_disponiveis += 1;
		}

	}
		
}
}

if($total_quartos > 0 and $quartos_disponiveis > 0){
    $porcentagemQuartos = ($quartos_disponiveis / $total_quartos) * 100;
}else{
    $porcentagemQuartos = 0;
}



$query = $pdo->query("SELECT * from reservas where check_in = '$data_atual' and hora_checkin != ''");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_checkin_conc = @count($res);

if($total_checkin_conc > 0 and $total_checkin > 0){
    $porcentagemCheckin = ($total_checkin_conc / $total_checkin) * 100;
}else{
    $porcentagemCheckin = 0;
}


$query = $pdo->query("SELECT * from reservas where check_out = '$data_atual' and hora_checkout != ''");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_checkout_conc = @count($res);

if($total_checkout_conc > 0 and $total_checkout > 0){
    $porcentagemCheckout = ($total_checkout_conc / $total_checkout) * 100;
}else{
    $porcentagemCheckout = 0;
}


//grafico de linhas
$meses = 6;
$mes_atual = date('m');
$ano_atual = date('Y');
$data_inicio_mes_atual = $ano_atual.'-'.$mes_atual.'-01';
$data_inicio_apuracao = date('Y-m-d', strtotime("-$meses months",strtotime($data_inicio_mes_atual)));
$datas_apuracao = '';
$datas_apuracao_final = '';

$total_receber_final = '';
$total_pagar_final = '';
for($cont=0; $cont<$meses; $cont++){

	$datas_apuracao = date('Y-m-d', strtotime("+$cont months",strtotime($data_inicio_apuracao)));

	$mes = date('m', strtotime($datas_apuracao));
	$ano = date('Y', strtotime($datas_apuracao));

	if($mes == '04' || $mes == '06' || $mes == '09' || $mes == '11'){
		$data_final_mes = '30';
	}else if($mes == '2'){
		$data_final_mes = '28';
	}else{
		$data_final_mes = '31';
	}
	
	$data_final_mes_completa = $ano.'-'.$mes.'-'.$data_final_mes;	
	//percorrer os meses totalizando os valores

$query = $pdo->query("SELECT * from receber where data_pgto >= '$datas_apuracao' and data_pgto<= '$data_final_mes_completa' and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total = @count($res);
$total_receber = 0;
$total_receberF = 0;
if($total > 0){
	for($i=0; $i<$total; $i++){		
		$valor = $res[$i]['valor'];
		$total_receber += $valor;		
	}
}


$query = $pdo->query("SELECT * from pagar where data_pgto >= '$datas_apuracao' and data_pgto<= '$data_final_mes_completa' and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total = @count($res);
$total_pagar = 0;
$total_pagarF = 0;
if($total > 0){
	for($i=0; $i<$total; $i++){		
		$valor = $res[$i]['valor'];
		$total_pagar += $valor;		
	}
}

	
		$total_receber_final .= $total_receber.'*';		
		$total_pagar_final .= $total_pagar.'*';
		

	$datas_apuracaoF = implode('/', array_reverse(explode('-', $datas_apuracao)));

	$datas_apuracao_final .= $datas_apuracaoF.'*';
}	


$total_reservas_meses = '';
//valores para grafico de barras
for($cont=1; $cont<=12; $cont++){
	if($cont < 10){
		$mes = '0'.$cont;
	}else{
		$mes = $cont;
	}
$data_inicio_mes = $ano_atual.'-'.$mes.'-01';

if($mes == '04' || $mes == '06' || $mes == '09' || $mes == '11'){
		$data_final_mes = '30';
	}else if($mes == '2'){
		$data_final_mes = '28';
	}else{
		$data_final_mes = '31';
	}

$data_inicio_mes = $ano_atual.'-'.$mes.'-01';
$data_fim_mes = $ano_atual.'-'.$mes.'-'.$data_final_mes;

$query = $pdo->query("SELECT * from reservas where data >= '$data_inicio_mes' and data <= '$data_fim_mes'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reservas_mes = @count($res);
$total_reservas_meses .= $total_reservas_mes.'*';
}


 ?>


<div class="main-page margin_mobile">

	<?php if($ativo_sistema == ''){ ?>
<div style="background: #ffc341; color:#3e3e3e; padding:10px; font-size:14px; margin-bottom:10px">
<div><i class="fa fa-info-circle"></i> <b>Aviso: </b> Prezado Cliente, não identificamos o pagamento de sua última mensalidade, entre em contato conosco o mais rápido possivel para regularizar o pagamento, caso contário seu acesso ao sistema será desativado.</div>
</div>
<?php } ?>

	<div class="col_3">
		<a href="reservas">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-calendar icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_checkin ?></strong></h5>
					<span><small>Check-In Hoje</small></span>
				</div>
			</div>
		</div>
		</a>
		<a href="reservas">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-laptop user1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_checkout ?></strong></h5>
					<span><small>Check-Out Hoje</small></span>
				</div>
			</div>
		</div>
		</a>
		<a href="reservas">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-money user2 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $reservas_hoje ?></strong></h5>
					<span><small>Reservas Hoje</small></span>
				</div>
			</div>
		</div>
		</a>
		<a href="estoque_baixo">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $estoque_baixo ?></strong></h5>
					<span><small>Estoque Baixo</small></span>
				</div>
			</div>
		</div>
		</a>
		<a href="hospedes">
		<div class="col-md-3 widget">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-users dollar2 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_hospedes ?></strong></h5>
					<span><small>Total Hóspedes</small></span>
				</div>
			</div>
		</div>
		</a>
		<div class="clearfix"> </div>
	</div>
	
	<div class="row-one widgettable">
		<div class="col-md-8 content-top-2 card">
			<div class="agileinfo-cdr altura_grafico">
				<div class="card-header">
					<h3>Recebimentos / Despesa</h3>
				</div>
				
				<div id="Linegraph" style="width: 98%; height: 350px">
				</div>
				
			</div>
		</div>
		<div class="col-md-4 stat">
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Quartos Disponíveis</h5>
					<label><?php echo $quartos_disponiveis ?> / <?php echo $total_quartos ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $porcentagemQuartos ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Check_In Concluídos</h5>
					<label><?php echo $total_checkin_conc ?> / <?php echo $total_checkin ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $porcentagemCheckin ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Check-Out Concluídos</h5>
					<label><?php echo $total_checkout_conc ?> / <?php echo $total_checkout ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $porcentagemCheckout ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		


		<div class="clearfix"> </div>
	</div>
	
	
	<div class="row-one widgettable">
		<div class="col-md-12 content-top-2 card" style="padding:20px">
			<div class="card-header">
				<h3>Reservas Efetuadas</h3>
			</div>			
				<canvas id="canvas" style="width: 100%; height:450px;"></canvas>
				
		</div>	
	</div>

	
</div>




<!-- for index page weekly sales java script -->
<script src="js/SimpleChart.js"></script>
<script>

	var meses = "<?=$datas_apuracao_final?>";
	var dados = meses.split("*"); 

	var receber = "<?=$total_receber_final?>";
	var dados_receber = receber.split("*"); 

	var pagar = "<?=$total_pagar_final?>";
	var dados_pagar = pagar.split("*"); 


	var maior_valor_linha_pagar = Math.max(...dados_pagar);
	var maior_valor_linha_receber = Math.max(...dados_receber);
	var maior_valor = Math.max(maior_valor_linha_pagar, maior_valor_linha_receber);
	maior_valor = parseFloat(maior_valor) + 200;
	    	
	var menor_valor_linha_pagar = Math.min(...dados_pagar);
	var menor_valor_linha_receber = Math.min(...dados_receber);
	var menor_valor = Math.min(menor_valor_linha_pagar, menor_valor_linha_receber);



	var graphdata1 = {
		linecolor: "#c91508",
		title: "Despesas",
		values: [
		{ X: dados[0], Y: dados_pagar[0] },
		{ X: dados[1], Y: dados_pagar[1] },
		{ X: dados[2], Y: dados_pagar[2] },
		{ X: dados[3], Y: dados_pagar[3] },
		{ X: dados[4], Y: dados_pagar[4] },
		{ X: dados[5], Y: dados_pagar[5] },
		
		]
	};
	var graphdata2 = {
		linecolor: "#00CC66",
		title: "Recebimentos",
		values: [
		{ X: dados[0], Y: dados_receber[0] },
		{ X: dados[1], Y: dados_receber[1] },
		{ X: dados[2], Y: dados_receber[2] },
		{ X: dados[3], Y: dados_receber[3] },
		{ X: dados[4], Y: dados_receber[4] },
		{ X: dados[5], Y: dados_receber[5] },
		
		]
	};


	var dataRangeLinha = {
    		linecolor: "transparent",
    		title: "",
    		values: [
    		{ X: dados[0], Y: menor_valor },
    		{ X: dados[1], Y: menor_valor },
    		{ X: dados[2], Y: menor_valor },
    		{ X: dados[3], Y: menor_valor },
    		{ X: dados[4], Y: menor_valor },
    		{ X: dados[5], Y: maior_valor },
    		
    		]
    	};


	$("#Linegraph").SimpleChart({
    			ChartType: "Line",
    			toolwidth: "50",
    			toolheight: "25",
    			axiscolor: "#E6E6E6",
    			textcolor: "#6E6E6E",
    			showlegends: true,
    			data: [graphdata2, graphdata1, dataRangeLinha],
    			legendsize: "30",
    			legendposition: 'bottom',
    			xaxislabel: 'Datas',
    			title: 'Demonstrativo de Contas',
    			yaxislabel: 'Total de Contas R$',
    			responsive: true,
    		});
	
</script>
<!-- //for index page weekly sales java script -->



<!-- GRAFICO DE BARRAS -->
	<script type="text/javascript">
		$(document).ready(function() {

			var reservas = "<?=$total_reservas_meses?>";
			var dados = reservas.split("*");  

		   
				var color = Chart.helpers.color;
				var barChartData = {
					labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
					datasets: [{
						label: '',
						backgroundColor: color('blue').alpha(0.5).rgbString(),
						borderColor: 'blue',
						borderWidth: 1,
						data: [
						dados[0],
						dados[1],
						dados[2],
						dados[3],
						dados[4],
						dados[5],
						dados[6],
						dados[7],
						dados[8],
						dados[9],
						dados[10],
						dados[11]
						
						]
					}, 
					]

				};

			var ctx = document.getElementById("canvas").getContext("2d");
					window.myBar = new Chart(ctx, {
						type: 'bar',
						data: barChartData,
						options: {
							responsive: true,
							legend: {
								position: '',
							},
							title: {
								display: true,
								text: 'Reservas Efetuadas nos Mêses'
							}
						}
					});

	})
	
	</script>