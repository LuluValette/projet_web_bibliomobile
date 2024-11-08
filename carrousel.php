<?php
// Inclure la classe ImageLoader pour charger les images depuis le fichier XML
require_once 'class/ImageLoader.php';

// Utiliser la méthode statique getAllImages pour récupérer toutes les images sous forme de tableau associatif
$carImages = ImageLoader::getAllImages();
?>
<script>
    // Exécuter le code une fois que le DOM est complètement chargé
    document.addEventListener("DOMContentLoaded", function() {
        // Récupérer les images en JSON depuis le PHP et les assigner à la variable JavaScript "images"
        const images = <?php echo json_encode($carImages); ?>;

        // Sélectionner l'élément contenant le carrousel dans le document HTML
        const carousel = document.getElementById('carousel');

        // Parcourir chaque image et créer un élément de carrousel pour chacune
        images.forEach((image, index) => {
            const imgDiv = document.createElement('div'); // Créer un div pour chaque image

            // Assigner la classe 'carousel-item' et définir la première image comme 'active'
            imgDiv.className = 'carousel-item' + (index === 0 ? ' active' : '');

            // Insérer l'image dans le div avec son URL et son texte alternatif
            imgDiv.innerHTML = `<img src="${image['url']}" alt="${image['alt']}">`;

            // Ajouter le div de l'image au conteneur du carrousel
            carousel.appendChild(imgDiv);
        });
    });

    // Initialiser l'index du carrousel à 0 pour afficher la première image en premier
    let currentIndex = 0;

    // Configurer un intervalle pour changer d'image toutes les 5 secondes
    setInterval(() => {
        const items = document.querySelectorAll('.carousel-item'); // Sélectionner tous les éléments du carrousel

        // Si le carrousel contient des images
        if (items.length > 0) {
            // Retirer la classe 'active' de l'image actuellement affichée
            items[currentIndex].classList.remove('active');

            // Passer à l'image suivante (boucle au début quand on arrive à la fin)
            currentIndex = (currentIndex + 1) % items.length;

            // Ajouter la classe 'active' à la nouvelle image pour l'afficher
            items[currentIndex].classList.add('active');
        }
    }, 5000); // Intervalle de 5000 millisecondes (5 secondes)
</script>
