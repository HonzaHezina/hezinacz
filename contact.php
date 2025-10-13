<?php
/**
 * Kontaktní formulář s podporou PHPMailer pro Wedos hosting
 * 
 * Tento skript používá PHPMailer knihovnu pro spolehlivé odesílání emailů
 * přes SMTP server s autentizací.
 */

// Načtení PHPMailer knihovny
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer/Exception.php';
require 'lib/PHPMailer/PHPMailer.php';
require 'lib/PHPMailer/SMTP.php';

// Načtení konfigurace
require 'email_config.php';

// Kontrola, zda byl formulář odeslán
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Získání hodnot z formuláře a sanitizace
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = trim($_POST['email'] ?? '');
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $custom_subject = htmlspecialchars(trim($_POST['subject'] ?? ''));

    // Kontrola povinných polí
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: index.html?status=error&msg=" . urlencode("Všechna povinná pole musí být vyplněna."));
        exit;
    }

    // Validace emailové adresy
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?status=error&msg=" . urlencode("Neplatná emailová adresa."));
        exit;
    }

    // Kontrola, zda je SMTP heslo nastaveno
    if (empty(SMTP_PASSWORD)) {
        error_log("CHYBA: SMTP heslo není nastaveno v email_config.php");
        header("Location: index.html?status=error&msg=" . urlencode("Emailový server není správně nakonfigurován. Kontaktujte správce webu."));
        exit;
    }

    // Nastavení předmětu
    $subject = !empty($custom_subject) ? $custom_subject : "Zpráva z kontaktního formuláře";

    // Vytvoření těla emailu
    $email_content = "
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #6C63FF, #FF57B9); color: white; padding: 20px; border-radius: 5px 5px 0 0; }
            .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #6C63FF; }
            .footer { background: #333; color: white; padding: 10px; text-align: center; font-size: 12px; border-radius: 0 0 5px 5px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Nová zpráva z kontaktního formuláře</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <span class='label'>Jméno:</span><br>
                    $name
                </div>";
    
    if (!empty($custom_subject)) {
        $email_content .= "
                <div class='field'>
                    <span class='label'>Předmět:</span><br>
                    $custom_subject
                </div>";
    }
    
    $email_content .= "
                <div class='field'>
                    <span class='label'>E-mail:</span><br>
                    <a href='mailto:$email'>$email</a>
                </div>
                <div class='field'>
                    <span class='label'>Zpráva:</span><br>
                    " . nl2br($message) . "
                </div>
            </div>
            <div class='footer'>
                <p>Tato zpráva byla odeslána z kontaktního formuláře na webu hezina.cz</p>
                <p>Datum: " . date('d.m.Y H:i:s') . "</p>
            </div>
        </div>
    </body>
    </html>";

    try {
        // Vytvoření PHPMailer instance
        $mail = new PHPMailer(true);

        // Nastavení SMTP
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;
        $mail->CharSet = 'UTF-8';

        // Debug режим (pouze pokud je zapnutý)
        if (EMAIL_DEBUG) {
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = function($str, $level) {
                error_log("PHPMailer debug: $str");
            };
        }

        // Odesílatel
        $mail->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
        $mail->addReplyTo($email, $name);

        // Příjemce
        $mail->addAddress(EMAIL_TO);

        // Obsah emailu
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $email_content;
        
        // Alternativní textová verze pro klienty bez HTML
        $mail->AltBody = "Nová zpráva z kontaktního formuláře\n\n" .
                        "Jméno: $name\n" .
                        ($custom_subject ? "Předmět: $custom_subject\n" : "") .
                        "E-mail: $email\n\n" .
                        "Zpráva:\n$message\n\n" .
                        "---\n" .
                        "Tato zpráva byla odeslána z kontaktního formuláře na webu hezina.cz\n" .
                        "Datum: " . date('d.m.Y H:i:s');

        // Odeslání emailu
        $mail->send();
        
        // Úspěšné odeslání - přesměrování
        header("Location: dekujeme.html");
        exit;

    } catch (Exception $e) {
        // Chyba při odesílání - logování a přesměrování
        error_log("Chyba při odesílání emailu: {$mail->ErrorInfo}");
        
        $error_msg = "Při odesílání zprávy došlo k chybě.";
        if (EMAIL_DEBUG) {
            $error_msg .= " Detail: " . $mail->ErrorInfo;
        } else {
            $error_msg .= " Zkuste to prosím znovu později.";
        }
        
        header("Location: index.html?status=error&msg=" . urlencode($error_msg));
        exit;
    }
} else {
    // Přímý přístup bez POST - přesměrování
    header("Location: index.html");
    exit;
}
?>
