<?php 

require 'app/dao/conexaoDao.php';
require 'app/dao/gruposDao.php';
$gruposDao = new gruposDao;
$conexaoDao = new conexaoDao;
$con = $conexaoDao->conexao();
if(isset($_GET['link']) && isset($_GET['id'])){
	$grupo_id = $_GET['id'];
	$link = $_GET['link'];
	$gruposDao->alterarClicks($con,$grupo_id);
	header('location: '.$link.'?utm_source=CentralNovel&utm_medium=CentralNovel&utm_campaign=CentralNovel');
}else{
	header('location: '.$link);
};




 ?>