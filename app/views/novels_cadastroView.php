<div class="col-md-12 interface-topo">
	<div class="col-md-12">
		<h4>
     <strong>Cadastro de Novels</strong></h4>
   </div>
 </div>
 <div class="col-md-12 interface">

  <h2>Cadastro de Novels</h2>
  <hr style="width: 50%;">

  <?php if (isset($status) && $status == true){?>
  <div class="alert alert-info alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Adicionado!</strong> Agora só aguardar a CN V.3 !
  </div>

  <?php }elseif(isset($status) && $status == false){?>
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Ocorreu um Erro!</strong> Algo de inesperado aconteceu, entre em contato com um Administrador.
  </div>

  <?php } ?>
  <form id="from-cadastroNovel" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
    Por favor não adicione nomes comuns e espaços em branco na area das Chaves.<br>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome do Novel <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input placeholder="Nome do Novel" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12" type="text">
      </div>
    </div>
    <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="chave">Sigla <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input placeholder="Ex: LMS"  id="chave" name="chave" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
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

</div>