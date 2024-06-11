<?php 
$tabela = 'config';
require_once("../conexao.php");

$nome = $_POST['nome_sistema'];
$email = $_POST['email_sistema'];
$telefone = $_POST['telefone_sistema'];
$endereco = $_POST['endereco_sistema'];
$instagram = $_POST['instagram_sistema'];
$api_whatsapp = $_POST['api_whatsapp'];
$token = $_POST['token'];
$instancia = $_POST['instancia'];
$no_show = $_POST['no_show'];
$dias_cancelamento = $_POST['dias_cancelamento'];
$taxa_cancelamento = $_POST['taxa_cancelamento'];
$marca_dagua = $_POST['marca_dagua'];
$info_reserva = $_POST['info_reserva'];
$info_checkin = $_POST['info_checkin'];
$prazo_devolucao = $_POST['prazo_devolucao'];

//foto logo
$caminho = '../img/logo.png';
$imagem_temp = @$_FILES['foto-logo']['tmp_name']; 

if(@$_FILES['foto-logo']['name'] != ""){
	$ext = pathinfo($_FILES['foto-logo']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 	
				
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


//foto logo rel
$caminho = '../img/logo.jpg';
$imagem_temp = @$_FILES['foto-logo-rel']['tmp_name']; 

if(@$_FILES['foto-logo-rel']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo-rel']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg'){ 	
			
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


//foto icone
$caminho = '../img/icone.png';
$imagem_temp = @$_FILES['foto-icone']['tmp_name']; 

if(@$_FILES['foto-icone']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-icone']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 	
			
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, instagram = :instagram, api_whatsapp = :api_whatsapp, token = :token, instancia = :instancia, no_show = :no_show, taxa_cancelamento = :taxa_cancelamento, dias_cancelamento = :dias_cancelamento, marca_dagua = '$marca_dagua', info_reserva = :info_reserva, info_checkin = :info_checkin, prazo_devolucao = '$prazo_devolucao' where id = 1");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":instagram", "$instagram");
$query->bindValue(":api_whatsapp", "$api_whatsapp");
$query->bindValue(":token", "$token");
$query->bindValue(":instancia", "$instancia");
$query->bindValue(":no_show", "$no_show");
$query->bindValue(":dias_cancelamento", "$dias_cancelamento");
$query->bindValue(":taxa_cancelamento", "$taxa_cancelamento");
$query->bindValue(":info_reserva", "$info_reserva");
$query->bindValue(":info_checkin", "$info_checkin");
$query->execute();

echo 'Editado com Sucesso';
 ?>