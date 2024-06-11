<?php 
$tabela = 'quartos';
require_once("../../../conexao.php");

$tipo = @$_POST['p1'];

$query = $pdo->query("SELECT * from $tabela where tipo LIKE '%$tipo%' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Número</th>	
	<th class="esc">Descrição</th>	
	<th class="esc">Tipo</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$numero = $res[$i]['numero'];
	$descricao = $res[$i]['descricao'];
	$tipo = $res[$i]['tipo'];
	$obs = $res[$i]['obs'];	
	$ativo = $res[$i]['ativo'];
	

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

	$query2 = $pdo->query("SELECT * from categorias_quartos where id = '$tipo'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_tipo = $res2[0]['nome'];

	if($obs != ""){
		$classe_obs = '';
	}else{
		$classe_obs = 'ocultar';
	}


echo <<<HTML
<tr style="color:{$classe_ativo}">
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$numero}

<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle {$classe_obs}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-comment-o text-danger"></i></big></a>

		<ul class="dropdown-menu">
		<li>
		<div class="notification_desc2">
		<p>{$obs}</p>
		</div>
		</li>										
		</ul>
</li>

</td>
<td class="esc">{$descricao}</td>
<td class="esc">{$nome_tipo}</td>

<td>
	<big><a href="#" onclick="editar('{$id}','{$numero}','{$descricao}','{$tipo}','{$obs}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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

<big><a href="#" onclick="mostrar('{$numero}','{$descricao}','{$nome_tipo}','{$obs}','{$ativo}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>

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

    
   

	$('.sel2').select2({
		dropdownParent: $('#modalForm')
	});

} );
</script>

<script type="text/javascript">
	function editar(id, numero, descricao, tipo, obs){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#numero').val(numero);
    	$('#descricao').val(descricao);
    	$('#tipo').val(tipo).change();
    	$('#obs').val(obs);
    	
    	$('#modalForm').modal('show');
	}


	function mostrar(numero, descricao, tipo, obs, ativo){
			
    	$('#titulo_dados').text(numero);
    	$('#descricao_dados').text(descricao);
    	$('#tipo_dados').text(tipo);
    	$('#obs_dados').text(obs);
    	$('#ativo_dados').text(ativo);
    	

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#numero').val('');
    	$('#descricao').val('');
    	$('#obs').val('');
    	

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