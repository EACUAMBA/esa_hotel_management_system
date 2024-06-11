<?php 
$tabela = 'receber';
require_once("../../../conexao.php");

@session_start();
$id_usuario = $_SESSION['id'];

$quantidade = $_POST['quantidade'];
$total = $_POST['total'];
$nome_hospede = $_POST['nome_hospede'];
$id_produto = $_POST['id'];
$id_hospede = $_POST['id_hospede'];
$id_reserva = $_POST['id_reserva'];

if($nome_hospede == ""){
	echo 'Escolha um quarto e um hóspede, ou clique no botão sem quarto!';
	exit();
}

$totalF = number_format($total, 2, ',', '.');  

$query = $pdo->query("SELECT * from produtos where id = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res[0]['estoque'];
$tem_estoque = $res[0]['tem_estoque'];
$nome_produto = $res[0]['nome'];


$query = $pdo->query("SELECT * from reservas where id = '$id_reserva'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$checkout = @$res[0]['check_out'];
$hospede_principal = @$res[0]['hospede'];

$query = $pdo->query("SELECT * from hospedes where id = '$hospede_principal'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$telefone_hospede = @$res[0]['telefone'];
$nome_hospede_principal = @$res[0]['nome'];


$descricao = $quantidade.' '.$nome_produto;
if($id_reserva != ""){
	$pago = 'Não';
	$data_venc = $checkout;
	$data_pgto = '';
	$usuario_pgto = '';
}else{
	$pago = 'Sim';
	$data_venc = date('Y-m-d');
	$data_pgto = date('Y-m-d');
	$usuario_pgto = $id_usuario;
}

if($tem_estoque == 'Sim'){
	if($estoque < $quantidade){
		echo 'Você não tem essa quantidade em estoque!';
		exit();
	}
	$novo_estoque = $estoque - $quantidade;
	$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' where id = '$id_produto'");
}


$pdo->query("INSERT INTO receber SET descricao = '$descricao', valor = '$total', data_venc = '$data_venc', data_lanc = curDate(), data_pgto = '$data_pgto', usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = '$pago', usuario_pgto = '$usuario_pgto', hospede = '$id_hospede', referencia = 'Venda', id_ref = '$id_reserva', quantidade = '$quantidade', hora = curTime(), id_produto = '$id_produto'");


echo 'Salvo com Sucesso';

//api do whatsapp
if($api_whatsapp == 'Sim' and $id_reserva != ""){

$total_gasto = 0;
$total_gastoF = 0;
$query = $pdo->query("SELECT * from receber where id_ref = '$id_reserva' and pago != 'Sim' and (referencia = 'Venda' or referencia = 'Serviço') ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$valor = $res[$i]['valor'];
	$total_gasto += $valor;
}
}

$total_gastoF = number_format($total_gasto, 2, ',', '.');  

		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_hospede);
		
		$mensagem = '_*Nova Compra* ('.$nome_sistema.')_ %0A';			
		$mensagem .= 'Comprado Por: *'.$nome_hospede.'* %0A';
		$mensagem .= 'Produto: *'.$nome_produto.'* %0A';
		$mensagem .= 'Quantidade: *'.$quantidade.'* %0A';
		$mensagem .= 'Total: *R$ '.$totalF.'* %0A%0A';
		
		$mensagem .= '_Gasto com Serviços e Compras_ %0A';
		$mensagem .= '_Total_ *R$ '.$total_gastoF.'*';
		
		require("../../api/texto.php");
	}
 ?>