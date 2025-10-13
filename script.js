// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Fade in elements on scroll
const fadeElements = document.querySelectorAll('.fade-in');
const fadeOptions = {
    threshold: 0.3,
    rootMargin: "0px 0px -100px 0px"
};

const fadeObserver = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            fadeObserver.unobserve(entry.target);
        }
    });
}, fadeOptions);

fadeElements.forEach(element => {
    fadeObserver.observe(element);
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const nav = document.querySelector('nav');
    if (window.scrollY > 100) {
        nav.style.padding = '1rem 10%';
        nav.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
    } else {
        nav.style.padding = '1.5rem 10%';
        nav.style.boxShadow = 'none';
    }
});

// Mobile menu implementation
function setupMobileMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');
    const mobileLinks = document.querySelectorAll('.mobile-link');
    
    if (menuToggle && mobileNav) {
        // Toggle mobile menu when hamburger icon is clicked
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.toggle('active');
            mobileNav.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });
        
        // Close mobile menu when a link is clicked
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                mobileNav.classList.remove('active');
                document.body.classList.remove('no-scroll');
            });
        });
    }
}

// Form submission handling - using PHP backend
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        // Kontrola URL parametrů pro případnou chybovou hlášku
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('status') && urlParams.get('status') === 'error') {
            const errorMsg = urlParams.get('msg') || 'Při odesílání zprávy došlo k chybě.';
            alert(errorMsg);
        }
        
        // Přidání vizuálního feedbacku před odesláním
        contactForm.addEventListener('submit', function(e) {
            const submitBtn = contactForm.querySelector('.submit-btn');
            if (submitBtn) {
                submitBtn.textContent = 'Odesílám...';
                submitBtn.disabled = true;
                
                // Vrácení tlačítka do původního stavu po 10 sekundách (pro případ výpadku)
                setTimeout(function() {
                    if (submitBtn.disabled) { // pokud je stále zakázáno
                        submitBtn.textContent = 'Odeslat zprávu';
                        submitBtn.disabled = false;
                    }
                }, 10000);
            }
            
            // Formulář se odešle standardně metodou POST na contact.php
        });
    }
});

// Přidání dynamického efektu particle na pozadí v hero sekci
function createParticleEffect() {
    const hero = document.querySelector('.hero');
    
    if (!hero) return;
    
    // Vytvoření kontejneru pro částice
    const particleContainer = document.createElement('div');
    particleContainer.className = 'particles';
    hero.appendChild(particleContainer);
    
    // Vytvoření částic
    for (let i = 0; i < 50; i++) {
        createParticle(particleContainer);
    }
}

function createParticle(container) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    
    // Náhodné vlastnosti částice
    const size = Math.random() * 5 + 1;
    const posX = Math.random() * 100;
    const posY = Math.random() * 100;
    const opacity = Math.random() * 0.5 + 0.1;
    const duration = Math.random() * 20 + 10;
    const delay = Math.random() * 10;
    
    // Nastavení stylu částice
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;
    particle.style.left = `${posX}%`;
    particle.style.top = `${posY}%`;
    particle.style.opacity = opacity;
    particle.style.animation = `float ${duration}s linear infinite`;
    particle.style.animationDelay = `${delay}s`;
    
    container.appendChild(particle);
}

// Inicializace po načtení stránky
window.addEventListener('load', function() {
    // Aktivace hamburger menu
    setupMobileMenu();
    
    // Přidání třídy no-scroll pro zamezení scrollování při otevřeném menu
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            .no-scroll {
                overflow: hidden;
            }
        </style>
    `);
    
    // Animace částic je připravena, ale neaktivní - můžete ji aktivovat odkomentováním
    // createParticleEffect();
});