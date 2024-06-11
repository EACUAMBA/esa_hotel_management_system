<?php 
@session_start();
require_once("../conexao.php");
require_once("verificar.php");

$data_atual = date('Y-m-d');

$pag_inicial = 'home';
if(@$_SESSION['nivel'] != 'Administrador'){
	require_once("verificar_permissoes.php");
}

if(@$_GET['pagina'] != ""){
	$pagina = @$_GET['pagina'];
}else{
	$pagina = $pag_inicial;
}

$id_usuario = @$_SESSION['id'];
$query = $pdo->query("SELECT * from usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$nome_usuario = $res[0]['nome'];
	$email_usuario = $res[0]['email'];
	$telefone_usuario = $res[0]['telefone'];
	$senha_usuario = $res[0]['senha'];
	$nivel_usuario = $res[0]['nivel'];
	$foto_usuario = $res[0]['foto'];
	$endereco_usuario = $res[0]['endereco'];
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $nome_sistema ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="../img/icone.png" type="image/x-icon">

	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons CSS-->

	<!-- side nav css file -->
	<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
	<!-- //side nav css file -->

	<link rel="stylesheet" href="css/monthly.css">

	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>

	<!--webfonts-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<!--//webfonts--> 

	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->

	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->
	<style>
		#chartdiv {
			width: 100%;
			height: 295px;
		}
	</style>
	<!--pie-chart --><!-- index page sales reviews visitors pie chart -->
	<script src="js/pie-chart.js" type="text/javascript"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			carregarFotosGaleria();

			$('#demo-pie-1').pieChart({
				barColor: '#2dde98',
				trackColor: '#eee',
				lineCap: 'round',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-2').pieChart({
				barColor: '#20158f',
				trackColor: '#eee',
				lineCap: 'butt',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-3').pieChart({
				barColor: '#c91508',
				trackColor: '#eee',
				lineCap: 'square',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});


		});

	</script>
	<!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->


<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/> <script src="DataTables/datatables.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style type="text/css">
		.select2-selection__rendered {
			line-height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}

		.select2-selection {
			height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}
	</style>  

	
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left" style="overflow: scroll; height:100%; scrollbar-width: thin;">
				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.php"><span class="fa fa-building-o"></span> Sistema PMS<span class="dashboard_text"><?php echo $nome_sistema ?></span></a></h1>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header">MENU NAVEGAÇÃO</li>
							<li class="treeview <?php echo $home ?>">
								<a href="index.php">
									<i class="fa fa-dashboard"></i> <span>Home</span>
								</a>
							</li>
							<li class="treeview <?php echo $menu_pessoas ?>">
								<a href="#">
									<i class="fa fa-users"></i>
									<span>Pessoas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo $hospedes ?>"><a href="hospedes"><i class="fa fa-angle-right"></i> Hóspedes</a></li>

									<li class="<?php echo $funcionarios ?>"><a href="funcionarios"><i class="fa fa-angle-right"></i> Funcionários</a></li>

									<li class="<?php echo $fornecedores ?>"><a href="fornecedores"><i class="fa fa-angle-right"></i> Fornecedores</a></li>

									<li class="<?php echo $usuarios ?>"><a href="usuarios"><i class="fa fa-angle-right"></i> Usuários</a></li>
									
								</ul>
							</li>

							<li class="treeview <?php echo $menu_cadastros ?>">
								<a href="#">
									<i class="fa fa-plus"></i>
									<span>Cadastros</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo $categorias_quartos ?>"><a href="categorias_quartos"><i class="fa fa-angle-right"></i> Tipo de Quarto</a></li>

									<li class="<?php echo $quartos ?>"><a href="quartos"><i class="fa fa-angle-right"></i> Quartos</a></li>

									<li class="<?php echo $cargos ?>"><a href="cargos"><i class="fa fa-angle-right"></i> Cargos</a></li>

									<li class="<?php echo $formas_pgto ?>"><a href="formas_pgto"><i class="fa fa-angle-right"></i> Formas Pgto</a></li>

									<li class="<?php echo $grupos ?>"><a href="grupos"><i class="fa fa-angle-right"></i> Grupos de Acesso</a></li>

									<li class="<?php echo $acessos ?>"><a href="acessos"><i class="fa fa-angle-right"></i> Acessos</a></li>
									
								</ul>
							</li>


							<li class="treeview <?php echo $menu_reservas ?>">
								<a href="#">
									<i class="fa fa-calendar"></i>
									<span>Reservas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo $reservas ?>"><a href="reservas"><i class="fa fa-angle-right"></i> Reservas</a></li>

									<li class="<?php echo $filtrar_reservas ?>"><a href="filtrar_reservas"><i class="fa fa-angle-right"></i> Filtrar Reservas</a></li>

									<li class="<?php echo $rel_quartos ?>"><a href="" data-toggle="modal" data-target="#modalRelQuartos"><i class="fa fa-angle-right"></i> Quartos Disponíveis</a></li>
									
									
								</ul>
							</li>


							<li class="treeview <?php echo $menu_financeiro ?>">
								<a href="#">
									<i class="fa fa-usd"></i>
									<span>Financeiro</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo $pagar ?>"><a href="pagar"><i class="fa fa-angle-right"></i>Contas à Pagar</a></li>

								<li class="<?php echo $receber ?>"><a href="receber"><i class="fa fa-angle-right"></i>Contas à Receber</a></li>


								<li class="<?php echo $compras ?>"><a href="compras"><i class="fa fa-angle-right"></i>Compras</a></li>

								<li class="<?php echo $rel_financeiro ?>"><a href="" data-toggle="modal" data-target="#modalRelFinanceiro"><i class="fa fa-angle-right"></i>Relatórios</a></li>

								<li class="<?php echo $rel_lucro ?>"><a href="" data-toggle="modal" data-target="#modalRelLucro"><i class="fa fa-angle-right"></i>Demonstrativo de Lucro</a></li>
									
									
								</ul>
							</li>



							<li class="treeview <?php echo $menu_produtos ?>">
								<a href="#">
									<i class="fa fa-product-hunt"></i>
									<span>Produtos</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo $categorias_produtos ?>"><a href="categorias_produtos"><i class="fa fa-angle-right"></i>Categorias</a></li>

								<li class="<?php echo $produtos ?>"><a href="produtos"><i class="fa fa-angle-right"></i>Produtos</a></li>

								<li class="<?php echo $entradas ?>"><a href="entradas"><i class="fa fa-angle-right"></i>Entradas</a></li>

								<li class="<?php echo $saidas ?>"><a href="saidas"><i class="fa fa-angle-right"></i>Saídas</a></li>

								<li class="<?php echo $estoque_baixo ?>"><a href="estoque_baixo"><i class="fa fa-angle-right"></i>Estoque Baixo</a></li>
									
									
								</ul>
							</li>


								<li class="treeview <?php echo $menu_servicos ?>">
								<a href="#">
									<i class="fa fa-plane"></i>
									<span>Serviços</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo $categorias_servicos ?>"><a href="categorias_servicos"><i class="fa fa-angle-right"></i>Categorias</a></li>

								<li class="<?php echo $servicos ?>"><a href="servicos"><i class="fa fa-angle-right"></i>Serviços</a></li>
									
									
								</ul>
							</li>


							<li class="treeview <?php echo $menu_vendas ?>">
								<a href="#">
									<i class="fa fa-money"></i>
									<span>Vendas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo $vendas_produtos ?>"><a href="vendas_produtos"><i class="fa fa-angle-right"></i>Produtos</a></li>

								<li class="<?php echo $vendas_servicos ?>"><a href="vendas_servicos"><i class="fa fa-angle-right"></i>Serviços</a></li>


								<li class="<?php echo $lista_vendas ?>"><a href="lista_vendas"><i class="fa fa-angle-right"></i>Lista de Vendas</a></li>

								<li class="<?php echo $lista_servicos ?>"><a href="lista_servicos"><i class="fa fa-angle-right"></i>Lista de Serviços</a></li>
									
									
								</ul>
							</li>


							<li class="treeview <?php echo $calendario ?>">
								<a href="calendario">
									<i class="fa fa-calendar"></i> <span>Calendário</span>
								</a>
							</li>



							<li class="treeview <?php echo $marketing ?>">
								<a href="marketing">
									<i class="fa fa-whatsapp"></i> <span>Marketing</span>
								</a>
							</li>



							<li class="treeview <?php echo @$menu_site ?>">
								<a href="#">
									<i class="fa fa-firefox"></i>
									<span>Site</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li class="<?php echo @$dados_site ?>"><a href="dados_site"><i class="fa fa-angle-right"></i>Dados do Site</a></li>

								<li class="<?php echo @$banners_site ?>"><a href="banners_site"><i class="fa fa-angle-right"></i>Banners Site</a></li>

								<li class="<?php echo @$especificacoes ?>"><a href="especificacoes"><i class="fa fa-angle-right"></i>Área de Lazer</a></li>

								<li class="<?php echo $galeria_site ?>"><a href="" data-toggle="modal" data-target="#modalGaleria"><i class="fa fa-angle-right"></i>Galeria Site</a></li>
								
									
									
								</ul>
							</li>


						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</aside>
		</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section " style="display:inline-flex;">
			<div class="header-left" >
				<!--toggle button start-->
				<button id="showLeftPush" data-toggle="collapse" data-target=".collapse"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left" ><!--notifications of menu start -->
					<ul class="nofitications-dropdown ">
						<li class="dropdown head-dpdn ">

							<?php 
							$query = $pdo->query("SELECT * from reservas where check_out = '$data_atual' and (hora_checkout = '' or hora_checkout is null)");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$total_checkout = @count($res);
							 ?>
							<a href="#" class="dropdown-toggle <?php echo $reservas ?>" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-calendar" style="color:#FFF"></i><span class="badge"><?php echo $total_checkout ?></span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>Você possui <?php echo $total_checkout ?> Checkout para Hoje!</h3>
									</div>
								</li>

								<?php 
									$query = $pdo->query("SELECT * from reservas where check_out = '$data_atual' and (hora_checkout = '' or hora_checkout is null) order by id asc limit 10");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$linhas = @count($res);

							if($linhas > 0){
								for($i=0; $i<$linhas; $i++){
									$hospede = $res[$i]['hospede'];
									$quarto = $res[$i]['quarto'];

									$query2 = $pdo->query("SELECT * from quartos where id = '$quarto'");
									$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
									$numero_quarto = @$res2[0]['numero'];

									$query2 = $pdo->query("SELECT * from hospedes where id = '$hospede'");
									$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
									$nome_hospede = @$res2[0]['nome'];
								 ?>

								<li><a href="#">
									<div class="user_img"><img src="images/1.jpg" alt=""></div>
									<div class="notification_desc">
										<p><?php echo $nome_hospede ?> <span style="color:red !important">(<?php echo $numero_quarto ?>)</span></p>
										
									</div>
									<div class="clearfix"></div>	
								</a></li>
								
								<?php } } ?>
								
								<li>
									<div class="notification_bottom">
										<a href="index.php?pagina=reservas"><small>Ver Check-Outs</small></a>
									</div> 
								</li>
							</ul>
						</li>
						


						<li class="dropdown head-dpdn">

							<?php 
							$query = $pdo->query("SELECT * from pagar where data_venc = curDate() and pago = 'Não'");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$total_checkout = @count($res);
							 ?>
							<a href="#" class="dropdown-toggle <?php echo $pagar ?>" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-money" style="color:#FFF"></i><span class="badge"><?php echo $total_checkout ?></span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>Você possui <?php echo $total_checkout ?> Contas à Pagar Hoje!</h3>
									</div>
								</li>

								<?php 
									$query = $pdo->query("SELECT * from pagar where data_venc = curDate() and pago = 'Não' order by id asc limit 10");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$linhas = @count($res);

							if($linhas > 0){
								for($i=0; $i<$linhas; $i++){
									$descricao = $res[$i]['descricao'];
									$valor = $res[$i]['valor'];
									$valorF = number_format($valor, 2, ',', '.');
								 ?>

								<li><a href="#">
									<div class="user_img"><img src="images/1.jpg" alt=""></div>
									<div class="notification_desc">
										<p><?php echo $descricao ?> <span style="color:red !important">R$(<?php echo $valorF ?>)</span></p>
										
									</div>
									<div class="clearfix"></div>	
								</a></li>
								
								<?php } } ?>
								
								<li>
									<div class="notification_bottom">
										<a href="index.php?pagina=pagar"><small>Ver Contas</small></a>
									</div> 
								</li>
							</ul>
						</li>


					</ul>



				


					<div class="clearfix"> </div>
				</div>
				
			</div>
			<div class="header-right">


				<div class="search-box esc">
					<form class="input" action="rel/reserva_class.php" target="_blank">
						<input class="sb-search-input input__field--madoka" placeholder="Código da Reserva" type="search" id="input-31" name="id"/>						
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>					
				</div><!--//end-search-box-->

				
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/perfil/<?php echo $foto_usuario ?>" alt="" width="50px" height="50px"> </span> 
									<div class="user-name esc">
										<p><?php echo $nome_usuario ?></p>
										<span><?php echo $nivel_usuario ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li class="<?php echo $configuracoes ?>"> <a href="" data-toggle="modal" data-target="#modalConfig"><i class="fa fa-cog"></i> Configurações</a> </li> 
								<li> <a href="" data-toggle="modal" data-target="#modalPerfil"><i class="fa fa-user"></i> Perfil</a> </li> 								
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Sair</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->




		<!-- main content start-->
		<div id="page-wrapper">
			<?php 
			require_once('paginas/'.$pagina.'.php');
			?>
		</div>





	</div>

	<!-- new added graphs chart js-->
	
	<script src="js/Chart.bundle.js"></script>
	<script src="js/utils.js"></script>
	
	
	
	<!-- Classie --><!-- for toggle left push menu script -->
	<script src="js/classie.js"></script>
	<script>
		var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		body = document.body;

		showLeftPush.onclick = function() {
			classie.toggle( this, 'active' );
			classie.toggle( body, 'cbp-spmenu-push-toright' );
			classie.toggle( menuLeft, 'cbp-spmenu-open' );
			disableOther( 'showLeftPush' );
		};


		function disableOther( button ) {
			if( button !== 'showLeftPush' ) {
				classie.toggle( showLeftPush, 'disabled' );
			}
		}
	</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->

	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
		$('.sidebar-menu').SidebarNav()
	</script>
	<!-- //side nav js -->
	
	
	
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->



	<!-- Mascaras JS -->
<script type="text/javascript" src="js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

	
</body>
</html>






<!-- Modal Perfil -->
<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Alterar Dados</h4>
				<button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-perfil">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome_perfil" name="nome" placeholder="Seu Nome" value="<?php echo $nome_usuario ?>" required>							
						</div>

						<div class="col-md-6">							
								<label>Email</label>
								<input type="email" class="form-control" id="email_perfil" name="email" placeholder="Seu Nome" value="<?php echo $email_usuario ?>" required>							
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone_perfil" name="telefone" placeholder="Seu Telefone" value="<?php echo $telefone_usuario ?>" required>							
						</div>

						<div class="col-md-4">							
								<label>Senha</label>
								<input type="password" class="form-control" id="senha_perfil" name="senha" placeholder="Senha" value="<?php echo $senha_usuario ?>" required>							
						</div>

						<div class="col-md-4">							
								<label>Confirmar Senha</label>
								<input type="password" class="form-control" id="conf_senha_perfil" name="conf_senha" placeholder="Confirmar Senha" value="" required>							
						</div>

						
					</div>


					<div class="row">
						<div class="col-md-12">	
							<label>Endereço</label>
							<input type="text" class="form-control" id="endereco_perfil" name="endereco" placeholder="Seu Endereço" value="<?php echo $endereco_usuario ?>" >	
						</div>
					</div>
					


					<div class="row">
						<div class="col-md-8">							
								<label>Foto</label>
								<input type="file" class="form-control" id="foto_perfil" name="foto" value="<?php echo $foto_usuario ?>" onchange="carregarImgPerfil()">							
						</div>

						<div class="col-md-4">								
							<img src="images/perfil/<?php echo $foto_usuario ?>"  width="80px" id="target-usu">								
							
						</div>

						
					</div>


					<input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
				

				<br>
				<small><div id="msg-perfil" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>








<!-- Modal Config -->
<div class="modal fade" id="modalConfig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Editar Configurações</h4>
				<button id="btn-fechar-config" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-config">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-4">							
								<label>Nome do Projeto</label>
								<input type="text" class="form-control" id="nome_sistema" name="nome_sistema" placeholder="Delivery Interativo" value="<?php echo @$nome_sistema ?>" required>							
						</div>

						<div class="col-md-4">							
								<label>Email Sistema</label>
								<input type="email" class="form-control" id="email_sistema" name="email_sistema" placeholder="Email do Sistema" value="<?php echo @$email_sistema ?>" >							
						</div>


						<div class="col-md-4">							
								<label>Telefone Sistema</label>
								<input type="text" class="form-control" id="telefone_sistema" name="telefone_sistema" placeholder="Telefone do Sistema" value="<?php echo @$telefone_sistema ?>" required>							
						</div>

					</div>


					<div class="row">
						<div class="col-md-6">							
								<label>Endereço <small>(Rua Número Bairro e Cidade)</small></label>
								<input type="text" class="form-control" id="endereco_sistema" name="endereco_sistema" placeholder="Rua X..." value="<?php echo @$endereco_sistema ?>" >							
						</div>

						<div class="col-md-6">							
								<label>Instagram</label>
								<input type="text" class="form-control" id="instagram_sistema" name="instagram_sistema" placeholder="Link do Instagram" value="<?php echo @$instagram_sistema ?>">							
						</div>
					</div>



					<div class="row">
						<div class="col-md-3">							
								<label>No Show (Entrada %) </label>
								<input type="number" class="form-control"  name="no_show" value="<?php echo @$no_show ?>" >							
						</div>

						<div class="col-md-3">							
								<label>Cancelamento Grátis (Dias)</label>
								<input type="number" class="form-control"  name="dias_cancelamento" value="<?php echo @$dias_cancelamento ?>" >							
						</div>

						<div class="col-md-3">							
								<label>Taxa Cancelamento  %</label>
								<input type="number" class="form-control"  name="taxa_cancelamento" value="<?php echo @$taxa_cancelamento ?>" >							
						</div>

						<div class="col-md-3">							
								<label>Prazo Devolução</label>
								<input type="number" class="form-control"  name="prazo_devolucao" value="<?php echo @$prazo_devolucao ?>" placeholder="Dias">							
						</div>
					</div>



					<div class="row">
						<div class="col-md-3">							
								<label>Api Whatsapp</label>
								<select name="api_whatsapp" class="form-control">
									<option value="Sim" <?php if($api_whatsapp == 'Sim'){ ?> selected <?php } ?>>Sim</option>
									<option value="Não" <?php if($api_whatsapp == 'Não'){ ?> selected <?php } ?>>Não</option>
								</select>						
						</div>

						<div class="col-md-3">							
								<label>Token Api Whatsapp</label>
								<input type="text" class="form-control"  name="token" value="<?php echo @$token ?>" >							
						</div>

						<div class="col-md-3">							
								<label>Instância Api Whatsapp</label>
								<input type="text" class="form-control"  name="instancia"  value="<?php echo @$instancia ?>">							
						</div>

						<div class="col-md-3">							
								<label>Marca D'agua</label>
								<select name="marca_dagua" class="form-control">
									<option value="Sim" <?php if($marca_dagua == 'Sim'){ ?> selected <?php } ?>>Sim</option>
									<option value="Não" <?php if($marca_dagua == 'Não'){ ?> selected <?php } ?>>Não</option>
								</select>						
						</div>
					</div>

					<div class="row">						
						<div class="col-md-12">	
							<label>Informações da Reserva</label>
							<textarea class="form-control" maxlength="2000" name="info_reserva"><?php echo $info_reserva ?></textarea>
						</div>
					</div>

					<div class="row">						
						<div class="col-md-12">	
							<label>Informações do CheckIn</label>
							<textarea class="form-control" maxlength="2000" name="info_checkin"><?php echo $info_checkin ?></textarea>
						</div>
					</div>

					

					<div class="row">
						<div class="col-md-4">						
								<div class="form-group"> 
									<label>Logo (*PNG)</label> 
									<input class="form-control" type="file" name="foto-logo" onChange="carregarImgLogo();" id="foto-logo">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo $logo_sistema ?>"  width="80px" id="target-logo">									
								</div>
							</div>


							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Ícone (*Png)</label> 
									<input class="form-control" type="file" name="foto-icone" onChange="carregarImgIcone();" id="foto-icone">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo $icone_sistema ?>"  width="50px" id="target-icone">									
								</div>
							</div>

						
					</div>




					<div class="row">
							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Logo Relatório (*Jpg)</label> 
									<input class="form-control" type="file" name="foto-logo-rel" onChange="carregarImgLogoRel();" id="foto-logo-rel">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo @$logo_rel ?>"  width="80px" id="target-logo-rel">									
								</div>
							</div>


						
					</div>					
				

				<br>
				<small><div id="msg-config" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>









<!-- Modal Rel Financeiro -->
<div class="modal fade" id="modalRelFinanceiro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório Financeiro</h4>
				<button id="btn-fechar-rel" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="rel/financeiro_class.php" target="_blank">
			<div class="modal-body">	
			<div class="row">
				<div class="col-md-4">
					<label>Data Inicial</label>
					<input type="date" name="dataInicial" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				<div class="col-md-4">
					<label>Data Final</label>
					<input type="date" name="dataFinal" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				<div class="col-md-4">
					<label>Filtro Data</label>
					<select name="filtro_data" class="form-control">
						<option value="data_lanc">Data de Lançamento</option>
						<option value="data_venc">Data de Vencimento</option>
						<option value="data_pgto">Data de Pagamento</option>
					</select>
				</div>
			</div>		


			<div class="row">				
				<div class="col-md-4">
					<label>Entradas / Saídas</label>
					<select name="filtro_tipo" class="form-control">
						<option value="receber">Entradas / Ganhos</option>
						<option value="pagar">Saídas / Despesas</option>
					</select>
				</div>

				<div class="col-md-4">
					<label>Tipo Lançamento</label>
					<select name="filtro_lancamento" class="form-control">
						<option value="">Tudo</option>
						<option value="Conta">Ganhos / Despesas</option>
						<option value="Venda">Vendas</option>
						<option value="Serviço">Serviços</option>
						<option value="Entrada">No-Show</option>
						<option value="Restante">Check-In</option>
						<option value="Cancelamento">Devoluções</option>
						<option value="Compra">Compras</option>
					</select>
				</div>
				<div class="col-md-4">
					<label>Pendentes / Pago</label>
					<select name="filtro_pendentes" class="form-control">
						<option value="">Tudo</option>
						<option value="Não">Pendentes</option>
						<option value="Sim">Pago</option>
					</select>
				</div>			
			</div>		
				
						

			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Gerar</button>
			</div>
			</form>
		</div>
	</div>
</div>







<!-- Modal Rel Lucro -->
<div class="modal fade" id="modalRelLucro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório de Lucro</h4>
				<button id="btn-fechar-rel" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="rel/lucro_class.php" target="_blank">
			<div class="modal-body">	
			<div class="row">
				<div class="col-md-4">
					<label>Data Inicial</label>
					<input type="date" name="dataInicial" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				<div class="col-md-4">
					<label>Data Final</label>
					<input type="date" name="dataFinal" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				
			</div>		


								

			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Gerar</button>
			</div>
			</form>
		</div>
	</div>
</div>





<!-- Modal Rel Quartos -->
<div class="modal fade" id="modalRelQuartos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório de Quartos Disponíveis</h4>
				<button id="btn-fechar-rel" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="rel/quartos_class.php" target="_blank">
			<div class="modal-body">	
			<div class="row">
				<div class="col-md-4">
					<label>Data Inicial</label>
					<input id="data_inicial_rel" type="date" name="dataInicial" class="form-control" value="<?php echo $data_atual ?>" onchange="verificarData()">
				</div>

				<div class="col-md-4">
					<label>Data Final</label>
					<input id="data_final_rel" type="date" name="dataFinal" class="form-control" value="<?php echo $data_atual ?>" onchange="verificarData()">
				</div>

				
			</div>		


								

			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Gerar</button>
			</div>
			</form>
		</div>
	</div>
</div>







<!-- Modal Galeria -->
<div class="modal fade" id="modalGaleria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Galeria do Site</h4>
				<button id="btn-fechar-rel" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">	
				
				<form id="form_galeria" method="POST" enctype="multipart/form-data" >
				<div class="row">
					<div class="col-md-8">
						<input type="file" class="form-control" id="imggaleria" name="imggaleria[]" multiple="multiple">
					</div>
					<div class="col-md-4">
						<button class="btn btn-primary" type="submit" id="btn_galeria">Salvar</button>
					</div>
				</div>
				
			</form>


				<hr>
				
				<div id="listar_fotos_galeria">
					
				</div>
				<small><div align="center" id="mensagem_excluir_galeria"></div></small>							

			</div>
						
		</div>
	</div>
</div>




<script type="text/javascript">
	function carregarImgPerfil() {
    var target = document.getElementById('target-usu');
    var file = document.querySelector("#foto_perfil").files[0];
    
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }
</script>






 <script type="text/javascript">
	$("#form-perfil").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-perfil.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-perfil').text('');
				$('#msg-perfil').removeClass()
				if (mensagem.trim() == "Editado com Sucesso") {

					$('#btn-fechar-perfil').click();
					location.reload();				
						

				} else {

					$('#msg-perfil').addClass('text-danger')
					$('#msg-perfil').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>






 <script type="text/javascript">
	$("#form-config").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-config.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-config').text('');
				$('#msg-config').removeClass()
				if (mensagem.trim() == "Editado com Sucesso") {

					$('#btn-fechar-config').click();
					location.reload();				
						

				} else {

					$('#msg-config').addClass('text-danger')
					$('#msg-config').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>




<script type="text/javascript">
	function carregarImgLogo() {
    var target = document.getElementById('target-logo');
    var file = document.querySelector("#foto-logo").files[0];
    
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }
</script>





<script type="text/javascript">
	function carregarImgLogoRel() {
    var target = document.getElementById('target-logo-rel');
    var file = document.querySelector("#foto-logo-rel").files[0];
    
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }
</script>





<script type="text/javascript">
	function carregarImgIcone() {
    var target = document.getElementById('target-icone');
    var file = document.querySelector("#foto-icone").files[0];
    
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }


    function verificarData(){
    	var dataInicial = $('#data_inicial_rel').val();
    	var dataFinal = $('#data_final_rel').val();
    	var dataAtual = "<?=$data_atual?>";

    	var dataIni = new Date(dataInicial);
    	var dataFin = new Date(dataFinal);
    	var dataHoje = new Date(dataAtual);

    	if(dataIni < dataHoje){
    		alert('Você não pode colocar uma data Retroativa!');
    		$('#data_inicial_rel').val(dataAtual);
    	}

    	if(dataFin < dataHoje){
    		alert('Você não pode colocar uma data Retroativa!');
    		$('#data_final_rel').val(dataAtual);
    	}
    }





function carregarFotosGaleria(){

		$.ajax({
        url: 'paginas/galeria_site/listar-fotos.php',
        method: 'POST',
        data: {},
        dataType: "html",

        success:function(result){
            $("#listar_fotos_galeria").html(result);
            $('#mensagem_excluir_galeria').text('');
        }
    });
	}



$("#form_galeria").submit(function () {
	
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/galeria_site/salvar-fotos.php',
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem_excluir_galeria').text('');
            $('#mensagem_excluir_galeria').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {                
               carregarFotosGaleria(); 
            } else {

                $('#mensagem_excluir_galeria').addClass('text-danger')
                $('#mensagem_excluir_galeria').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});




</script>