<?php require_once("sistema/conexao.php"); 

$telefone = $_POST['telefone'];
$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$criancas = $_POST['criancas'];
$adultos = $_POST['adultos'];

$check_inF = implode('/', array_reverse(explode('-', $checkin)));
$check_outF = implode('/', array_reverse(explode('-', $checkout)));

$mensagem = '_*Solicitação de Reserva* ('.$nome_sistema.')_ %0A';
		$mensagem .= 'Check-In: *'.$check_inF.'* %0A';
		$mensagem .= 'Check-Out: *'.$check_outF.'* %0A';
		$mensagem .= 'Quantidade Adultos: *'.$adultos.'* %0A';
		$mensagem .= 'Quantidade Crianças: *'.$criancas.'* %0A';

//api do whatsapp
if($api_whatsapp == 'Sim'){	
		require("sistema/painel/api/texto.php");
		echo 'Enviado';
	}else{
		echo 'http://api.whatsapp.com/send?1=pt_BR&phone='.$whatsapp_sistema.'&text='.$mensagem;
	}

?>