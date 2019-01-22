<script type="text/javascript" src="<?=$base?>app/www/js/functions.js"></script>
<script type="text/javascript">
  window.onload = function () {
	var button = document.getElementById("recarregar");
	button.removeAttribute("disabled");
	button.onclick = function() {
	  if (!button.getAttribute("disabled") != "disabled") {
		button.setAttribute("disabled", "disabled");
		setTimeout(function() {
		  button.removeAttribute("disabled");
		}, 10000);
		// do stuff ...
	  }
	}
  }
</script>

<div class="col-md-12 interface-topo" style="min-height: 50px;max-height: 70px;">
	<div class="col-md-12">
	 		<div style="float: left;">
	 			<h4>Ultimos Lançamentos</h4>
	 		</div>
	 	<button id="recarregar" type="submit" value="true" name="termos" class="btn btn-dark recarregar"   style="float: right;">Recarregar</button>
	</div>
</div>
<div class="col-md-12 interface">
	<div class="table-responsive" style="border: 0px;">
		<table class="table table-hover carregar-aqui">
			<thead>
				<tr>
					<td class="col-md-6">Título</td>
					<td class="col-md-3">Grupo</td>
					<td class="col-md-2">Data</td>
					<td class="col-md-1"></td>
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

	
</div>