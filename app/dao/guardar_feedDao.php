<?php 

/**
* 
*/
require 'app/models/guardar_feedModel.php';

class guardar_feedDao{
	public function adicionarNoticia($con,$noticia){
		//Criando Dados
		$stmt = $con->prepare("INSERT INTO guardar_feed(titulo,grupo_id,data,link,novel_id,volume,capitulo,parte) VALUES(?, ?, ?, ?,?,?,?,?)");
		//bindParan não aceita valor de retorno de metodos, para isso é melhor utlizar bindValue.
		$stmt->bindValue(1,$noticia->getTitulo());
		$stmt->bindValue(2,$noticia->getGrupo());
		$stmt->bindValue(3,$noticia->getData());
		$stmt->bindValue(4,$noticia->getLink());
		$stmt->bindValue(5,$noticia->getNovel());
		$stmt->bindValue(6,$noticia->getVolume());
		$stmt->bindValue(7,$noticia->getCapitulo());
		$stmt->bindValue(8,$noticia->getParte());
		$stmt->execute();
	}
	public function removerNoticia($con,$id){
		// Deletando Dados
		$stmt = $con->prepare("DELETE FROM guardar_feed WHERE id = ?");
		$stmt->bindParam(1,$id);
		$stmt->execute();
	}
	public function alterarNoticia($con,$noticia){
		//Alterando Dados
		$stmt = $con->prepare("UPDATE guardar_feed SET titulo = ?, grupo_id = ?, data = ?,link = ?, novel_id = ?, volume = ?, capitulo = ?, parte = ?, WHERE id = ?");
		//bindParan não aceita valor de retorno de metodos, para isso é melhor utlizar bindValue.
		$stmt->bindValue(1,$noticia->getTitulo());
		$stmt->bindValue(2,$noticia->getGrupo());
		$stmt->bindValue(3,$noticia->getData());
		$stmt->bindValue(4,$noticia->getLink());
		$stmt->bindValue(5,$noticia->getNovel());
		$stmt->bindValue(6,$noticia->getVolume());
		$stmt->bindValue(7,$noticia->getCapitulo());
		$stmt->bindValue(8,$noticia->getParte());
		$stmt->bindValue(9,$noticia->getId());
		$stmt->execute();
	}

	public function buscarAll($con){
		//Consulta
		$noticias = new ArrayObject(); 
		$rs = $con->query("select * FROM guardar_feed");
		$rss = $rs->fetchAll(PDO::FETCH_OBJ);
		foreach ($rss as $res) {
			$noticia = new guardar_feedModel();
        	$noticia->_setId($res->id);
        	$noticia->_setTitulo($res->titulo);
	    	$noticia->_setGrupo($res->grupo_id);
        	$noticia->_setData($res->data);
        	$noticia->_setLink($res->link);
        	$noticia->_setNovel($res->novel_id);
        	$noticia->_setVolume($res->volume);
        	$noticia->_setCapitulo($res->capitulo);
        	$noticia->_setParte($res->parte);
        	$noticias -> append($noticia);
		}

        return $noticias;
	}
	//------------------------------------
	public function buscarIdGrupo($con,$id){
		//Consulta
		$noticias = new ArrayObject(); 
		$rs = $con->query("SELECT guardar_feed.*,grupos.nome FROM guardar_feed  INNER JOIN grupos ON (guardar_feed.grupo_id = grupos.id) WHERE grupos.id = $id ORDER BY guardar_feed.data DESC");
		$rss = $rs->fetchAll(PDO::FETCH_OBJ);
		foreach ($rss as $res) {
			$noticia = new guardar_feedModel();
        	$noticia->_setId($res->id);
        	$noticia->_setTitulo($res->titulo);
	    	$noticia->_setGrupo($res->grupo_id);
        	$noticia->_setData($res->data);
        	$noticia->_setLink($res->link);
        	$noticia->_setNovel($res->novel_id);
        	$noticia->_setVolume($res->volume);
        	$noticia->_setCapitulo($res->capitulo);
        	$noticia->_setParte($res->parte);
        	$noticias -> append($noticia);
		}

        return $noticias;
	}
	public function buscarId($con,$id){
		//Consulta
		$noticia = new guardar_feedModel();
		$rs = $con->query("select * FROM guardar_feed where id='$id'");
		$rss = $rs->fetch(PDO::FETCH_OBJ);
		if ($rss) {
	    	$noticia->_setId($rss->id);
	    	$noticia->_setTitulo($rss->titulo);
	    	$noticia->_setGrupo($rss->grupo_id);
	    	$noticia->_setData($rss->data);
        	$noticia->_setLink($res->link);
        	$noticia->_setNovel($res->novel_id);
        	$noticia->_setVolume($res->volume);
        	$noticia->_setCapitulo($res->capitulo);
        	$noticia->_setParte($res->parte);
		}else{
			echo "Registro Inexistente.";
		}

        return $noticia;
	}

	public function buscarPag($con,$inicio,$total_reg){
		//Consulta
		$rs = $con->query("SELECT * FROM guardar_feed LIMIT $inicio,$total_reg");
		$rss = $rs->fetchAll(PDO::FETCH_OBJ);

        return $rss;
	}
}
?>