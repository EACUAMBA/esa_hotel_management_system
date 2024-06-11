<?php 
$tabela = 'receber';
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
$quantidade = $res[0]['quantidade'];
$produto = $res[0]['id_produto'];
$referencia = $res[0]['referencia'];

if($foto != "sem-foto.png"){
	@unlink('../../images/contas/'.$foto);
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';

//devolover os produtos ao estoque
if($produto != '' and $referencia == 'Venda'){

	$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$estoque = $res[0]['estoque'];
$tem_estoque = $res[0]['tem_estoque'];

	if($tem_estoque == 'Sim'){	
	$novo_estoque = $estoque + $quantidade;
	$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' where id = '$produto'");
}
}

?>