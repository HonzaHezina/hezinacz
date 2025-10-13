# Instalační průvodce - Kontaktní formulář s PHPMailer

## Rychlý start

### 1. Vytvoření emailové schránky na Wedos

1. Přihlaste se do administrace Wedos
2. Přejděte do sekce **E-maily**
3. Vytvořte novou emailovou schránku `info@hezina.cz` (pokud ještě neexistuje)
4. Zapamatujte si nebo uložte heslo k této schránce

### 2. Konfigurace emailu na webu

1. Otevřete soubor `email_config.php` v textovém editoru
2. Najděte řádek: `define('SMTP_PASSWORD', '');`
3. Mezi uvozovky vložte heslo k emailové schránce:
   ```php
   define('SMTP_PASSWORD', 'vase-skutecne-heslo');
   ```
4. Uložte soubor

### 3. Nahrání souborů na server

Nahrajte všechny soubory na váš webhosting přes FTP nebo správce souborů:

```
/
├── index.html
├── styles.css
├── script.js
├── contact.php
├── email_config.php      ← DŮLEŽITÉ!
├── dekujeme.html
├── lib/
│   └── PHPMailer/        ← DŮLEŽITÉ!
│       ├── PHPMailer.php
│       ├── SMTP.php
│       └── Exception.php
└── ... další soubory
```

### 4. Testování

1. Otevřete web v prohlížeči
2. Přejděte na kontaktní formulář
3. Vyplňte testovací zprávu
4. Klikněte na "Odeslat zprávu"
5. Pokud vše funguje správně, budete přesměrováni na děkovnou stránku
6. Zkontrolujte svou emailovou schránku (hezina@gmail.com)

## Řešení problémů

### Zpráva se neodešle

**Možné příčiny:**

1. **Chybné heslo v email_config.php**
   - Zkontrolujte, že heslo v `SMTP_PASSWORD` je správné
   - Heslo musí být bez uvozovek navíc

2. **Emailová schránka neexistuje**
   - Vytvořte schránku info@hezina.cz na Wedos
   - Ověřte, že schránka je aktivní

3. **Chybí PHPMailer soubory**
   - Zkontrolujte, že složka `lib/PHPMailer/` obsahuje všechny soubory
   - Soubory musí být: PHPMailer.php, SMTP.php, Exception.php

4. **SMTP není povoleno**
   - V administraci Wedos zkontrolujte nastavení emailové schránky
   - Ověřte, že SMTP odesílání je povoleno

### Debug režim

Pro detailní diagnostiku problému:

1. Otevřete `email_config.php`
2. Změňte: `define('EMAIL_DEBUG', false);` na `define('EMAIL_DEBUG', true);`
3. Zkuste odeslat zprávu
4. Zkontrolujte chybové logy PHP na serveru (v administraci Wedos nebo v souboru error.log)

### Časté chyby

| Chyba | Řešení |
|-------|--------|
| "SMTP heslo není nastaveno" | Doplňte heslo v email_config.php |
| "Authentication failed" | Zkontrolujte přihlašovací údaje |
| "Could not connect to SMTP host" | Zkontrolujte SMTP_HOST a SMTP_PORT |
| "5xx SMTP error" | Kontaktujte podporu Wedos |

## Pokročilá konfigurace

### Změna SMTP serveru

Pokud používáte jiný SMTP server než Wedos:

```php
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_ENCRYPTION', 'tls');
define('SMTP_USERNAME', 'vas-email@example.com');
define('SMTP_PASSWORD', 'vase-heslo');
```

### Změna příjemce

Pro změnu emailu, kam chodí zprávy z formuláře:

```php
define('EMAIL_TO', 'novy-email@example.com');
```

### Použití SSL místo TLS

Pro port 465 se SSL:

```php
define('SMTP_PORT', 465);
define('SMTP_ENCRYPTION', 'ssl');
```

## Bezpečnostní doporučení

1. ❌ **NIKDY** nenahrávejte `email_config.php` s heslem do veřejného Git repozitáře
2. ✅ Používejte silné heslo pro emailovou schránku
3. ✅ Pravidelně kontrolujte logy serveru
4. ✅ Zvažte přidání CAPTCHA pro ochranu před spamem
5. ✅ Po nasazení nastavte `EMAIL_DEBUG` na `false`

## Podpora

Pokud máte problémy:

1. Zkontrolujte tento návod znovu
2. Zapněte debug režim a zkontrolujte logy
3. Kontaktujte podporu Wedos pro SMTP problémy
4. Vytvořte issue na GitHubu pro problémy s kódem

---

**Užitečné odkazy:**
- [Wedos - Nastavení e-mailu](https://www.wedos.cz)
- [PHPMailer dokumentace](https://github.com/PHPMailer/PHPMailer)
