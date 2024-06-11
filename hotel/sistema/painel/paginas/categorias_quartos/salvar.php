<?php 
$tabela = 'categorias_quartos';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$especificacoes = $_POST['especificacoes'];
$valor = $_POST['valor'];

$valor = str_replace(',', '.', $valor);
$descricao = str_replace('"', '', $descricao);
$descricao = str_replace("'", "", $descricao);
$descricao = str_replace(array("\n"), '<br>', $descricao);
$descricao = str_replace(array("\r"), '', $descricao);

$especificacoes = str_replace('"', '', $especificacoes);
$especificacoes = str_replace("'", "", $especificacoes);
$especificacoes = str_replace(array("\n"), '<br>', $especificacoes);
$especificacoes = str_replace(array("\r"), '', $especificacoes);


$nome_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
$nome_url = preg_replace('/[ -]+/' , '-' , $nome_novo);

$nome_url = str_replace('%', '', $nome_url);
$nome_url = str_replace('"', '', $nome_url);
$nome_url = str_replace('/', '', $nome_url);

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

$caminho = '../../images/quartos/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/quartos/'.$foto);
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
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, descricao = :descricao, especificacoes = :especificacoes, ativo = 'Sim', foto = '$foto', valor = :valor, nome_url = '$nome_url' ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, descricao = :descricao, especificacoes = :especificacoes, ativo = 'Sim', foto = '$foto', valor = :valor, nome_url = '$nome_url' where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":especificacoes", "$especificacoes");
$query->bindValue(":valor", "$valor");
$query->execute();

echo 'Salvo com Sucesso';
 ?>