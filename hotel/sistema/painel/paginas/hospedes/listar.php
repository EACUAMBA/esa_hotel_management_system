<?php 
$tabela = 'hospedes';
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
	<th class="esc">Telefone</th>	
	<th class="esc">Email</th>	
	<th class="esc">Documento</th>	
	<th class="esc">Cadastrado</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$telefone = $res[$i]['telefone'];
	$email = $res[$i]['email'];
	$bi = $res[$i]['bi'];
	$obs = $res[$i]['obs'];
	$placa = $res[$i]['placa'];
	$responsavel = $res[$i]['responsavel'];
	$data_nasc = $res[$i]['data_nasc'];
	
	$endereco = $res[$i]['endereco'];	
	$data = $res[$i]['data'];

	$dataF = implode('/', array_reverse(explode('-', $data)));
	$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));

	
echo <<<HTML
<tr>
<td>
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$nome}
</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$email}</td>
<td class="esc">{$bi}</td>
<td class="esc">{$dataF}</td>
<td>
	<big><a href="#" onclick="editar('{$id}','{$nome}','{$email}','{$telefone}','{$endereco}','{$bi}','{$obs}','{$placa}','{$responsavel}','{$data_nascF}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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

<big><a href="#" onclick="mostrar('{$nome}','{$email}','{$telefone}','{$endereco}','{$bi}','{$dataF}','{$obs}','{$placa}','{$responsavel}','{$data_nascF}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a href="#" onclick="arquivo('{$id}', '{$nome}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>

<big><a href="#" onclick="reservas('{$id}', '{$nome}')" title="Ver Reservas"><i class="fa fa-calendar" style="color:#827878"></i></a></big>


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
	function editar(id, nome, email, telefone, endereco, bi, obs, placa, responsavel, nasc){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    	$('#email').val(email);
    	$('#telefone').val(telefone);
    	$('#endereco').val(endereco);
    	$('#documento').val(bi);
    	$('#obs').val(obs);
    	$('#placa').val(placa);
    	$('#responsavel').val(responsavel).change();

    	$('#data_nascimento').val(nasc);

    	$('#modalForm').modal('show');
	}


	function mostrar(nome, email, telefone, endereco, bi, data, obs, placa, responsavel, nasc){
		    	
    	$('#titulo_dados').text(nome);
    	$('#email_dados').text(email);
    	$('#telefone_dados').text(telefone);
    	$('#endereco_dados').text(endereco);
    	$('#bi_dados').text(bi);
    	$('#data_dados').text(data);
    	$('#obs_dados').text(obs);
    	$('#placa_dados').text(placa);
    	$('#responsavel_dados').text(responsavel);
    	$('#nasc_dados').text(nasc);
    	    	

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#email').val('');
    	$('#telefone').val('');
    	$('#endereco').val('');
    	$('#obs').val('');
    	$('#bi').val('');
    	$('#placa').val('');

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


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


function reservas(id, nome){
    $('#id-reservas').val(id);    
    $('#nome-reservas').text(nome);
    $('#modalReservas').modal('show');   
    listarReservas();   
}
</script>