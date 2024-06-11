<?php 
$tabela = 'dados_site';
require_once("../../../conexao.php");

$titulo_sobre = $_POST['titulo_sobre'];
$descricao_sobre1 = $_POST['descricao_sobre1'];
$descricao_sobre2 = $_POST['descricao_sobre2'];
$descricao_sobre3 = $_POST['descricao_sobre3'];
$foto_video_sobre = $_POST['foto_video_sobre'];
$video_sobre_index = $_POST['video_sobre_index'];


$descricao_sobre1 = str_replace('"', '', $descricao_sobre1);
$descricao_sobre1 = str_replace("'", "", $descricao_sobre1);

$descricao_sobre2 = str_replace('"', '', $descricao_sobre2);
$descricao_sobre2 = str_replace("'", "", $descricao_sobre2);

$descricao_sobre3 = str_replace('"', '', $descricao_sobre3);
$descricao_sobre3 = str_replace("'", "", $descricao_sobre3);




//validar troca da foto logo site
$query = $pdo->query("SELECT * FROM $tabela order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$logo_site = $res[0]['logo_site'];
}else{
	$logo_site = 'sem-foto.jpg';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto_logo_site']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../../img/' .$nome_img;

$imagem_temp = @$_FILES['foto_logo_site']['tmp_name']; 

if(@$_FILES['foto_logo_site']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($logo_site != "sem-foto.jpg"){
				@unlink('../../../img/'.$logo_site);
			}

			$logo_site = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}






//validar troca da foto sobre index
$query = $pdo->query("SELECT * FROM $tabela order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto_sobre_index = $res[0]['foto_sobre_index'];
}else{
	$foto_sobre_index = 'sem-foto.jpg';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto_sobre_index']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../../img/' .$nome_img;

$imagem_temp = @$_FILES['foto_sobre_index']['tmp_name']; 

if(@$_FILES['foto_sobre_index']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto_sobre_index != "sem-foto.jpg"){
				@unlink('../../../img/'.$foto_sobre_index);
			}

			$foto_sobre_index = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}






//validar troca da foto sobre pagina
$query = $pdo->query("SELECT * FROM $tabela order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto_sobre_pagina = $res[0]['foto_sobre_pagina'];
}else{
	$foto_sobre_pagina = 'sem-foto.jpg';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto_sobre_pagina']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../../img/' .$nome_img;

$imagem_temp = @$_FILES['foto_sobre_pagina']['tmp_name']; 

if(@$_FILES['foto_sobre_pagina']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto_sobre_pagina != "sem-foto.jpg"){
				@unlink('../../../img/'.$foto_sobre_pagina);
			}

			$foto_sobre_pagina = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}





//validar troca da foto sobre pagina
$query = $pdo->query("SELECT * FROM $tabela order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto_banner_mobile = $res[0]['foto_banner_mobile'];
}else{
	$foto_banner_mobile = 'sem-foto.jpg';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto_banner_mobile']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../../img/' .$nome_img;

$imagem_temp = @$_FILES['foto_banner_mobile']['tmp_name']; 

if(@$_FILES['foto_banner_mobile']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto_banner_mobile != "sem-foto.jpg"){
				@unlink('../../../img/'.$foto_banner_mobile);
			}

			$foto_banner_mobile = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if($total_reg == 0){
$query = $pdo->prepare("INSERT INTO $tabela SET logo_site = '$logo_site', titulo_sobre = :titulo_sobre, descricao_sobre1 = :descricao_sobre1, descricao_sobre2 = :descricao_sobre2, descricao_sobre3 = :descricao_sobre3, video_sobre_index = :video_sobre_index, foto_video_sobre = '$foto_video_sobre', foto_sobre_index = '$foto_sobre_index', foto_sobre_pagina = '$foto_sobre_pagina', foto_banner_mobile = '$foto_banner_mobile'");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET logo_site = '$logo_site', titulo_sobre = :titulo_sobre, descricao_sobre1 = :descricao_sobre1, descricao_sobre2 = :descricao_sobre2, descricao_sobre3 = :descricao_sobre3, video_sobre_index = :video_sobre_index, foto_video_sobre = '$foto_video_sobre', foto_sobre_index = '$foto_sobre_index', foto_sobre_pagina = '$foto_sobre_pagina', foto_banner_mobile = '$foto_banner_mobile'");
}
$query->bindValue(":titulo_sobre", "$titulo_sobre");
$query->bindValue(":descricao_sobre1", "$descricao_sobre1");
$query->bindValue(":descricao_sobre2", "$descricao_sobre2");
$query->bindValue(":descricao_sobre3", "$descricao_sobre3");
$query->bindValue(":video_sobre_index", "$video_sobre_index");
$query->execute();

echo 'Salvo com Sucesso';
 ?>