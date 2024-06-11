<?php 
require_once("../../../conexao.php");
$pagina = 'pagar';
$data_atual = date('Y-m-d');

$total_valor = 0;
$total_valorF = 0;
$total_pendentes = 0;
$total_pendentesF = 0;
$total_pagas = 0;
$total_pagasF = 0;

$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$status = '%'.@$_POST['status'].'%';
$alterou_data = @$_POST['alterou_data'];
$vencidas = @$_POST['vencidas'];
$hoje = @$_POST['hoje'];
$amanha = @$_POST['amanha'];


//PEGAR O TOTAL DAS CONTAS A PAGAR PENDENTES
$query = $pdo->query("SELECT * from $pagina where referencia = 'Compra' and pago = 'Não'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
		$total_valor += $res[$i]['valor'];
		$total_valorF = number_format($total_valor, 2, ',', '.');
}}


$data_hoje = date('Y-m-d');
$data_amanha = date('Y/m/d', strtotime("+1 days",strtotime($data_hoje)));

if($alterou_data == 'Sim'){
	if($dataInicial != "" || $dataFinal != ""){
		$query = $pdo->query("SELECT * from $pagina where referencia = 'Compra' and (data_lanc >= '$dataInicial' and data_lanc <= '$dataFinal') and pago LIKE '$status' order by id desc ");
	}
}else if($status != '%%' and $alterou_data == ''){
	$query = $pdo->query("SELECT * from $pagina where referencia = 'Compra' and pago LIKE '$status' order by id desc ");
}

else if($vencidas == 'Vencidas'){
	$query = $pdo->query("SELECT * from $pagina where referencia = 'Compra' and data_venc < curDate() and pago = 'Não' order by id desc ");
}

else if($vencidas == 'Hoje'){
	$query = $pdo->query("SELECT * from $pagina where referencia = 'Compra' and data_venc = curDate() and pago = 'Não' order by id desc ");
}

else if($vencidas == 'Amanha'){
	$query = $pdo->query("SELECT * from $pagina where referencia = 'Compra' and data_venc = '$data_amanha' and pago = 'Não' order by id desc ");
}

else{
	$query = $pdo->query("SELECT * from $pagina WHERE referencia = 'Compra' order by id desc limit 100");
}


echo <<<HTML
<small>
HTML;

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th>Descrição</th>				
				<th class="esc">Valor</th> 
				<th class="esc">Fornecedor</th> 
				<th class="esc">Data Compra</th> 
				<th class="esc">Vencimento</th> 
				<th class="esc">Lançada Por</th>				
				<th>Arquivo</th>				
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$descricao = $res[$i]['descricao'];
$fornecedor = $res[$i]['fornecedor'];
$valor = $res[$i]['valor'];
$data_lanc = $res[$i]['data_lanc'];
$data_venc = $res[$i]['data_venc'];
$data_pgto = $res[$i]['data_pgto'];
$usuario_lanc = $res[$i]['usuario_lanc'];
$usuario_pgto = $res[$i]['usuario_pgto'];
$arquivo = $res[$i]['arquivo'];
$pago = $res[$i]['pago'];
$obs = $res[$i]['obs'];
$hospede = $res[$i]['hospede'];
$funcionario = $res[$i]['funcionario'];

//extensão do arquivo
$ext = pathinfo($arquivo, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else if($ext == 'doc' || $ext == 'docx' || $ext == 'txt'){
	$tumb_arquivo = 'word.png';
}else if($ext == 'xlsx' || $ext == 'xlsm' || $ext == 'xls'){
	$tumb_arquivo = 'excel.png';
}else if($ext == 'xml'){
	$tumb_arquivo = 'xml.png';
}else{
	$tumb_arquivo = $arquivo;
}

$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
$valorF = number_format($valor, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_pgto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_pgto = $res2[0]['nome'];
}else{
	$nome_usu_pgto = 'Sem Usuário';
}


$nome_pessoa = 'Sem Registro';
$tipo_pessoa = 'Pessoa';
$pix_pessoa = 'Sem Registro';


$query2 = $pdo->query("SELECT * FROM fornecedores where id = '$fornecedor'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];	
	$pix_pessoa = $res2[0]['chave_pix'];
	$tipo_pessoa = 'Fornecedor';
}

$query2 = $pdo->query("SELECT * FROM funcionarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];	
	$pix_pessoa = $res2[0]['chave_pix'];
	$tipo_pessoa = 'Funcionário';
}


$query2 = $pdo->query("SELECT * FROM hospedes where id = '$hospede'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];	
	$pix_pessoa = 'Não Cadastrado!';
	$tipo_pessoa = 'Hóspede';
}


if($pago == 'Sim'){
	$classe_pago = 'verde';
	$ocultar = 'ocultar';
	$total_pagas += $valor;
}else{
	$classe_pago = 'text-danger';
	$ocultar = '';
	$total_pendentes += $valor;
}

if($nome_pessoa == 'Sem Registro'){
	$classe_pessoa = 'ocultar';	
}else{
	$classe_pessoa = '';	
}

$total_pagasF = number_format($total_pagas, 2, ',', '.');
$total_pendentesF = number_format($total_pendentes, 2, ',', '.');

echo <<<HTML
			<tr> 
				<td>
				<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
				<i class="fa fa-square {$classe_pago} mr-1"></i> {$descricao} </td> 
					<td class="esc">R$ {$valorF} </td>	
					<td class="esc">{$nome_pessoa} </td>	
					<td class="esc">{$data_lancF}</td>
				<td class="esc">{$data_vencF}</td>
				<td class="esc">{$nome_usu_lanc}</td>
				<td><a href="images/contas/{$arquivo}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="30px" height="30px"></a></td>
				<td>
					

					<big><a href="#" onclick="mostrar('{$id}', '{$descricao}', '{$nome_pessoa}', '{$tipo_pessoa}','{$valorF}','{$data_lancF}','{$data_vencF}','{$data_pgtoF}','{$nome_usu_lanc}','{$nome_usu_pgto}','{$arquivo}','{$pago}','{$obs}','{$pix_pessoa}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

				
		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir_conta('{$id}', '{$descricao}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>



		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a class="{$ocultar}" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square" style="color:#079934"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Baixa? <a href="#" onclick="baixar_conta('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>				
					

					<big><a href="#" onclick="arquivo('{$id}', '{$descricao}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>
				</td>  
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
		<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	<div align="right" style="margin-top: 10px"> 
	<span>Total Pendente: <span class="text-danger">{$total_pendentesF}</span></span> 
	<span style="margin-left: 35px">Total Pago: <span class="verde">{$total_pagasF}</span></span> 
	</div>
</small>
HTML;
}else{
	echo 'Não possui nenhuma conta para esta data!';
}

?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();
	    $('#total_itens').text('R$ <?=$total_valorF?>');
	} );



	function editar(id, descricao, fornecedor, valor, data_venc, arquivo, funcionario, obs, hospede){

		if(fornecedor == 0){
			fornecedor = "";
		}

		if(funcionario == 0){
			funcionario = "";
		}

		if(hospede == 0){
			hospede = "";
		}

		
		
		$('#id').val(id);
		$('#descricao').val(descricao);
		$('#fornecedor').val(fornecedor).change();
		$('#valor').val(valor);
		$('#data_venc').val(data_venc);		
		$('#funcionario').val(funcionario).change();
		$('#hospede').val(hospede).change();
		$('#obs').val(obs);		

		$('#arquivo').val('');
		

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

		resultado = arquivo.split(".", 2);

    	  if(resultado[1] === 'pdf'){
            $('#target').attr('src', "images/pdf.png");
            return;
        } else if(resultado[1] === 'rar' || resultado[1] === 'zip'){
            $('#target').attr('src', "images/rar.png");
            return;
        }else if(resultado[1] === 'doc' || resultado[1] === 'docx'){
            $('#target').attr('src', "images/word.png");
            return;
        }else if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
            $('#target').attr('src', "images/excel.png");
            return;
        }else if(resultado[1] === 'xml'){
            $('#target').attr('src', "images/xml.png");
            return;
        }else{
        	$('#target').attr('src','images/contas/' + arquivo);			
        }			
	}



	function mostrar(id, descricao, pessoa, tipo_pessoa, valor, data_lanc, data_venc, data_pgto, usuario_lanc, usuario_pgto,  arquivo, pago, obs, pix){

		
		if(data_pgto == "00/00/0000" || data_pgto == ""){
			data_pgto = 'Não Pago Ainda';
		}

		
		$('#pessoa_mostrar').text(pessoa);
		$('#tipo_pessoa_mostrar').text(tipo_pessoa);


		$('#nome_mostrar').text(descricao);
		
		$('#valor_mostrar').text(valor);
		$('#lanc_mostrar').text(data_lanc);
		$('#venc_mostrar').text(data_venc);
		$('#pgto_mostrar').text(data_pgto);		
		$('#usu_lanc_mostrar').text(usuario_lanc);	
		$('#usu_pgto_mostrar').text(usuario_pgto);	
		
		$('#pago_mostrar').text(pago);
		$('#obs_mostrar').text(obs);

	
		$('#pix_mostrar').text(pix);
		
		$('#link_arquivo').attr('href','images/contas/' + arquivo);
		

		$('#modalMostrar').modal('show');

		resultado = arquivo.split(".", 2);

    	 if(resultado[1] === 'pdf'){
            $('#target_mostrar').attr('src', "images/pdf.png");
            return;
        } else if(resultado[1] === 'rar' || resultado[1] === 'zip'){
            $('#target_mostrar').attr('src', "images/rar.png");
            return;
        }else if(resultado[1] === 'doc' || resultado[1] === 'docx'){
            $('#target_mostrar').attr('src', "images/word.png");
            return;
        }else if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
            $('#target_mostrar').attr('src', "images/excel.png");
            return;
        }else if(resultado[1] === 'xml'){
            $('#target_mostrar').attr('src', "images/xml.png");
            return;
        }else{
        	$('#target_mostrar').attr('src','images/contas/' + arquivo);			
        }		
       
	}

	function limparCampos(){
		$('#id').val('');
		$('#descricao').val('');		
		$('#valor').val('');		
		$('#data_venc').val('<?=$data_atual?>');			
		$('#arquivo').val('');
		$('#target').attr('src','images/contas/sem-foto.png');
		$('#obs').val('');	
		

		$('#ids').val('');
		$('#div_botoes').hide();	

	}


	


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
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
			$('#div_botoes').hide();	
		}else{
			$('#div_botoes').show();	
		}
	}

	function deletarSel(){
		var ids = $('#ids').val();
		var id = ids.split("-");
		
		for(i=0; i<id.length-1; i++){
			excluir_conta(id[i]);			
		}

		limparCampos();
	}

	function baixarSel(){
		var ids = $('#ids').val();
		var id = ids.split("-");
		
		for(i=0; i<id.length-1; i++){
			baixar_conta(id[i]);			
		}

		limparCampos();
	}


</script>



