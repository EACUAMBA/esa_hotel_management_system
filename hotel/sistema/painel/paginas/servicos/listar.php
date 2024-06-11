<?php 
$tabela = 'servicos';
require_once("../../../conexao.php");

$cat = @$_POST['p1'];

$query = $pdo->query("SELECT * from $tabela where categoria LIKE '%$cat%' order by id desc");
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
	<th class="esc">Valor</th>	
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
	$valor = $res[$i]['valor'];
	
	$foto = $res[$i]['foto'];	
	$ativo = $res[$i]['ativo'];
	
	$valorF = number_format($valor, 2, ',', '.');  
	
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

	
	
	$query2 = $pdo->query("SELECT * from categorias_servicos where id = '$categoria'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_categoria = $res2[0]['nome'];

echo <<<HTML
<tr style="color:{$classe_ativo}">
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$nome}
</td>
<td class="esc">{$nome_categoria}</td>
<td class="esc">R$ {$valorF}</td>

<td class="esc"><img src="images/servicos/{$foto}" width="25px"></td>
<td>
	<big><a href="#" onclick="editar('{$id}','{$nome}','{$valor}','{$descricao}','{$foto}','{$categoria}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

	<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>

<big><a href="#" onclick="mostrar('{$nome}','{$valorF}','{$descricao}','{$ativo}','{$foto}','{$nome_categoria}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} verde"></i></a></big>


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
	function editar(id, nome, valor, descricao, foto, categoria){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    	$('#descricao').val(descricao);
    	$('#valor').val(valor);    	
    	$('#categoria').val(categoria).change();

    	$('#target').attr("src", "images/servicos/" + foto);

    	$('#modalForm').modal('show');
	}

	function mostrar(nome, valor, descricao, ativo, foto, categoria){

				    	
    	$('#titulo_dados').text(nome);
    	$('#valor_dados').text(valor);
    	$('#descricao_dados').html(descricao);    	 	
    	$('#ativo_dados').text(ativo);    	
    	$('#foto_dados').attr("src", "images/servicos/" + foto);    	 
    	$('#categoria_dados').html(categoria);   
    	

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#descricao').val('');
    	$('#valor').val('');
    	
    	$('#foto').val('');
    	$('#target').attr("src", "images/servicos/sem-foto.jpg");

    	$('#ids').val('');
    	$('#btn-deletar').hide();	
	}

	function selecionar(id){

		var ids = $('#ids').val();

		if($('#seletor-'+id).is(":checked") == true){
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		}else{
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();
		if(ids_final == ""){
			$('#btn-deletar').hide();
		}else{
			$('#btn-deletar').show();
		}
	}

	function deletarSel(){
		var ids = $('#ids').val();
		var id = ids.split("-");
		
		for(i=0; i<id.length-1; i++){
			excluir(id[i]);			
		}

		limparCampos();
	}


	
</script>