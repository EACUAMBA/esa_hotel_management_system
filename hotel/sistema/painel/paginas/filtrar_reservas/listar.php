<?php 
$tabela = 'reservas';
require_once("../../../conexao.php");

$tipo = @$_POST['p1'];
$dataInicial = @$_POST['p2'];
$dataFinal = @$_POST['p3'];
$codigo = @$_POST['p4'];

if($tipo == ""){
	$tipo = 'check_in';
}

if($dataInicial == ""){
	$dataInicial = date('Y-m-d');
}

if($dataFinal == ""){
	$dataFinal = date('Y-m-d');
}

if($codigo == ""){
	$query = $pdo->query("SELECT * from $tabela where $tipo >= '$dataInicial' and $tipo <= '$dataFinal' order by $tipo asc");
}else{
	$query = $pdo->query("SELECT * from $tabela where id = '$codigo' order by $tipo asc");
}


$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Código</th>
	<th>Hóspede</th>	
	<th class="esc">Tipo Quarto</th>	
	<th class="esc">Quarto</th>
	<th class="esc">Check-In</th>
	<th class="esc">Check-Out</th>
	<th class="esc">Data Reserva</th>
	<th class="esc">Funcionário</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$hospede = $res[$i]['hospede'];
	$tipo_quarto = $res[$i]['tipo_quarto'];
	$quarto = $res[$i]['quarto'];
	$funcionario = $res[$i]['funcionario'];
	$check_in = $res[$i]['check_in'];
	$check_out = $res[$i]['check_out'];
	$valor = $res[$i]['valor'];
	$no_show = $res[$i]['no_show'];
	$hospedes = $res[$i]['hospedes'];
	$obs = $res[$i]['obs'];
	$valor_diaria = $res[$i]['valor_diaria'];
	$data = $res[$i]['data'];
	$desconto = $res[$i]['desconto'];
	$forma_pgto = $res[$i]['forma_pgto'];

	$query2 = $pdo->query("SELECT * from categorias_quartos where id = '$tipo_quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_tipo = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from quartos where id = '$quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$numero_quarto = @$res2[0]['numero'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from hospedes where id = '$hospede'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_hospede = @$res2[0]['nome'];
	$bi = @$res2[0]['bi'];
	$telefone_hospede = @$res2[0]['telefone'];

	$query2 = $pdo->query("SELECT * from formas_pgto where id = '$forma_pgto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$forma_pgto_nome = @$res2[0]['nome'];

	$nome_hospedeF = mb_strimwidth($nome_hospede, 0, 20, "...");
	$check_inF = implode('/', array_reverse(explode('-', $check_in)));
	$check_outF = implode('/', array_reverse(explode('-', $check_out)));
	$dataF = implode('/', array_reverse(explode('-', $data)));

	$valorF = number_format($valor, 2, ',', '.');  
	$no_showF = number_format($no_show, 2, ',', '.');  

	if($obs != ""){
		$classe_obs = '';
	}else{
		$classe_obs = 'ocultar';
	}
	


echo <<<HTML
<tr>
<td>{$id}</td>
<td>
{$nome_hospede}

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
<td class="esc">{$nome_tipo}</td>
<td class="esc">{$numero_quarto}</td>
<td class="esc verde">{$check_inF}</td>
<td class="esc text-danger">{$check_outF}</td>
<td class="esc">{$dataF}</td>
<td class="esc">{$nome_func}</td>
<td>
	
	<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a title="Detalhamento" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-info-circle text-primary"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p style="font-size: 13px">
		
		<b>Nome</b> {$nome_hospede}<br> 
		<b>BI</b> {$bi} / <b>Tel:</b> {$telefone_hospede}<br>
		<b>Quantidade de Hóspedes</b> {$hospedes}<br>
		<b>Valor</b> R$ {$valorF} / <b>Entrada</b> R$ {$no_showF}<br>
		<b>Forma de Pagamento</b> {$forma_pgto_nome}<br>
		<b>Lançador Por</b> {$nome_func}<br>
		<span class="{$classe_obs}"><br><b>OBS:</b> {$obs}</span>
		</p>
		</div>
		</li>										
		</ul>
</li>

<big><a target="_blank" href="rel/reserva_class.php?id={$id}" title="Detalhamento PDF"><i class="fa fa-file-pdf-o text-danger"></i></a></big>

<big><a target="_blank" href="rel/consumo_class.php?id={$id}" title="Detalhamento Consumo"><i class="fa fa-file-pdf-o verde"></i></a></big>

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