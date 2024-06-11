<?php 
require_once("../../../conexao.php");

$quarto = @$_POST['quarto'];

$query = $pdo->query("SELECT * from quartos where numero = '$quarto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_quarto = @$res[0]['id'];

$query = $pdo->query("SELECT * from reservas where quarto = '$id_quarto' and hora_checkin != '' and hora_checkin is not null and (hora_checkout = '' or hora_checkout is null)");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$hospede = $res[0]['hospede'];
	$id_reserva = $res[0]['id'];

	$query = $pdo->query("SELECT * from hospedes where id = '$hospede'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_hospede = $res[0]['nome'];
$bi_hospede = $res[0]['bi'];
$id_hospede = $res[0]['id'];

echo <<<HTML
<a href="#" onclick="selecionarHospede('{$nome_hospede}', '{$id_hospede}')"><small>1 - {$nome_hospede}</small></a>
HTML;

$query = $pdo->query("SELECT * from hospedes where reserva = '$id_reserva'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
$cont = 1;
for($i=0; $i<$linhas; $i++){
	$cont += 1; 
	$nome_hospede = $res[$i]['nome'];
	$bi_hospede = $res[$i]['bi'];
	$id_hospede = $res[$i]['id'];

echo <<<HTML
<br><a href="#" onclick="selecionarHospede('{$nome_hospede}', '{$id_hospede}')"><small>{$cont} - {$nome_hospede}</small></a>
HTML;
}
}
}else{
	echo '0';
	exit();
}

?>


<script type="text/javascript">

	$(document).ready( function () {	

	
	$('#id_reserva').val('<?=$id_reserva?>')

	});

	function selecionarHospede(nome, id){
		$('#nome_hospede').val(nome)
		$('#id_hospede').val(id)
	}
</script>