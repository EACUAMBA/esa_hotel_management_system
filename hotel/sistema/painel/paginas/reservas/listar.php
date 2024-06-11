<?php 
$tabela = 'reservas';
require_once("../../../conexao.php");
$data_atual = date('Y-m-d');

$data = @$_POST['p1'];
$filtro = @$_POST['p2'];
$id_quarto = @$_POST['p3'];

if($filtro == ""){
	$filtro = 'check_in';
}

if($data == ""){
	$data = date('Y-m-d');
}

$data_calend = $data;
if($id_quarto == ""){
	$query = $pdo->query("SELECT * from $tabela where $filtro = '$data' order by hora_checkout asc");
}else{
	$query = $pdo->query("SELECT * from $tabela where $filtro = '$data' and quarto = '$id_quarto' order by hora_checkout asc");	
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
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
	$hora_checkin = $res[$i]['hora_checkin'];
	$hora_checkout = $res[$i]['hora_checkout'];
	$funcionario_checkin = $res[$i]['funcionario_checkin'];
	$funcionario_checkout = $res[$i]['funcionario_checkout'];
	$tipo_pgto_checkin = $res[$i]['tipo_pgto_checkin'];
	$tipo_pgto_checkout = $res[$i]['tipo_pgto_checkout'];
	$valor_checkout = $res[$i]['valor_checkout'];
	$valor_checkin = $res[$i]['valor_checkin'];



	$query2 = $pdo->query("SELECT * from categorias_quartos where id = '$tipo_quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_tipo = @$res2[0]['nome'];
	$nome_tipoF = mb_strimwidth($nome_tipo, 0, 9, "");

	$query2 = $pdo->query("SELECT * from quartos where id = '$quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$numero_quarto = @$res2[0]['numero'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario_checkin'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func_checkin = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario_checkout'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func_checkout = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from hospedes where id = '$hospede'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_hospede = @$res2[0]['nome'];
	$bi = @$res2[0]['bi'];
	$telefone_hospede = @$res2[0]['telefone'];
	$placa_hospede = @$res2[0]['placa'];

	$query2 = $pdo->query("SELECT * from formas_pgto where id = '$forma_pgto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$forma_pgto_nome = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from formas_pgto where id = '$tipo_pgto_checkin'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$forma_pgto_checkin = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from formas_pgto where id = '$tipo_pgto_checkout'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$forma_pgto_checkout = @$res2[0]['nome'];

	$nome_hospedeF = mb_strimwidth($nome_hospede, 0, 20, "...");
	$check_inF = implode('/', array_reverse(explode('-', $check_in)));
	$check_outF = implode('/', array_reverse(explode('-', $check_out)));

	$diferenca = $valor - $no_show;

	$restante_reserva = $diferenca - $valor_checkin;
	$restante_reservaF = number_format($restante_reserva, 2, ',', '.'); 



	$valorF = number_format($valor, 2, ',', '.');  
	$no_showF = number_format($no_show, 2, ',', '.');  
	$valor_checkoutF = number_format($valor_checkout, 2, ',', '.');  
	$valor_checkinF = number_format($valor_checkin, 2, ',', '.');  

	$diferencaF = number_format($diferenca, 2, ',', '.');  

	

	if($obs != ""){
		$classe_obs = '';
	}else{
		$classe_obs = 'ocultar';
	}

	if($hora_checkin == ""){
		$classe_excluir = '';
	}else{
		$classe_excluir = 'ocultar';
	}

$valorCheckout = 0;
$query2 = $pdo->query("SELECT * from receber where (referencia = 'Venda' or referencia = 'Serviço') and pago = 'Não' and id_ref = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$linhas2 = @count($res2);
if($linhas2 > 0){
	for($i2=0; $i2<$linhas2; $i2++){
		$valorCheckout += $res2[$i2]['valor'];
	}
}

$valorCheckout += $restante_reserva;

if($valor_checkout != ""){
	$valorCheckout = $valor_checkoutF;
	$classe_checkout = '100';
}else{
	$classe_checkout = '0';
}

if($hora_checkin != ""){	
$classe_checkin = '100';
}else{
	$classe_checkin = '0';
}


echo <<<HTML
<div class="col-md-4 widget" style="margin-right: 5px; margin-bottom: 5px">
			<div class="r3_counter_box">

			<li class="dropdown head-dpdn2" style="display: inline-block; position:absolute; right:0px; top:-5px">
		<a title="Excluir ou Cancelar Reserva" style="" href="#" class="dropdown-toggle {$classe_excluir}" data-toggle="dropdown" aria-expanded="false"><img src="images/delete.png" width="8px"></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir_reserva('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>
				
		<li class="dropdown head-dpdn2" style="display:inline">
		<a title="Detalhes da Reserva" style="" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="pull-left fa imagem_fundo" style="filter: grayscale({$classe_checkout}%);"></i></a>

		<ul class="dropdown-menu" style="margin-left:-100px; margin-top: -50px">
		<li>
		<div class="notification_desc2">
		<p style="font-size: 13px">
		<a href="rel/reserva_class.php?id={$id}" target="_blank">
		<small><span class="fa fa-file-pdf-o text-danger" style="position:absolute; right:10px; top:-12px; width:15px"></span></small>
		</a>
		<b>Nome</b> {$nome_hospede}<br> 
		<b>BI</b> {$bi} / <b>Tel:</b> {$telefone_hospede}<br>
		<b>Quantidade de Hóspedes</b> {$hospedes}<br>
		<b>Valor</b> R$ {$valorF} / <b>Entrada</b> R$ {$no_showF}<br>
		<b>Forma de Pagamento</b> {$forma_pgto_nome}<br>
		<b>Lançador Por</b> {$nome_func}<br>
		<span class="{$classe_obs}"><br><b>OBS:</b> {$obs}</span>
		</p>
		</div>
		</li>										
		</ul>
</li>
				
				<div class="stats">
					<h5 style="font-size:16px"><strong>{$numero_quarto} ({$nome_tipoF}) 
					<a title="Editar Reserva" href="#" onclick="editar('{$id}', '{$hospede}', '{$check_in}', '{$check_out}', '{$tipo_quarto}', '{$quarto}', '{$valor_diaria}', '{$valor}', '{$no_show}', '{$hospedes}', '{$obs}', '{$desconto}', '{$forma_pgto}')"><img style="margin-left: 10px" src="images/edit.png" width="15px"></a>
					</strong></h5>
					<span style="font-size:13px">{$nome_hospedeF}</span>
					</div>
					<hr style="margin-bottom:1px">
					<div align="center" style="font-size:12px; "> 
					<a href="#" onclick="fazer_checkin('{$id}', '{$nome_hospede}', '{$quarto}', '{$valorF}', '{$no_showF}', '{$diferenca}', '{$obs}', '{$hospedes}','{$placa_hospede}','{$hora_checkin}','{$telefone_hospede}','{$nome_func_checkin}','{$forma_pgto_checkin}', '{$check_in}', '{$numero_quarto}', '{$diferencaF}', '{$valor_checkinF}')" title="Efetuar Check-In"><img src="images/data-green.png" width="17px" style="filter: grayscale({$classe_checkin}%);"></a> {$check_inF}
					<a href="#" onclick="fazer_checkout('{$id}', '{$nome_hospede}', '{$quarto}', '{$valorCheckout}',  '{$obs}', '{$hospedes}','{$hora_checkout}','{$telefone_hospede}','{$nome_func_checkout}','{$forma_pgto_checkout}', '{$check_out}', '{$hora_checkin}', '{$numero_quarto}', '{$restante_reserva}', '{$restante_reservaF}')" title="Efetuar Check-Out"><img style="margin-left: 10px; filter: grayscale({$classe_checkout}%);" src="images/data-red.png" width="17px"></a> {$check_outF} </div>
			</div>
</div>
HTML;
}

}else{
	echo '<small>Nenhum registro Cadastrado!</small><br>';
}
echo <<<HTML
<div style="margin-top: 10px; position:fixed; bottom:10px; right:10px">
<div style="font-size:14px">
	<span style="margin-right: 7px;float:left;"><span class="quadrado_quarto_menor" style="background: #23ad35"></span>Disponível</span>
	<span style="margin-right: 7px;float:left;"><div class="quadrado_quarto_menor" style="background: #b52d22"></div>Ocupado</span>
	<span style="margin-right: 7px;float:left;"><div class="quadrado_quarto_menor" style="background: #cf840c"></div>Check-In</span>
	<span style="margin-right: 7px;"><div class="quadrado_quarto_menor" style="background: blue"></div>Check-Out</span>
</div>
HTML;
$query = $pdo->query("SELECT * from quartos where ativo = 'Sim' order by numero asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);

for($i=0; $i<$linhas; $i++){
	$numero = $res[$i]['numero'];
	$id_q = $res[$i]['id'];

	$query2 = $pdo->query("SELECT * from reservas where (quarto = '$id_q' and check_in <= '$data_calend' and check_out >= '$data_calend') or (quarto = '$id_q' and check_in <= '$data_calend' and check_out >= '$data_calend') order by id desc");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		
		if(@count($res2) > 0){
			//ocupado
			$classe_reserva = '#b52d22';			
		}else{	
			//disponivel		
			$classe_reserva = '#23ad35';						
		}

		$query3 = $pdo->query("SELECT * from reservas where quarto = '$id_q' and check_in = '$data_calend' order by id desc");
		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res3) > 0){
			$hora_checkin2 = @$res3[0]['hora_checkin'];
			//checkin
			if($hora_checkin2 != ""){
				$classe_reserva = '#b52d22';	
			}else{
				$classe_reserva = '#cf840c';	
			}
					
		}

		$query3 = $pdo->query("SELECT * from reservas where quarto = '$id_q' and check_out = '$data_calend' order by id desc");
		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res3) > 0){
			$hora_checkout2 = @$res3[0]['hora_checkout'];

			////checkout
			if($hora_checkout2 != ""){
				$classe_reserva = '#b52d22';
			}else{
				$classe_reserva = 'blue';
			}


			//checkin e checkout
			$query3 = $pdo->query("SELECT * from reservas where quarto = '$id_q' and check_in = '$data_calend' order by id desc");
			$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			$hora_checkin3 = @$res3[0]['hora_checkin'];
			if(@count($res3) > 0){

				if($hora_checkin3 != "" and $hora_checkout2 == ""){
					$classe_reserva = 'linear-gradient(45deg, blue 50%, #b52d22 50%)';
				}else if($hora_checkin3 != "" and $hora_checkout2 != ""){
					$classe_reserva = '#23ad35';
				}else{
					$classe_reserva = 'linear-gradient(45deg, blue 50%, #cf840c 50%)';
				}

				
							
			}			
		}

		

		

echo <<<HTML
	<a href="#" onclick="buscar({$id_q})"><div class="quadrado_quarto" style="background:{$classe_reserva};">
	{$numero}
	</div></a>
HTML;
} 
echo <<<HTML
</div>
HTML;
?>


<script type="text/javascript">
	$(document).ready( function () {		
       

	$('.sel2').select2({
		dropdownParent: $('#modalForm')
	});

	$('.sel3').select2({
		dropdownParent: $('#modalCheckin')
	});

	$('.sel4').select2({
		dropdownParent: $('#modalCheckout')
	});

} );
</script>

<script type="text/javascript">
	function editar(id, hospede, check_in, check_out, tipo_quarto, quarto, valor_diaria, valor, noshow, hospedes, obs, desconto, forma_pgto){
		

		$("#btn_form").show();

		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#hospede').val(hospede).change();
    	$('#check_in').val(check_in);
    	$('#check_out').val(check_out);
    	$('#obs').val(obs);
    	$('#desconto').val(desconto);
    	$('#valor_diaria').val(valor_diaria);
    	
    	
    	$('#hospedes').val(hospedes);
    	$('#obs').val(obs);
		
    	$('#forma_pgto').val(forma_pgto).change();

    	$('#id_quarto').val(quarto);
    	

    	$('#tipo_quarto').val(tipo_quarto).change();
    	setTimeout(function(){ 
		    $('#quarto').val(quarto).change();
		    $('#valor_reserva').val(valor);
		}, 300);		

		
		setTimeout(function(){
		 $('#no_show').val(noshow);		   
		}, 400); 
    	
    	
    	$('#modalForm').modal('show');
	}



	function limparCampos(){
		$('#id').val('');
    	$('#numero').val('');
    	$('#descricao').val('');
    	$('#obs').val('');
    	$('#id_quarto').val('');

    	var data = $('#data_agenda').val();
    	$('#check_in').val(data);
    	$('#check_out').val(data);

    	$('#ids').val('');
    	$('#btn-deletar').hide();

    	quartos();
    	$("#btn_form").show();
		$("#img_loading_form").hide();
    	
	}

	function selecionar(id){

		var ids = $('#ids').val();

		if($('#seletor-'+id).is(":checked") == true){
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		}else{
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();
		if(ids_final == ""){
			$('#btn-deletar').hide();
		}else{
			$('#btn-deletar').show();
		}
	}

	function deletarSel(){
		var ids = $('#ids').val();
		var id = ids.split("-");
		
		for(i=0; i<id.length-1; i++){
			excluir(id[i]);			
		}

		limparCampos();
	}


	function fazer_checkin(id, hospede, quarto, valor, noshow, diferenca, obs, hospedes, placa, hora, telefone, funcionario, tipo_pgto, data, numero, diferencaF, valor_checkin){
		
		if(hora == ""){			

			var data_atual = '<?=$data_atual?>';
		if(data != data_atual){
			//alert('Você só pode efetuar o checkin na data do checkin!');
			//return;
		}

		$('#modalCheckin').modal('show');

			$('#mensagem_checkin').text('');
	    	$('#titulo_checkin').text('CheckIn: '+hospede);

	    	$('#id_checkin').val(id);
	    	$('#id_hospedes').val(id);
	    	$('#quarto_checkin').val(numero);
	    	$('#valor_checkin').val(valor);
	    	$('#noshow_checkin').val(noshow);
	    	$('#diferenca_checkin').val(diferenca);
	    	$('#obs_checkin').val(obs);
	    	$('#hospedes_checkin').val(hospedes);
	    	$('#placa_checkin').val(placa);

	    	$('#total_restante').text(diferencaF);

	    	$('#modalCheckin').modal('show');
	    	listar_hosp(id);	
		}else{
			$('#titulo_checkin_dados').text('Detalhamento CheckIn');

			$('#hospede_dados').text(hospede);
	    	$('#quarto_dados').text(quarto);
	    	$('#hospedes_dados').text(hospedes);
	    	//$('#telefone_dados').text(telefone);

	    	$('#valor_dados').text('R$ ' + valor_checkin);
	    	$('#func_dados').text(funcionario);
	    	$('#hora_dados').text(hora);
	    	$('#pgto_dados').text(tipo_pgto);

	    	$('#obs_dados').text(obs);
	    	if(obs == ""){
	    		$('#div_obs_dados').hide();
	    	}else{
	    		$('#div_obs_dados').show();
	    	}

	    	listar_hosp_dados(id);

			$('#modalCheckinDados').modal('show');
		}
		
	}



	function fazer_checkout(id, hospede, quarto, valor, obs, hospedes,  hora, telefone, funcionario, tipo_pgto, data, hora_checkin, numero, restante, restanteF){


		if(hora_checkin == ""){	
			alert('Faça Primeiro o checkin!');
			return;	
		}
		
		if(hora == ""){	
		$('#modalCheckout').modal('show');

			$('#mensagem_checkout').text('');
	    	$('#titulo_checkout').text('CheckOut: '+hospede);

	    	$('#id_checkout').val(id);
	    	$('#id_hospedes_checkout').val(id);
	    	$('#quarto_checkout').val(numero);
	    	$('#valor_checkout').val(valor);	    	
	    	$('#obs_checkout').val(obs);
	    	$('#hospedes_checkout').val(hospedes);

	    	$('#restante_checkout').val(restante);
	    	
	    	$('#modalCheckout').modal('show');
	    	listar_hosp_checkout(id);	
		}else{

			$('#titulo_checkout_dados').text('Detalhamento CheckOut');

			$('#hospede_dados_checkout').text(hospede);
	    	$('#quarto_dados_checkout').text(quarto);
	    	$('#hospedes_dados_checkout').text(hospedes);
	    	//$('#telefone_dados').text(telefone);

	    	$('#valor_dados_checkout').text('R$ ' + valor);
	    	$('#func_dados_checkout').text(funcionario);
	    	$('#hora_dados_checkout').text(hora);
	    	$('#pgto_dados_checkout').text(tipo_pgto);

	    	$('#obs_dados_checkout').text(obs);
	    	if(obs == ""){
	    		$('#div_obs_dados_checkout').hide();
	    	}else{
	    		$('#div_obs_dados_checkout').show();
	    	}

	    	listar_hosp_dados_checkout(id);

			$('#modalCheckoutDados').modal('show');
		}
		
	}
</script>