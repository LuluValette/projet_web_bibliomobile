<?php
// class/User.php

include 'Database.php';

class User {
    private $pdo;

    public function __construct() {
        // Obtient l'instance de connexion à la base de données via le singleton Database
        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    /**
     * Authentifie un utilisateur en vérifiant le nom d'utilisateur et le mot de passe
     *
     * @param string $username Le nom d'utilisateur
     * @param string $password Le mot de passe
     * @return bool True si l'authentification réussit, sinon False
     */
    public function authenticate($username, $password) {
        // Préparation de la requête pour obtenir l'utilisateur avec le nom d'utilisateur donné
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Vérifie qu'un utilisateur correspondant est trouvé
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            // Vérifie le mot de passe (utilisez password_verify si les mots de passe sont hashés)
            if ($password === $user['password']) { // Meilleure pratique : password_verify($password, $user['password'])
                session_start();
                $_SESSION['user_id'] = $user['id']; // Stocke l'ID utilisateur dans la session pour indiquer qu'il est connecté
                return true;
            }
        }
        return false; // Retourne faux si l'authentification échoue
    }
}
?>