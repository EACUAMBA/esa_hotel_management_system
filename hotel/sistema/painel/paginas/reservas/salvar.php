<?php 
$tabela = 'reservas';
require_once("../../../conexao.php");

@session_start();
$id_usuario = @$_SESSION['id'];

$hospede = $_POST['hospede'];
$obs = $_POST['obs'];
$tipo_quarto = $_POST['tipo_quarto'];
$quarto = $_POST['quarto'];
$valor_diaria = $_POST['valor_diaria'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$valor_reserva = $_POST['valor_reserva'];
$no_show = $_POST['no_show'];
$hospedes = $_POST['hospedes'];
$desconto = $_POST['desconto'];
$forma_pgto = $_POST['forma_pgto'];

if($desconto == "" or $desconto < 0){
	$desconto = 0;
}

$valor_reserva = str_replace(',', '.', $valor_reserva);
$no_show = str_replace(',', '.', $no_show);
$valor_diaria = str_replace(',', '.', $valor_diaria);
$desconto = str_replace(',', '.', $desconto);

$id = $_POST['id'];

//validacao 
if($hospedes <= 0){
	echo 'O número de Hóspedes tem que ser maior que zero!';
	exit();
}



if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET hospede = :hospede, tipo_quarto = :tipo_quarto, quarto = :quarto, funcionario = :funcionario, check_in = :check_in, check_out = :check_out, valor = :valor, no_show = :no_show, hospedes = :hospedes, obs = :obs, valor_diaria = :valor_diaria, data = curDate(), desconto = :desconto, forma_pgto = :forma_pgto");

	
}else{
$query = $pdo->prepare("UPDATE $tabela SET hospede = :hospede, tipo_quarto = :tipo_quarto, quarto = :quarto, funcionario = :funcionario, check_in = :check_in, check_out = :check_out, valor = :valor, no_show = :no_show, hospedes = :hospedes, obs = :obs, valor_diaria = :valor_diaria, desconto = :desconto, forma_pgto = :forma_pgto where id = '$id'");
}
$query->bindValue(":hospede", "$hospede");
$query->bindValue(":tipo_quarto", "$tipo_quarto");
$query->bindValue(":quarto", "$quarto");
$query->bindValue(":funcionario", "$id_usuario");
$query->bindValue(":check_in", "$check_in");
$query->bindValue(":check_out", "$check_out");
$query->bindValue(":valor", "$valor_reserva");
$query->bindValue(":no_show", "$no_show");
$query->bindValue(":hospedes", "$hospedes");
$query->bindValue(":obs", "$obs");
$query->bindValue(":valor_diaria", "$valor_diaria");
$query->bindValue(":desconto", "$desconto");
$query->bindValue(":forma_pgto", "$forma_pgto");
$query->execute();
if($id == ""){
	$ultimo_id = $pdo->lastInsertId();
	if($no_show > 0){
		$pdo->query("INSERT INTO receber SET descricao = 'Entrada Reserva', valor = '$no_show', data_venc = curDate(), data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Sim', data_pgto = curDate(), usuario_pgto = '$id_usuario', hospede = '$hospede', referencia = 'Entrada', id_ref = '$ultimo_id'");	
	}
}else{
	$ultimo_id = $id;
	$pdo->query("UPDATE receber SET valor = '$no_show', data_pgto = curDate(), usuario_pgto = '$id_usuario', hospede = '$hospede' where referencia = 'Entrada' and id_ref = '$id'");	
}


echo 'Salvo com Sucesso-'.$ultimo_id;

$query2 = $pdo->query("SELECT * from hospedes where id = '$hospede'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_hospede = @$res2[0]['nome'];
	$bi = @$res2[0]['bi'];
	$telefone_hospede = @$res2[0]['telefone'];

	$check_inF = implode('/', array_reverse(explode('-', $check_in)));
	$check_outF = implode('/', array_reverse(explode('-', $check_out)));

	$valorF = number_format($valor_reserva, 2, ',', '.');  
	$no_showF = number_format($no_show, 2, ',', '.');  


//api do whatsapp
if($api_whatsapp == 'Sim'){
		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_hospede);
		if($id == ""){
			$mensagem = '_*Nova Reserva* ('.$nome_sistema.')_ %0A';
		}else{
			$mensagem = '_*Reserva Editada* ('.$nome_sistema.')_ %0A';
		}		
		$mensagem .= 'Número da Reserva: *'.$ultimo_id.'* %0A';
		$mensagem .= 'Hóspede: *'.$nome_hospede.'* %0A';
		$mensagem .= 'Telefone: *'.$telefone_hospede.'* %0A';
		$mensagem .= 'Check-In: *'.$check_inF.'* %0A';
		$mensagem .= 'Check-Out: *'.$check_outF.'* %0A';
		$mensagem .= 'Quantidade Hóspedes: *'.$hospedes.'* %0A';
		$mensagem .= 'Total Reserva: *R$ '.$valorF.'* %0A';
		$mensagem .= 'Valor Entrada: *R$ '.$no_showF.'* %0A%0A';

		$mensagem .= '_*Atenção* '.$info_reserva.'_ %0A%0A';

		$mensagem .= '_Abaixo o detalhamento em PDF da Reserva_ %0A';
		require("../../api/texto.php");
	}
 ?>