<?php
	require 'vendor/autoload.php';
	use PHPMailer\PHPMailer\PHPMailer; 

	$mail = new PHPMailer();
	
    $fname = "Facundo";		
    $toemail = "facundorueda14@gmail.com";	
    $subject = "Baja de postulacion";	
    $message = "No sera tenido en cuenta para esta postulacion. Muchas gracias.";
    $mail->isSMTP();                           
    $mail->Host = 'smtp.gmail.com';            
    $mail->SMTPAuth = true;                    
    $mail->Username = 'facundoarueda@hotmail.com';
    $mail->Password = 'CONTRASEÑADELMAILDELQUEMANDA';
    $mail->SMTPSecure = 'tls';          
    $mail->Port = 587;                  
    $mail->setFrom('facundoarueda@hotmail.com', 'Facundo Rueda');
    $mail->addReplyTo('facundorueda14@gmail.com', 'NOMBREDELQUEMANDA');
    $mail->addAddress($toemail);   

    $mail->isHTML(true); 

    $bodyContent = $message;

    $mail->Subject = $subject;
    $bodyContent = 'Querido '.$fname.':';
    $bodyContent .='<p>'.$message.'</p>';
    $mail->Body = $bodyContent;

    if(!$mail->send())
        echo 'Error: '.$mail->ErrorInfo;
    else
        echo 'Enviado!';
?>