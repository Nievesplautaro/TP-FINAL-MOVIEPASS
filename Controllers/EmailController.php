<?php

namespace Controllers;

use controllers\UserController as UserController;
Use Models\PHPMailer as PHPMailer;
Use Models\Exception as Exception;
use Models\SMTP as SMTP;
Use Models\User as User;


class EmailController{

    public function sendTicketPurchase(){

        $userController = new UserController();
        $user = $userController->GetUserLoged();

        if ($user == null){
            echo "no usser logged in";
        }else{
            $mail = new PHPMailer(true);

            try{
    
                // Datos de la cuenta de correo utilizada para enviar v�a SMTP
    
                $smtpHost = "smtp.live.com";                            // Dominio alternativo brindado en el email de alta 
                $smtpUsuario = "MoviePassProject@hotmail.com";               // Mi cuenta de correo
                $smtpClave = "TestingPass123";                          // Mi contrase�a
    
                $mail->IsSMTP();                                        // telling the class to use SMTP
                $mail->SMTPDebug = 0;
                $mail->Mailer = "smtp";                                 // Enable verbose debug output
                $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );                                                      // Send using SMTP
    
                
                $mail->Host       = $smtpHost;                          // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                               // Enable SMTP authentication
                $mail->Username   = $smtpUsuario;                       // SMTP username
                $mail->Password   = $smtpClave;                         // SMTP password
                $mail->SMTPSecure = 'tls';                              // `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                // TCP port to connect to
    
                //Recipients
    
                $mail->From = $smtpUsuario;
                $mail->FromName = "TEST";
               // $mail->setFrom($smtpUsuario);     // Email who gonna Send Email                          
    
                $emailToSend = $user->getEmail();
                $mail->AddAddress($emailToSend, 'User');                // Recipient
                $mail->Subject = "MoviePass® Ticket Purchase";          // Este es el titulo del email.
    
                // Email Content
    
                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Body = "
                    <html> 
    
                        <body> 
                            <div Style='align:center;'>
    
                            <h1>TICKET PURCHASE INFORMATION</h1>
    
                            <p>Perri Gei</p>
    
                            </div>
    
                            </br>
                            <p>--------------------------------------------------------------------------------MoviePass®--------------------------------------------------------------------------------</p>
                            </br>
                            <p>( This is an automated message, please do not reply to this message, if you have any queries please contact tecinformaticas@mdp.utn.edu.ar  )</p>
                            </br>
                            <p>--------------------------------------------------------------------------------MoviePass®--------------------------------------------------------------------------------</p>
                            </br>
                        </body> 
    
                    </html>
    
                <br />"; // Texto del email en formato HTML
    
                
                $estadoEnvio = $mail->Send(); 
    
                if($estadoEnvio){
                    echo "El correo fue enviado correctamente.";
                } else {
                    echo "Ocurri� un error inesperado.";
                }
    
            } catch (Exception $e){
                echo "Mail Error: {$mail->ErrorInfo}";
            }
        }

    }
}
?>

