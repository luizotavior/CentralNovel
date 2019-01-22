<div class="col-md-12 interface-topo">
	<div class="col-md-12">
		<h4>
	 	<strong>Cadastro de Grupos</strong></h4>
	</div>
</div>
<div class="col-md-12 interface">

<h2>Cadastro de Grupos</h2>
<hr style="width: 50%;">

<!-- 1ª Tela-->
<?php if(!isset($termos) && !isset($status)){
?>
<!--- TERMOS -->
<h3>Termos de Uso</h3>
<ul>
    <li>Para se cadastrar é necessário que você seja uma pessoa plenamente capaz. Não são aceitas inscrições realizadas por programas, computadores ou qualquer tipo de robots, exceto quando autorizado pela Central Novel.</li>
    <li>Você precisa fornecer um Feed/Rss válido para completar o processo de inscrição.</li>
    <li>Cada Grupo deve ser ter um representante. O Representante do grupo deve cadastar utilizando o e-mail do mesmo, para contato caso necessário.</li>
    <li>Você é responsável por manter o seu site online, caso o site se encontre varias vezes offline o mesmo será retirado do Sistema.</li>
    <li>Você não pode utilizar o Sistema da Central Novel para nenhum propósito ilegal ou não autorizado.</li>
    <li>Seu site não deve conter conteudo Pirata,Ilegal ou de caráter imoral.</li>
    <li>Em casos de suspeita de tentativa de fraude, a Central Novel se dá o direito de, a qualquer momento, interromper imediatamente o seu grupo do acesso ao sistema, através do bloqueio do Grupo.</li>
    <li>Em caso de bloqueio de conta, o usuário ficará impedido de utilizar o sistema.</li>
    <li>Todos os riscos derivados da utilização deste site são do usuário. Se o seu uso resultar na necessidade de serviços ou reposição de material, propriedade, equipamento ou informação do usuário, a Central Novel não será responsável por este custo.</li>

</ul>
<form id="from-termosGrupo" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="submit" class="btn btn-primary">Não Concordo</button>
      <button type="submit" value="true" name="termos" class="btn btn-success">Concordo</button>
    </div>
  </div>
</form>

<?php
  }?>


<!-- 2ª Tela -->
<?php 
if((isset($termos) && $termos == true )|| isset($status)){
?>
<?php if (isset($status) && $status == true){?>
  <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Adicionado!</strong> Agora só aguardar a Aprovação para o seu Site entrar em nossa Lista.
                  </div>

<?php }elseif(isset($status) && $status == false){?>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Ocorreu um Erro!</strong> Algo de inesperado aconteceu, entre em contato com um Administrador.
                  </div>

<?php } ?>
<form id="from-cadastroGrupo" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome do Grupo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Nome do grupo" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link">Site <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Ex: https://lmsnovelbr.wordpress.com/"  id="link" name="link" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="feed">Feed/Rss <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Ex: https://lmsnovelbr.wordpress.com/feed/"  id="feed" name="feed" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input placeholder="Ex: joão123@gmail.com" id="email" name="email" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                    <hr style="width: 70%;">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancelar</button>
                          <button type="submit" value="enviar" name="enviar" class="btn btn-success">Cadastrar</button>
                        </div>
                      </div>

                    </form>


<?php
}elseif(isset($termos) && $termos == false){
    echo "REDIRECT";
    } 
 ?>

</div>