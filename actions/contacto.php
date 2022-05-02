<?php
  
if($_POST) {
    $contact-name = "";
    $contact-email = "";
    $contact-message = "";
    $email_body = "<div>";
      
    if(isset($_POST['contact-name'])) {
        $contact-name = filter_var($_POST['contact-name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Nombre del contacto:</b></label>&nbsp;<span>".$contact-name."</span>
                        </div>";
    }
 
    if(isset($_POST['contact-email'])) {
        $contact-email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['contact-email']);
        $contact-email = filter_var($contact-email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Email del contacto:</b></label>&nbsp;<span>".$contact-email."</span>
                        </div>";
    }
      
    if(isset($_POST['contact-message'])) {
        $contact-message = htmlspecialchars($_POST['contact-message']);
        $email_body .= "<div>
                           <label><b>contact Message:</b></label>
                           <div>".$contact-message."</div>
                        </div>";
    }
      
    $recipient = "guillermo.garcia.grao@gmail.com";
    $email_title = "Mensaje de ".$contact-name." para Iglesia Parroquia de San Miguel Arcángel"
      
    $email_body .= "</div>";
 
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $contact-email . "\r\n";
      
    if(mail($recipient, $email_title, $email_body, $headers)) {
        echo "<p>Thank you for contacting us, $contact-name. You will get a reply within 24 hours.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
      
} else {
    echo '<p>Something went wrong</p>';
}
?>