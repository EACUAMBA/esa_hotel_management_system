<?php 
$tabela = 'pagar';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$id = $_POST['id'];

$query = $pdo->query("SELECT * from $tabela where id = '$id' and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	exit();
}

$pdo->query("UPDATE $tabela SET pago = 'Sim', usuario_pgto = '$id_usuario', data_pgto = curDate() where id = '$id'");

echo 'Baixado com Sucesso';

?>

