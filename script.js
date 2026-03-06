const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.getElementById('navLinks');

if (menuToggle && navLinks) {
  menuToggle.addEventListener('click', () => {
    const isOpen = navLinks.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', String(isOpen));
  });

  navLinks.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('open');
      menuToggle.setAttribute('aria-expanded', 'false');
    });
  });
}

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener('click', (event) => {
    const targetId = anchor.getAttribute('href');
    if (!targetId || targetId === '#') return;

    const target = document.querySelector(targetId);
    if (!target) return;

    event.preventDefault();
    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});

const yearElement = document.getElementById('year');
if (yearElement) yearElement.textContent = new Date().getFullYear();

const contactForm = document.getElementById('contactForm');
const statusElement = document.getElementById('status');

if (contactForm && statusElement) {
  const isProd = window.location.hostname === 'hezina.cz' || window.location.hostname === 'www.hezina.cz';
  const ENDPOINT = isProd
    ? 'https://n8n.janagi.org/webhook/a45b6308-f437-42e2-8399-5cc0aae50b9c'
    : 'https://n8n.janagi.org/webhook-test/a45b6308-f437-42e2-8399-5cc0aae50b9c';

  contactForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    statusElement.textContent = 'Odesílám…';

    const formData = new FormData(contactForm);
    if (formData.get('website')) return;

    const payload = Object.fromEntries(formData.entries());

    try {
      const response = await fetch(ENDPOINT, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });

      if (!response.ok) throw new Error('Bad response');

      statusElement.textContent = 'Díky! Zpráva byla odeslána.';
      contactForm.reset();
    } catch (error) {
      statusElement.textContent = 'Odeslání se nepovedlo. Zkuste to prosím znovu.';
    }
  });
}
