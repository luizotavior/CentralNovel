<div class="col-md-12 interface-topo">
	<div class="col-md-12">
		<h4>
	 	<strong>Novels</strong></h4>
	</div>
</div>
<div class="col-md-12 interface">

<h1>Novels</h1>
<hr style="width: 40%">
<p style="text-align: justify;">
Logo abaixo você encontra todos as Novels Cadastradas no Sistema.
</p>

<hr style="width: 60%">
<div class="table-responsive"  style="border: 0px;">
	<table class="table table-hover carregar-aqui">
	<thead>
		<tr>
			<td class="col-md-3 align-center">Nome</td>
			<td class="col-md-3 align-center">Chave(s)</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($novels as $novel){ ?>
		<tr>
			<td class="col-md-3 align-center"><?=$novel->getNome();?></td>
			<td class="col-md-1 align-center"><?=$novel->getChave();?></td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
</div>

<div class="row">
	<div clas="col-md-12">
		<div class="col-md-4"></div>
		<div class="col-md-4 alert alert-info alert-dismissible fade in" role="alert" align="center">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    </button>
		   	<a href="<?= $base ?>novels/cadastrar">Cadastrar Novel</a>
		 </div>
		 <div class="col-md-4"></div>
	</div>
</div>
<hr style="width: 70%">
</div>