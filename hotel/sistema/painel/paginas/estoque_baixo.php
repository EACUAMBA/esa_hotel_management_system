<?php 
$pag = 'estoque_baixo';

//verificar se ele tem a permissão de estar nessa página
if(@$estoque_baixo == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>

<div class="margin_mobile">
<a href="rel/estoque_class.php" target="_blank" style="position:absolute; right:30px" class="btn btn-success"><span class="fa fa-file-pdf-o"></span> Relatório</a>
</div>
<br>
<div class="bs-example widget-shadow" style="padding:15px" id="listar">

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
						<span><b>Valor Venda: </b></span><span id="venda_dados"></span>
					</div>
					
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Valor Compra </b></span><span id="compra_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Categoria </b></span><span id="categoria_dados"></span>
					</div>

					
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>

					
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Estoque: </b></span><span id="estoque_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Nível Alerta </b></span><span id="nivel_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Tem Estoque </b></span><span id="tem_estoque_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Fornecedor </b></span><span id="fornecedor_dados"></span>
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
