<?php
// Inclure la classe SessionManager pour gérer les sessions utilisateurs
include_once __DIR__ . '/../class/SessionManager.php';
// Inclure la classe AdminVoiture pour gérer l'administration des voitures
include_once __DIR__ . '/../class/AdminVoiture.php';

// Démarrer une session pour vérifier si l'utilisateur est connecté
SessionManager::startSession();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!SessionManager::estConnecte()) {
    header('Location: connexion.php'); // Redirection vers la page de connexion
    exit(); // Terminer le script pour empêcher l'accès à la suite du code
}

// Créer une instance de la classe AdminVoiture pour accéder aux fonctions de gestion des voitures
$adminVoiture = new AdminVoiture();
?>
<!DOCTYPE html>
<html lang="fr"> <!-- Déclaration de la langue du document en français -->
<head>
    <meta charset="UTF-8"> <!-- Encodage des caractères en UTF-8 pour la compatibilité avec les caractères spéciaux -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rendre le site responsive pour les appareils mobiles -->
    <title>Administration des Voitures</title> <!-- Titre de la page pour l'onglet du navigateur -->

    <!-- Lien vers le fichier CSS principal contenant les styles généraux de la page -->
    <link rel="stylesheet" href="/css/styles.css">

    <!-- Lien vers le fichier CSS spécifique à l'administration des voitures -->
    <link rel="stylesheet" href="/css/administration.css">

    <!-- Lien vers jQuery pour simplifier la manipulation du DOM et les interactions AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Lien vers le fichier JavaScript pour les fonctions de l'administration -->
    <script src="/js/administration.js"></script>
</head>
<body>

<header>
    <!-- Titre principal de la page d'administration -->
    <h1>Gestion des Voitures</h1>

    <!-- Formulaire pour la déconnexion, qui envoie une requête POST pour se déconnecter -->
    <form action="deconnexion.php" method="POST">
        <input type="submit" value="Se déconnecter"> <!-- Bouton de déconnexion -->
    </form>
</header>

<div id="main-content">
    <!-- Sous-titre de la section principale indiquant la liste des voitures -->
    <h2>Liste des Voitures</h2>

    <!-- Lien vers la page permettant d'ajouter une nouvelle voiture -->
    <a href="ajouter_voiture.php">Ajouter une nouvelle voiture</a>

    <?php
    // Afficher la liste des voitures en appelant la méthode displayVoitures() de la classe AdminVoiture
    echo $adminVoiture->displayVoitures();
    ?>
</div>

</body>
</html>
