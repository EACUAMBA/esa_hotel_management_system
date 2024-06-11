<?php 
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * FROM galeria_site");
echo <<<HTML
<div class='row'>
HTML;
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(count($res) > 0){
for ($i=0; $i < count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	$id = $res[$i]['id'];
	$foto = $res[$i]['foto'];
	}
	echo <<<HTML
	<a href="images/galeria/{$foto}" target="_blank"> <img class='ml-4 mb-2' src="images/galeria/{$foto}" width="90" style="margin-bottom: 5px"></a>
	
	<li class="dropdown head-dpdn2" style="display: inline-block; margin-right:15px">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-times text-danger"></i></a>
	<ul class="dropdown-menu">
	<li>
	<div class="notification_desc2">
	<p>Confirmar Exclusão? <a href="#" onclick="excluirImagem('{$id}')"><span class="text-danger">Sim</span></a></p>
	</div>
	</li>
	</ul>
	</li>

	HTML;     

}
}else{
	echo 'Não possui nenhuma foto cadastrada!';
}

echo <<<HTML
</div>
HTML;   
?>




<script type="text/javascript">


	


	function excluirImagem(id){
    
    $.ajax({        
        url: 'paginas/galeria_site/excluir-imagem.php',
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (mensagem) {
            $('#mensagem_excluir_galeria').text('');
            $('#mensagem_excluir_galeria').removeClass()
            if (mensagem.trim() == "Excluído com Sucesso") {                
                carregarFotosGaleria();               
            } else {

                $('#mensagem_excluir_galeria').addClass('text-danger')
                $('#mensagem_excluir_galeria').text(mensagem)
            }


        },      

    });
}


</script>


