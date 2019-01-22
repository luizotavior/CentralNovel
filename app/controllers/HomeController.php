<?php 
//---------------------------//
//$title = "Central Novel";
$centro = "app/views/homeView.php";
$lateral = "app/views/lateralView.php";
$tabela = "app/views/tabelaView.php";
require 'app/dao/conexaoDao.php';
require 'app/dao/guardar_feedDao.php';
$guardar_feedDao = new guardar_feedDao;
$conexaoDao = new conexaoDao;
$con = $conexaoDao->conexao();

//----------------------------------//

?>