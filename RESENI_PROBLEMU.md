# Řešení problému s odesíláním emailů

## 🎯 Shrnutí problému

Email z kontaktního formuláře na webu hezina.cz přestal fungovat na Wedos hostingu.

## ✅ Co bylo opraveno

### 1. Hlavní technické problémy

**Původní kód měl tyto problémy:**

- ❌ Používal základní PHP `mail()` funkci, která nefunguje správně na Wedos shared hostingu
- ❌ `ini_set()` pro SMTP konfiguraci je na shared hostingu zakázáno/ignorováno
- ❌ Chybějící SMTP autentizace (Wedos vyžaduje přihlášení s heslem)
- ❌ Žádná podpora TLS/SSL šifrování pro bezpečné připojení
- ❌ Špatná doména v odesílateli: `info@coumis.cz` místo `info@hezina.cz`
- ❌ Minimální error handling - uživatel neví, co se pokazilo

**Nové řešení:**

- ✅ **PHPMailer knihovna** - profesionální řešení pro odesílání emailů
- ✅ **SMTP autentizace** - správné přihlášení k Wedos SMTP serveru
- ✅ **TLS šifrování** - bezpečné připojení na port 587
- ✅ **Konfigurovatelné** - všechna nastavení v `email_config.php`
- ✅ **Error handling** - detailní logování chyb pro diagnostiku
- ✅ **HTML emaily** - pěkně formátované zprávy s firemním designem
- ✅ **Debug režim** - pro snadné řešení problémů

### 2. Přidané soubory

| Soubor | Účel |
|--------|------|
| `lib/PHPMailer/` | PHPMailer knihovna (7 souborů) |
| `email_config.php` | Konfigurace SMTP (DOPLŇTE HESLO!) |
| `email_config.example.php` | Ukázkový konfigurační soubor |
| `INSTALACE.md` | Krok za krokem instalační průvodce |
| `TEST.md` | Návod na testování formuláře |
| `RESENI_PROBLEMU.md` | Tento dokument |
| `.gitignore` | Git konfigurace |

### 3. Upravené soubory

| Soubor | Změny |
|--------|-------|
| `contact.php` | Kompletně přepsán pro PHPMailer |
| `README.md` | Přidána sekce o emailech a doporučení |

## 🚀 Co musíte udělat nyní

### Krok 1: Vytvořte emailovou schránku (pokud neexistuje)

1. Přihlaste se do administrace Wedos
2. Přejděte do **E-maily**
3. Vytvořte schránku `info@hezina.cz` (pokud ještě neexistuje)
4. Poznamenejte si heslo

### Krok 2: Nastavte heslo v konfiguraci

1. Otevřete soubor `email_config.php`
2. Najděte řádek:
   ```php
   define('SMTP_PASSWORD', '');
   ```
3. Vyplňte heslo mezi uvozovky:
   ```php
   define('SMTP_PASSWORD', 'vase-skutecne-heslo');
   ```
4. Uložte soubor

### Krok 3: Nahrajte soubory na server

Nahrajte **VŠECHNY** soubory na Wedos hosting:
- Zvláště důležité: `lib/PHPMailer/` složka a `email_config.php`
- Použijte FTP nebo File Manager ve Wedos administraci

### Krok 4: Otestujte formulář

1. Otevřete web v prohlížeči
2. Vyplňte kontaktní formulář
3. Odešlete testovací zprávu
4. Zkontrolujte inbox: hezina@gmail.com

✅ **Pokud vše funguje:** Budete přesměrováni na děkovnou stránku a email dorazí

❌ **Pokud nefunguje:** Zkontrolujte logy na serveru a viz sekce "Řešení problémů"

## 🔧 Řešení problémů

### Debug režim

Pro zjištění přesné příčiny problému:

1. V `email_config.php` změňte:
   ```php
   define('EMAIL_DEBUG', true);
   ```
2. Zkuste odeslat zprávu
3. Zkontrolujte error logy na serveru
4. Po vyřešení nastavte zpět na `false`

### Časté chyby

| Chybová hláška | Řešení |
|----------------|--------|
| "SMTP heslo není nastaveno" | Vyplňte heslo v `email_config.php` |
| "Authentication failed" | Zkontrolujte uživatelské jméno a heslo |
| "Could not connect" | Ověřte SMTP server a port |
| Zpráva se neodešle | Zkontrolujte, že složka `lib/PHPMailer/` je nahraná |

**Podrobný průvodce řešením problémů najdete v souboru `INSTALACE.md`**

## 📧 Konfigurace emailu

### Aktuální nastavení:

- **SMTP Server**: smtp.wedos.com
- **Port**: 587 (TLS)
- **Odesílatel**: info@hezina.cz
- **Příjemce**: hezina@gmail.com
- **Reply-To**: Email vyplněný uživatelem ve formuláři

### Jak změnit příjemce:

V `email_config.php`:
```php
define('EMAIL_TO', 'novy-email@example.com');
```

## 💡 Doporučené další úpravy webu

V souboru **README.md** najdete kompletní seznam doporučení v sekci "Doporučené další úpravy webu", včetně:

### Bezpečnost
- ✅ HTTPS certifikát (zkontrolujte, že je aktivní)
- 🔲 CAPTCHA ochrana proti spam botům (např. Google reCAPTCHA)
- 🔲 Rate limiting pro prevenci zneužití formuláře
- 🔲 CSP (Content Security Policy) hlavičky

### SEO a Marketing
- 🔲 Google Analytics pro sledování návštěvnosti
- 🔲 Meta tagy pro sociální sítě (Open Graph)
- 🔲 Strukturovaná data (Schema.org)
- 🔲 Sitemap.xml a robots.txt

### Obsah
- 🔲 Blog s články o AI
- 🔲 Portfolio/case studies
- 🔲 Video tutoriály
- 🔲 FAQ sekce
- 🔲 Recenze od klientů

### Funkčnost
- 🔲 Newsletter systém
- 🔲 Kalendář pro rezervace (Calendly integrace)
- 🔲 Multi-jazyčná verze (CZ/EN)
- 🔲 Chat widget pro rychlou komunikaci
- 🔲 PDF ke stažení (portfolio, ceník)

### Výkon
- 🔲 Optimalizace obrázků
- 🔲 Minifikace CSS/JS
- 🔲 Cache mechanismus
- 🔲 CDN pro statické soubory

### Design
- 🔲 Tmavý/světlý režim (theme switcher)
- 🔲 Pokročilé animace
- 🔲 Lepší mobilní UX
- 🔲 Micro-interakce

**Kompletní popis každého doporučení najdete v README.md**

## 📚 Dokumentace

- **INSTALACE.md** - Detailní instalační průvodce
- **TEST.md** - Návod na testování formuláře
- **README.md** - Kompletní dokumentace projektu
- **email_config.example.php** - Ukázková konfigurace

## 🆘 Potřebujete pomoc?

1. Zkontrolujte **INSTALACE.md** pro krok-za-krokem návod
2. Zapněte debug režim a zkontrolujte logy
3. Kontaktujte podporu Wedos pro SMTP problémy: podpora@wedos.cz
4. Vytvořte issue na GitHubu pro problémy s kódem

## ✨ Shrnutí změn

### Co bylo vyřešeno:
- ✅ Email se nyní odesílá přes správný SMTP server s autentizací
- ✅ Kód je profesionální, bezpečný a snadno konfigurovatelný
- ✅ Přidána kompletní dokumentace
- ✅ Vytvořen instalační průvodce
- ✅ Přidána doporučení pro další vylepšení webu

### Co je potřeba udělat:
- ⏳ Vytvořit/ověřit emailovou schránku info@hezina.cz na Wedos
- ⏳ Doplnit SMTP heslo do email_config.php
- ⏳ Nahrát všechny soubory na server
- ⏳ Otestovat kontaktní formulář

---

**Web je připraven k nasazení!** 🚀

Po dokončení těchto kroků bude kontaktní formulář plně funkční a spolehlivý.
