<?php 
$tabela = 'quartos';
require_once("../../../conexao.php");

$checkin = @$_POST['checkin'];
$checkout = @$_POST['checkout'];
$diaria = @$_POST['diaria'];
$desconto = @$_POST['desconto'];

if($desconto == "" or $desconto < 0){
	$desconto = 0;
}

//calcular diferença de dias entre as datas
$diferenca = strtotime($checkout) - strtotime($checkin);
$dias = floor($diferenca / (60 * 60 * 24));
if($dias == 0){
	$dias = 1;
}
$valor_reserva = $diaria * $dias - $desconto;
$vlr_no_show = ($valor_reserva * $no_show) / 100;

$valor_reserva = number_format($valor_reserva, 2);
$vlr_no_show = number_format($vlr_no_show, 2);

$valor_reserva = str_replace(',', '', $valor_reserva);
$vlr_no_show = str_replace(',', '', $vlr_no_show);

echo $valor_reserva.'**'.$vlr_no_show;
?>