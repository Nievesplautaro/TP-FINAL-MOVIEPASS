<?php

namespace Controllers;

use controllers\UserController as UserController;
Use Models\PHPMailer as PHPMailer;
Use Models\Exception as Exception;
use Models\SMTP as SMTP;
Use Models\User as User;
Use Models\Show as Show;



class EmailController{

    public function sendTicketPurchase($user, $show,$qrArray){
        require_once(VIEWS_PATH."validate-session.php");

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
                $mail->FromName = "MoviePass";
               // $mail->setFrom($smtpUsuario);     // Email who gonna Send Email                          
    
                $emailToSend = $user->getEmail();
                $mail->AddAddress($emailToSend, 'User');                // Recipient
                $mail->Subject = "MoviePass Ticket Data";          // Este es el titulo del email.
                 
                $dataname = explode("@",$emailToSend);
                $name = $dataname[0];

                // QR Content
                $info = "Cinema: ";
                $info .= $show->getRoom()->getCinema()->getName();
                $info .= "\nRoom: ";
                $info .= $show->getRoom()->getRoomName();
                $info .= "\nMovie: ";
                $info .= $show->getMovie()->getTitle();
                $info .= "\nUnit Price: ";
                $info .= $qrArray['ticket_price'];
                $info .= "\nQuantity: ";
                $info .= $qrArray['quantity'];
                $qrcontent = urlencode($info);


                // Email Content
                
                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Body = "
                    <html> 
    
                        <body style='display: block;'> 
                            <div Style='align:center;'>
                                <img src='https://i.ibb.co/z6bhV25/Screenshot-2020-11-21-Movie-Pass.png' style='width:100%'>
                            </div>
                            <div style='margin-bottom: 5px;'>
                                <div style='text-align: center;margin-bottom: 10px;font-size: 16px;'>
                                    <div style='text-align:center;font-size: 18px;font-weight: bold;margin-bottom: 10px;'> Hello ".$name."
                                    </div>
                                    <div style='text-align:center;font-size: 16px;font-weight: bold;margin-bottom: 10px;'>Your payment was credited successfully. Here you have your QR code and all the information to enter the movie.
                                    </div>
                                </div>
                                <div style='display: flex;margin-bottom:15px;'>
                                    <div class='QRCODE' style='width:50%; display:flex;'>
                                    <img style='max-width: 190px; margin:auto;' src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$qrcontent."&choe=UTF-8' title='Link to Google.com' />
                                    </div>
                                    <div class='Details' style='width:50%; padding: 10px;border: 0.5px solid #cecece;text-align: center;'>
                                        <div style='font-size: 22px;font-weight: bold;margin-bottom: 25px;border-bottom: 0.5px solid #cecece;'>
                                            Ticket Details
                                        </div>
                                        <div style='font-weight: bold;margin-bottom: 5px;'> Movie: ".$show->getMovie()->getTitle().
                                        "</div>
                                        <div style='font-weight: bold;margin-bottom: 5px;'> Cinema: ".$show->getRoom()->getCinema()->getName().
                                        "</div>
                                        <div style='font-weight: bold;margin-bottom: 5px;'> Room: ".$show->getRoom()->getRoomName().
                                        "</div>
                                        <div style='font-weight: bold;margin-bottom: 5px;'> Start Time: ".$show->getStartTime().
                                        "</div>                             
                                    </div>
                                </div>
                                <div style='text-align:center; font-size:18px;font-weight: bold;' >
                                Enjoy!
                                </div>
                            </div>
                        </body> 
    
                    </html>
    
                "; // Texto del email en formato HTML
    
                
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

