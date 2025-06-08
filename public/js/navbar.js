// Script minimalista para gerenciar a barra de navegação
// Sem interferência nos dropdowns do Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    console.log('Navbar script carregado');
    console.log('Bootstrap disponível:', typeof bootstrap !== 'undefined');
    
    const navbar = document.querySelector('.navbar');

    // Efeito de scroll na navbar
    window.addEventListener('scroll', function() {
        if (window.scrollY > 30) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Verificar dropdowns após carregamento completo
    setTimeout(() => {
        const dropdowns = document.querySelectorAll('[data-bs-toggle="dropdown"]');
        console.log(`${dropdowns.length} dropdowns encontrados na página`);
        
        dropdowns.forEach((dropdown, index) => {
            console.log(`Dropdown ${index + 1}:`, dropdown);
        });
    }, 100);
});
