<?php
    require './bibliotecas/PHPMailer/Exception.php';
    require './bibliotecas/PHPMailer/OAuth.php';
    require './bibliotecas/PHPMailer/PHPMailer.php';
    require './bibliotecas/PHPMailer/POP3.php';
    require './bibliotecas/PHPMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensage = null;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function mensagemValida(){
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }
            return true;

        }
    }

    $mensagem = new Mensagem();

    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if(!$mensagem->mensagemValida()){
        echo 'Mensagem valida';
    }else{
        echo 'Mensagem não válida';
        die();
    }

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'contato@andrewdeveloper.com.br';   // SMTP username
        $mail->Password = '*******';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('contato@andrewdeveloper.com.br', 'Andrewdeveloper Remetente');
        $mail->addAddress('contato@andrewdeveloper.com.br', 'Web Completo Destinatario');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Assunto do email';
        $mail->Body    = 'Conteudo do <strong>Email</strong>';
        $mail->AltBody = 'Eu sou o corpo do Email';

        $mail->send();
        echo 'Mensagem foi enviada';
    } catch (Exception $e) {
        echo 'Mensagem não foi enviada';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }