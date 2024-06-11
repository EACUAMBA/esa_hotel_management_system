<?php 
$tabela = 'produtos';
require_once("../../../conexao.php");

$cat = @$_POST['p1'];

$query = $pdo->query("SELECT * from $tabela where estoque < nivel_estoque and ativo = 'Sim' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Categoria</th>	
	<th class="esc">Valor Venda</th>	
	<th class="esc">Valor Compra</th>
	<th class="esc">Estoque</th>	
	<th class="esc">Nível Mínimo</th>		
	<th class="esc">Foto</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$descricao = $res[$i]['descricao'];
	$categoria = $res[$i]['categoria'];
	$valor_venda = $res[$i]['valor_venda'];
	$valor_compra = $res[$i]['valor_compra'];
	$estoque = $res[$i]['estoque'];
	$tem_estoque = $res[$i]['tem_estoque'];
	$nivel_estoque = $res[$i]['nivel_estoque'];
	$foto = $res[$i]['foto'];	
	$ativo = $res[$i]['ativo'];
	$fornecedor = $res[$i]['fornecedor'];
	
	$valor_vendaF = number_format($valor_venda, 2, ',', '.');  
	$valor_compraF = number_format($valor_compra, 2, ',', '.');  
	$descricaoF = mb_strimwidth($descricao, 0, 50, "...");

	if($ativo == 'Sim'){
	$icone = 'fa-check-square';
	$titulo_link = 'Desativar Usuário';
	$acao = 'Não';
	$classe_ativo = '';
	}else{
		$icone = 'fa-square-o';
		$titulo_link = 'Ativar Usuário';
		$acao = 'Sim';
		$classe_ativo = '#c4c4c4';
	}

	if($estoque < $nivel_estoque){
		$classe_estoque = 'text-danger';
	}else{
		$classe_estoque = '';
	}

	
	$query2 = $pdo->query("SELECT * from categorias_produtos where id = '$categoria'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_categoria = @$res2[0]['nome'];

$query2 = $pdo->query("SELECT * from fornecedores where id = '$fornecedor'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_forn = @$res2[0]['nome'];

echo <<<HTML
<tr style="color:{$classe_ativo}">
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$nome}
</td>
<td class="esc">{$nome_categoria}</td>
<td class="esc">R$ {$valor_vendaF}</td>
<td class="esc">R$ {$valor_compraF}</td>
<td class="esc {$classe_estoque}">{$estoque}</td>
<td class="esc">{$nivel_estoque}</td>
<td class="esc"><img src="images/produtos/{$foto}" width="25px"></td>
<td>
	

<big><a href="#" onclick="mostrar('{$nome}','{$valor_vendaF}','{$valor_compraF}','{$descricao}','{$estoque}','{$nivel_estoque}','{$tem_estoque}','{$ativo}','{$foto}','{$nome_categoria}','{$nome_forn}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


</td>
</tr>
HTML;

}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
HTML;
}else{
	echo 'Nenhum registro Cadastrado!';
}
?>



<script type="text/javascript">
	$(document).ready( function () {		
    $('#tabela').DataTable({
    	"language" : {
            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
        "ordering": false,
		"stateSave": true
    });
} );
</script>

<script type="text/javascript">
	
	function mostrar(nome, valor_venda, valor_compra, descricao, estoque, nivel_estoque, tem_estoque, ativo, foto, categoria, fornecedor){

				    	
    	$('#titulo_dados').text(nome);
    	$('#venda_dados').text(valor_venda);
    	$('#descricao_dados').html(descricao);
    	$('#compra_dados').html(valor_compra);    	
    	$('#ativo_dados').text(ativo);    	
    	$('#foto_dados').attr("src", "images/produtos/" + foto);
    	$('#estoque_dados').html(estoque);   
    	$('#nivel_dados').html(nivel_estoque);   
    	$('#tem_estoque_dados').html(tem_estoque);   
    	$('#categoria_dados').html(categoria);   
    	$('#fornecedor_dados').html(fornecedor);   
    	

    	$('#modalDados').modal('show');
	}

		
</script>


