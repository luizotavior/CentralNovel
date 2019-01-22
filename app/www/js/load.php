<?php
	require 'app/dao/conexaoDao.php';
	require 'app/dao/guardar_feedDao.php';
	$conexaoDao = new conexaoDao;
	$con = $conexaoDao->conexao();
	$guardar_feedDao = new guardar_feedDao;


	$init 	= $_POST['init'];
	$max 	= $_POST['max'];

	$result = array(
		'totalResults' => 0,
		'dados' => null
	);

	$queryTotal = $guardar_feedDao->buscarAll($con);
	$result["totalResults"] = count($queryTotal);

	$queryDados = $guardar_feedDao->buscarPag($con,$init,$max);

	if($result["totalResults"] > 0){

		/*while($res = mysql_fetch_assoc($queryDados)){
			$arr[] = $res;
		}*/
		foreach ($queryDados as $res) {
			$arr[] = $res;
		}

		$result["dados"] = $arr;
	var_dump($result);
	}

	echo json_encode($result);
