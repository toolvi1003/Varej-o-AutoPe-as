// Arquivo JavaScript principal para Varejão Auto Peças

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM totalmente carregado e analisado. Scripts.js está funcionando.');

    // Exemplo: Adicionar um evento de clique a todos os links de navegação
    const navLinks = document.querySelectorAll('header nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            // Poderia adicionar alguma lógica aqui, como um smooth scroll ou analytics
            // console.log('Link de navegação clicado:', this.href);
        });
    });
});
