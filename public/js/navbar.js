// Script para gerenciar a barra de navegação
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    // A barra de status do admin foi removida

    // Adiciona efeito de scroll à barra de navegação
    window.addEventListener('scroll', function() {
        if (window.scrollY > 30) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Toggle do modo administrador (se existir)
    const adminModeToggle = document.getElementById('adminModeToggle');
    if (adminModeToggle) {
        adminModeToggle.addEventListener('click', function() {
            this.classList.toggle('on');
            // Aqui você pode adicionar código para alternar entre os modos
            // Por exemplo, redirecionar para uma rota específica
        });
    }

    // Adicionar evento de hover aos dropdowns para dispositivos desktop
    if (window.innerWidth >= 992) {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.classList.add('show');
                }
            });
            dropdown.addEventListener('mouseleave', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    }
});
