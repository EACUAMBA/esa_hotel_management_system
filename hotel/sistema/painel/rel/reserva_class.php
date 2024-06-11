<?php 
require_once("../../conexao.php");

$id = $_GET['id'];
$enviar = @$_GET['enviar'];

$html = file_get_contents($url_sistema."painel/rel/reserva.php?id=$id");

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$pdf = new DOMPDF($options);


//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();
//NOMEAR O PDF GERADO

$output = $pdf->output();
$arquivo = "../pdf/reservas/reserva_".$id.".pdf";
	
if(file_put_contents($arquivo,$output) <> false) {
	$pdf->stream(
	'reserva.pdf',
	array("Attachment" => false)
);

}


$query = $pdo->query("SELECT * from reservas where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$hospede = $res[0]['hospede'];

$query = $pdo->query("SELECT * from hospedes where id = '$hospede' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res[0]['telefone'];

//enviar relatório para o whatsapp
if($enviar == 'sim' and $api_whatsapp == 'Sim'){
$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
$mensagem = '';
$url_envio = $url_sistema."painel/pdf/reservas/reserva_".$id.".pdf";
require("../api/doc.php");
}

 ?>