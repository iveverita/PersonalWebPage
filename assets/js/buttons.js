
document.getElementById('projectsButton').addEventListener('click', function() {
    document.getElementById('projectsSection').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('contactFormButton').addEventListener('click', function() {
    document.getElementById('contactForm').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('contactsButton').addEventListener('click', function() {
    document.getElementById('contactsSection').scrollIntoView({ behavior: 'smooth' });
});

document.addEventListener('DOMContentLoaded', function() {
    var languageButton = document.getElementById('languageButton');
    var adminButton = document.getElementById('adminButton');

    if (languageButton) {
        languageButton.addEventListener('click', function() {
            var currentUrl = window.location.href;
            var currentLang = currentUrl.includes('?lang=en') ? 'en' : 'fr';
            var newLang = currentLang === 'en' ? 'fr' : 'en';
            var newUrl;
            if (currentUrl.includes('?lang=')) {
                newUrl = currentUrl.replace(/lang=(en|fr)/, 'lang=' + newLang);
            } else {
                newUrl = currentUrl + '?lang=' + newLang;
            }
            window.location.href = newUrl;
        });
    }

    if (adminButton) {
        adminButton.addEventListener('click', function() {
            const username = prompt('Enter username:');
            const password = prompt('Enter password:');
            if (username === 'admin' && password === 'LongPass') {
                window.location.href = 'assets/php/database/projects/add_proj_form.php';
            } else {
                alert('Invalid credentials');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    hamburger.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        hamburger.textContent = navMenu.classList.contains('active') ? '×' : '☰';
    });

    const navButtons = document.querySelectorAll('nav ul button');
    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            navMenu.classList.remove('active');
            hamburger.textContent = '☰';
        });
    });
});