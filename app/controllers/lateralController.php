<?php 
//---------------------------//
require 'app/dao/parceirosDao.php';
$parceirosDao = new parceirosDao;
//-----------------------------------//
$parceiros = new parceirosDao;
if(!isset($con)){
	require 'app/dao/conexaoDao.php';
	$conexaoDao = new conexaoDao;
	$con = $conexaoDao->conexao();
}
$parceiros = $parceirosDao->buscarParceiros($con);

 ?>