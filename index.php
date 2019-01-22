<?php 
	require 'app/core/FunctionsCore.php';
	require 'app/controllers/PagesController.php';

	$controllerName = 'PagesController';
	$acao = null;


	//Metodo para Verificar se a Pagina é existente.
	$url = isset( $_GET['url'] ) ? $_GET['url'] : 'home';
	$url = LinkAmigavel($url);
	$url2 = $url;
	$url = explode('/', $url);
	$url[0] = ($url[0] == NULL ? 'home' : $url[0]);
	if(isset($url[1]) && file_exists('app/views/'.$url[0]."/".$url[1])){
		// Nome1/nome2 - apartir da  raiz
	       $url2 = str_replace(".php","", $url2);
	       $actionName = $url2;
	    
	}else{
		//Verifica se tem nome1.php apartir da pasta View
		$url = str_replace(".php","", $url);
		if(file_exists('app/views/'.$url[0].'View.php')){
	        $actionName = $url[0];
	        //Verificar o Sub Directorio
	        if(isset($url[1])){
	        		$acao = $url[1];
	        	
	        }
	    }elseif(isset( $url[1] )){
	    	//verifica se tem nome1/nome2 apartir da pasta View
	        if(file_exists('app/views/'.$url[0].'/'.$url[1].'View.php')){
	          $url = str_replace(".php","", $url);
	          $actionName = $url[0].'/'.$url[1];
	        }
	    }else{
	    	$actionName = 'e404';
	    }
	}
	//Fim Metodo
	$controllerName = "app\\controllers\\".$controllerName ;
	$controller = new  $controllerName;
	$controller->$actionName($acao);

 ?>