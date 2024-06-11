<?php 
$tabela = 'fornecedores';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$chave_pix = $_POST['chave_pix'];

$id = $_POST['id'];


if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, telefone = :telefone, data = curDate(), endereco = :endereco, chave_pix = :chave_pix ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email,  telefone = :telefone, endereco = :endereco, chave_pix = :chave_pix where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":chave_pix", "$chave_pix");
$query->execute();

echo 'Salvo com Sucesso';
 ?>