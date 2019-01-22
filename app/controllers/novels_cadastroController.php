<?php 

//---------------------------//
$lateral = "app/views/lateralView.php";
$centro = "app/views/novels_cadastroView.php";
require 'app/dao/conexaoDao.php';
require 'app/dao/novelsDao.php';
$novelsDao = new novelsDao;
$conexaoDao = new conexaoDao;
$con = $conexaoDao->conexao();
//----------------------------------//


if(isset($_POST['enviar'])){
	$novel = new novelsModel;
	$novel->setNome($_POST['nome']);
	$novel->setChave($_POST['chave']);

	try {
		$novelsDao->adicionar($con,$novel);
		$status = true;
	} catch (Exception $e) {
		$status = false;
	}
}

?>