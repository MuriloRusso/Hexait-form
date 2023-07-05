<?php   

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$organizacao = $_POST['organizacao'];
  	$pais = $_POST['pais'];
	$cargo = $_POST['cargo'];
	$EmployeeSize = $_POST['EmployeeSize'];	
	$telefone = $_POST['telefone'];
	$tema = $_POST['tema'];
	

	// $data_envio = date('d/m/Y');
	$data_envio = date('Y-m-d');
	$hora_envio = date('H:i:s');


	//Guardar informações preenchidas no banco de dados

	$usuario = 'formhexait';
	$senha = 'H7667@ngeL';
	$database = 'formhexait';
	$host = 'formhexait.mysql.dbaas.com.br';


	$mysqli = new mysqli($host, $usuario, $senha, $database);

	if($mysqli->error){

		die('Falha ao conectar ao banco de dados');

	}


	$sql_code = "INSERT INTO agendamento_reuniao (nome, sobrenome, email, organizacao, pais, cargo, EmployeeSize, telefone, tema, data_envio, hora_envio) VALUES ('{$nome}', '{$sobrenome}', '{$email}', '{$organizacao}', '{$pais}', '{$cargo}', '{$EmployeeSize}', '{$telefone}', '{$tema}', '{$data_envio}', '{$hora_envio}')";

	$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);		

	// header("Location: index.html");

	//---------------------


	require 'PHPMailer-master/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->isSMTP();

	$mail->Host = "email-ssl.com.br";
	$mail->Port = "465";
	$mail->SMTPSecure = "ssl";
	$mail->SMTPAuth = "true";
	$mail->Username = "no-reply@hexait.com.br";
	$mail->Password = "H7667@ngeL";


	$mail->setFrom($mail->Username, 'Hexait'); //remetente

	 $mail->addAddress('nienkotter@hexait.com.br');
	// $mail->addAddress('contato@murilorusso.com.br');

	$mail->Subject = 'Agendamento Reunião';

	$mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';


	$conteudo_email = " 
	
	<strong>Nome: </strong><br> $nome <br> <br>

	<strong>Sobrenome: </strong><br> $sobrenome <br> <br>
	
	<strong>E-mail: </strong><br> $email <br> <br>

	<strong>Organização:</strong> <br> $organizacao  <br> <br>

	<strong>Pais:</strong> <br> $pais  <br> <br>

	<strong>Cargo:</strong> <br> $cargo  <br> <br>

	<strong>EmployeeSize:</strong> <br> $EmployeeSize  <br> <br>

	<strong>Telefone: </strong><br> $telefone <br> <br>

	<strong>tema:/strong> <br> $tema  <br> <br>


	<br><br><br>
	Este e-mail foi enviado em $data_envio às $hora_envio <br>

	";


	$conteudo_email = utf8_decode($conteudo_email);

	$mail->IsHTML(true);
	$mail->Body = $conteudo_email;


	

	if($mail->send()){
		
		$mail->ClearAllRecipients();
		
// 		// $mail->addAddress('diretoria@hexait.com.br');
		$mail->addAddress('murilo@2up.com.br');
		
		$mail->send();
		
		
		
		header("Location: index.html?alert=sucess");
		
	}

	else{
		
		header("Location: index.html?alert=error".$mail->ErrorInfo);
		
	}




?>