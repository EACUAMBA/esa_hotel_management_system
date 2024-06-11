<?php 
$tabela = 'pagar';
require_once("../../../conexao.php");


@session_start();
$nivel_usuario = @$_SESSION['nivel'];

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id' and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $nivel_usuario != 'Administrador'){
	echo 'Somente um Administrador pode excluir uma conta já Paga!';
	exit();
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['arquivo'];
$produto = $res[0]['id_ref'];
$quantidade = $res[0]['quantidade'];
if($foto != "sem-foto.png"){
	@unlink('../../images/contas/'.$foto);
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);	
$estoque_produto = $res[0]['estoque'];
$novo_estoque = $estoque_produto - $quantidade;

//adicionar os produtos na tabela produtos
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$produto'"); 	

?>