<?php 
$tabela = 'galeria_site';
require_once("../../../conexao.php");

for ($i = 0; $i < count(@$_FILES['imggaleria']['name']); $i++){

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imggaleria']['name'][$i];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/galeria/' .$nome_img;

$imagem_temp = @$_FILES['imggaleria']['tmp_name'][$i]; 

if(@$_FILES['imggaleria']['name'][$i] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 

		if (@$_FILES['imggaleria']['name'][$i] != ""){			

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}else{
	echo 'Insira uma Imagem!';
	exit();
}

$query = $pdo->query("INSERT INTO $tabela SET foto = '$foto'");

}

echo 'Salvo com Sucesso';
 ?>