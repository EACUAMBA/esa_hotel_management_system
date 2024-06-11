<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];


$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);
$data_venc = $_POST['data_venc'];
$hospede = $_POST['hospede'];
$obs = $_POST['obs'];
$id = $_POST['id'];


if($descricao == "" and $hospede == ""){
	echo 'Escolha um Hóspede ou insira uma descrição!';
	exit();
}


if($descricao == "" and $hospede != ""){
	$query = $pdo->query("SELECT * FROM hospedes where id = '$hospede'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_hospede = $res[0]['nome'];
	$descricao = $nome_hospede;
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['arquivo'];
}else{
	$foto = 'sem-foto.png';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['arquivo']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/contas/' .$nome_img;

$imagem_temp = @$_FILES['arquivo']['tmp_name']; 

if(@$_FILES['arquivo']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'webp' or $ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx' or $ext == 'txt' or $ext == 'xlsx' or $ext == 'xlsm' or $ext == 'xls' or $ext == 'xml' ){  

		if (@$_FILES['arquivo']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.png"){
				@unlink('../../images/contas/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET descricao = :descricao, valor = :valor, data_venc = '$data_venc', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = '$foto', pago = 'Não', obs = :obs, hospede = '$hospede', referencia = 'Conta'");	

}else{
	$query = $pdo->prepare("UPDATE $tabela SET descricao = :descricao,  valor = :valor, data_venc = '$data_venc', usuario_lanc = '$id_usuario', arquivo = '$foto', obs = :obs, hospede = '$hospede' where id = '$id'");
		
}

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor", "$valor");
$query->bindValue(":obs", "$obs");
$query->execute();


echo 'Salvo com Sucesso'; 

?>