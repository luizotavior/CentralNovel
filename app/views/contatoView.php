<div class="col-md-12 interface-topo">
	<div class="col-md-12">
		<h4>
	 	<strong>Contato</strong></h4>
	</div>
</div>
<div class="col-md-12 interface">

<h2>Entre em contato</h2>
<hr style="width: 50%;">

<!-- 1ª Tela-->
<?php if(!isset($enviaEmail) && !isset($status)){
?>
<!--- TERMOS -->
<h3>Contato</h3>
<p style="text-align: justify;">Você pode entrar em contato conosco atraves do e-mail <a href="mailto:contato@centralnovel.com.br?subject=feedback" "email me">contato@centralnovel.com.br</a> ou nos envie uma mensagem clicando no botão abaixo.</p>
<hr style="width: 70%;">
<form id="from-EmailContato" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
      <button type="submit" value="true" name="enviaEmail" class="btn btn-success">Enviar Mensagem</button>
    </div>
  </div>
</form>

<?php
  }?>


<!-- 2ª Tela -->
<?php 
if((isset($enviaEmail) && $enviaEmail == true )|| isset($status)){
?>
<?php if (isset($status) && $status == true){?>
  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Enviado!</strong> Dentro de algumas horas você irá receber a resposta. Obrigado.
                  </div>

<?php }elseif(isset($status) && $status == false){?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Ocorreu um Erro!</strong> No momento o sistema de Contato encontra-se Desligado.
                  </div>

<?php } ?>
<form id="from-enviaEmail" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Nome" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assunto">Assunto <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="assunto" class="form-control" required="required">
                            <option></option>
                            <option value="Parceria">Parceria</option>
                            <option value="Sugestão">Sugestão</option>
                            <option value="Reclamação">Reclamação</option>
                            <option value="Link Off">Link Off</option>
                            <option value="Outro">Outro</option>

                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site">Site
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Ex: http://NovelMania.com.br/" id="site" name="site" class="date-picker form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Ex: joão123@gmail.com" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Mensagem<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="Mensagem" name="mensagem" required="required"  class="form-control col-md-7 col-xs-12"> </textarea>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                    <hr style="width: 70%;">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancelar</button>
                          <button type="submit" value="enviar" name="enviar" class="btn btn-success">Enviar</button>
                        </div>
                      </div>

                    </form>


<?php
}elseif(isset($enviaEmail) && $enviaEmail == false){
    echo "REDIRECT";
    } 
 ?>

</div>