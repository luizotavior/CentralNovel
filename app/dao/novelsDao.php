<?php 



require 'app/models/novelsModel.php';

class novelsDao{

    public function adicionar($con,$novelModel){
        //Criando Dados
        $stmt = $con->prepare("INSERT INTO novels(nome,chave) VALUES(?, ?)");
        //bindParan não aceita valor de retorno de metodos, para isso é melhor utlizar bindValue.
        $stmt->bindValue(1,$novelModel->getNome());
        $stmt->bindValue(2,$novelModel->getChave());
        $stmt->execute();
    }
    public function buscarAll($con){
	//Consulta
       $novels = new ArrayObject(); 
       $rs = $con->query("select * FROM novels");
       $rss = $rs->fetchAll(PDO::FETCH_OBJ);
       foreach ($rss as $res) {
          $novel = new novelsModel();
          $novel->setId($res->id);
          $novel->setNome($res->nome);
          $novel->setChave($res->chave);
          $novels -> append($novel);
      }

      return $novels;
  }
}
?>