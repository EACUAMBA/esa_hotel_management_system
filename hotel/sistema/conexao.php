<?php 

//definir fuso horário
date_default_timezone_set('America/Sao_Paulo');


//dados conexão bd local
$servidor = 'localhost';
$banco = 'hotel';
$usuario = 'root';
$senha = 'root';


/*
//dados conexão bd hospedada
$servidor = 'sh-pro24.hostgator.com.br';
$banco = 'hugocu75_hotel';
$usuario = 'hugocu75_hotel';
$senha = 'Bancohotel';
*/

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao conectar ao banco de dados!<br>';
	echo $e;
}


$url_sistema = "http://$_SERVER[HTTP_HOST]/sistema/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/sistema/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/hotel/sistema/";
}

//variaveis globais
$nome_sistema = 'Nome Sistema';
$email_sistema = 'contato@hugocursos.com.br';
$telefone_sistema = '(31)97527-5084';

$query = $pdo->query("SELECT * from config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone = '$telefone_sistema', logo = 'logo.png', logo_rel = 'logo.jpg', icone = 'icone.png', api_whatsapp = 'Não', no_show = '50', dias_cancelamento = '30', taxa_cancelamento = '30', marca_dagua = 'Sim', prazo_devolucao = '7'");
}else{
$nome_sistema = $res[0]['nome'];
$email_sistema = $res[0]['email'];
$telefone_sistema = $res[0]['telefone'];
$endereco_sistema = $res[0]['endereco'];
$instagram_sistema = $res[0]['instagram'];
$logo_sistema = $res[0]['logo'];
$logo_rel = $res[0]['logo_rel'];
$icone_sistema = $res[0]['icone'];
$api_whatsapp = $res[0]['api_whatsapp'];
$token = $res[0]['token'];
$instancia = $res[0]['instancia'];
$no_show = $res[0]['no_show'];
$dias_cancelamento = $res[0]['dias_cancelamento'];
$taxa_cancelamento = $res[0]['taxa_cancelamento'];
$marca_dagua = $res[0]['marca_dagua'];
$info_reserva = $res[0]['info_reserva'];
$info_checkin = $res[0]['info_checkin'];
$prazo_devolucao = $res[0]['prazo_devolucao'];
$ativo_sistema = $res[0]['ativo'];

$whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);
}	


if($ativo_sistema != 'Sim' and $ativo_sistema != ''){ ?>
	<style type="text/css">
		@media only screen and (max-width: 700px) {
		  .imgsistema_mobile{
		    width:300px;
		  }    
		}
	</style>
	<div style="text-align: center; margin-top: 100px">
	<img src="<?php echo $url_sistema ?>img/bloqueio.png" class="imgsistema_mobile">	
	</div>
<?php 
exit();
} 
 ?>
