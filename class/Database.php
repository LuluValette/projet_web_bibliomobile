<?php
// class/Database.php

class Database {
    // Instance unique pour le singleton
    private static $instance = null;
    private $pdo;

    // Constructeur privé pour empêcher l'instanciation directe et implémenter le singleton
    private function __construct() {
        // Informations de connexion à la base de données
        $host = 'mysql-valette.alwaysdata.net';
        $dbname = 'valette_bdd';
        $username = 'valette_god';
        $password = 'PetitPoney';

        try {
            // Création de l'objet PDO pour la connexion à la base de données
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            // Définir le mode d'erreur de PDO sur Exception pour une gestion des erreurs plus propre
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, afficher un message et arrêter le script
            die('Connection failed: ' . $e->getMessage());
        }
    }

    // Méthode pour obtenir l'instance unique de la classe (singleton)
    public static function getInstance() {
        if (self::$instance === null) {
            // Si aucune instance n'existe, la créer
            self::$instance = new Database();
        }
        return self::$instance; // Retourner l'instance unique
    }

    // Méthode pour obtenir la connexion PDO à la base de données
    public function getConnection() {
        return $this->pdo;
    }

    // Méthode pour récupérer les informations d'une voiture en fonction de son nom
    public function getCarInfo($nomVoiture) {
        // Préparer et exécuter la requête SQL pour obtenir les informations de la voiture
        $stmt = $this->pdo->prepare("SELECT * FROM voitures WHERE nom = :nom");
        $stmt->execute([':nom' => $nomVoiture]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne les informations sous forme de tableau associatif
    }

    // Méthode pour récupérer uniquement les noms de toutes les voitures
    public function getCarNames() {
        // Préparer et exécuter la requête SQL pour obtenir tous les noms de voitures
        $stmt = $this->pdo->prepare("SELECT nom FROM voitures");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Retourne un tableau contenant uniquement les noms des voitures
    }
}
?>