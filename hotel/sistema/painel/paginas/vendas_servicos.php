<?php 
$pag = 'vendas_servicos';

//verificar se ele tem a permissão de estar nessa página
if(@$vendas_servicos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
 ?>
<div class="margin_mobile">
	<div class="row">
		<?php 
		$query = $pdo->query("SELECT * from categorias_servicos where ativo = 'Sim' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$foto = $res[$i]['foto'];	
	$ativo = $res[$i]['ativo'];
	
	//totalizar produtos
	$query2 = $pdo->query("SELECT * from servicos where categoria = '$id' and ativo = 'Sim'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$produtos = @count($res2);
if($produtos > 0){
?>

<a href="#" onclick="listar('<?php echo $id ?>')">
<div class="col-md-3 widget" style="margin-right: 5px; margin-bottom: 5px; ">			<div class="r3_counter_box" style="min-height: 60px; padding:10px">
				<i class="pull-left fa " style="background-image:url('images/servicos/<?php echo $foto ?>'); background-size: cover;"></i>
				<div class="stats">
					<h5 style="font-size:17px"><strong><?php echo $nome ?>	</strong></h5>
					<span style="font-size:13px"><?php echo $produtos ?> Serviços</span>
					</div>	
			</div>
</div>
 </a>
<?php } } } else{ echo 'Cadastre uma Categoria!'; } ?>

	</div>
</div>


<br>
<small><b>Serviços Categoria:</b> <span id="nome_categoria"></span></small>

<div style="margin-top: 5px" id="listar">

</div>




<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_venda">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-6">
							<div class="col-md-6">							
								<label>Quarto</label>
								<input type="text" class="form-control" id="quarto" name="quarto" >							
							</div>
							<div class="col-md-6">	
								<a href="#" onclick="buscarQuarto()" class="btn btn-primary" style="margin-top:20px">Buscar</a>
							</div>

							<div class="col-md-7">						
								<label>Quantidade</label>
								<input type="number" class="form-control" id="quantidade" name="quantidade"  required value="1" onchange="calcular()" onkeyup="calcular()">							
						</div>

						<div class="col-md-5">							
								<label>Total</label>
								<input type="text" class="form-control" id="total" name="total"  required readonly="">							
						</div>

							<div class="col-md-12">							
								<label>Hóspede</label>
								<input type="text" class="form-control" id="nome_hospede" name="nome_hospede" required readonly>							
						</div>

						</div>



						<div class="col-md-6" id="listar_hospedes">
							<a id="btn_sem_quarto" href="#" onclick="receberValor()" class="btn btn-danger" style="margin-top:20px">Sem Quarto</a>
						</div>
						
						
					</div>


					<input type="hidden" class="form-control" id="total_oculta">

					<input type="hidden" class="form-control" id="id" name="id">	
					<input type="hidden" class="form-control" id="id_hospede" name="id_hospede">
					<input type="hidden" class="form-control" id="id_reserva" name="id_reserva">					

				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>

			<div class="modal-footer">       
					<button id="btn_venda" type="submit" class="btn btn-success">Fechar Venda</button>
					<img id="img_loading" src="../img/loading.gif" width="40px" style="display:none">
				</div>
			
			</form>
		</div>
	</div>
</div>




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	function buscarQuarto(){		
		var quarto = $('#quarto').val();
		if(quarto == ""){
			alert('Coloque o número do Quarto');
			return;
		}
		$.ajax({
        url: 'paginas/' + pag + "/buscar_quarto.php",
        method: 'POST',
        data: {quarto},
        dataType: "html",

        success:function(result){

        	if(result == "0"){
        		alert('Não possui check-In para este quarto!');
        		$('#quarto').val('');
        		$('#id_hospede').val('');
        		$('#id_reserva').val('');
        		$("#listar_hospedes").text('');
        		$("#listar_hospedes").append('<a id="btn_sem_quarto" href="#" onclick="receberValor()" class="btn btn-danger" style="margin-top:20px">Sem Quarto</a>')
        		return;
        	}else{
        		$("#listar_hospedes").html(result);
            	$('#mensagem').text('');
        	}
            
        }
    });
	}

	function calcular(){
		var quantidade = $('#quantidade').val();
		var valor_fixo = $('#total_oculta').val();

		if(quantidade <= 0){
			$('#quantidade').val('1');
			var quantidade = 1;
		}
		
		var total = parseFloat(quantidade) * parseFloat(valor_fixo);
		$('#total').val(total.toFixed(2));
	}

	function receberValor(){
		$('#nome_hospede').val('Sem Quarto Lançado')
	}




$("#form_venda").submit(function () {

	$("#btn_venda").hide();
		$("#img_loading").show();

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {
            	$("#img_loading").hide();
                $('#btn-fechar').click();
                listar();          

            } else {

                $('#mensagem').addClass('text-danger')
                $('#mensagem').text(mensagem)
                $("#btn_venda").show();
					$("#img_loading").hide();
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>