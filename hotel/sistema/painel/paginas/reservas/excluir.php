<?php 
$tabela = 'reservas';
require_once("../../../conexao.php");

@session_start();
$id_usuario = @$_SESSION['id'];

$id = $_POST['id'];

$query2 = $pdo->query("SELECT * from reservas where id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$hospede = @$res2[0]['hospede'];
$check_in = @$res2[0]['check_in'];
$check_out = @$res2[0]['check_out'];
$no_show = @$res2[0]['no_show'];
$valor_reserva = @$res2[0]['valor'];
$hospedes = @$res2[0]['hospedes'];
$data_reserva = @$res2[0]['data'];

$query2 = $pdo->query("SELECT * from hospedes where id = '$hospede'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_hospede = @$res2[0]['nome'];
$bi = @$res2[0]['bi'];
$telefone_hospede = @$res2[0]['telefone'];

	$check_inF = implode('/', array_reverse(explode('-', $check_in)));
	$check_outF = implode('/', array_reverse(explode('-', $check_out)));

	$valorF = number_format($valor_reserva, 2, ',', '.');  
	$no_showF = number_format($no_show, 2, ',', '.');  


$texto_descricao = 'Cancelamento Reserva';
//acrescentar o prazo de devolução a data de vencimento da conta
$data_hoje = date('Y-m-d');
$nova_data_venc = date('Y/m/d', strtotime("+$prazo_devolucao days",strtotime($data_hoje)));

$data_limite_cancelamento = date('Y/m/d', strtotime("-$dias_cancelamento days",strtotime($check_in)));

//calculo do valor a ser reembolsado
// Calcula a diferença em segundos entre as datas
$diferenca = strtotime($data_hoje) - strtotime($data_reserva);
//Calcula a diferença em dias
$dias = floor($diferenca / (60 * 60 * 24));
$total_dias_reserva = $dias;

if($total_dias_reserva <= 7){
	$valor_devolucao = $no_show;
}else{
	if(strtotime($data_limite_cancelamento) > strtotime($data_hoje)){
		$valor_devolucao = $no_show;		
	}else{
		$valor_devolucao = $no_show - $no_show * ($taxa_cancelamento / 100);
		$texto_descricao = 'Cancelamento Reserva ('.$taxa_cancelamento.'%)';
	}
}


//lançar conta a pagar com o valor da reserva
$pdo->query("INSERT INTO pagar SET descricao = '$texto_descricao', valor = '$valor_devolucao', data_venc = '$nova_data_venc', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não',  hospede = '$hospede', referencia = 'Cancelamento', id_ref = '$id'");	

//api do whatsapp
if($api_whatsapp == 'Sim'){
		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_hospede);
		$mensagem = '_*Reserva Cancelada* ('.$nome_sistema.')_ %0A';			
		$mensagem .= 'Hóspede: *'.$nome_hospede.'* %0A';
		$mensagem .= 'Telefone: *'.$telefone_hospede.'* %0A';
		$mensagem .= 'Check-In: *'.$check_inF.'* %0A';
		$mensagem .= 'Check-Out: *'.$check_outF.'* %0A';
		$mensagem .= 'Quantidade Hóspedes: *'.$hospedes.'* %0A';
		$mensagem .= 'Total Reserva: *R$ '.$valorF.'* %0A';
		$mensagem .= 'Valor Entrada: *R$ '.$no_showF.'* %0A%0A';
		require("../../api/texto.php");
	}

@unlink('../../pdf/reservas/reserva_'.$id.'.pdf');

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
echo 'Excluído com Sucesso';
?>