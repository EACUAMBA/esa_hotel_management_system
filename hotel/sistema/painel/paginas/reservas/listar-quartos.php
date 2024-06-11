<?php 
$tabela = 'quartos';
require_once("../../../conexao.php");

$tipo = @$_POST['tipo'];
$check_in = @$_POST['check_in'];
$check_out = @$_POST['check_out'];
$id_quarto_post = @$_POST['id_quarto'];
$id = @$_POST['id'];

$query = $pdo->query("SELECT * from reservas where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$check_in_reserva = @$res[0]['check_in'];
$check_out_reserva = @$res[0]['check_out'];

$query = $pdo->query("SELECT * from categorias_quartos where id = '$tipo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor = $res[0]['valor'];

$query = $pdo->query("SELECT * from quartos where ativo = 'Sim' and tipo = '$tipo' order by numero asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
		$id_quarto = $res[$i]['id'];

		//verificar se o quarto tem checkin no dia
		$query3 = $pdo->query("SELECT * from reservas where quarto = '$id_quarto' and check_in = '$check_in' and hora_checkout is null order by id desc");
		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res3) == 0 || $id_quarto_post == $id_quarto){
		
		//verificar se nesta data já possui reserva para o quarto
		$query2 = $pdo->query("SELECT * from reservas where (quarto = '$id_quarto' and check_in <= '$check_in' and check_out > '$check_in' and id != '$id') or (quarto = '$id_quarto' and check_in < '$check_out' and check_out > '$check_out' and id != '$id') order by id desc");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) == 0 || ($id_quarto == $id_quarto_post and strtotime($check_in) >= strtotime($check_in_reserva) and $check_out <= $check_out_reserva)){
			echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['numero'].'</option>';
		}	

		}

	} }else{
		echo '<option value="">Cadastre um Quarto</option>';
	 } 

?>

<script type="text/javascript">
	$("#valor_diaria").val("<?=$valor?>");
	var id_quarto = "<?=$id_quarto_post?>";
	if(id_quarto != ""){
		$("#quarto").val(id_quarto);
	}
</script>