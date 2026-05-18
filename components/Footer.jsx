// Footer.jsx
function Footer() {
  const year = new Date().getFullYear();
  return (
    <footer className="footer">
      <div className="container footer__inner">
        <div>© {year} Jan Hezina · hezina.cz</div>
        <div className="footer__links">
          <a href="#prinos">Co dostanete</a>
          <a href="#cena">Cena</a>
          <a href="#kontakt">Kontakt</a>
          <a href="https://www.linkedin.com/in/jan-hezina/" target="_blank" rel="noopener">LinkedIn ↗</a>
        </div>
      </div>
    </footer>
  );
}

window.Footer = Footer;
