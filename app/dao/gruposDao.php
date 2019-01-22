<?php 

/**
* 
*/
require 'app/models/gruposModel.php';

class gruposDao{

	//desativado
	// public function atualizarDataLast($con,$id,$data){
	// 	//Alterando Dados
	// 	$stmt = $con->prepare("UPDATE grupos SET data_last=CURRENT_TIMESTAMP WHERE id='$id'");
	// 	$stmt->execute();
	// }
	
	public function adicionarGrupo($con,$grupo){
		//Criando Dados
		$stmt = $con->prepare("INSERT INTO grupos(nome,link,feed,email,ativo,data_nasc) VALUES(?, ?, ?, ?, ?,CURRENT_TIMESTAMP)");
		//bindParan não aceita valor de retorno de metodos, para isso é melhor utlizar bindValue.
		$stmt->bindValue(1,$grupo->getNome());
		$stmt->bindValue(2,$grupo->getLink());
		$stmt->bindValue(3,$grupo->getFeed());
		$stmt->bindValue(4,$grupo->getEmail());
		$stmt->bindValue(5,$grupo->getAtivo());
		$stmt->execute();
	}
	public function removerGrupo($con,$id){
		// Deletando Dados
		$stmt = $con->prepare("DELETE FROM grupos WHERE id = ?");
		$stmt->bindParam(1,$id);
		$stmt->execute();
	}
	public function alterarGrupo($con,$grupo){
		//Alterando Dados
		$stmt = $con->prepare("UPDATE grupos SET nome = ?, link = ?, feed = ?, email = ?, pagina = ? , ativo = ? WHERE id = ?");
		//bindParan não aceita valor de retorno de metodos, para isso é melhor utlizar bindValue.
		$stmt->bindValue(1,$grupo->getNome());
		$stmt->bindValue(2,$grupo->getLink());
		$stmt->bindValue(3,$grupo->getFeed());
		$stmt->bindValue(4,$grupo->getEmail());
		$stmt->bindValue(5,$grupo->getPagina());
		$stmt->bindValue(6,$grupo->getAtivo());
		$stmt->bindValue(7,$noticia->getId());
		$stmt->execute();
	}
		public function alterarClicks($con,$grupo_id){
		//Alterando Dados
		$stmt = $con->prepare("UPDATE grupos SET clicks = clicks+1 WHERE id = ? and ativo=1");
		//bindParan não aceita valor de retorno de metodos, para isso é melhor utlizar bindValue.
		$stmt->bindValue(1,$grupo_id);
		$stmt->execute();
	}

	public function buscarAll($con){
		//Consulta
		$grupos = new ArrayObject(); 
		$rs = $con->query("select * FROM grupos");
		$rss = $rs->fetchAll(PDO::FETCH_OBJ);
		foreach ($rss as $res) {
			$grupo = new gruposModel();
        	$grupo->_setId($res->id);
        	$grupo->_setNome($res->nome);
	    	$grupo->_setLink($res->link);
        	$grupo->_setFeed($res->feed);
			$grupo->_setEmail($res->email);
			$grupo->_setAtivo($res->ativo);
			$grupo->_setPagina($res->pagina);
			$grupo->_setClicks($res->clicks);
        	$grupos -> append($grupo);
		}

        return $grupos;
	}
	public function buscarAtivos($con){
		//Consulta
		$grupos = new ArrayObject(); 
		$rs = $con->query("select * FROM grupos where ativo=1 ORDER BY nome ASC");
		$rss = $rs->fetchAll(PDO::FETCH_OBJ);
		foreach ($rss as $res) {
			$grupo = new gruposModel();
        	$grupo->_setId($res->id);
        	$grupo->_setNome($res->nome);
	    	$grupo->_setLink($res->link);
        	$grupo->_setFeed($res->feed);
			$grupo->_setEmail($res->email);
			$grupo->_setAtivo($res->ativo);
			$grupo->_setPagina($res->pagina);
			$grupo->_setClicks($res->clicks);
			$grupo->_setDataNasc($res->data_nasc);
			$grupo->_setDataLast($res->data_last);
        	$grupos -> append($grupo);
		}

        return $grupos;
	}

	public function buscarPagina($con,$pagina){
		//Consulta
		$rs = $con->prepare("SELECT * FROM grupos WHERE pagina=?");
		$rs->bindParam(1, $pagina, PDO::PARAM_STR);
		$rs->execute();
		$rss = $rs->fetch(PDO::FETCH_OBJ);
		if ($rss) {
			$grupo = new gruposModel();
	    	$grupo->_setId($rss->id);
	    	$grupo->_setNome($rss->nome);
	    	$grupo->_setLink($rss->link);
	    	$grupo->_setFeed($rss->feed);
			$grupo->_setEmail($rss->email);
			$grupo->_setPagina($rss->pagina);
			$grupo->_setAtivo($rss->ativo);
			$grupo->_setClicks($rss->clicks);
			$grupo->_setDataNasc($rss->data_nasc);
			$grupo->_setDataLast($rss->data_last);
        	return $grupo;
		}
		return $rss;
		

	}

	public function buscarId($con,$id){
		//Consulta
		$grupo = new gruposModel();
		$rs = $con->query("select * FROM grupos where id='$id'");
		$res = $rs->fetch(PDO::FETCH_OBJ);
		if ($res) {
        	$grupo->_setId($res->id);
        	$grupo->_setNome($res->nome);
	    	$grupo->_setLink($res->link);
        	$grupo->_setFeed($res->feed);
			$grupo->_setEmail($res->email);
			$grupo->_setPagina($res->pagina);
			$grupo->_setAtivo($res->ativo);
			$grupo->_setClicks($res->clicks);
			$grupo->_setDataNasc($res->data_nasc);
			$grupo->_setDataLast($res->data_last);
		}else{
			echo "Registro Inexistente.";
		}

        return $grupo;
	}
}
?>