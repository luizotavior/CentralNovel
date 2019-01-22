<?php require 'app/controllers/lateralController.php'; ?>

<div class="col-md-12 interface-topo">
	<h4>Chat Novel</h4>
</div>
<div class="col-md-12 interface">
	<div id="tlkio" data-channel="centralnovel" data-custom-css="https://centralnovel.com.br/app/www/css/chat.css" data-theme="theme--day" style="width:100%;height:400px;"></div><script async src="https://tlk.io/embed.js" type="text/javascript"></script>
</div>
<div class="col-md-12" style="padding-top: 30px;"></div>

<div class="col-md-12 interface-topo">
	<h4>Comunicação</h4>
</div>
<div class="col-md-12 interface">
	<center>
		<a href="https://discord.gg/qCjSsdX"><img class="img-responsive" src="<?=$base?>/app/www/images/discord.png" alt="Discord Central Novel"> </a>


	</center>
</div>
<div class="col-md-12" style="padding-top: 30px;"></div>
<div class="col-md-12 interface-topo">
	<h4>Grupos Parceiros</h4>
</div>
<div class="col-md-12 interface">
	<div class="table-responsive" style="border: 0px;">
		<table class="table table-hover">
			<tbody>
				<?php foreach ($parceiros as $parceiro){ ?>
				<tr>
					<td class="col-md-3 align-center"><a href="<?=$base;?>grupos/<?=$parceiro->getPagina();?>"><?=$parceiro->getNome();?></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<div class="col-md-12" style="padding-top: 30px;"></div>
<div class="col-md-12 interface-topo">
	<h4>Publicidade</h4>
</div>
<div class="col-md-12 interface table-responsive" style="border: none;" >

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Lateral Direita -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7781654679401477"
     data-ad-slot="3410238547"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

<div class="col-md-12" style="padding-top: 30px;"></div>
<div class="col-md-12 interface-topo">
	<h4>Facebook</h4>
</div>
<div class="col-md-12 interface table-responsive" style="border: none;" >
	<center><iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCentral-Novel-358265851177937%2F&tabs&width=340&height=180&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=510739275626213" width="340" height="180" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></center>

</div>