<?php 

/**
* 
*/
require 'app/models/parceirosModel.php';
class parceirosDao{


	public function buscarParceiros($con){
		//Consulta
		$parceiros = new ArrayObject(); 
		$rs = $con->query("SELECT parceiros.id,parceiros.grupos_id, grupos.nome,grupos.pagina FROM parceiros  INNER JOIN grupos ON (parceiros.grupos_id = grupos.id) ORDER BY grupos.nome ASC");
		$rss = $rs->fetchAll(PDO::FETCH_OBJ);
		foreach ($rss as $res) {
			$parceiro = new parceirosModel();
        	$parceiro->_setId($res->id);
        	$parceiro->_setGruposId($res->grupos_id);
        	$parceiro->_setNome($res->nome);
			$parceiro->_setPagina($res->pagina);
        	$parceiros -> append($parceiro);
		}

        return $parceiros;
	}
}
 ?>