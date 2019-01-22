<?php 

	/**
	* 
	*/
	namespace app\controllers;
	$title = "Central Novel";
//Verificação para ver se o Usuario esta Acessando o Site com o HTTP ou HTTPS.
	if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) {
		$base = "https://";
	}else{
		$base = "http://";
		header("location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}
	$base = $base.$_SERVER['HTTP_HOST'].'/';



	$menu = $base.'app/views/menuView.php';
	//A Variavel Base deve ser arrumada Manualmente nos arquivos:
	//App/www/js/functions.js
	//App/www/js/functions2.js
	class PagesController{
		function home(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			//include 'app/dao/conexaoDao.php';
			include 'app/controllers/HomeController.php';
			include 'app/views/headerView.php';
			include 'app/views/footerView.php';
		}

		function contato(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/ContatoController.php';
			include 'app/views/headerView.php';
			include 'app/views/footerView.php';
		}

		function tabelarefresh(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/TabelaRefreshController.php';
			include 'app/views/tabelarefreshView.php';
		}

		function tabela(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/tabelaController.php';
			include 'app/views/tabelaView.php';
		}
		function tabela2(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/tabela2Controller.php';
			include 'app/views/tabela2View.php';
		}
		function link(){
			$title = $GLOBALS["title"];
			$base = $GLOBALS["base"] ;
			include 'app/controllers/linkController.php';
			include 'app/views/linkView.php';
		}
		function forum(){
			$title = $GLOBALS["title"];
			$base = $GLOBALS["base"] ;
			include 'app/views/forumView.php';
		}

		function grupos($sublink){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			switch ($sublink) {
				case 'cadastrar':
				include 'app/controllers/grupos_cadastroController.php';				
				include 'app/views/headerView.php';
				include 'app/views/footerView.php';
				break;

				case '':
				include 'app/controllers/gruposController.php';			
				include 'app/views/headerView.php';
				include 'app/views/footerView.php';
				break;
				
				//Caso Pagina Restrita do Grupo
				default:
				include 'app/controllers/grupos_infoController.php';			
				include 'app/views/headerView.php';
				include 'app/views/footerView.php';
				break;
			}
		}

		function novels($sublink){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			switch ($sublink) {
				case 'cadastrar':
				include 'app/controllers/novels_cadastroController.php';				
				include 'app/views/headerView.php';
				include 'app/views/footerView.php';
				break;

				default:
				include 'app/controllers/novelsController.php';			
				include 'app/views/headerView.php';
				include 'app/views/footerView.php';
				break;
			}
		}

		function sobre(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/SobreController.php';			
			include 'app/views/headerView.php';
			include 'app/views/footerView.php';
		}

		function alianca(){
			$title = "Aliança Novel";
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/aliancaController.php';			
			include 'app/views/headerView.php';
			include 'app/views/footerView.php';
		}
		
		function publicidade(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/publicidadeController.php';			
			include 'app/views/headerView.php';
			include 'app/views/footerView.php';
		}

		function e404(){
			$title = $GLOBALS["title"];
			$menu = $GLOBALS["menu"] ;
			$base = $GLOBALS["base"] ;
			include 'app/controllers/404Controller.php';			
			include 'app/views/headerView.php';
			include 'app/views/footerView.php';
		}
		
	}

	?>