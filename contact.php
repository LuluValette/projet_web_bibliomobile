<!DOCTYPE html>
<html lang="fr"> <!-- Définit le document HTML avec la langue principale en français -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8 pour supporter les caractères spéciaux -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page responsive pour une adaptation sur les écrans mobiles -->
    <title>Contact</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->

    <!-- Lien vers le fichier CSS principal pour appliquer le style de la page -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<header>
    <!-- Titre principal de la page de contact -->
    <h1>Contact</h1>

    <!-- Inclusion du fichier 'menu.php' qui contient le menu de navigation principal -->
    <?php include 'all/menu.php'; ?>
</header>

<?php
// Inclure le fichier 'recuperer_contact.php' pour charger les informations de contact depuis la base de données
include 'all/recuperer_contact.php';
?>

<section id="presentation">
    <div class="presentation-content" id="page-contact">
        <!-- Affichage des informations de contact récupérées avec des liens pour appeler et envoyer un email directement -->
        <p>Je suis disponible au numéro <a href="tel:<?php echo htmlspecialchars($phone); ?>"><?php echo htmlspecialchars($phone); ?></a>
            et à l'adresse <a href="mailto:<?php echo htmlspecialchars($mail); ?>"><?php echo htmlspecialchars($mail); ?></a>.
        </p>

        <!-- Affichage de l'adresse physique avec la protection des caractères spéciaux -->
        <p>Vous pouvez venir me voir à l'adresse <?php echo htmlspecialchars($address); ?>.</p>
    </div>
</section>

<footer>
    <!-- Pied de page avec un message de droits d'auteur -->
    <p>&copy; 2024 Mon Site. Tous droits réservés.</p>
</footer>

</body>
</html>