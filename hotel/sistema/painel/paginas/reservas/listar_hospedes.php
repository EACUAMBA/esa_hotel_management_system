<?php 
$tabela = 'reservas';
require_once("../../../conexao.php");

$id = @$_POST['id'];

$query = $pdo->query("SELECT * from $tabela where id = '$id'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
$hospedes = $res[0]['hospedes'];
$hospede = $res[0]['hospede'];

$query = $pdo->query("SELECT * from hospedes where id = '$hospede'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_hospede = $res[0]['nome'];
$bi_hospede = $res[0]['bi'];

echo '<small>1 - '.$nome_hospede.' - Doc: '.$bi_hospede.'</small>';

$query = $pdo->query("SELECT * from hospedes where reserva = '$id'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
$cont = 1;
for($i=0; $i<$linhas; $i++){
	$cont += 1; 
	$nome_hospede = $res[$i]['nome'];
	$bi_hospede = $res[$i]['bi'];
	$id_hospede = $res[$i]['id'];

	echo '<br><small>'.$cont.' - '.$nome_hospede.' - Doc: '.$bi_hospede.'</small>';
echo <<<HTML
<small><li class="dropdown head-dpdn2" style="display: inline-block; margin-left: 5px">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluirHospede('{$id_hospede}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li></small>
HTML;
}
}

?>

<script type="text/javascript">
	
function excluirHospede(id){	
    $('#mensagem-excluir').text('Excluindo...')
    
    $.ajax({
        url: 'paginas/' + pag + "/excluir_hospede.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {           
            	var id = $("#id_hospedes").val();		
                listar_hosp(id);
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
}
</script>