<?php 
$pag = 'reservas';

//verificar se ele tem a permissão de estar nessa página
if(@$reservas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>
<div class="margin_mobile">
	<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Reserva</a>

	<select class="form-control" style="width:150px; display:inline; margin-left: 20px" id="filtro" onchange="buscar()">
		<option value="check_in">Data Check-In</option>
		<option value="check_out">Data Check-Out</option>
		<option value="data">Data Lançamento</option>
	</select>
	<a href="#" onclick="buscar()"><i class="fa fa-search text-primary"></i></a>
</div>								



<input type="hidden" name="data_agenda" id="data_agenda" value="<?php echo date('Y-m-d') ?>"> 

<div class="row" style="margin-top: 15px">

	<div class="col-md-4 agile-calendar">
		<div class="calendar-widget">

			<!-- grids -->
			<div class="agile-calendar-grid">
				<div class="page">

					<div class="w3l-calendar-left">
						<div class="calendar-heading">

						</div>
						<div class="monthly" id="mycalendar"></div>
					</div>

					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-xs-12 col-md-8" style="padding:5px 5px; margin-top: 0px;" id="listar">

	</div>
</div>

<br><br>



<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-reservas">
				<div class="modal-body">


					<div class="row">

						<div class="col-md-6">							
							<label>Hóspede</label>
							<select class="form-control sel2" name="hospede" id="hospede" style="width:100%" required>
								<?php 
								$query = $pdo->query("SELECT * from hospedes where responsavel = 'Sim' order by id desc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								$linhas = @count($res);
								if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
										$nomeF = mb_strimwidth($res[$i]['nome'], 0, 26, "...");
										?>

										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $nomeF ?> - BI <?php echo $res[$i]['bi'] ?></option>

									<?php } }else{ ?>
										<option value="">Cadastre um Hóspede</option>
									<?php } ?>
								</select>									
							</div>


							<div class="col-md-3">							
								<label>Check-In</label>
								<input type="date" class="form-control" id="check_in" name="check_in" placeholder="" value="<?php echo $data_atual ?>" onchange="datas()">							
							</div>

							<div class="col-md-3">							
								<label>Check-Out</label>
								<input type="date" class="form-control" id="check_out" name="check_out" placeholder="" value="<?php echo $data_atual ?>" onchange="datas()">							
							</div>





						</div>


						<div class="row">


							<div class="col-md-4">							
								<label>Tipo Quarto</label>
								<select class="form-control sel2" name="tipo_quarto" id="tipo_quarto" style="width:100%" required onchange="quartos()">
									<?php 
									$query = $pdo->query("SELECT * from categorias_quartos where ativo = 'Sim' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
										for($i=0; $i<$linhas; $i++){
											?>

											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

										<?php } }else{ ?>
											<option value="">Cadastre um Tipo de Quarto</option>
										<?php } ?>
									</select>							
								</div>

								<div class="col-md-2">							
									<label>Quarto</label>
									<select class="form-control sel2" name="quarto" id="quarto" style="width:100%" required onchange="trocarQuarto()">

									</select>							
								</div>					


								<div class="col-md-3">							
									<label>Valor Diária</label>
									<input type="text" class="form-control" id="valor_diaria" name="valor_diaria" onkeyup="calcular()">					
								</div>

								<div class="col-md-3">							
									<label>Valor Reserva</label>
									<input type="text" class="form-control" id="valor_reserva" name="valor_reserva" >					
								</div>


							</div>


							<div class="row">					

								<div class="col-md-3">							
									<label>Valor Desconto</label>
									<input type="text" class="form-control" id="desconto" name="desconto" value="0" onkeyup="calcular()">					
								</div>

								<div class="col-md-3">							
									<label>No Show (Valor Entrada)</label>
									<input type="text" class="form-control" id="no_show" name="no_show">					
								</div>


								<div class="col-md-3">							
									<label>Forma PGTO</label>
									<select class="form-control sel2" name="forma_pgto" id="forma_pgto" style="width:100%" required >
										<?php 
										$query = $pdo->query("SELECT * from formas_pgto order by id asc");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										$linhas = @count($res);
										if($linhas > 0){
											for($i=0; $i<$linhas; $i++){
												?>

												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } }else{ ?>
												<option value="">Cadastre uma Forma PGTO</option>
											<?php } ?>
										</select>							
									</div>


									<div class="col-md-3">							
										<label>Hóspedes</label>
										<input type="number" class="form-control" id="hospedes" name="hospedes" placeholder="" value="1" required>							
									</div>

									<div class="col-md-12">							
										<label>OBS</label>
										<input type="text" class="form-control" id="obs" name="obs" placeholder="" >							
									</div>




								</div>




								<input type="hidden" class="form-control" id="id" name="id">
								<input type="hidden" class="form-control" id="id_quarto">


								<br>
								<small><div id="mensagem" align="center"></div></small>
							</div>
							<div class="modal-footer">       
								<button id="btn_form" type="submit" class="btn btn-primary">Salvar</button>

								<img id="img_loading_form" src="../img/loading.gif" width="40px" style="display:none">
							</div>
						</form>
					</div>
				</div>
			</div>





			<!-- Modal -->
			<div class="modal fade" id="modalCheckin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_checkin"></span></h4>
							<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form id="form_checkin">								
								<div class="row" style="margin-top: 0px">
									<div class="col-md-2">							
										<label>Quarto</label>
										<input type="text" class="form-control" id="quarto_checkin" name="quarto_checkin" placeholder="" readonly="">							
									</div>


									<div class="col-md-2">							
										<label>Hóspedes</label>
										<input type="text" class="form-control" id="hospedes_checkin" name="hospedes_checkin" placeholder="" readonly="">							
									</div>

									<div class="col-md-2">							
										<label>Total Reserva</label>
										<input type="text" class="form-control" id="valor_checkin" name="valor_checkin" placeholder="" readonly="">							
									</div>

									<div class="col-md-2">							
										<label>Entrada</label>
										<input type="text" class="form-control" id="noshow_checkin" name="noshow_checkin" placeholder="" readonly="">							
									</div>


									<div class="col-md-2">							
										<label>
										Restante 
											<li class="dropdown head-dpdn2" style="display:inline">
		<a title="Informações" style="" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-info-circle text-primary"></i></a>

		<ul class="dropdown-menu" style="margin-left:-100px; margin-top: 30px">
		<li>
		<div class="notification_desc2">
		<p style="font-size: 13px">
		<a href="rel/reserva_class.php?id={$id}" target="_blank">
		<small><span class="fa fa-file-pdf-o text-danger" style="position:absolute; right:10px; top:-12px; width:15px"></span></small>
		</a>
		<b>Falta <span id="total_restante"></span> Reais da Reserva</b><br> 
		<span style="font-weight: 200">É opcional o pagamento do valor no checkin ou no checkout, podendo ser pago no checkin de forma parcial ou deixando todo o valor para ser pago no checkout!</span>
		<span></span>
		</p>
		</div>
		</li>										
		</ul>

										</label>
										<input type="text" class="form-control text-danger" id="diferenca_checkin" name="diferenca_checkin" placeholder="" >							
									</div>

									<div class="col-md-2">							
										<label>Placa</label>
										<input type="text" class="form-control" id="placa_checkin" name="placa_checkin" placeholder="" >							
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">							
										<label>Forma PGTO</label>
										<select class="form-control sel3" name="forma_pgto_checkin" id="forma_pgto_checkin" style="width:100%" required >
											<?php 
											$query = $pdo->query("SELECT * from formas_pgto order by id asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$linhas = @count($res);
											if($linhas > 0){
												for($i=0; $i<$linhas; $i++){
													?>

													<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

												<?php } }else{ ?>
													<option value="">Cadastre uma Forma PGTO</option>
												<?php } ?>
											</select>							
										</div>

										<div class="col-md-7">							
											<label>OBS</label>
											<input type="text" class="form-control" id="obs_checkin" name="obs_checkin" placeholder="" >							
										</div>

										<div class="col-md-2" style="margin-top: 18px">
											<button id="btn_checkin" type="submit" class="btn btn-primary">CheckIn</button>
											<img id="img_loading" src="../img/loading.gif" width="40px" style="display:none">
										</div>
									</div>

									<input type="hidden" class="form-control" id="id_checkin" name="id_checkin">
								</form>

								<hr>

								<div class="row">
									<div class="col-md-6">


										<form id="form_hospedes" style="margin-left: -15px">
											<div class="col-md-7">							
												<label>Nome</label>
												<input type="text" class="form-control" id="nome_hospede" name="nome_hospede" placeholder="" required>						
											</div>

											<div class="col-md-5">							
												<label>Telefone</label>
												<input type="text" class="form-control" id="telefone" name="telefone_checkin" placeholder="" required>							
											</div>

											<div class="col-md-7">							
												<label>Documento</label>
												<input type="text" class="form-control" id="bi_checkin" name="bi_checkin" placeholder="BI, RG ou qualquer outro Documento" required>							
											</div>

											<div class="col-md-2">
												<div class="col-md-1" style="margin-top: 20px">
													<button type="submit" class="btn btn-primary">Salvar</button>
												</div>
											</div>

											<input type="hidden" class="form-control" id="id_hospedes" name="id_hospedes">
										</form>
									</div>



									<div class="col-md-6">
										<b>Hóspedes</b>
										<div id="listar_hospedes">

										</div>
									</div>
								</div>




								<br>
								<small><div id="mensagem_checkin" align="center"></div></small>
							</div>	     


						</div>
					</div>
				</div>






				<!-- Modal -->
				<div class="modal fade" id="modalCheckinDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_checkin_dados"></span></h4>
								<button id="btn-fechar-checkin-dados" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">							
								<table style="border-bottom-style: solid; font-size: 15px; margin-bottom:10px; width: 100%; table-layout: fixed;">
									<thead> 
										<tr style="margin-left: 0px; background-color:#f5f5f5; font-weight: bold"> 
											<th style="width:20%">Quarto</th>
											<th style="width:20%">Hóspedes</th>	
											<th style="width:60%">Hóspede Principal</th>	

										</tr> 
									</thead> 
									<tbody>
										<tr style="margin-left: 0px;"> 
											<td style="width:20%" id="quarto_dados"></td>
											<td style="width:20%" id="hospedes_dados"></td>	
											<td style="width:60%" id="hospede_dados"></td>	
										</td>
									</tr>
								</tbody>
							</table>	


							<table style="border-bottom-style: solid; font-size: 15px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top: 20px">
								<thead> 
									<tr style="margin-left: 0px; background-color:#f5f5f5; font-weight: bold"> 
										<th style="width:20%">Valor Checkin</th>
										<th style="width:35%">Funcionário</th>	
										<th style="width:15%">Hora </th>	
										<th style="width:30%">Forma PGTO </th>
									</tr> 
								</thead> 
								<tbody>
									<tr style="margin-left: 0px;"> 
										<td style="width:20%" id="valor_dados"></td>
										<td style="width:35%" id="func_dados"></td>	
										<td style="width:15%" id="hora_dados"></td>	
										<td style="width:30%" id="pgto_dados"></td>
									</tr>
								</tbody>
							</table>

							<div style="margin-top: 20px" id="div_obs_dados">
								<span><b>Observações: </b><span id="obs_dados"></span></span><br>							
							</div>

							<div style="margin-top: 20px">
								<b>Hóspedes</b>
								<div id="listar_hospedes_dados">

								</div>
							</div>

						</div>	     

					</div>
				</div>
			</div>






			<!-- Modal -->
			<div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_checkout"></span></h4>
							<button id="btn-fechar-checkout" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form id="form_checkout">								
								<div class="row" style="margin-top: 0px">
									<div class="col-md-2">							
										<label>Quarto</label>
										<input type="text" class="form-control" id="quarto_checkout" name="quarto_checkout" placeholder="" readonly="">							
									</div>


									<div class="col-md-2">							
										<label>Reserva R$</label>
										<input type="text" class="form-control" id="restante_checkout" name="restante_checkout" placeholder="" readonly="">							
									</div>

									<div class="col-md-2">							
										<label>Total à Pagar</label>
										<input type="text" class="form-control" id="valor_checkout" name="valor_checkout" placeholder="" readonly="">							
									</div>	

									<div class="col-md-3">							
										<label>Forma PGTO</label>
										<select class="form-control sel4" name="forma_pgto_checkout" id="forma_pgto_checkout" style="width:100%" required >
											<?php 
											$query = $pdo->query("SELECT * from formas_pgto order by id asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$linhas = @count($res);
											if($linhas > 0){
												for($i=0; $i<$linhas; $i++){
													?>

													<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

												<?php } }else{ ?>
													<option value="">Cadastre uma Forma PGTO</option>
												<?php } ?>
											</select>							
										</div>
								
									<div class="col-md-3" style="margin-top: 25px">
										<small><a href="#" onclick="detalhamentoConsumo()"><span class="fa fa-file-pdf-o text-danger"> </span> Detalhamento de Consumo</a></small>
									</div>	
								
								</div>

								<div class="row">

									<div class="col-md-2">							
										<label>Hóspedes</label>
										<input type="text" class="form-control" id="hospedes_checkout" name="hospedes_checkout" placeholder="" readonly="">							
									</div>
									
										<div class="col-md-8">							
											<label>OBS</label>
											<input type="text" class="form-control" id="obs_checkout" name="obs_checkout" placeholder="" >							
										</div>

										<div class="col-md-2" style="margin-top: 18px">
											<button id="btn_checkout" type="submit" class="btn btn-primary">CheckOut</button>
											<img id="img_loading_checkout" src="../img/loading.gif" width="40px" style="display:none">
										</div>
									</div>

									<input type="hidden" class="form-control" id="id_checkout" name="id_checkout">
								</form>

								<hr>

								<div class="row">

								<input type="hidden" class="form-control" id="id_hospedes_checkout" name="id_hospedes_checkout">								
									<div class="col-md-6">
										<b>Hóspedes</b>
										<div id="listar_hospedes_checkout">

										</div>
									</div>
								</div>




								<br>
								<small><div id="mensagem_checkin" align="center"></div></small>
							</div>	     


						</div>
					</div>
				</div>




				<!-- Modal -->
				<div class="modal fade" id="modalCheckoutDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_checkout_dados"></span></h4>
								<button id="btn-fechar-checkout-dados" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">							
								<table style="border-bottom-style: solid; font-size: 15px; margin-bottom:10px; width: 100%; table-layout: fixed;">
									<thead> 
										<tr style="margin-left: 0px; background-color:#f5f5f5; font-weight: bold"> 
											<th style="width:20%">Quarto</th>
											<th style="width:20%">Hóspedes</th>	
											<th style="width:70%">Hóspede Principal</th>	

										</tr> 
									</thead> 
									<tbody>
										<tr style="margin-left: 0px;"> 
											<td style="width:20%" id="quarto_dados_checkout"></td>
											<td style="width:20%" id="hospedes_dados_checkout"></td>	
											<td style="width:60%" id="hospede_dados_checkout"></td>	
										</td>
									</tr>
								</tbody>
							</table>	


							<table style="border-bottom-style: solid; font-size: 15px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top: 20px">
								<thead> 
									<tr style="margin-left: 0px; background-color:#f5f5f5; font-weight: bold"> 
										<th style="width:20%">Valor Checkout</th>
										<th style="width:35%">Funcionário</th>	
										<th style="width:15%">Hora </th>	
										<th style="width:30%">Forma PGTO </th>
									</tr> 
								</thead> 
								<tbody>
									<tr style="margin-left: 0px;"> 
										<td style="width:20%" id="valor_dados_checkout"></td>
										<td style="width:35%" id="func_dados_checkout"></td>	
										<td style="width:15%" id="hora_dados_checkout"></td>	
										<td style="width:30%" id="pgto_dados_checkout"></td>
									</tr>
								</tbody>
							</table>

							<div style="margin-top: 20px" id="div_obs_dados_checkout">
								<span><b>Observações: </b><span id="obs_dados_checkout"></span></span><br>							
							</div>

							<div style="margin-top: 20px">
								<b>Hóspedes</b>
								<div id="listar_hospedes_dados_checkout">

								</div>
							</div>

						</div>	     

					</div>
				</div>
			</div>







				<script type="text/javascript">var pag = "<?=$pag?>"</script>
				<script src="js/ajax.js"></script>

				<script type="text/javascript">

					$(document).ready( function () {
						quartos();			 	 
						$('.sel').select2({

						});
					});

					
					function buscar(id){
						var busca = $('#data_agenda').val();
						var filtro = $('#filtro').val();
						listar(busca, filtro, id);
					}


					function quartos(){
						var tipo = $('#tipo_quarto').val();
						var check_in = $('#check_in').val();
						var check_out = $('#check_out').val();
						var id_quarto = $('#id_quarto').val();
						var id = $('#id').val();

						//alert(id_quarto)

						$.ajax({
							url: 'paginas/' + pag + "/listar-quartos.php",
							method: 'POST',
							data: {tipo, check_in, check_out, id_quarto, id},
							dataType: "html",

							success:function(result){
								
        	//alert(result)
        	$("#quarto").html(result);   
        	calcular();       
        }
    });
					}

					function datas(){
						verificarDataReservas()
						var checkin = $('#check_in').val();
						var checkout = $('#check_out').val();
						var diaria = $('#valor_diaria').val();

						quartos()

						if(checkout < checkin){			
							$('#check_out').val(checkin);
							return;
						}

						calcular();
					}

					function calcular(checkin, checkout, diaria){

						var checkin = $('#check_in').val();
						var checkout = $('#check_out').val();
						var diaria = $('#valor_diaria').val();
						var desconto = $('#desconto').val();

						$.ajax({
							url: 'paginas/' + pag + "/calcular.php",
							method: 'POST',
							data: {checkin, checkout, diaria, desconto},
							dataType: "html",

							success:function(result){
								var res = result.split("**")        	
								$('#no_show').val(res[1]);
								$('#valor_reserva').val(res[0]);           
							}
						});
					}



				</script>







				<!-- calendar -->
				<script type="text/javascript" src="js/monthly.js"></script>
				<script type="text/javascript">
					$(window).load( function() {

						$('#mycalendar').monthly({
							mode: 'event',

						});

						$('#mycalendar2').monthly({
							mode: 'picker',
							target: '#mytarget',
							setWidth: '250px',
							startHidden: true,
							showTrigger: '#mytarget',
							stylePast: true,
							disablePast: true
						});

						switch(window.location.protocol) {
							case 'http:':
							case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
	}

});
</script>
<!-- //calendar -->


<script type="text/javascript">
	$("#form-reservas").submit(function () {

		$("#btn_form").hide();
		$("#img_loading_form").show();

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/salvar.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				var msg = mensagem.split("-")

				$('#mensagem').text('');
				$('#mensagem').removeClass()
				if (msg[0].trim() == "Salvo com Sucesso") {

					$('#btn-fechar').click();
					var data = $('#data_agenda').val();
					buscar();
					$("#img_loading_form").hide();

                //chamar o relatorio da reserva 
                var id = msg[1].trim();                
                window.open("rel/reserva_class.php?id="+id+"&enviar=sim"); 


            } else {

            	$('#mensagem').addClass('text-danger')
            	$('#mensagem').text(mensagem)
            	$("#btn_form").show();
				$("#img_loading_form").hide();
            }

            $("#btn_form").show();
        },

        cache: false,
        contentType: false,
        processData: false,

    });

	});



				


	function excluir_reserva(id){	
		$('#mensagem-excluir').text('Excluindo...')

		$.ajax({
			url: 'paginas/' + pag + "/excluir.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(mensagem){
				alert(mensagem)
				if (mensagem.trim() == "Excluído com Sucesso") {            	
					buscar();
				} else {
					$('#mensagem-excluir').addClass('text-danger')
					$('#mensagem-excluir').text(mensagem)
				}
			}
		});
	}

	function listar_hosp(id){
		$.ajax({
			url: 'paginas/' + pag + "/listar_hospedes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				$("#listar_hospedes").html(result);           
			}
		});
	}

	function listar_hosp_checkout(id){
		$.ajax({
			url: 'paginas/' + pag + "/listar_hospedes.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				$("#listar_hospedes_checkout").html(result);           
			}
		});
	}

	function listar_hosp_dados(id){
		$.ajax({
			url: 'paginas/' + pag + "/listar_hospedes_dados.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				$("#listar_hospedes_dados").html(result);           
			}
		});
	}

	function listar_hosp_dados_checkout(id){
		$.ajax({
			url: 'paginas/' + pag + "/listar_hospedes_dados.php",
			method: 'POST',
			data: {id},
			dataType: "html",

			success:function(result){
				$("#listar_hospedes_dados_checkout").html(result);           
			}
		});
	}
</script>



<script type="text/javascript">
	$("#form_hospedes").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/salvar_hospede.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {  

				if (mensagem == "Salvo com Sucesso") {             
					var id = $("#id_hospedes").val();
					listar_hosp(id)
					$("#nome_hospede").val('')
					$("#bi_checkin").val('')
					$("#telefone").val('')
				} else {
					alert(mensagem)
					$("#nome_hospede").val('')
					$("#bi_checkin").val('')
					$("#telefone").val('')
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});

</script>




<script type="text/javascript">
	$("#form_checkin").submit(function () {

		$("#btn_checkin").hide();
		$("#img_loading").show();

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/salvar_checkin.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {  

				if (mensagem.trim() == "Salvo com Sucesso") { 				
					$('#modalCheckin').modal('hide');
					buscar();					
					$("#img_loading").hide();
				} else {
					alert(mensagem)
					$("#btn_checkin").show();
					$("#img_loading").hide();
				}

				$("#btn_checkin").show();


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});



	function detalhamentoConsumo(){
		var id_reserva = $("#id_checkout").val();
		window.open("rel/consumo_class.php?id="+id_reserva+"&enviar=sim");
	}




		$("#form_checkout").submit(function () {

		$("#btn_checkout").hide();
		$("#img_loading_checkout").show();

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: 'paginas/' + pag + "/salvar_checkout.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {  

				if (mensagem.trim() == "Salvo com Sucesso") { 				
					$('#modalCheckout').modal('hide');
					buscar();					
					$("#img_loading_checkout").hide();
				} else {
					alert(mensagem)
					$("#btn_checkout").show();
					$("#img_loading_checkout").hide();
				}

				$("#btn_checkout").show();

			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});



		function verificarDataReservas(){
    	var dataInicial = $('#check_in').val();
    	var dataFinal = $('#check_out').val();
    	var dataAtual = "<?=$data_atual?>";

    	var dataIni = new Date(dataInicial);
    	var dataFin = new Date(dataFinal);
    	var dataHoje = new Date(dataAtual);

    	if(dataIni < dataHoje){
    		alert('Você não pode colocar uma data Retroativa!');
    		$('#check_in').val(dataAtual);
    	}

    	if(dataFin < dataHoje){
    		alert('Você não pode colocar uma data Retroativa!');
    		$('#check_out').val(dataAtual);
    	}
    }


    function trocarQuarto(){
    	var id_quarto = $('#quarto').val();
    	$('#id_quarto').val(id_quarto);
    }

</script>