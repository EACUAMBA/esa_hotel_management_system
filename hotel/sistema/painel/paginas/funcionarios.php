<?php 
$pag = 'funcionarios';

//verificar se ele tem a permissão de estar nessa página
if(@$funcionarios == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
 ?>

 <div class="margin_mobile">
<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Funcionário</a>



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
						<div class="col-md-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>							
						</div>

						<div class="col-md-6">							
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Seu Email"  >							
						</div>

						
					</div>


					<div class="row">

						<div class="col-md-6">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Seu Telefone" required>							
						</div>
						

						<div class="col-md-6">							
								<label>Nível</label>
								<select class="form-control" name="nivel" id="nivel">
								  <?php 
								  	$query = $pdo->query("SELECT * from cargos order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
									for($i=0; $i<$linhas; $i++){
								   ?>

								   <option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } }else{ ?>
									<option value="">Cadastre um Cargo / Nível</option>
								<?php } ?>
								</select>							
						</div>


						
					</div>


					<div class="row">
						<div class="col-md-4">							
								<label>BI</label>
								<input type="text" class="form-control" id="bi" name="bi" placeholder="" >							
						</div>

						<div class="col-md-8">							
								<label>Chave Pix</label>
								<input type="text" class="form-control" id="chave_pix" name="chave_pix" placeholder="Dados para Pagamento"  >							
						</div>

						
					</div>

					<div class="row">

						<div class="col-md-12">							
								<label>Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Seu Endereço" >							
						</div>
					</div>


					<div class="row">

						<div class="col-md-12">							
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
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>

					
					<div class="col-md-8" style="margin-bottom: 5px">
						<span><b>Email: </b></span><span id="email_dados"></span>
					</div>

					

					<div class="col-md-4" style="margin-bottom: 5px">
						<span><b>BI: </b></span><span id="bi_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Cargo: </b></span><span id="nivel_dados"></span>
					</div>

					
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data Cadastro: </b></span><span id="data_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Pagamento: </b></span><span id="pix_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Endereço: </b></span><span id="endereco_dados"></span>
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



