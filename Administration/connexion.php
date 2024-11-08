<?php
// connexion.php

// Inclusion des fichiers nécessaires pour la gestion des utilisateurs, la base de données, et les sessions
include_once '../class/User.php';
include_once '../class/Database.php';
include_once __DIR__ . '/../class/SessionManager.php';

// Initialiser la variable $error à null pour gérer les messages d'erreur
$error = null;

// Vérifier si la requête est de type POST (soumission du formulaire de connexion)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et échapper les valeurs du formulaire pour éviter les failles XSS
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
    $password = $_POST['password']; // Récupérer le mot de passe sans échapper (à gérer lors de l'authentification)

    // Créer une instance de la classe User pour authentifier l'utilisateur
    $user = new User();

    // Authentification de l'utilisateur avec les informations fournies
    if ($user->authenticate($username, $password)) {
        // Redirection vers la page d'administration en cas de succès
        header('Location: administration.php');
        exit(); // Terminer le script après la redirection
    } else {
        // Définir un message d'erreur si l'authentification échoue
        $error = "Utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Indique que la langue principale de la page est le français -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page responsive pour les appareils mobiles -->
    <title>Connexion</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->

    <!-- Inclusion des fichiers CSS pour le style général et spécifique à la page de connexion -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/connexion.css">
</head>
<body>
<div class="login-container"> <!-- Conteneur principal pour centrer le formulaire de connexion -->
    <h2>Connexion</h2> <!-- Titre de la page de connexion -->

    <?php if ($error): ?> <!-- Affichage du message d'erreur s'il existe -->
        <div class="error-message"><?= htmlspecialchars($error); ?></div> <!-- Affiche le message d'erreur échappé pour éviter les failles XSS -->
    <?php endif; ?>

    <!-- Formulaire de connexion pour l'utilisateur -->
    <form action="connexion.php" method="POST">
        <!-- Champ pour le nom d'utilisateur -->
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>

        <!-- Champ pour le mot de passe -->
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <!-- Bouton de soumission pour se connecter -->
        <input type="submit" value="Se connecter">
    </form>
</div>
</body>
</html>