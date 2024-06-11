<?php 
$pag = 'categorias_quartos';

//verificar se ele tem a permissão de estar nessa página
if(@$categorias_quartos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>
<div class="margin_mobile">
<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Tipo</a>



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
						<div class="col-md-8">							
							<label>Nome</label>
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>							
						</div>					

						<div class="col-md-4">							
							<label>Valor</label>
							<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor Diária">							
						</div>
						
					</div>


					<div class="row">

						<div class="col-md-12">							
							<label>Descrição</label>
							<textarea name="descricao" id="descricao" maxlength="2000" class="form-control"></textarea>							
						</div>				

						
					</div>

					<div class="row">

						<div class="col-md-12">							
							<label>Especificações <small>(Separar por ** Ex: Banheiro**Ar Condicionado**Hidromassagem)</small></label>
							<textarea name="especificacoes" id="especificacoes" maxlength="2000" class="form-control"></textarea>							
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
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Valor Diária: </b></span><span id="valor_dados"></span>
					</div>

					
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>

					

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Descrição: </b></span><span id="descricao_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Especificações: </b></span><br>
						<small><i><span id="especificacoes_dados"></span></i></small>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<div align="center"><img src="" id="foto_dados" width="250px"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>





<!-- Modal Fotos -->
<div class="modal fade" id="modalFotos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_fotos"></span></h4>
				<button id="btn-fechar-fotos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form id="form-fotos" method="POST" enctype="multipart/form-data" >
				<div class="row">
					<div class="col-md-8">
						<input type="file" class="form-control" id="imgquartos" name="imgquartos[]" multiple="multiple">
					</div>
					<div class="col-md-4">
						<button class="btn btn-primary" type="submit" id="btn-fotos">Salvar</button>
					</div>
				</div>
				<input type="hidden" name="id_fotos" id="id_fotos">
			</form>


				<hr>
				
				<div id="listar-fotos">
					
				</div>
				<small><div align="center" id="mensagem-excluir-foto"></div></small>
			</div>

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




$("#form-fotos").submit(function () {

	var id = $('#id_fotos').val();
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar-fotos.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-excluir-foto').text('');
            $('#mensagem-excluir-foto').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {
                
               carregarFotos(id);    

            } else {

                $('#mensagem-excluir-foto').addClass('text-danger')
                $('#mensagem-excluir-foto').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


</script>
