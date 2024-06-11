<?php 
$tabela = 'pagar';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$data_atual = date('Y-m-d');


$fornecedor = @$_POST['fornecedor'];
$produto = @$_POST['produto'];
$valor = $_POST['valor'];
$quantidade = $_POST['quantidade'];
$valor = str_replace(',', '.', $valor);
$data_pgto = $_POST['data_pgto'];
$data_venc = $_POST['vencimento'];
$obs = $_POST['obs'];
$id = $_POST['id'];

if(strtotime($data_pgto) > strtotime($data_atual)){
	echo 'Você não pode colocar uma data maior que a data de hoje para pagamento!';
	exit();
}

$pago = 'Não';
if($data_pgto != ""){
	$pago = 'Sim';
}

$valor_unitario = $valor / $quantidade;

$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_produto = $res[0]['nome'];
	$estoque_produto = $res[0]['estoque'];
	$descricao = $quantidade.' '.$nome_produto;


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
	$query = $pdo->prepare("INSERT INTO $tabela SET descricao = :descricao, fornecedor = '$fornecedor', valor = :valor, data_venc = '$data_venc', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = '$foto', pago = '$pago', funcionario = '0', obs = :obs, hospede = '0', referencia = 'Compra', id_ref = '$produto', data_pgto = '$data_pgto', quantidade = '$quantidade'");	

}

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor", "$valor");
$query->bindValue(":obs", "$obs");
$query->execute();


echo 'Salvo com Sucesso';

$novo_estoque = $quantidade + $estoque_produto;

//adicionar os produtos na tabela produtos
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque', fornecedor = '$fornecedor', valor_compra = '$valor_unitario' WHERE id = '$produto'"); 

?>