<?php 
$tabela = 'produtos';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$valor_compra = $_POST['valor_compra'];
$valor_venda = $_POST['valor_venda'];
$estoque = $_POST['estoque'];
$nivel_estoque = $_POST['nivel_estoque'];
$tem_estoque = $_POST['tem_estoque'];


$valor_compra = str_replace(',', '.', $valor_compra);
$valor_venda = str_replace(',', '.', $valor_venda);

$id = $_POST['id'];



//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-foto.jpg';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../images/produtos/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/produtos/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}

$query = $pdo->query("SELECT * from $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Nome já Cadastrado!';
	exit();
}

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, descricao = :descricao, categoria = '$categoria', ativo = 'Sim', foto = '$foto', valor_venda = :valor_venda, valor_compra = :valor_compra, estoque = '$estoque', tem_estoque = '$tem_estoque', nivel_estoque = '$nivel_estoque' ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, descricao = :descricao, categoria = '$categoria', foto = '$foto', valor_venda = :valor_venda, valor_compra = :valor_compra, estoque = '$estoque', tem_estoque = '$tem_estoque', nivel_estoque = '$nivel_estoque' where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor_venda", "$valor_venda");
$query->bindValue(":valor_compra", "$valor_compra");
$query->execute();

echo 'Salvo com Sucesso';
 ?>