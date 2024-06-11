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
$tel_hospede = $res[0]['telefone'];

echo '<small>1 - '.$nome_hospede.' - <b>Tel</b> '.$tel_hospede.' - <b>Doc:</b> '.$bi_hospede.'</small>';

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
    $tel_hospede = $res[$i]['telefone'];

	echo '<br><small>'.$cont.' - '.$nome_hospede.' - <b>Tel</b> '.$tel_hospede.' - <b>Doc:</b> '.$bi_hospede.'</small>';

}
}

?>

