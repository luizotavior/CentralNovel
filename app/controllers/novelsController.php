<?php 

//---------------------------//
$lateral = "app/views/lateralView.php";
$centro = "app/views/novelsView.php";
require 'app/dao/conexaoDao.php';
require 'app/dao/novelsDao.php';
$novelsDao = new novelsDao;
$conexaoDao = new conexaoDao;
$con = $conexaoDao->conexao();
//----------------------------------//

$novels = $novelsDao->buscarAll($con);
$total = count($novels);

?>

