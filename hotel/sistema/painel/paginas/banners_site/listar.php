<?php 
$tabela = 'banners_site';
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Título</th>	
	<th class="esc">Subtítulo</th>	
	<th class="esc">Descrição</th>	
	<th class="esc">Link</th>			
	<th class="esc">Foto</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$titulo = $res[$i]['titulo'];
	$descricao = $res[$i]['descricao'];
	$subtitulo = $res[$i]['subtitulo'];
	$link = $res[$i]['link'];
	$foto = $res[$i]['foto'];	
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

	

echo <<<HTML
<tr style="color:{$classe_ativo}">
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$titulo}
</td>
<td class="esc">{$subtitulo}</td>
<td class="esc">{$descricao}</td>
<td class="esc">{$link}</td>
<td class="esc"><img src="images/banners/{$foto}" width="25px"></td>
<td>
	<big><a href="#" onclick="editar('{$id}','{$titulo}','{$subtitulo}','{$descricao}','{$link}','{$foto}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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
	function editar(id, titulo, subtitulo, descricao, link, foto){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#titulo').val(titulo);
    	$('#descricao').val(descricao);
    	$('#subtitulo').val(subtitulo);
    	$('#link').val(link);

    	$('#target').attr("src", "images/banners/" + foto);

    	$('#modalForm').modal('show');
	}


	function limparCampos(){
		$('#id').val('');
    	$('#titulo').val('');
    	$('#descricao').val('');
    	$('#subtitulo').val('');
    	$('#link').val('');
    	$('#foto').val('');
    	$('#target').attr("src", "images/banners/sem-foto.jpg");

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