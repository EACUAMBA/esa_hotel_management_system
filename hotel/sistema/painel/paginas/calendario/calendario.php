<script>
	function modalShow() {		
		$('#modalShow').modal('show');
	}

	$(document).ready(function() {
		$('#calendar').fullCalendar({


		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listYear'
		},

		defaultDate:'<?php echo date('Y-m-d'); ?>',
		editable: true,
		navLinks: true,
		eventLimit: true,
		selectable: true,
		selectHelper: true,
		select: function(start, end) {
			return;
			$('#ModalAdd #inicio').val(moment(start).format('DD-MM-YYYY HH:mm:ss'));
			$('#ModalAdd #termino').val(moment(end).format('DD-MM-YYYY HH:mm:ss'));
			$('#ModalAdd').modal('show');
		},
		eventRender: function(event, element) {
			return;
			//alert(event.id)
			element.bind('click', function() {
				$('#ModalEdit #id_evento').val(event.id);
				$('#ModalEdit #titulo').val(event.title);
				$('#ModalEdit #descricao').val(event.description);
				$('#ModalEdit #cor').val(event.color);
				$('#ModalEdit #convidado').val(event.hospedes);
				$('#ModalEdit #remetente').val(event.valor);
				$('#ModalEdit #status').val(event.hospedes);
				$('#ModalEdit #inicio').val(event.hospedes);
				//$('#ModalEdit #termino').val(event.end.format('DD-MM-YYYY HH:mm:ss'));
				$('#ModalEdit').modal('show');
			});
		},
		eventDrop: function(event, delta, revertFunc) { 

			edit(event);
		},
					
		eventResize: function(event,dayDelta,minuteDelta,revertFunc) { 

			edit(event);
		},

		events: [
					<?php for($i=0; $i < $total_reg; $i++){

						$hora_inicio = "01:00:00";
						$hora_final = "23:00:00";

						$data_inicio = $res[$i]['check_in']." ".$hora_inicio;
						$data_final = $res[$i]['check_out']." ".$hora_final;

						$dtInicio = $res[$i]['check_in'];
						$dtFinal = $res[$i]['check_out'];				
						
						if($hora_inicio == '00:00:00' || $hora_inicio == ''){
							$start = $res[$i]['hora_checkin'];
						}else{
							$start = $data_inicio;
						}
						if($hora_final == '00:00:00' || $hora_inicio == ''){
							$end = $res[$i]['hora_checkout'];
						}else{
							$end = $data_final;
						}

						
						$hospede = $res[$i]['hospede'];
						$query2 = $pdo->query("SELECT * FROM hospedes where id = '$hospede'");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						if(@count($res2) > 0){
							$nome_hospede = $res2[0]['nome'];							
						}else{
							$nome_hospede = 'Sem Hóspede';
							
						}


						$funcionario = $res[$i]['funcionario'];
						$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						if(@count($res2) > 0){
							$profissional = $res2[0]['nome'];							
						}else{
							$profissional = 'Sem Registro';
							
						}
						

						if($res[$i]['hora_checkin'] == ""){
							$cor_agd = "#17497a";
						}else{
							$cor_agd = "#751914";
						}

						$tipo_quarto = $res[$i]['tipo_quarto'];
						$quarto = $res[$i]['quarto'];


						$query2 = $pdo->query("SELECT * from categorias_quartos where id = '$tipo_quarto'");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						$nome_tipo = @$res2[0]['nome'];
						$nome_tipoF = mb_strimwidth($nome_tipo, 0, 9, "");

						$query2 = $pdo->query("SELECT * from quartos where id = '$quarto'");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						$numero_quarto = @$res2[0]['numero'];

							$valor = $res[$i]['valor'];
							$valorF = number_format($valor, 2, ',', '.');  

							$check_in = $res[$i]['check_in'];
	$check_out = $res[$i]['check_out'];
							$check_inF = implode('/', array_reverse(explode('-', $check_in)));
	$check_outF = implode('/', array_reverse(explode('-', $check_out)));

					?>
					{
						id: '<?php echo $res[$i]['id'] ?>',
						title: '<?php echo $numero_quarto ?> (<?php echo $nome_tipoF ?>) / <?php echo $check_outF ?> Checkout / Hóspede <?php echo $nome_hospede ?> / Valor: <?php echo $valorF ?>',
						description: '<?php echo $nome_hospede ?>',
						start: '<?php echo $dtInicio; ?>',
						end: '<?php echo $dtInicio; ?>',
						color: '<?php echo $cor_agd ?>',
						hospede: '<?php echo $res[$i]['hospede'] ?>',
						valor: '<?php echo $valorF ?>',
						hospedes:'<?php echo $res[$i]['hospedes'] ?>',
					},
					<?php } ?>
				]
			});
				
				function edit(event){
					alert('recurso indisponível')
					return;
					start = event.start.format('DD-MM-YYYY HH:mm:ss');
					if(event.end){
						end = event.end.format('DD-MM-YYYY HH:mm:ss');
					}else{
						end = start;
					}
					
					id_evento =  event.id;
					
					Event = [];
					Event[0] = id_evento;
					Event[1] = start;
					Event[2] = end;
					
					$.ajax({
					url: 'evento/action/eventoEditData.php',
					type: "POST",
					data: {Event:Event},
					success: function(rep) {
							if(rep == 'OK'){
								alert('Modificação Salva!');
							}else{
								alert('Falha ao salvar, tente novamente!'); 
							}
						}
				});
			}
		});

</script>


