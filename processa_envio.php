<?php
	//print_r($_POST);
	require "./bibliotecas/PHPMailer/Exception.php";
	require "./bibliotecas/PHPMailer/OAuth.php";
	require "./bibliotecas/PHPMailer//PHPMailer.php";
	require "./bibliotecas/PHPMailer/POP3.php";
	require "./bibliotecas/PHPMailer/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	class Mensagem{
		//encapsulamento
		private $para =null;
		private $assunto =null;
		private $mensagem =null;

		//criaão dos metodos especiais
		//de modo geral o get retona o valor e o set modifica

		public function __get($atributo){
			return $this->$atributo;
		}	

		public function __set($atributo,$valor){
			$this->$atributo =$valor;
		}
		public function mensagemValida(){
			if(empty($this->para)|| empty($this->assunto)|| empty($this->mensagem)){
				return false;
			}
			return true;
		}


	}
	$mensagem =new Mensagem();

	$mensagem->__set('para', $_POST['para']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem', $_POST['mensagem']);

	//print_r($mensagem);

	if (!$mensagem->mensagemValida()) {
		echo 'Mensagem não é Valida';
		die();
	}
	$mail = new PHPMailer(true);
	try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'curso.web2020@gmail.com';                 // SMTP username
    $mail->Password = '2ws4rf6yh';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('curso.web2020@gmail.com', 'Web Completo Remetente');
    $mail->addAddress('curso.web2020@gmail.com', 'Web Completo Destinatario');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Olá, este é o assunto.';
    $mail->Body    = 'Oi, eu sou o conteudo do <strong> email</strong> <b>in bold!</b>';
    $mail->AltBody = 'Oi, eu sou o conteudo do email';

    $mail->send();
    echo 'Message has been sent';
	} catch (Exception $e) {
    echo 'Não foi possivel enviar esse email, tente mais tarde';
    echo 'Detalhes do erro: ' . $mail->ErrorInfo;
	}
?>