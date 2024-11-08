<?php
// Inclusion de la classe SessionManager pour gérer les sessions
include_once __DIR__ . '/../class/SessionManager.php';

// Ajouter des en-têtes HTTP pour empêcher le navigateur de mettre en cache la page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // Empêche le stockage en cache
header("Pragma: no-cache"); // Désactive la mise en cache
header("Expires: 0"); // Définit la date d'expiration à zéro pour une suppression immédiate du cache

// Supprimer tous les cookies du domaine pour assurer une déconnexion complète
if (isset($_SERVER['HTTP_COOKIE'])) {
    // Récupérer tous les cookies en les séparant par un point-virgule
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);

    // Parcourir chaque cookie pour le supprimer
    foreach ($cookies as $cookie) {
        // Séparer le nom et la valeur du cookie
        $parts = explode('=', $cookie);
        $name = trim($parts[0]); // Récupérer le nom du cookie

        // Expirer chaque cookie pour différents chemins et sous-domaines possibles
        setcookie($name, '', time() - 3600, '/'); // Expire le cookie pour le chemin racine
        setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST']); // Expire le cookie pour le domaine principal
        setcookie($name, '', time() - 3600, '/', '.' . $_SERVER['HTTP_HOST']); // Expire le cookie pour le sous-domaine
    }
}

// Appeler la méthode de déconnexion de SessionManager pour détruire la session
SessionManager::logout();

// Arrêter l'exécution du script pour éviter tout autre traitement après la déconnexion
exit();
?>