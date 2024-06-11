<?php 
$pag = 'compras';

//verificar se ele tem a permissão de estar nessa página
if(@$compras == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

?>


<div class="row">
	<div class="col-md-10">
		
		<div style="float:left; margin-right:35px">
			<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i>Compra</button>
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span>
		</div>
		<div class="esc" style="float:left; margin-right:20px">
			<input type="date" class="form-control " name="data-inicial"  id="data-inicial" value="<?php echo date('Y-m-d') ?>" required>
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:30px">
			<input type="date" class="form-control " name="data-final"  id="data-final" value="<?php echo date('Y-m-d') ?>" required>
		</div>


		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status" class="bi bi-search"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<select class="form-control" aria-label="Default select example" name="status-busca" id="status-busca">
				<option value="">Todas</option>
				<option value="Não">Pendentes</option>
				<option value="Sim">Pagas</option>
				
			</select>
		</div>

		<div style="margin-top:5px;"> 
			<small >
				<a title="Contas à Pagar Vencidas" class="text-muted" href="#" onclick="listarContasVencidas('Vencidas')"><span>Vencidas</span></a> / 
				<a title="Contas à Pagar Hoje" class="text-muted" href="#" onclick="listarContasVencidas('Hoje')"><span>Hoje</span></a> / 
				<a title="Contas à Pagar Amanhã" class="text-muted" href="#" onclick="listarContasVencidas('Amanha')"><span>Amanhã</span></a>
			</small>
		</div>

		
	</div>

	<div align="right" class="col-md-2">
		<small><i class="fa fa-usd text-danger"></i> <span class="text-dark">Pendentes: <span class="text-danger" id="total_itens"></span></span></small>
	</div>
</div>

<div id="div_botoes" style="display:none">
<li class="dropdown head-dpdn2" style="display:inline-block;">		
		<a href="#" data-toggle="dropdown"  class="btn btn-danger dropdown-toggle" id="btn-deletar" style=""><span class="fa fa-trash-o"></span> Deletar</a>

		<ul class="dropdown-menu">
		<li>
		<div class="notification_desc2">
		<p>Excluir Selecionados? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>

<li class="dropdown head-dpdn2" style="display: inline-block; margin-left: 20px">		
		<a href="#" data-toggle="dropdown"  class="btn btn-success dropdown-toggle" id="btn-baixar" style=""><span class="fa fa-check-square"></span> Baixar</a>

		<ul class="dropdown-menu">
		<li>
		<div class="notification_desc2">
		<p>Baixar Selecionados? <a href="#" onclick="baixarSel()"><span class="verde">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>


<input type="hidden" id="ids">

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-contas">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Produto</label> 
								<select class="form-control sel2" name="produto" id="produto" style="width:100%">
								  <?php 
								  	$query = $pdo->query("SELECT * from produtos where tem_estoque = 'Sim' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								   ?>

								   <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } }else{ ?>
									<option value="">Cadastre um Produto</option>
								<?php } ?>
								</select>		
							</div>						
						</div>

						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Fornecedor</label> 
								<select class="form-control sel2" name="fornecedor" id="fornecedor" style="width:100%">
								  <?php 
								  	$query = $pdo->query("SELECT * from fornecedores order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								   ?>

								   <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } }else{ ?>
									<option value="">Cadastre um Fornecedor</option>
								<?php } ?>
								</select>		
							</div>						
						</div>

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Quantidade</label> 
								<input type="number" class="form-control" name="quantidade" id="quantidade" value="<?php echo date('Y-m-d') ?>" required> 
							</div>						
						</div>


					</div>

					<div class="row">
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Total da Compra</label> 
								<input type="text" class="form-control" name="valor" id="valor"  required> 
							</div>						
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Vencimento</label> 
								<input type="date" class="form-control" name="vencimento" id="vencimento"  required> 
							</div>						
						</div>

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Pago Em</label> 
								<input type="date" class="form-control" name="data_pgto" id="data_pgto" > 
							</div>						
						</div>
					</div>								

					<div class="row">						

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Imagem / Arquivo</label> 
								<input class="form-control" type="file" name="arquivo" onChange="carregarImg();" id="arquivo">
							</div>						
						</div>
						<div class="col-md-2">
							<div id="divImg">
								<img src="images/contas/sem-foto.png"  width="100px" id="target">									
							</div>
						</div>


						<div class="col-md-6">						
							<div class="form-group"> 
								<label>OBS</label> 
								<textarea maxlength="255" type="text" class="form-control" name="obs" id="obs"> </textarea>
							</div>						
						</div>


					</div>				
					

					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>



			</form>

		</div>
	</div>
</div>






<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="nome_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">			



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b><span id="tipo_pessoa_mostrar"></span> </b></span>
						<span id="pessoa_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Valor: </b></span>
						<span id="valor_mostrar"></span>
					</div>
				</div>


				

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Chave Pix: </b></span>
							<span id="pix_mostrar"></span>							
						</div>
					
					</div>		


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data Lançamento: </b></span>
						<span id="lanc_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Data Vencimento: </b></span>
						<span id="venc_mostrar"></span>
					</div>
				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data PGTO: </b></span>
						<span id="pgto_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Usuário Cadastro: </b></span>
						<span id="usu_lanc_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Usuário Baixa: </b></span>
						<span id="usu_pgto_mostrar"></span>							
					</div>

						<div class="col-md-6">							
						<span><b>Pago: </b></span>
						<span id="pago_mostrar"></span>
					</div>
					
				</div>


			


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-12">							
						<span><b>OBS: </b></span>
						<span id="obs_mostrar"></span>
					</div>
				</div>



				<div class="row">
					<div class="col-md-12" align="center">		
						<a id="link_arquivo" target="_blank"><img  width="200px" id="target_mostrar"></a>	
					</div>
				</div>



			</div>


		</div>
	</div>
</div>






	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
					<button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-arquivos" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Arquivo</label> 
									<input class="form-control" type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
								</div>	
							</div>
							<div class="col-md-4" style="margin-top:-10px">	
								<div id="divImgArquivos">
									<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos">									
								</div>					
							</div>




						</div>

						<div class="row" style="margin-top:-40px">
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome-arq"  id="nome-arq" placeholder="Nome do Arquivo * " required>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Inserir</button>
							</div>
						</div>

						<hr>

						<small><div id="listar-arquivos"></div></small>

						<br>
						<small><div align="center" id="mensagem-arquivo"></div></small>

						<input type="hidden" class="form-control" name="id-arquivo"  id="id-arquivo">


					</div>
				</form>
			</div>
		</div>





<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>



		<script type="text/javascript">
			$(document).ready(function() {
				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});



				$('#data-inicial').change(function(){					
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					var alterou_data = 'Sim';
					listarBusca(dataInicial, dataFinal, status, alterou_data);

				});

				$('#data-final').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					var alterou_data = 'Sim';
					listarBusca(dataInicial, dataFinal, status, alterou_data);
				});

				$('#status-busca').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					listarBusca(dataInicial, dataFinal, status);
				});


			});
		</script>


		<script type="text/javascript">
			$(document).ready(function() {
				$('.sel3').select2({
					dropdownParent: $('#modalParcelar')
				});
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.sel4').select2({
					dropdownParent: $('#modalBaixar')
				});
			});
		</script>





<script type="text/javascript">

			function listarBusca(dataInicial, dataFinal, status, alterou_data){				
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {dataInicial, dataFinal, status, alterou_data},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}



			function listarContasVencidas(vencidas){

				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {vencidas},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}


			function listarContasHoje(hoje){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {hoje},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}


			function listarContasAmanha(amanha){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {amanha},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}

		</script>


<script type="text/javascript">
			function carregarImg() {
				var target = document.getElementById('target');
				var file = document.querySelector("#arquivo").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);


				if(resultado[1] === 'pdf'){
					$('#target').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx'){
					$('#target').attr('src', "images/word.png");
					return;
				}

				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target').attr('src', "images/xml.png");
					return;
				}

				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>



<script type="text/javascript">
			function carregarImgArquivos() {
				var target = document.getElementById('target-arquivos');
				var file = document.querySelector("#arquivo_conta").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);


				if(resultado[1] === 'pdf'){
					$('#target-arquivos').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx'){
					$('#target-arquivos').attr('src', "images/word.png");
					return;
				}

				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos').attr('src', "images/xml.png");
					return;
				}

				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>




<script type="text/javascript">
	
$("#form-contas").submit(function () {
	event.preventDefault();
	var formData = new FormData(this);

	$.ajax({
		url: 'paginas/' + pag + "/inserir.php",
		type: 'POST',
		data: formData,

		success: function (mensagem) {
			
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {                    
                    $('#btn-fechar').click();
                   var dataInicial = $('#data-inicial').val();
				var dataFinal = $('#data-final').val();
				var status = $('#status-busca').val();
				var alterou_data = 'Sim';
				listarBusca(dataInicial, dataFinal, status, alterou_data);
                } else {
                	$('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,
            
        });

});

</script>


<script type="text/javascript">
	

function excluir_conta(id){	
    $('#mensagem-excluir').text('Excluindo...')
    
    $.ajax({
        url: 'paginas/' + pag + "/excluir.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
        	
            if (mensagem.trim() == "Excluído com Sucesso") {    

                var dataInicial = $('#data-inicial').val();
				var dataFinal = $('#data-final').val();
				var status = $('#status-busca').val();
				var alterou_data = 'Sim';
				listarBusca(dataInicial, dataFinal, status, alterou_data);
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
}




function baixar_conta(id){	
    $('#mensagem-excluir').text('Baixando...')
    
    $.ajax({
        url: 'paginas/' + pag + "/baixar.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
        	
            if (mensagem.trim() == "Baixado com Sucesso") {    

                var dataInicial = $('#data-inicial').val();
				var dataFinal = $('#data-final').val();
				var status = $('#status-busca').val();
				var alterou_data = 'Sim';
				listarBusca(dataInicial, dataFinal, status, alterou_data);
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
}

</script>





		<script type="text/javascript">
			$("#form-arquivos").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/' + pag + "/arquivos.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-arquivo').text('');
						$('#mensagem-arquivo').removeClass()
						if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-arq').val('');
						$('#arquivo_conta').val('');
						$('#target-arquivos').attr('src','images/arquivos/sem-foto.png');
						listarArquivos();
					} else {
						$('#mensagem-arquivo').addClass('text-danger')
						$('#mensagem-arquivo').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
		</script>

		<script type="text/javascript">
			function listarArquivos(){
				var id = $('#id-arquivo').val();	
				$.ajax({
					url: 'paginas/' + pag + "/listar-arquivos.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-arquivos").html(result);
					}
				});
			}

		</script>

