<?php 

//---------------------------//
$lateral = "app/views/lateralView.php";
$centro = "app/views/contatoView.php";
require 'app/dao/conexaoDao.php';
require 'app/dao/gruposDao.php';
$gruposDao = new gruposDao;
$conexaoDao = new conexaoDao;
$con = $conexaoDao->conexao();
//----------------------------------//

if(isset($_POST['enviaEmail'])){
	$enviaEmail = $_POST['enviaEmail'];
}
if(isset($_POST['enviar']) && isset($_POST['mensagem'])){

	try {

		//1 – Definimos Para quem vai ser enviado o email
		$para = "contato@centralnovel.com.br";
		//2 - resgatar o nome digitado no formulário e  grava na variavel $nome
		$nome = $_POST['nome'];
		// 3 - resgatar o assunto digitado no formulário e  grava na variavel //$assunto
		$assunto = $_POST['assunto']." - ".$_POST['nome'];
		//4 – Agora definimos a  mensagem que vai ser enviado no e-mail
		$mensagem = "<strong>Nome:  </strong>".$nome;
		$mensagem .= "<br>  <strong>Email: </strong>".$_POST['email'];
		if (isset($_POST['site'])) {
			$mensagem .= "<br>  <strong>Site: </strong>".$_POST['site'];
		}
		$mensagem .= "<br>  <strong>Mensagem: </strong>".$_POST['mensagem'];

		//5 – agora inserimos as codificações corretas e  tudo mais.
		$headers =  "Content-Type:text/html; charset=UTF-8\n";
		$headers .= "From:  Central Novel<noreply@centralnovel.com.br>\n"; //Vai ser //mostrado que  o email partiu deste email e seguido do nome
		$headers .= "X-Sender:  <noreply@centralnovel.com.br>\n"; //email do servidor //que enviou
		$headers .= "X-Mailer: PHP  v".phpversion()."\n";
		$headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
		$headers .= "Reply-To: ".$_POST['email']."\n";
		$headers .= "Return-Path:  <contato@centralnovel.com.br>\n"; //caso a msg //seja respondida vai para  este email.
		$headers .= "MIME-Version: 1.0\n";
		$envio = mail($para, $assunto, $mensagem, $headers);  //função que faz o envio do email.
		 
		if($envio)
		 $status = true;
		else
		 $status = false;

	} catch (Exception $e) {
		$status = false;
	}
}

 ?>

