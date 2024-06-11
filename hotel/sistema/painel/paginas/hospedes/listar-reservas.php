<?php 
require_once("../../../conexao.php");
$pagina = 'reservas';
$id = $_POST['id'];

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM $pagina where hospede = '$id' order by data desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="">
		<thead> 
			<tr> 	
				<th>Código</th>			
				<th>Check_In</th>
				<th>Check_Out</th>				
				<th class="esc">Quarto</th>				
				<th class="esc">Tipo Quarto</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
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
	$hora_checkin = $res[$i]['hora_checkin'];
	$hora_checkout = $res[$i]['hora_checkout'];
	$funcionario_checkin = $res[$i]['funcionario_checkin'];
	$funcionario_checkout = $res[$i]['funcionario_checkout'];
	$tipo_pgto_checkin = $res[$i]['tipo_pgto_checkin'];
	$tipo_pgto_checkout = $res[$i]['tipo_pgto_checkout'];
	$valor_checkout = $res[$i]['valor_checkout'];


	$check_inF = implode('/', array_reverse(explode('-', $check_in)));
	$check_outF = implode('/', array_reverse(explode('-', $check_out)));


	$query2 = $pdo->query("SELECT * from categorias_quartos where id = '$tipo_quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_tipo = @$res2[0]['nome'];
	
	$query2 = $pdo->query("SELECT * from quartos where id = '$quarto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$numero_quarto = @$res2[0]['numero'];


echo <<<HTML
			<tr>					
				<td class="">{$id}</td>
				<td >{$check_inF}</td>				
				<td >{$check_outF}</td>	
				<td class="esc">{$numero_quarto}</td>	
				<td class="esc">{$nome_tipo}</td>	
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
	</table>
</small>
HTML;
}else{
	echo 'Não possui nenhuma reserva cadastrada!';
}

?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela_arquivos').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();	    
	} );


	function excluirArquivo(id, nome){	
    
    $.ajax({
        url: 'paginas/' + pag + "/excluir-arquivo.php",
        method: 'POST',
        data: {id, nome},
        dataType: "text",

        success: function (mensagem) {
            $('#mensagem-arquivo').text('');
            $('#mensagem-arquivo').removeClass()
            if (mensagem.trim() == "Excluído com Sucesso") {                
                listarArquivos();                
            } else {

                $('#mensagem-arquivo').addClass('text-danger')
                $('#mensagem-arquivo').text(mensagem)
            }


        },      

    });
}


</script>


