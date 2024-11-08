<?php
// Inclure la classe SessionManager pour gérer les sessions utilisateurs
include_once __DIR__ . '/../class/SessionManager.php';
// Inclure la classe AdminVoiture pour accéder aux fonctions d'administration des voitures
include_once __DIR__ . '/../class/AdminVoiture.php';

// Démarrer une session pour vérifier si l'utilisateur est connecté
SessionManager::startSession();

// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
if (!SessionManager::estConnecte()) {
    header('Location: connexion.php'); // Redirection vers la page de connexion
    exit(); // Terminer le script pour empêcher l'accès non autorisé
}

// Créer une instance de la classe AdminVoiture pour utiliser ses méthodes de gestion
$adminVoiture = new AdminVoiture();
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Indique que le contenu principal de la page est en français -->
<head>
    <meta charset="UTF-8"> <!-- Encodage des caractères en UTF-8 pour une bonne compatibilité des caractères -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Permet à la page d'être responsive -->
    <title>Administration des Voitures</title> <!-- Titre de la page visible dans l'onglet du navigateur -->

    <!-- Inclusion des fichiers CSS pour le style général et le style de l'administration -->
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/administration.css">

    <!-- Lien vers jQuery pour les fonctionnalités interactives et la manipulation du DOM -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Lien vers le fichier JavaScript spécifique aux fonctionnalités d'administration -->
    <script src="/js/administration.js"></script>
</head>
<body>

<header>
    <!-- Titre de la section d'administration des voitures -->
    <h1>Gestion des Voitures</h1>

    <!-- Formulaire pour permettre à l'utilisateur de se déconnecter -->
    <form action="deconnexion.php" method="POST">
        <input type="submit" value="Se déconnecter"> <!-- Bouton de déconnexion -->
    </form>
</header>

<div id="main-content">
    <!-- Sous-titre et lien pour ajouter une nouvelle voiture -->
    <h2>Liste des Voitures</h2>
    <a href="ajouter_voiture.php">Ajouter une nouvelle voiture</a>

    <?php
    // Affichage de la liste des voitures en appelant la méthode displayVoitures() de la classe AdminVoiture
    echo $adminVoiture->displayVoitures();
    ?>
</div>

</body>
</html>