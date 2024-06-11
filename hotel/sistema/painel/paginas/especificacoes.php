<?php 
$pag = 'especificacoes';

//verificar se ele tem a permissão de estar nessa página
if(@$especificacoes == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>
<div class="margin_mobile">
<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Lazer</a>



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
						<div class="col-md-12">							
							<label>Nome</label>
							<input maxlength="20" type="text" class="form-control" id="nome" name="nome" placeholder="Quadra de Tênis">							
						</div>					

						
						
					</div>

				

					<div class="row">
						<div class="col-md-8">							
							<label>Foto</label>
							<input type="file" class="form-control" id="foto" name="foto" onchange="carregarImg()">							
						</div>

						<div class="col-md-4">								
							<img src="images/especificacoes/sem-foto.jpg"  width="80px" id="target">								
							
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





<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>




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


</script>
