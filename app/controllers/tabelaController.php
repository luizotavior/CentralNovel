<?php 

if(isset($_POST['sleep']) && $_POST['sleep']){
	sleep(1);
}
 try {
	$db_driver = 'mysql';
	$db_host = '159.203.127.17';
	$db_nome = 'admin_centraln';
	$db_usuario = 'admin_centraln';
	$db_senha = 'lefn5KEUZv';
	# Atribui o objeto PDO à variável $db.
	$con = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
	# Garante que o PDO lance exceções durante erros.
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	# Garante que os dados sejam armazenados com codificação UFT-8.
	$con->exec('SET NAMES utf8');
} catch (PDOException $e) {
	echo $e;
}

$init = $_POST['init'];
$max = $_POST['max'];


$result = array(
	'totalResults' => 0,
	'dados' => null
	);
$rs = $con->query("select * FROM guardar_feed");
$rss = $rs->fetchAll(PDO::FETCH_OBJ);
$result["totalResults"] = count($rss);

$rs = $con->query("SELECT GF.titulo,GF.data,GF.link,GF.grupo_id,GP.nome,GP.pagina,GP.link as Glink FROM guardar_feed GF JOIN grupos GP ON (GF.grupo_id = GP.id)  ORDER BY GF.data DESC LIMIT $init,$max ");
$rss = $rs->fetchAll(PDO::FETCH_OBJ);
if($result["totalResults"] > 0){
$countador = count($rss);
	for ($i=0; $i < $countador; $i++) {
		
		$rss[$i]->data = data($rss[$i]->data,24);
	}
	$result['dados'] = $rss;
}

echo json_encode($result);

 ?>