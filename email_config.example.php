<?php
/**
 * Ukázkový konfigurační soubor pro email
 * 
 * INSTRUKCE:
 * 1. Zkopírujte tento soubor jako 'email_config.php'
 * 2. Vyplňte SMTP_PASSWORD (heslo k vaší emailové schránce)
 * 3. Případně upravte další nastavení dle potřeby
 */

// SMTP nastavení pro Wedos
define('SMTP_HOST', 'smtp.wedos.com');
define('SMTP_PORT', 587);
define('SMTP_ENCRYPTION', 'tls'); // nebo 'ssl' pro port 465

// SMTP přihlašovací údaje
// DŮLEŽITÉ: Doplňte heslo k emailové schránce!
define('SMTP_USERNAME', 'info@hezina.cz'); // Emailová adresa z vaší domény
define('SMTP_PASSWORD', ''); // DOPLŇTE HESLO!

// Odesílatel a příjemce
define('EMAIL_FROM', 'info@hezina.cz');
define('EMAIL_FROM_NAME', 'Kontaktní formulář - Jan Hezina');
define('EMAIL_TO', 'hezina@gmail.com');
define('EMAIL_REPLY_TO_NAME', 'Kontaktní formulář');

// Debug režim (nastavte na false na produkci)
define('EMAIL_DEBUG', false);
?>
