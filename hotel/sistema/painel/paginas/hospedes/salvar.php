<?php 
$tabela = 'hospedes';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$bi = $_POST['bi'];
$endereco = $_POST['endereco'];
$obs = $_POST['obs'];
$responsavel = $_POST['responsavel'];
$placa = $_POST['placa'];
$data_nasc = $_POST['data_nasc'];
$id = $_POST['id'];

$data_nasc = implode('-', array_reverse(explode('/', $data_nasc)));

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, bi = :bi, obs = :obs, responsavel = :responsavel, placa = :placa, telefone = :telefone, data = curDate(), endereco = :endereco, data_nasc = :data_nasc ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, bi = :bi, obs = :obs, telefone = :telefone, responsavel = :responsavel, placa = :placa, endereco = :endereco, data_nasc = :data_nasc where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":bi", "$bi");
$query->bindValue(":obs", "$obs");
$query->bindValue(":responsavel", "$responsavel");
$query->bindValue(":placa", "$placa");
$query->bindValue(":data_nasc", "$data_nasc");
$query->execute();

echo 'Salvo com Sucesso';
 ?>