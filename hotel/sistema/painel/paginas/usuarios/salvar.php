<?php 
$tabela = 'usuarios';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nivel = $_POST['nivel'];
$endereco = $_POST['endereco'];
$senha = '123';
$senha_crip = md5($senha);
$id = $_POST['id'];

//validacao email
$query = $pdo->query("SELECT * from $tabela where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Email já Cadastrado!';
	exit();
}

//validacao telefone
$query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Telefone já Cadastrado!';
	exit();
}

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, senha = '$senha', senha_crip = '$senha_crip', nivel = '$nivel', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = :telefone, data = curDate(), endereco = :endereco ");

	//enviar mensagem whatsapp
	if($api_whatsapp == 'Sim'){
		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
		$mensagem = '_Você foi Cadastrado no Sistema '.$nome_sistema.'_ %0A';
		$mensagem .= 'Nome: *'.$nome.'* %0A';
		$mensagem .= 'Email: *'.$email.'* %0A';
		$mensagem .= 'Senha: *'.$senha.'* %0A%0A';
		$mensagem .= '_Após acessar seu painel, troque a senha para uma de sua preferência!_ %0A';
		require("../../api/texto.php");
	}
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, nivel = '$nivel', telefone = :telefone, endereco = :endereco where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->execute();

echo 'Salvo com Sucesso';
 ?>