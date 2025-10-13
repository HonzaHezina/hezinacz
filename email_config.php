<?php
/**
 * Konfigurace emailu pro Wedos hosting
 * 
 * DŮLEŽITÉ: Po nahrání na server vyplňte SMTP_PASSWORD a případně upravte další nastavení
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
