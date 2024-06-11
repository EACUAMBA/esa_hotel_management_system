<?php 
require_once("../../../conexao.php");

$nome_hospede = $_POST['nome_hospede'];
$bi_checkin = $_POST['bi_checkin'];
$id = $_POST['id_hospedes'];
$telefone = $_POST['telefone_checkin'];


$query = $pdo->query("SELECT * from hospedes where telefone = '$telefone'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$id_hospede = $res[0]['id'];
	$query = $pdo->prepare("UPDATE hospedes SET nome = :nome_hospede, bi = :bi_checkin, reserva = '$id', telefone = '$telefone', responsavel = 'Não' WHERE id = '$id_hospede'");

	$query->bindValue(":nome_hospede", "$nome_hospede");
	$query->bindValue(":bi_checkin", "$bi_checkin");
	$query->execute();
	echo 'Salvo com Sucesso';
	exit();
}


$query = $pdo->query("SELECT * from hospedes where bi = '$bi_checkin'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$id_hospede = $res[0]['id'];
	$query = $pdo->prepare("UPDATE hospedes SET nome = :nome_hospede, bi = :bi_checkin, reserva = '$id', telefone = '$telefone', responsavel = 'Não' WHERE id = '$id_hospede'");

	$query->bindValue(":nome_hospede", "$nome_hospede");
	$query->bindValue(":bi_checkin", "$bi_checkin");
	$query->execute();
	echo 'Salvo com Sucesso';
	exit();
}

$query = $pdo->query("SELECT * from reservas where id = '$id'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$hospedes = $res[0]['hospedes'];

$query = $pdo->query("SELECT * from hospedes where reserva = '$id'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas >= $hospedes - 1){
	echo 'Você não pode cadastrar mais que '.$hospedes.' Hóspedes para esse Checkin!';
	exit();
}

$query = $pdo->prepare("INSERT INTO hospedes SET nome = :nome_hospede, bi = :bi_checkin, reserva = '$id', telefone = '$telefone', data = curDate(), responsavel = 'Não'");

$query->bindValue(":nome_hospede", "$nome_hospede");
$query->bindValue(":bi_checkin", "$bi_checkin");
$query->execute();
echo 'Salvo com Sucesso';
?>