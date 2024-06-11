 <?php require_once("cabecalho.php") ?>

 <section class="section section-md bg-white text-center" style="margin-top: -50px">
          <div class="shell">
            <div class="range range-50 range-md-center">
              <div class="cell-sm-8">
                <div class="contact-box">
                  <h3>Contate-nos</h3>
                  
                  <form method="post" id="form_contato">
                    <div class="range range-sm-bottom spacing-20">
                      <div class="cell-sm-6">
                        <div class="form-wrap">
                          <input class="form-input" type="text" name="nome" style="background:#c9c9c9; color:#49494a" placeholder="Seu Nome" required>                         
                        </div>
                      </div>
                      <div class="cell-sm-6">
                        <div class="form-wrap">
                          <input class="form-input" type="text" name="telefone" id="telefone" style="background:#c9c9c9; color:#49494a" placeholder="Seu Telefone">     
                        </div>
                      </div>
                      <div class="cell-xs-12">
                        <div class="form-wrap">
                           <input class="form-input" type="text" name="mensagem" style="background:#c9c9c9; color:#49494a" placeholder="Mensagem" required>     
                        </div>
                      </div>
                      <div class="cell-sm-6">
                        <div class="form-wrap">
                          <input class="form-input" type="email" name="email" style="background:#c9c9c9; color:#49494a" placeholder="Seu Email" required>     
                        </div>
                      </div>
                      <div class="cell-sm-6">
                        <button class="button button-steel-blue5 button-square button-block button-effect-ujarak" type="submit"><span>Enviar</span></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="cell-sm-4">
                <aside class="contact-box-aside text-left">
                  <div class="range range-50">
                    
                    <div class="cell-xs-6 cell-sm-12">
                      <p class="aside-title"> Telefone</p>
                      <hr class="divider divider-left divider-custom">
                      <div class="unit unit-middle unit-horizontal unit-spacing-xs unit-xs-top">
                        <div class="unit__left"><span class="text-middle icon icon-sm mdi mdi-whatsapp icon-primary"></span></div>
                        <div class="unit__body"><a class="text-middle link link-gray-dark" href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_sistema ?>&text=Gostaria de Mais informações sobre as reservas" style="color:#707070"><?php echo $telefone_sistema ?></a></div>
                      </div>
                    </div>
                    <div class="cell-xs-6 cell-sm-12">
                      <p class="aside-title"> Endereço</p>
                      <hr class="divider divider-left divider-custom">
                      <div class="unit unit-middle unit-horizontal unit-spacing-xs unit-xs-top">
                        <div class="unit__left"><span class="text-middle icon icon-sm mdi mdi-map-marker icon-primary"></span></div>
                        <div class="unit__body" style="color:#707070"><?php echo $endereco_sistema ?></div>
                      </div>
                    </div>
                   
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </section>

  <?php require_once("rodape.php") ?>



    <script type="text/javascript">
        

$("#form_contato").submit(function () {

   event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'enviar.php',
        type: 'POST',
        data: formData,

        success: function (mensagem) { 
            if (mensagem.trim() == "Enviado") {
              alert('Email Enviado!')
            } 

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});



      </script>