<?php 
$tabela = 'quartos';
require_once("../../../conexao.php");

$numero = $_POST['numero'];
$obs = $_POST['obs'];
$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];

$id = $_POST['id'];

//validacao 
$query = $pdo->query("SELECT * from $tabela where numero = '$numero' and tipo = '$tipo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Quarto já Cadastrado!';
	exit();
}



if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET numero = :numero, descricao = :descricao, tipo = '$tipo', obs = :obs, ativo = 'Sim'");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET numero = :numero, descricao = :descricao, tipo = '$tipo', obs = :obs where id = '$id'");
}
$query->bindValue(":numero", "$numero");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":obs", "$obs");
$query->execute();

echo 'Salvo com Sucesso';
 ?>