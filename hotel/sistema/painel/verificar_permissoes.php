<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];


$home = 'ocultar';
$configuracoes = 'ocultar';
$marketing = 'ocultar';
$calendario = 'ocultar';

//grupo pessoas
$usuarios = 'ocultar';
$funcionarios = 'ocultar';
$hospedes = 'ocultar';
$fornecedores = 'ocultar';


//grupo cadastros
$categorias_quartos = 'ocultar';
$quartos = 'ocultar';
$cargos = 'ocultar';
$formas_pgto = 'ocultar';
$acessos = 'ocultar';
$grupos = 'ocultar';

//grupo reservas
$reservas = 'ocultar';
$filtrar_reservas = 'ocultar';
$rel_quartos = 'ocultar';


//grupo financeiro
$rel_financeiro = 'ocultar';
$compras = 'ocultar';
$pagar = 'ocultar';
$receber = 'ocultar';
$rel_lucro = 'ocultar';

//grupo produtos
$produtos = 'ocultar';
$categorias_produtos = 'ocultar';
$estoque_baixo = 'ocultar';
$saidas = 'ocultar';
$entradas = 'ocultar';


//servicos
$categorias_servicos = 'ocultar';
$servicos = 'ocultar';


//vendas
$vendas_produtos = 'ocultar';
$vendas_servicos = 'ocultar';
$lista_vendas = 'ocultar';
$lista_servicos = 'ocultar';


//dados site
$dados_site = 'ocultar';
$banners_site = 'ocultar';
$especificacoes = 'ocultar';
$galeria_site = 'ocultar';

$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];
		
		$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];

		if($chave == 'home'){
			$home = '';
		}


		if($chave == 'configuracoes'){
			$configuracoes = '';
		}

		if($chave == 'marketing'){
			$marketing = '';
		}

		if($chave == 'calendario'){
			$calendario = '';
		}




		if($chave == 'usuarios'){
			$usuarios = '';
		}

		if($chave == 'funcionarios'){
			$funcionarios = '';
		}

		if($chave == 'hospedes'){
			$hospedes = '';
		}

		
		if($chave == 'fornecedores'){
			$fornecedores = '';
		}





		if($chave == 'categorias_quartos'){
			$categorias_quartos = '';
		}

		if($chave == 'cargos'){
			$cargos = '';
		}

		if($chave == 'quartos'){
			$quartos = '';
		}

		if($chave == 'grupos'){
			$grupos = '';
		}

		if($chave == 'acessos'){
			$acessos = '';
		}

		if($chave == 'formas_pgto'){
			$formas_pgto = '';
		}





		if($chave == 'reservas'){
			$reservas = '';
		}

		if($chave == 'filtrar_reservas'){
			$filtrar_reservas = '';
		}

		if($chave == 'rel_quartos'){
			$rel_quartos = '';
		}





		if($chave == 'compras'){
			$compras = '';
		}

		if($chave == 'rel_financeiro'){
			$rel_financeiro = '';
		}

		if($chave == 'pagar'){
			$pagar = '';
		}

		if($chave == 'receber'){
			$receber = '';
		}

		if($chave == 'rel_lucro'){
			$rel_lucro = '';
		}



		if($chave == 'produtos'){
			$produtos = '';
		}

		if($chave == 'categorias_produtos'){
			$categorias_produtos = '';
		}

		if($chave == 'estoque_baixo'){
			$estoque_baixo = '';
		}

		if($chave == 'saidas'){
			$saidas = '';
		}

		if($chave == 'entradas'){
			$entradas = '';
		}







		if($chave == 'categorias_servicos'){
			$categorias_servicos = '';
		}

		if($chave == 'servicos'){
			$servicos = '';
		}




		if($chave == 'vendas_produtos'){
			$vendas_produtos = '';
		}

		if($chave == 'vendas_servicos'){
			$vendas_servicos = '';
		}

		if($chave == 'lista_vendas'){
			$lista_vendas = '';
		}

		if($chave == 'lista_servicos'){
			$lista_servicos = '';
		}



		if($chave == 'dados_site'){
			$dados_site = '';
		}


		if($chave == 'banners_site'){
			$banners_site = '';
		}


		if($chave == 'especificacoes'){
					$especificacoes = '';
				}


		if($chave == 'galeria_site'){
					$galeria_site = '';
				}


		
	}

}


$pag_inicial = '';
if($home != 'ocultar'){
	$pag_inicial = 'home';
}else{
	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);	
	if($total_reg > 0){
			$permissao = $res[0]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);		
			$pag_inicial = $res2[0]['chave'];		

	}else{
		echo 'Você não tem permissão para acessar nenhuma página, acione o administrador!';
		exit();
	}
}



if($usuarios == 'ocultar' and $funcionarios == 'ocultar' and $hospedes == 'ocultar' and $fornecedores == 'ocultar'){
	$menu_pessoas = 'ocultar';
}else{
	$menu_pessoas = '';
}



if($categorias_quartos == 'ocultar' and $cargos == 'ocultar' and $quartos == 'ocultar' and $grupos == 'ocultar' and $acessos == 'ocultar' and $formas_pgto == 'ocultar'){
	$menu_cadastros = 'ocultar';
}else{
	$menu_cadastros = '';
}


if($reservas == 'ocultar' and $filtrar_reservas == 'ocultar' and $rel_quartos == 'ocultar'){
	$menu_reservas = 'ocultar';
}else{
	$menu_reservas = '';
}




if($compras == 'ocultar' and $rel_financeiro == 'ocultar' and $pagar == 'ocultar' and $receber == 'ocultar' and $rel_lucro == 'ocultar'){
	$menu_financeiro = 'ocultar';
}else{
	$menu_financeiro = '';
}


if($produtos == 'ocultar' and $categorias_produtos == 'ocultar' and $estoque_baixo == 'ocultar' and $saidas == 'ocultar' and $entradas == 'ocultar'){
	$menu_produtos = 'ocultar';
}else{
	$menu_produtos = '';
}





if($categorias_servicos == 'ocultar' and $servicos == 'ocultar' ){
	$menu_servicos = 'ocultar';
}else{
	$menu_servicos = '';
}



if($vendas_servicos == 'ocultar' and $vendas_produtos == 'ocultar' and $lista_vendas == 'ocultar' and $lista_servicos == 'ocultar'){
	$menu_vendas = 'ocultar';
}else{
	$menu_vendas = '';
}



if($dados_site == 'ocultar' and $banners_site == 'ocultar' and $galeria_site == 'ocultar' and $especificacoes == 'ocultar'){
	$menu_site = 'ocultar';
}else{
	$menu_site = '';
}




 ?>