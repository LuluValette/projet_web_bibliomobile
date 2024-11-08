// Sélectionne les éléments du menu et du bouton de bascule
const menuToggle = document.getElementById('menu-toggle');
const mainMenu = document.getElementById('main-menu');

// Ajoute un événement pour le clic sur le bouton de bascule
menuToggle.addEventListener('click', () => {
    // Bascule la classe "hidden" sur le menu pour afficher ou masquer
    mainMenu.classList.toggle('hidden');

    // Change le texte du bouton en fonction de l'état du menu
    menuToggle.textContent = mainMenu.classList.contains('hidden')
        ? 'Afficher le menu'
        : 'Masquer le menu';
});