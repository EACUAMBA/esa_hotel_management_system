<?php 
$tabela = 'banners_site';
require_once("../../../conexao.php");

$id = $_POST['id'];


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto = $res[0]['foto'];

if($foto != "sem-foto.jpg"){
	@unlink('../../images/banners/'.$foto);
}

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
echo 'Excluído com Sucesso';
?>