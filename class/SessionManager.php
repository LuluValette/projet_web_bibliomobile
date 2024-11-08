<?php
class SessionManager {
    /**
     * Démarre une session si aucune session n'est active.
     */
    public static function startSession() {
        // Vérifie si aucune session n'est déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Démarre une nouvelle session
        }
    }

    /**
     * Vérifie si l'utilisateur est connecté en regardant si 'user_id' est défini dans la session.
     *
     * @return bool True si l'utilisateur est connecté, sinon False.
     */
    public static function estConnecte() {
        // Assure que la session est démarrée
        self::startSession();
        // Retourne vrai si 'user_id' est défini dans la session, sinon faux
        return isset($_SESSION['user_id']);
    }

    /**
     * Déconnecte l'utilisateur en détruisant la session et en ajoutant des en-têtes pour empêcher la mise en cache.
     * Redirige ensuite vers la page d'accueil ou de connexion.
     */
    public static function logout() {
        // Assure que la session est démarrée
        self::startSession();

        // Détruire la session en cours
        session_destroy();

        // Ajouter des en-têtes pour empêcher le navigateur de mettre en cache la page de déconnexion
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Rediriger vers la page d'accueil ou de connexion après la déconnexion
        header('Location: ../index.php');
        exit(); // Terminer le script après la redirection
    }
}
?>