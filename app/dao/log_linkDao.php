<?php 



require 'app/models/log_linkModel.php';

class log_linkDao{

    public function adicionarLog($con,$log_link){
        //Criando Dados
        $stmt = $con->prepare("INSERT INTO log_link(grupo_id,ip) VALUES(?, ?)");
        //bindParan não aceita valor de retorno de metodos, para isso é melhor utlizar bindValue.
        $stmt->bindValue(1,$log_link->getGrupoId());
        $stmt->bindValue(2,$log_link->getIp());
        $stmt->execute();
    }
}
 ?>