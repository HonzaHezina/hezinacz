<?php
// Kontrola, zda byl formulář odeslán
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Získání hodnot z formuláře
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $custom_subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';

    // Konfigurace emailu
    $recipient = 'hezina@gmail.com'; // Změňte na svou emailovou adresu
    $smtp_server = 'wes1-smtp.wedos.net';
    $sender_email = 'info@coumis.cz'; // Musí být z vaší domény na Wedos

    // Kontrola povinných polí
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: index.html?status=error&msg=Všechna povinná pole musí být vyplněna.");
        exit;
    }

    // Validace emailové adresy
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?status=error&msg=Neplatná emailová adresa.");
        exit;
    }

    // Nastavení předmětu
    $subject = !empty($custom_subject) ? $custom_subject : "Zpráva z kontaktního formuláře";

    // OPRAVENÉ HLAVIČKY - přidán Return-Path a From s doménovou adresou
    $headers = "From: Kontaktní formulář <$sender_email>" . "\r\n";
    $headers .= "Return-Path: $sender_email" . "\r\n";
    $headers .= "Reply-To: $name <$email>" . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    // Tělo e-mailu
    $email_content = "<html><body>";
    $email_content .= "<h2>Nová zpráva z kontaktního formuláře</h2>";
    $email_content .= "<p><strong>Jméno:</strong> $name</p>";

    if (!empty($custom_subject)) {
        $email_content .= "<p><strong>Předmět:</strong> $custom_subject</p>";
    }

    $email_content .= "<p><strong>E-mail:</strong> $email</p>";
    $email_content .= "<p><strong>Zpráva:</strong></p>";
    $email_content .= "<p>" . nl2br($message) . "</p>";
    $email_content .= "<hr>";
    $email_content .= "<p><em>Tato zpráva byla odeslána z kontaktního formuláře na vašich osobních stránkách.</em></p>";
    $email_content .= "</body></html>";

    // OPRAVENÉ SMTP nastavení pro Wedos
    ini_set('SMTP', $smtp_server);
    ini_set('smtp_port', 587);
    ini_set('sendmail_from', $sender_email);

    // Odeslání e-mailu s dodatečným parametrem -f pro return-path
    $success = mail($recipient, $subject, $email_content, $headers, "-f $sender_email");

    // Přesměrování na děkovnou stránku nebo zpět na formulář v případě chyby
    if ($success) {
        header("Location: dekujeme.html");
    } else {
        header("Location: index.html?status=error&msg=Při odesílání zprávy došlo k chybě. Zkuste to prosím znovu.");
    }
    exit;
}
?>