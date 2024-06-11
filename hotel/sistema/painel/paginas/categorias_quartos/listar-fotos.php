<?php 
require_once("../../../conexao.php");
$id = @$_POST['id']; 

$query = $pdo->query("SELECT * FROM fotos_quartos where quarto = '$id' ");
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
	<a href="images/quartos/{$foto}" target="_blank"> <img class='ml-4 mb-2' src="images/quartos/{$foto}" width="90" style="margin-bottom: 5px"></a>
	
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
    var id_fotos = $('#id_fotos').val();
    $.ajax({        
        url: 'paginas/categorias_quartos/excluir-imagem.php',
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (mensagem) {
            $('#mensagem_fotos').text('');
            $('#mensagem_fotos').removeClass()
            if (mensagem.trim() == "Excluído com Sucesso") {                
                carregarFotos(id_fotos);                
            } else {

                $('#mensagem_fotos').addClass('text-danger')
                $('#mensagem_fotos').text(mensagem)
            }


        },      

    });
}


</script>


