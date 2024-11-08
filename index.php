<!DOCTYPE html>
<html lang="fr"> <!-- Définit le document HTML et indique que la langue principale est le français -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8 pour supporter les caractères spéciaux -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend le site responsive en ajustant l'affichage pour les petits écrans -->
    <title>bibliomobile</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->

    <!-- Lien vers le fichier CSS principal contenant les styles généraux de la page -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Lien vers le fichier CSS pour le style du menu de navigation -->
    <link rel="stylesheet" href="css/menu.css">

    <!-- Lien vers le fichier CSS pour le style du footer -->
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<header>
    <!-- Titre principal de la page, introduisant le thème de la bibliothèque automobile -->
    <h1>Bienvenue sur la bibliothèque automobile</h1>

    <!-- Inclusion du fichier 'menu.php' qui contient le menu de navigation -->
    <?php include 'all/menu.php'; ?>
</header>

<section id="presentation">
    <!-- Section de présentation avec un texte d'introduction sur le site et son contenu -->
    <div class="presentation-content">
        <p>
            Bienvenue sur la bibliothèque automobile ! <br/> Découvrez des voitures ayant marqué leur génération et l'univers de l'automobile. <br/>Bonne lecture !
        </p>
    </div>
</section>

<!-- Section du carrousel d'images pour afficher des images de voitures -->
<section class="carousel-container">
    <!-- Conteneur pour le carrousel, où les images seront chargées dynamiquement -->
    <div class="carousel-inner" id="carousel"></div>
</section>

<footer>
    <!-- Inclusion du fichier 'footer.php' pour afficher le pied de page avec les informations de contact -->
    <?php include 'all/footer.php'; ?>
</footer>

<!-- Inclusion du fichier 'carrousel.php' pour charger et afficher les images du carrousel -->
<?php include 'carrousel.php'; ?>
</body>
</html>