<?php 
require_once("../../../conexao.php");


$id_usuario = $_POST['id'];

$checked = '';
$query = $pdo->query("SELECT * FROM acessos where grupo = 0 order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
	echo '<span class="titulo-grupo"><b>Sem Grupo</b></span><br><div class="row">';
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$nome = $res[$i]['nome'];
		$chave = $res[$i]['chave'];
		$id = $res[$i]['id'];


		$query2 = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' and permissao = '$id'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$checked = 'checked';
		}else{
			$checked = '';
		}


		echo '
		<div class="form-check col-md-3">
		<input class="form-check-input" type="checkbox" value="" id="" '.$checked.' onclick="adicionarPermissao('.$id.','.$id_usuario.')">
		<label class="labelcheck" >
		'.$nome.'
		</label>
		</div>
		';
	}

	echo '</div><hr>';	
}



$query = $pdo->query("SELECT * FROM grupo_acessos ORDER BY id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];

	echo '<span class="titulo-grupo"><b>'.$nome.'</b></span><br><div class="row">';

	

$checked = '';
$query3 = $pdo->query("SELECT * FROM acessos where grupo = '$id' order by id asc");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$total_reg3 = @count($res3);

if($total_reg3 > 0){	
	for($i3=0; $i3 < $total_reg3; $i3++){
		foreach ($res3[$i3] as $key => $value){}
			$nome = $res3[$i3]['nome'];
		$chave = $res3[$i3]['chave'];
		$id = $res3[$i3]['id'];


		$query2 = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' and permissao = '$id'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$checked = 'checked';
		}else{
			$checked = '';
		}


		echo '
		<div class="form-check col-md-3">
		<input class="form-check-input" type="checkbox" value="" id="" '.$checked.' onclick="adicionarPermissao('.$id.','.$id_usuario.')">
		<label class="labelcheck" >
		'.$nome.'
		</label>
		</div>
		';
	}

	echo '</div><hr>';	
}


}

}

?>