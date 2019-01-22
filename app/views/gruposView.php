<div class="col-md-12 interface-topo">
	<div class="col-md-12">
		<h4>
	 	<strong>Grupos</strong></h4>
	</div>
</div>
<div class="col-md-12 interface">

<h1>Grupos</h1>
<hr style="width: 40%">
<p style="text-align: justify;">
Logo abaixo você encontra todos os Grupos Cadastrados e Ativos no Sistema.
</p>

<hr style="width: 60%">
<div class="table-responsive"  style="border: 0px;">
	<table class="table table-hover carregar-aqui">
	<thead>
		<tr>
			<td class="col-md-3 align-center">Nome</td>
			<td class="col-md-3 align-center">Site</td>
			<td class="col-md-3 align-center">E-mail</td>
			<td class="col-md-1 align-center">Clicks</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($grupos as $grupo){ ?>
		<tr>
			<td class="col-md-3 align-center"><a href="<?=$base;?>grupos/<?=$grupo->getPagina();?>"><?=$grupo->getNome();?></a></td>
			<a href="'+base+'link?id='+data.dados[i].grupo_id+'&link='+data.dados[i].link+'">
			<td class="col-md-3 align-center"><a href="<?=$base?>link?id=<?=$grupo->getId()?>&link=<?=$grupo->getLink();?>"><?=$grupo->getLink();?></a></td>
			<td class="col-md-3 align-center"><a href="mailto:<?=$grupo->getEmail();?>" "email me"><i class="fa fa-at"></i><?=$grupo->getNome();?></a></td>
			<td class="col-md-1 align-center"><?=$grupo->getClicks();?></td>
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
		   	<a href="<?= $base ?>grupos/cadastrar">Cadastrar Grupo</a>
		 </div>
		 <div class="col-md-4"></div>
	</div>
</div>
<hr style="width: 70%">
</div>