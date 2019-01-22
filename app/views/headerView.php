<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-85412244-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-85412244-1');
    </script>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon"  href="<?=$base ?>app/www/images/favicon.ico">
    <meta name="keywords" content="CENTRAL NOVEL,NOVEL,NOVELS,LIGTH NOVEL,TDG,SAO,ANIME,MANGA,LIVRO">
    <meta name="description" content="Central de Novels">
    <meta name="author" content="Luiz Otávio Rodrigues">
    <meta name="robots" content="index, follow">
    <meta property="og:site_name" content="CentralNovel.com.br" />
	<meta property="og:url" content="https://centralnovel.com.br/" />
    <meta property="og:title" content="Imperio Huang Long (Central Novel)">
    <meta property="og:image" content="https://centralnovel.com.br/app/www/images/capa.png">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="pt_BR">
    <meta property=”fb:app_id” content=”358265851177937″>
    <meta property="og:description" content="Sistema agregador de lançamentos de traduções de capitulos de novels." />

	<title><?= $title ?></title>
    <link href="<?=$base ?>app/www/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=$base ?>app/www/bootstrap/css/bootstrap.min.css">
	<link rel=stylesheet href="<?=$base ?>app/www/css/style.css">
	<script src="<?=$base ?>app/www/js/ie-emulation-modes-warning.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Google Ads -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7781654679401477",
        enable_page_level_ads: true
      });
    </script>

    
    
</head>

<body>
    
<?php
//Abertura do Menu, esta Variavel é enviada apartir do 'Conroller' da pagina atual.
include 'app/views/menuView.php';
 ?>



 <div class="container">
  <div class="row">
    <div class="col-md-12 col-xs-12" style="padding-bottom: 25px;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Principal -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-7781654679401477"
     data-ad-slot="9456772146"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
    
    </div>
  </div>

   <div class="row">
 		
 		<?php 
 		//Caso a pagina tenha um Layout Diferente...
 		//if(){
 		?>
		<!-- Conteudo Central -->
 		<div class="col-md-8 " style="padding-bottom: 30px;">
 		
 				<?php include $centro; ?>
 		</div>
 		<!-- Conteudo Lateral -->
 		<div class="col-md-4">
 				<?php include $lateral; ?>
 			
 		</div>







 		<?php
 		//}//Linha28.
 		?>
 	</div>
 