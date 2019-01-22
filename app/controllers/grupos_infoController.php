<?php 
//---------------------------//
//$title = "Central Novel";
$centro = "app/views/grupos_infoView.php";
$lateral = "app/views/lateralView.php";
$tabela = "app/views/tabelaView.php";
require 'app/dao/conexaoDao.php';
require 'app/dao/guardar_feedDao.php';
require 'app/dao/gruposDao.php';
$guardar_feedDao = new guardar_feedDao;
$conexaoDao = new conexaoDao;
$gruposDao = new gruposDao;
$con = $conexaoDao->conexao();

//----------------------------------//
$url = isset( $_GET['url'] ) ? $_GET['url'] : 'home';
$url = LinkAmigavel($url);
$url2 = $url;
$url = explode('/', $url);
$url[0] = ($url[0] == NULL ? 'home' : $url[0]);
//----------------------------------//
$texto = LinkAmigavel($url[1]);
//----------------------------------//
$grupo = $gruposDao->buscarPagina($con,$texto);


$visualizar = false;
if($grupo){
	$visualizar = true;
	$grupo->_SetDataNasc(data($grupo->GetDataNasc(),24));

	$id = $grupo->getId();
	$postagens = $guardar_feedDao->buscarIdGrupo($con,$id);
	$totalPostagem = count($postagens);
	if($totalPostagem >0){
		$dataLast = $postagens[0]->getdata();
		$grupo->_SetDataLast(data($dataLast));
		for ($i=0; $i < $totalPostagem; $i++) {
			$postagens[$i]->_SetData(data($postagens[$i]->GetData(),24));
		}
	}





}

?>