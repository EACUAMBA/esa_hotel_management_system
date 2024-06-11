<?php 
$pag = 'quartos';

//verificar se ele tem a permissão de estar nessa página
if(@$quartos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
 ?>
<div class="margin_mobile">
<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Quarto</a>



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

<select class="form-control sel" id="tipo_busca" onchange="buscar()" style="width:200px; display:inline">
	<option value="">Filtrar por Tipo</option>
								  <?php 
								  	$query = $pdo->query("SELECT * from categorias_quartos order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);									
									for($i=0; $i<$linhas; $i++){
								   ?>

								   <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } ?>
								</select>	
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

						<div class="col-md-4">							
								<label>Número</label>
								<input type="number" class="form-control" id="numero" name="numero" placeholder=""  required>							
						</div>

						<div class="col-md-8">							
								<label>Descrição</label>
								<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Nome ou Descrição do Quarto" >							
						</div>

						

						
					</div>


					<div class="row">					
						

						<div class="col-md-4">							
								<label>Tipo</label>
								<select class="form-control sel2" name="tipo" id="tipo" style="width:100%">
								  <?php 
								  	$query = $pdo->query("SELECT * from categorias_quartos order by nome asc");
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

						<div class="col-md-8">							
								<label>Observações</label>
								<input type="text" class="form-control" id="obs" name="obs" placeholder="" >							
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
						<span><b>Descrição: </b></span><span id="descricao_dados"></span>
					</div>

														

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Tipo: </b></span><span id="tipo_dados"></span>
					</div>

					
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>OBS: </b></span><span id="obs_dados"></span>
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
		 $('.sel').select2({

    	});
	});

	function buscar(){
		var busca = $('#tipo_busca').val();
		listar(busca);
	}
</script>



