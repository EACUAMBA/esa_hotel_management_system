<?php 
$pag = 'servicos';

//verificar se ele tem a permissão de estar nessa página
if(@$servicos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>
<div class="margin_mobile">


<form method="post" action="rel/servicos_class.php" target="_blank">

<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Serviço</a>

<button type="submit" style="position:absolute; right:30px" class="btn btn-success"><span class="fa fa-file-pdf-o"></span> Relatório</button>


<li class="dropdown head-dpdn2" style="display: inline-block;">		
	<a href="#" data-toggle="dropdown"  class="btn btn-danger dropdown-toggle" id="btn-deletar" style="display:none"><span class="fa fa-trash-o"></span> Deletar</a>

	<ul class="dropdown-menu">
		<li>
			<div class="notification_desc2">
				<p>Excluir Selecionados? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a></p>
			</div>
		</li>										
	</ul>
</li>

<select class="form-control estilo_block sel3" style="width:200px;" id="filtro" name="filtro" onchange="buscar()">
	<option value="">Filtrar por Categoria</option>
	<?php 
								  	$query = $pdo->query("SELECT * from categorias_servicos order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								   ?>

								   <option value='<?php echo $res[$i]['id'] ?>'><?php echo $res[$i]['nome'] ?></option>

								<?php } } ?>
</select>
<i class="fa fa-search text-primary" style="margin-right: 20px"></i>
</form>



</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>


<input type="hidden" id="ids">

<!-- Modal Perfil -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
				<div class="modal-body">


					<div class="row">
						<div class="col-md-7">							
							<label>Nome</label>
							<input type="text" class="form-control" id="nome" name="nome" required>							
						</div>	

						<div class="col-md-5">							
							<label>Categoria</label>
							<select class="form-control sel2" name="categoria" id="categoria" style="width:100%">
								  <?php 
								  	$query = $pdo->query("SELECT * from categorias_servicos order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								   ?>

								   <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } }else{ ?>
									<option value="">Cadastre uma Categoria</option>
								<?php } ?>
								</select>									
						</div>			

					</div>


					<div class="row">

						<div class="col-md-8">							
							<label>Descrição</label>
							<input type="text" name="descricao" id="descricao" maxlength="255" class="form-control">
						</div>	

						<div class="col-md-4">							
							<label>Valor</label>
							<input type="text" name="valor" id="valor"  class="form-control">							
						</div>				

						
					</div>




					<div class="row">
						<div class="col-md-8">							
							<label>Foto</label>
							<input type="file" class="form-control" id="foto" name="foto" onchange="carregarImg()">							
						</div>

						<div class="col-md-4">								
							<img src="images/quartos/sem-foto.jpg"  width="80px" id="target">								
							
						</div>

						
					</div>				


					


					<input type="hidden" class="form-control" id="id" name="id">					

					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>
				<div class="modal-footer">       
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>





<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_dados"></span></h4>
				<button id="btn-fechar-dados" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<div class="row" style="margin-top: 0px">

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Descrição </b></span><span id="descricao_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Valor: </b></span><span id="valor_dados"></span>
					</div>
					
				

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Categoria </b></span><span id="categoria_dados"></span>
					</div>

					
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>

					
					
					

					<div class="col-md-12" style="margin-bottom: 5px">
						<div align="center"><img src="" id="foto_dados" width="250px"></div>
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
		 $('.sel2').select2({
					dropdownParent: $('#modalForm')
				});

		 $('.sel3').select2({
					
				});
	});

	</script>


<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

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

function buscar(){
		var busca = $('#filtro').val();			
		listar(busca);
	}

</script>
