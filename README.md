# Jan Hezina - AI Expert & Mentor

Moderní osobní stránka pro prezentaci služeb v oblasti AI.

## Struktura projektu

Projekt je rozdělen do následujících souborů:

- `index.html` - Hlavní HTML struktura stránky
- `styles.css` - Veškeré CSS styly
- `script.js` - JavaScript funkcionalita
- `contact.php` - PHP skript pro zpracování formuláře
- `dekujeme.html` - Potvrzovací stránka po odeslání kontaktního formuláře

## Spuštění projektu

Projekt je možné spustit otevřením souboru `index.html` v libovolném moderním webovém prohlížeči.

## Funkce

- Plně responzivní design pro všechny velikosti obrazovek
- Hamburger menu pro mobilní zařízení
- Tmavý režim s moderními efekty
- SVG ilustrace generované přímo v kódu (bez nutnosti externích obrázků)
- Animace na scroll
- Funkční kontaktní formulář s PHP skriptem pro odesílání e-mailů

## Sekce stránky

1. **Úvod** - Hero sekce s hlavním nadpisem a SVG ilustrací AI mozku
2. **O mně** - Informace o odbornosti a zkušenostech
3. **Kurzy AI** - Nabídka kurzů rozdělená podle úrovně pokročilosti
4. **Nástroje** - Přehled používaných nástrojů a technologií
5. **Kontakt** - Kontaktní formulář a odkazy na sociální sítě

## Technické detaily

- Moderní CSS vlastnosti (flexbox, grid, proměnné)
- Animované SVG elementy
- Efekt glassmorphism na kartách a formuláři
- Optimalizované přechody a animace pro plynulý uživatelský zážitek

## Přizpůsobení

Pro úpravu stránky je možné:

- Změnit barvy úpravou CSS proměnných v `:root` v souboru `styles.css`
- Přidat nebo odebrat sekce v `index.html`
- Upravit obsah podle potřeby

## Odesílání e-mailů

Kontaktní formulář používá **PHPMailer** knihovnu pro spolehlivé odesílání emailů přes SMTP server s autentizací.

### Konfigurace SMTP pro Wedos

1. Otevřete soubor `email_config.php`
2. Doplňte SMTP heslo do `SMTP_PASSWORD` (heslo k emailové schránce info@hezina.cz)
3. Případně upravte další parametry (email příjemce, SMTP server, atd.)

```php
define('SMTP_USERNAME', 'info@hezina.cz'); // Emailová adresa z vaší domény
define('SMTP_PASSWORD', 'vase-heslo-zde'); // DOPLŇTE HESLO!
define('EMAIL_TO', 'hezina@gmail.com'); // Příjemce zpráv
```

### Wedos SMTP nastavení

- **SMTP Server**: smtp.wedos.com
- **Port**: 587 (TLS) nebo 465 (SSL)
- **Autentizace**: Ano (uživatelské jméno a heslo k emailové schránce)
- **Odesílatel**: Musí být emailová adresa z vaší domény na Wedos

### Řešení problémů

- Pokud emaily nefungují, zkontrolujte, zda je správně nastaveno heslo v `email_config.php`
- Ujistěte se, že emailová adresa v `SMTP_USERNAME` existuje na vašem hostingu
- Zkontrolujte, zda má email na Wedos zapnuté SMTP odesílání
- Pro debug nastavte `EMAIL_DEBUG` na `true` v `email_config.php` a zkontrolujte server logy

## Nasazení

1. Nahrajte všechny soubory na váš webhosting na wedos.cz
2. Ujistěte se, že PHP na serveru funguje správně (PHP 7.0 nebo novější)
3. **DŮLEŽITÉ**: Vytvořte emailovou schránku `info@hezina.cz` na Wedos hostingu (pokud ještě neexistuje)
4. Upravte soubor `email_config.php`:
   - Doplňte heslo k emailové schránce do `SMTP_PASSWORD`
   - Případně upravte příjemce v `EMAIL_TO`
5. Zkontrolujte, že složka `lib/PHPMailer/` je nahrána se všemi soubory
6. Otestujte funkčnost kontaktního formuláře odesláním testovací zprávy

## Budoucí vylepšení

- Přidání galerie projektů
- Implementace vlastního backendu pro kontaktní formulář
- Přidání sekce s recenzemi klientů
- Integrování vlastních fotografií

## Doporučené další úpravy webu

### Bezpečnost
- ✅ **HOTOVO**: Implementace PHPMailer pro bezpečné odesílání emailů
- Přidání CAPTCHA (např. Google reCAPTCHA) pro ochranu před spamem
- Implementace rate limitingu pro prevenci zneužití formuláře
- HTTPS certifikát (SSL) - ověřte, že je aktivní na Wedos

### SEO a Marketing
- Přidání meta tagů pro sociální sítě (Open Graph, Twitter Cards)
- Implementace Google Analytics nebo jiného nástroje pro sledování návštěvnosti
- Přidání strukturovaných dat (Schema.org) pro lepší viditelnost ve vyhledávačích
- Sitemap.xml pro lepší indexaci
- robots.txt pro správné řízení crawlerů

### Obsah
- Přidání konkrétních case studies nebo příkladů projektů
- Blog nebo sekce s články o AI
- Video představení nebo tutoriály
- Sekce s FAQ (často kladené otázky)
- Testimonials/recenze od klientů

### Funkčnost
- Newsletter formulář pro pravidelnou komunikaci
- Kalendář pro rezervaci konzultací (integrace s Calendly nebo podobným)
- Multi-jazyčná podpora (CZ/EN)
- Možnost stažení portfolia nebo prezentace v PDF
- Chat widget pro rychlou komunikaci

### Výkon
- Optimalizace obrázků (kompress, lazy loading)
- Minifikace CSS a JavaScript souborů
- Implementace cache mechanismu
- CDN pro rychlejší načítání statických souborů

### Design
- Přidání tmavého/světlého režimu (theme switcher)
- Animace při scrollování (smooth scroll, fade-in efekty)
- Micro-interakce pro lepší UX
- Mobilní optimalizace kontaktního formuláře

---

Vytvořeno s ❤️ pro Jana Hezinu, AI experta a mentora.