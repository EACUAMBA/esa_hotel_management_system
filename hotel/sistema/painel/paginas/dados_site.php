<?php 
$pag = 'dados_site';

//verificar se ele tem a permissão de estar nessa página
if(@$dados_site == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

$query = $pdo->query("SELECT * FROM dados_site order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto_logo_site = @$res[0]['logo_site'];
$titulo_sobre = @$res[0]['titulo_sobre'];
$descricao_sobre1 = @$res[0]['descricao_sobre1'];
$descricao_sobre2 = @$res[0]['descricao_sobre2'];
$descricao_sobre3 = @$res[0]['descricao_sobre3'];
$foto_sobre_index = @$res[0]['foto_sobre_index'];
$foto_sobre_pagina = @$res[0]['foto_sobre_pagina'];
$video_sobre_index = @$res[0]['video_sobre_index'];
$foto_video_sobre = @$res[0]['foto_video_sobre'];
$foto_banner_mobile = @$res[0]['foto_banner_mobile'];
?>
<div class="margin_mobile">
	<form id="form_site">
		<div class="row">
			<div class="col-md-2">							
				<label>Título Sobre</label>
				<input maxlength="15" type="text" class="form-control" id="titulo_sobre" name="titulo_sobre" placeholder="Título Área Sobre Index" value="<?php echo @$titulo_sobre ?>">							
			</div>	

			<div class="col-md-5">							
				<label>Descrição Sobre 1</label>
				<textarea maxlength="200" class="form-control" id="descricao_sobre1" name="descricao_sobre1" placeholder="Descrição Primeiro Parágrafo Sobre"><?php echo @$descricao_sobre1 ?></textarea>						
			</div>	

			<div class="col-md-5">							
				<label>Descrição Sobre 2</label>
				<textarea maxlength="200" class="form-control" id="descricao_sobre2" name="descricao_sobre2" placeholder="Descrição Segundo Parágrafo Sobre"><?php echo @$descricao_sobre2 ?></textarea>						
			</div>

			<div class="col-md-12" style="margin-top: 10px">							
				<label>Descrição Sobre 3 (Página Sobre)</label>
				<textarea maxlength="1000" class="form-control" id="descricao_sobre3" name="descricao_sobre3" placeholder="Descrição Terceiro Parágrafo na página Sobre"><?php echo @$descricao_sobre3 ?></textarea>						
			</div>


			<div class="col-md-2" style="margin-top: 10px">							
				<label>Foto / Vídeo (Sobre)</label>
				<select class="form-control" id="foto_video_sobre" name="foto_video_sobre">
					<option value="Foto" <?php if(@$foto_video_sobre == 'Foto'){ ?> selected <?php } ?>>Somente Foto</option>
					<option value="Vídeo" <?php if(@$foto_video_sobre == 'Vídeo'){ ?> selected <?php } ?>>Foto e Vídeo</option>
				</select>							
			</div>	


			

			<div class="col-md-6" style="margin-top: 10px">	
				<label>Vídeo Sobre Index</label>
				<input type="text" class="form-control" id="video_sobre_index" name="video_sobre_index" placeholder="Url Incorporada do Vídeo Youtube" value="<?php echo @$video_sobre_index ?>">							
			</div>	

		</div>

			<div class="row">

				<div class="col-md-4" style="margin-top: 10px">						
				<div class="form-group"> 
					<label>Foto Sobre Index <small>(1020 x 525)</small></label> 
					<input class="form-control" type="file" name="foto_sobre_index" onChange="carregarImgFotoSobreIndex();" id="foto_sobre_index">
				</div>						
			</div>
			<div class="col-md-2" style="margin-top: 10px">
				<div id="divImgFotoSobreIndex">
					<img src="../img/<?php echo @$foto_sobre_index ?>"  width="80px" id="target_sobre_index">									
				</div>
			</div>



			<div class="col-md-4" style="margin-top: 10px">						
				<div class="form-group"> 
					<label>Foto da Página Sobre <small>(550 x 550)</small></label> 
					<input class="form-control" type="file" name="foto_sobre_pagina" onChange="carregarImgFotoSobrePagina();" id="foto_sobre_pagina">
				</div>						
			</div>
			<div class="col-md-2" style="margin-top: 10px">
				<div id="divImgFotoSobrePagina">
					<img src="../img/<?php echo @$foto_sobre_pagina ?>"  width="80px" id="target_sobre_pagina">									
				</div>
			</div>



			<div class="col-md-4" style="margin-top: 10px">						
				<div class="form-group"> 
					<label>Logo do Site <small>Imagem Horizontal</small></label> 
					<input class="form-control" type="file" name="foto_logo_site" onChange="carregarImgLogoSite();" id="foto_logo_site">
				</div>						
			</div>
			<div class="col-md-2" style="margin-top: 10px">
				<div id="divImgLogoSite">
					<img src="../img/<?php echo $foto_logo_site ?>"  width="80px" id="target_logo_site">									
				</div>
			</div>


			<div class="col-md-4" style="margin-top: 10px">						
				<div class="form-group"> 
					<label>Foto Banner Mobile <small>Imagem Horizontal</small></label> 
					<input class="form-control" type="file" name="foto_banner_mobile" onChange="carregarImgBannerMobile();" id="foto_banner_mobile">
				</div>						
			</div>
			<div class="col-md-2" style="margin-top: 10px">
				<div id="divImgLogoSite">
					<img src="../img/<?php echo $foto_banner_mobile ?>"  width="80px" id="target_banner_mobile">									
				</div>
			</div>


		</div>
		<small><div align="center" id="mensagem"></div></small>
		<div align="right">
			<button type="submit" class="btn btn-primary">Salvar</button>
		</div>
		
	</form>
</div>

<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>




<script type="text/javascript">
	function carregarImgFotoSobreIndex() {
		var target = document.getElementById('target_sobre_index');
		var file = document.querySelector("#foto_sobre_index").files[0];

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


	function carregarImgFotoSobrePagina() {
		var target = document.getElementById('target_sobre_pagina');
		var file = document.querySelector("#foto_sobre_pagina").files[0];

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



	function carregarImgLogoSite() {
		var target = document.getElementById('target_logo_site');
		var file = document.querySelector("#foto_logo_site").files[0];

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


	function carregarImgBannerMobile() {
		var target = document.getElementById('target_banner_mobile');
		var file = document.querySelector("#foto_banner_mobile").files[0];

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



$("#form_site").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {                    
            	location.reload();
            } else {

                $('#mensagem').addClass('text-danger')
                $('#mensagem').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});



</script>
