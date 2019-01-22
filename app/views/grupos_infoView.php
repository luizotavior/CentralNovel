<script type="text/javascript" src="<?=$base?>app/www/js/functions2.js"></script>
<div class="col-md-12 interface-topo">
	<div class="col-md-12">
		<h4>
	 	<strong>Grupos</strong></h4>
	</div>
</div>
<div class="col-md-12 interface">

<?php 
if ($visualizar) {?>
<h2><?=$grupo->getNome()?> <small><a href="<?=$base?>link?id=<?=$grupo->getId()?>&link=<?=$grupo->getLink()?>" target="_blank"><i class="fa fa-external-link"></i></a></small></h2>
<div class="esconde-id" style="display: none;">
	<?=$grupo->getId()?>
</div>
<hr style="width: 50%;"><div class="table-responsive">
	<table class="table table-hover">
	<thead>
		<tr>
			<td class="col-md-3 align-center">Cadastrada</td>
			<td class="col-md-3 align-center">Ultima Postagem</td>
			<td class="col-md-3 align-center">Total de Postagem</td>
			<td class="col-md-1 align-center">Ativo</td>
			<td class="col-md-1 align-center">Clicks</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="col-md-3 align-center"><?=$grupo->getDataNasc()?></td>
			<td class="col-md-3 align-center"><?=$grupo->getDataLast()?></td>
			<td class="col-md-3 align-center"><?=$totalPostagem?></td>
			<td class="col-md-1 align-center"><?=$grupo->getAtivo();?></td>
			<td class="col-md-1 align-center"><?=$grupo->getClicks();?></td>
		</tr>
	</tbody>
	</table>
</div>


<div class="table-responsive">
	<table class="table table-hover carregar-aqui">
		<thead>
			<tr>
			<td class="col-md-3 align-center">Título</td>
			<td class="col-md-3 align-center">Data</td>
			</tr>
		</thead>
		<tbody class="carregar-aqui">
			
		</tbody>
	</table>
</div>
<div class="row">
	<div clas="col-md-12">
		<div class="col-md-4"></div>
		<div class="col-md-4 carregar-gif" align="center" style="padding-bottom: 15px;">
	<!--Giff -->
		 </div>
		 <div class="col-md-4"></div>
	</div>
</div>

<div class="row">
	<div clas="col-md-12">
		<div class="col-md-4"></div>
		<div class="col-md-4 alert alert-info alert-dismissible fade in carregar-mais" role="alert" align="center">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    </button>
		    <a href="#" class="carregar-mais"><STRONG>Carregar Mais</STRONG></a>
		 </div>
		 <div class="col-md-4"></div>
	</div>
</div>
<div class="row">
	<div clas="col-md-12">
		<div class="col-md-4"></div>
		<div class="col-md-4 alert alert-danger alert-dismissible fade in carregar-block" role="alert" align="center" style="display: none;">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    </button>
		    <a href="#"><STRONG>Carregar Mais.</STRONG></a>
		 </div>
		 <div class="col-md-4"></div>
	</div>
</div>




<hr style="width: 70%;">




<?php } ?>
</div>