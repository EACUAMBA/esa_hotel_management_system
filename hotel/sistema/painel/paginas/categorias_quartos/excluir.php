<?php 
$tabela = 'categorias_quartos';
require_once("../../../conexao.php");

$id = $_POST['id'];

//verificar se possui registros relacionados a ela
$query = $pdo->query("SELECT * FROM quartos where tipo = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Você não pode excluir esta categoria, existem quartos relacionados a ela!';
	exit();
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto = $res[0]['foto'];

if($foto != "sem-foto.jpg"){
	@unlink('../../images/quartos/'.$foto);
}

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
$pdo->query("DELETE FROM fotos_quartos WHERE quarto = '$id' ");
echo 'Excluído com Sucesso';
?>