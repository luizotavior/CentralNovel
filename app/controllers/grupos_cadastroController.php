<?php 

//---------------------------//
$lateral = "app/views/lateralView.php";
$centro = "app/views/grupos_cadastroView.php";
require 'app/dao/conexaoDao.php';
require 'app/dao/gruposDao.php';
$gruposDao = new gruposDao;
$conexaoDao = new conexaoDao;
$con = $conexaoDao->conexao();
//----------------------------------//

if(isset($_POST['termos'])){
	$termos = $_POST['termos'];
}
if(isset($_POST['enviar'])){
	$grupo = new gruposModel;
	$grupo->_setNome($_POST['nome']);
	$grupo->_setEmail($_POST['email']);
	$grupo->_setLink($_POST['link']);
	$grupo->_setFeed($_POST['feed']);
	$grupo->_setAtivo('0');

	try {
		$gruposDao->adicionarGrupo($con,$grupo);
		$status = true;
	} catch (Exception $e) {
		$status = false;
	}

	if($status == true && isset($grupo)){
		try {

		//1 – Definimos Para quem vai ser enviado o email
			$para = "contato@centralnovel.com.br";
		//2 - resgatar o nome digitado no formulário e  grava na variavel $nome
			$nome = $_POST['nome'];
		// 3 - resgatar o assunto digitado no formulário e  grava na variavel //$assunto
			$assunto = "Cadastro Sistema - ".$_POST['nome'];
		//4 – Agora definimos a  mensagem que vai ser enviado no e-mail
			$mensagem = "<strong>Nome:  </strong>".$_POST['nome'];
			$mensagem .= "<br>  <strong>Email: </strong>".$_POST['email'];
			$mensagem .= "<br>  <strong>Site: </strong>".$_POST['link'];
			$mensagem .= "<br>  <strong>Feed/RSS: </strong>".$_POST['feed'];
			$mensagem .= "<br>  <strong>Mensagem: </strong> Um Grupo foi Cadastrado em nosso Sistema, Peço que verifique se o mesmo esta qualificado para o cadastro.";

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

	} catch (Exception $e) {}
}
}

?>