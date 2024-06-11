<?php 
$tabela = 'categorias_quartos';
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
	<th>Nome</th>	
	<th class="esc">Descrição</th>	
	<th class="esc">Valor</th>	
	<th class="esc">Quartos</th>		
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
	$especificacoes = $res[$i]['especificacoes'];
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

	//totalizar quartos
	$query2 = $pdo->query("SELECT * from quartos where tipo = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$quartos = @count($res2);

echo <<<HTML
<tr style="color:{$classe_ativo}">
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$nome}
</td>
<td class="esc">{$descricaoF}</td>
<td class="esc">R$ {$valorF}</td>
<td class="esc">{$quartos}</td>
<td class="esc"><img src="images/quartos/{$foto}" width="25px"></td>
<td>
	<big><a href="#" onclick="editar('{$id}','{$nome}','{$valor}','{$descricao}','{$especificacoes}','{$foto}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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

<big><a href="#" onclick="mostrar('{$nome}','{$valorF}','{$descricao}','{$especificacoes}','{$ativo}','{$foto}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} verde"></i></a></big>

<big><a href="#" onclick="fotos('{$id}', '{$nome}')" title="Inserir Fotos"><i class="fa fa-file-image-o text-primary"></i></a></big>

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
	function editar(id, nome, valor, descricao, especificacoes, foto){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    	$('#descricao').val(descricao);
    	$('#valor').val(valor);
    	$('#especificacoes').val(especificacoes);

    	$('#target').attr("src", "images/quartos/" + foto);

    	$('#modalForm').modal('show');
	}


	function mostrar(nome, valor, descricao, especificacoes, ativo, foto){

		for (let letra of especificacoes){  				
			if (letra === '*'){
				especificacoes = especificacoes.replace('**', '<br>-')
			}			
		}
		    	
    	$('#titulo_dados').text(nome);
    	$('#valor_dados').text(valor);
    	$('#descricao_dados').html(descricao);
    	$('#especificacoes_dados').html('-' + especificacoes);    	
    	$('#ativo_dados').text(ativo);    	
    	$('#foto_dados').attr("src", "images/quartos/" + foto);
    	

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#descricao').val('');
    	$('#especificacoes').val('');
    	$('#valor').val('');
    	$('#foto').val('');
    	$('#target').attr("src", "images/quartos/sem-foto.jpg");

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


	function fotos(id, nome){			    	
    	$('#titulo_fotos').text(nome);
    	$('#id_fotos').val(id);  	   	
    	carregarFotos(id);
    	$('#modalFotos').modal('show');
	}

	function carregarFotos(id){
		$.ajax({
        url: 'paginas/' + pag + "/listar-fotos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar-fotos").html(result);
            $('#mensagem-excluir-foto').text('');
        }
    });
	}
</script>