# Testování kontaktního formuláře

## Co bylo opraveno

### Hlavní problémy s původním kódem:
1. ❌ Špatná doména v sender_email: `info@coumis.cz` → ✅ `info@hezina.cz`
2. ❌ PHP `mail()` funkce s `ini_set()` nefunguje na Wedos (shared hosting má tyto nastavení zamčená)
3. ❌ Chybějící SMTP autentizace (Wedos vyžaduje přihlášení)
4. ❌ Žádná podpora TLS/SSL encryption pro port 587
5. ❌ Minimální error handling a logování

### Nové řešení s PHPMailer:
- ✅ Profesionální PHPMailer knihovna (verze 6.9.1)
- ✅ Plná podpora SMTP autentizace
- ✅ TLS/SSL encryption
- ✅ Proper error handling a logování
- ✅ HTML formátované emaily s pěkným designem
- ✅ Konfigurovatelné nastavení přes `email_config.php`
- ✅ Debug režim pro diagnostiku problémů

## Jak otestovat po nasazení

### 1. Před nahráním na server

V souboru `email_config.php` nastavte:

```php
define('SMTP_PASSWORD', 'skutecne-heslo-k-info@hezina.cz');
define('EMAIL_DEBUG', true); // Pro testování zapněte debug
```

### 2. Nahrání na Wedos

1. Nahrajte všechny soubory přes FTP nebo File Manager
2. Ujistěte se, že složka `lib/PHPMailer/` obsahuje všechny PHP soubory
3. Zkontrolujte, že `email_config.php` má správné heslo

### 3. Test formuláře

1. Otevřete web v prohlížeči
2. Přejděte na kontaktní sekci (#contact)
3. Vyplňte testovací data:
   - **Jméno**: Testovací zpráva
   - **E-mail**: vas-email@example.com
   - **Předmět**: Test kontaktního formuláře
   - **Zpráva**: Testování nového PHPMailer systému
4. Klikněte "Odeslat zprávu"

### 4. Očekávané výsledky

**Úspěch:**
- Přesměrování na `dekujeme.html`
- Email dorazí na `hezina@gmail.com` s HTML formátováním
- Email obsahuje všechny vyplněné údaje

**Chyba:**
- Vrácení na `index.html` s chybovou hláškou v URL
- Chybová hláška se zobrazí v alertu (zpracováno JavaScriptem)

### 5. Kontrola logů

Pokud něco nefunguje:

1. V administraci Wedos přejděte do sekce **Logy**
2. Zkontrolujte **error.log** pro PHP chyby
3. Hledejte řádky začínající "PHPMailer debug:" (pokud je EMAIL_DEBUG zapnutý)

## Časté problémy a řešení

### "SMTP heslo není nastaveno"
- ➡️ Vyplňte heslo v `email_config.php`

### "Authentication failed"
- ➡️ Zkontrolujte, že SMTP_USERNAME a SMTP_PASSWORD jsou správně
- ➡️ Ověřte, že emailová schránka existuje na Wedos

### "Could not connect to SMTP host"
- ➡️ Zkontrolujte SMTP_HOST: `smtp.wedos.com`
- ➡️ Zkontrolujte SMTP_PORT: `587` pro TLS
- ➡️ Ověřte, že server má přístup k internetu

### Email dorazí, ale bez formátování
- ➡️ Normální, někteří klienti neukazují HTML
- ➡️ Je zahrnuta i plain text verze (AltBody)

## Po úspěšném testu

1. V `email_config.php` nastavte:
   ```php
   define('EMAIL_DEBUG', false);
   ```
2. Smažte testovací emaily
3. Formulář je připraven k ostrému provozu!

## Bezpečnostní poznámky

- ⚠️ NIKDY nesdílejte `email_config.php` s heslem
- ⚠️ Používejte silné heslo pro emailovou schránku
- ⚠️ Zvažte přidání CAPTCHA pro ochranu před spam boty
- ⚠️ Pravidelně kontrolujte logy serveru

## Kontakt při problémech

Pokud máte problémy:
1. Zkontrolujte INSTALACE.md pro detailní návod
2. Zapněte debug režim a zkontrolujte logy
3. Kontaktujte podporu Wedos pro SMTP problémy
4. Vytvořte issue na GitHubu

---

**Poznámka**: Tento test lze provést pouze na produkčním serveru s platným SMTP přístupem. V lokálním vývojovém prostředí bez SMTP serveru nebude fungovat.
