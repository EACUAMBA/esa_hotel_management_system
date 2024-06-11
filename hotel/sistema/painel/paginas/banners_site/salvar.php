<?php 
$tabela = 'banners_site';
require_once("../../../conexao.php");

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$subtitulo = $_POST['subtitulo'];
$link = $_POST['link'];


$descricao = str_replace('"', '', $descricao);
$descricao = str_replace("'", "", $descricao);

$titulo = str_replace('"', '', $titulo);
$titulo = str_replace("'", "", $titulo);

$subtitulo = str_replace('"', '', $subtitulo);
$subtitulo = str_replace("'", "", $subtitulo);

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

$caminho = '../../images/banners/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/banners/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET titulo = :titulo, descricao = :descricao, subtitulo = :subtitulo, link = :link, ativo = 'Sim', foto = '$foto'");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET titulo = :titulo, descricao = :descricao, subtitulo = :subtitulo, link = :link, foto = '$foto' where id = '$id'");
}
$query->bindValue(":titulo", "$titulo");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":subtitulo", "$subtitulo");
$query->bindValue(":link", "$link");
$query->execute();

echo 'Salvo com Sucesso';
 ?>