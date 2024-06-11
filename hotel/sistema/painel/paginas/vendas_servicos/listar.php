<?php 
$tabela = 'servicos';
require_once("../../../conexao.php");

$id = @$_POST['p1'];

if($id == ""){
	$query = $pdo->query("SELECT * from categorias_servicos where ativo = 'Sim' order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id = $res[0]['id'];
$nome_cat = $res[0]['nome'];
}else{
	$query = $pdo->query("SELECT * from categorias_servicos where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cat = $res[0]['nome'];
}

$query = $pdo->query("SELECT * from $tabela where categoria = '$id' and ativo = 'Sim' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$valor_venda = $res[$i]['valor'];	
		
	$foto = $res[$i]['foto'];		
	$valor_vendaF = number_format($valor_venda, 2, ',', '.');  
	
	
echo <<<HTML
<a href="#" onclick="produto('{$id}', '{$nome}', '$valor_venda')">
<div class="col-md-3 widget " style="margin-right: 5px; margin-bottom: 5px; ">			<div class="r3_counter_box" style="min-height: 60px; padding:10px">
				<i class="pull-left fa " style="background-image:url('images/servicos/{$foto}'); background-size: cover;"></i>
				<div class="stats">
					<h5 style="font-size:12px"><strong>{$nome}	</strong></h5>
					<span><span style="color:red; font-size:13px">R$ {$valor_vendaF}</span> </span>
					</div>	
			</div>
</div>
 </a>
HTML;
} 
}else{
	echo 'Nenhum Serviço Cadastrado!';
}
?>


<script type="text/javascript">
	$(document).ready( function () {	

	$('#nome_categoria').text('<?=$nome_cat?>')

	});

	function produto(id, nome, valor){

		$('#mensagem').text('');
    	$('#titulo_inserir').text('Venda: '+nome);
    	$("#btn_venda").show();

    	$('#id_reserva').val(''); 

    	$('#id').val(id); 
    	$('#total').val(valor);
    	$('#total_oculta').val(valor); 
    	$('#nome_hospede').val('');
    	$('#quarto').val('');
    	$('#quantidade').val('1');
    	$("#listar_hospedes").text('');
    	$("#listar_hospedes").append('<a id="btn_sem_quarto" href="#" onclick="receberValor()" class="btn btn-danger" style="margin-top:20px">Sem Quarto</a>')
    	$('#modalForm').modal('show');
	}
</script>