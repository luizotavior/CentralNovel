<?php

class conexaoDao{

    # Método que inicia a Conexão com o Banco de Dados.
    # Método estático - acessível sem instanciação.
  public function conexao(){
   try {
  $db_driver = 'mysql';
  $db_host = '';
  $db_nome = '';
  $db_usuario = '';
  $db_senha = '';
          # Atribui o objeto PDO à variável $db.
    $con = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            # Garante que o PDO lance exceções durante erros.
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
    $con->exec('SET NAMES utf8mb4');
    
    return $con;
  } catch (PDOException $e) {
   echo htmlentities('Houve um erro na conexão! ' . $e->getMessage());
   die("Connection Error: " . $e->getMessage());
 }
}
public function sqlRun($con,$sql){
  $stmt = $con->prepare($sql);
  $stmt->execute();
}
}