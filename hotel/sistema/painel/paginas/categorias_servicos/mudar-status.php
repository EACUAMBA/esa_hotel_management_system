<?php 
$tabela = 'categorias_servicos';
require_once("../../../conexao.php");

$id = $_POST['id'];
$acao = $_POST['acao'];

$pdo->query("UPDATE $tabela SET ativo = '$acao' WHERE id = '$id' ");
echo 'Alterado com Sucesso';
?>