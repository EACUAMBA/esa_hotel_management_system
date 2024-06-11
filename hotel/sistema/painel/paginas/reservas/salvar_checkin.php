<?php 
require_once("../../../conexao.php");

@session_start();
$id_usuario = @$_SESSION['id'];

$placa = $_POST['placa_checkin'];
$forma_pgto_checkin = $_POST['forma_pgto_checkin'];
$obs = $_POST['obs_checkin'];
$valor_checkin = $_POST['diferenca_checkin'];
$id = $_POST['id_checkin'];


$query = $pdo->query("SELECT * from reservas where id = '$id'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$hospedes = $res[0]['hospedes'];
$hospede = $res[0]['hospede'];
$quarto = $res[0]['quarto'];

$query = $pdo->query("SELECT * from quartos where id = '$quarto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_quarto = $res[0]['id'];

$query = $pdo->query("SELECT * from reservas where quarto = '$id_quarto' and hora_checkin != '' and hora_checkin is not null and (hora_checkout = '' or hora_checkout is null)");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	echo 'Este quarto ainda não foi liberado!';
	exit();
}

$query = $pdo->query("SELECT * from hospedes where reserva = '$id'");	
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas != $hospedes - 1){
	echo 'Você precisa cadastrar todos os hóspedes da reserva antes de efetuar o checkin!';
	exit();
}


$query = $pdo->prepare("UPDATE reservas SET funcionario_checkin = '$id_usuario', obs = :obs, hora_checkin = curTime(), valor_checkin = '$valor_checkin', tipo_pgto_checkin = '$forma_pgto_checkin', placa = :placa WHERE id = '$id'");

$query->bindValue(":obs", "$obs");
$query->bindValue(":placa", "$placa");
$query->execute();
echo 'Salvo com Sucesso';


//lançar o valor no recebimento
if($valor_checkin > 0){
$pdo->query("INSERT INTO receber SET descricao = 'Restante Reserva', valor = '$valor_checkin', data_venc = curDate(), data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Sim', data_pgto = curDate(), usuario_pgto = '$id_usuario', hospede = '$hospede', referencia = 'Restante', id_ref = '$id'");
}

//api whatsapp
if($api_whatsapp == 'Sim' and $info_checkin != ""){

		$mensagem = '*Informações do Check-In* ('.$nome_sistema.') %0A%0A';
		$mensagem .= '_'.$info_checkin.'_';

		//hospede da reserva
		$query = $pdo->query("SELECT * from hospedes where id = '$hospede'");	
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$telefone_hospede = $res[0]['telefone'];		
		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_hospede);		
		
		
		require("../../api/texto.php");

		//percorrer os demais hospedes
		$query = $pdo->query("SELECT * from hospedes where reserva = '$id'");	
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$linhas = @count($res);
			if($linhas > 0){			
			for($i=0; $i<$linhas; $i++){				
				$telefone_hospede = $res[$i]['telefone'];
				$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_hospede);	
				require("../../api/texto.php");
			}
		}
	}

?>