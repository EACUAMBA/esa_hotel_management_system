<?php 
$tabela = 'funcionarios';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nivel = $_POST['nivel'];
$endereco = $_POST['endereco'];
$chave_pix = $_POST['chave_pix'];
$bi = $_POST['bi'];
$obs = $_POST['obs'];
$id = $_POST['id'];


//validacao telefone
$query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Telefone já Cadastrado!';
	exit();
}

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, bi = :bi, obs = :obs, chave_pix = :chave_pix, cargo = '$nivel', telefone = :telefone, data = curDate(), endereco = :endereco ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, cargo = '$nivel', telefone = :telefone, endereco = :endereco, bi = :bi, obs = :obs, chave_pix = :chave_pix where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":obs", "$obs");
$query->bindValue(":chave_pix", "$chave_pix");
$query->bindValue(":bi", "$bi");
$query->execute();

echo 'Salvo com Sucesso';
 ?>