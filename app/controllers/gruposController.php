<?php 

//---------------------------//
$lateral = "app/views/lateralView.php";
$centro = "app/views/gruposView.php";
require 'app/dao/conexaoDao.php';
require 'app/dao/gruposDao.php';
$gruposDao = new gruposDao;
$conexaoDao = new conexaoDao;
$con = $conexaoDao->conexao();
//----------------------------------//

$grupos = $gruposDao->buscarAtivos($con);
$total = count($grupos);
foreach ($grupos as $grupo){ 


	if($grupo->getEmail() == null){
		$grupo->_setEmail("N/A");
	}
	if($grupo->getClicks() == null){
		$grupo->_setClicks("N/A");
	}
	if($grupo->getAtivo() == 1){
		$grupo->_SetAtivo("Sim");
	}else{
		$grupo->_SetAtivo("Não");
	}

}

?>

