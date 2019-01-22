<?php 

/**
* 
*/
class timeDao{


    public function reset($con){
        $stmt = $con->prepare("TRUNCATE table time");
        $stmt->execute();
    }

    //timestamp automatico
    public function adicionarTime($con){
        $stmt = $con->prepare("INSERT INTO time() VALUES ()");
        $stmt->execute();
    }

}
 ?>