<?php 
$pag = 'filtrar_reservas';

//verificar se ele tem a permissão de estar nessa página
if(@$filtrar_reservas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>
<div class="margin_mobile row">

<form method="post" action="rel/lista_reservas_class.php" target="_blank">
<button type="submit" style="position:absolute; right:30px" class="btn btn-success"><span class="fa fa-file-pdf-o"></span> Relatório</button>

<select class="form-control estilo_block" style="width:150px;" id="filtro" name="filtro" onchange="buscar()">
	<option value="check_in">Data Check-In</option>
	<option value="check_out">Data Check-Out</option>
	<option value="data">Data Lançamento</option>
</select>
<i class="fa fa-search text-primary" style="margin-right: 20px"></i>

<span class="estilo_block">
<span style="margin-right: 5px;"><small>Data Inicial</small></span>
<input type="date" id="dataInicial" name="dataInicial" class="form-control input_data" value="<?php echo $data_atual ?>" onchange="buscar()">
</span>

<span class="estilo_block">
<span style="margin-right: 5px;"><small>Data Final</small></span>
<input type="date" id="dataFinal" name="dataFinal" class="form-control input_data" value="<?php echo $data_atual ?>" onchange="buscar()">
</span>

<input style="width:100px" class="form-control estilo_block" type="text" name="id_reserva" placeholder="ID Reserva" id="id_da_reserva">
<button class="btn btn-info estilo_block" type="button" onclick="buscar()"><i class="fa fa-search"></i></button>

</form>
</div>								

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">

	$(document).ready( function () {	
		 $('.sel').select2({

    	});
	});

	function buscar(){
		var busca = $('#filtro').val();
		var dataInicial = $('#dataInicial').val();
		var dataFinal = $('#dataFinal').val();
		var codigo = $('#id_da_reserva').val();		
		listar(busca, dataInicial, dataFinal, codigo);
		$('#id_da_reserva').val('');
	}

	
</script>



