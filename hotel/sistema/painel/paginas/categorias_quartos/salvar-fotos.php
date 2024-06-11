<?php 
$tabela = 'fotos_quartos';
require_once("../../../conexao.php");

$id_quarto = $_POST['id_fotos'];

for ($i = 0; $i < count(@$_FILES['imgquartos']['name']); $i++){

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imgquartos']['name'][$i];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/quartos/' .$nome_img;

$imagem_temp = @$_FILES['imgquartos']['tmp_name'][$i]; 

if(@$_FILES['imgquartos']['name'][$i] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 

		if (@$_FILES['imgquartos']['name'][$i] != ""){			

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

$query = $pdo->query("INSERT INTO $tabela SET quarto = '$id_quarto', foto = '$foto'");

}

echo 'Salvo com Sucesso';
 ?>