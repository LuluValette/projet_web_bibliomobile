<?php
// Inclusion des classes nécessaires pour la base de données, la gestion des images, et la gestion des voitures
include_once 'Database.php';
include_once 'ImageLoader.php';
include_once 'VoitureImageManager.php'; // Nouveau fichier pour la gestion des images

class AdminVoiture {
    private $db;

    public function __construct() {
        // Initialisation de la connexion à la base de données
        $this->db = Database::getInstance()->getConnection();
    }

    public function getVoitureByName($nom) {
        // Requête pour obtenir une voiture spécifique par son nom (sensible à la casse)
        $sql = "SELECT * FROM voitures WHERE BINARY nom = :nom";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null; // Retourne null si aucune voiture n'est trouvée
        }

        // Charger l'image associée à la voiture depuis ImageLoader
        $imageData = $this->getImageForCar($nom);
        $result['imageHtml'] = isset($imageData['error'])
            ? '<p>' . htmlspecialchars($imageData['error']) . '</p>'
            : '<img src="' . htmlspecialchars($imageData['url'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($imageData['alt'], ENT_QUOTES, 'UTF-8') . '">';

        return $result;
    }

    public function getAllVoitures() {
        // Requête pour obtenir toutes les voitures dans la base de données
        $sql = "SELECT * FROM voitures";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les voitures sous forme de tableau associatif
    }

    public function displayVoitures() {
        // Génère un tableau HTML pour afficher toutes les voitures
        $voitures = $this->getAllVoitures();
        $html = '<table>';
        $html .= '<tr><th>Image</th><th>Nom</th><th>Histoire</th><th>Moteur</th><th>Puissance</th><th>Accélération</th><th>Vitesse</th><th>Particularité</th><th>Surnom</th><th>Modèle</th><th>Marque</th><th>Action</th></tr>';

        foreach ($voitures as $voiture) {
            $imageHTML = $voiture['imageHtml'] ?? '<p>Image non disponible</p>';
            $html .= '<tr>';
            $html .= '<td>' . $imageHTML . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['nom'] ?? '') . '</td>';
            // Ajout de tous les champs voiture
            $html .= '<td>' . htmlspecialchars($voiture['histoire'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['moteur'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['puissance'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['acceleration'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['vitesse'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['particularite'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['surnom'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['modele'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($voiture['marque'] ?? '') . '</td>';
            $html .= '<td><a href="modifier_voiture.php?nom=' . urlencode($voiture['nom']) . '" class="table-action-button">Modifier</a> | ';
            $html .= '<a href="#" class="delete-voiture table-action-button" data-nom="' . htmlspecialchars($voiture['nom']) . '">Supprimer</a></td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html; // Retourne le tableau HTML complet
    }

    public function ajouterVoiture($nom, $histoire, $moteur, $puissance, $acceleration, $vitesse, $particularite, $surnom, $modele, $marque, $imageFile = null) {
        // Insertion d'une nouvelle voiture dans la base de données
        $sql = "INSERT INTO voitures (nom, histoire, moteur, puissance, acceleration, vitesse, particularite, surnom, modele, marque) 
                VALUES (:nom, :histoire, :moteur, :puissance, :acceleration, :vitesse, :particularite, :surnom, :modele, :marque)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':histoire', $histoire);
        $stmt->bindParam(':moteur', $moteur);
        $stmt->bindParam(':puissance', $puissance);
        $stmt->bindParam(':acceleration', $acceleration);
        $stmt->bindParam(':vitesse', $vitesse);
        $stmt->bindParam(':particularite', $particularite);
        $stmt->bindParam(':surnom', $surnom);
        $stmt->bindParam(':modele', $modele);
        $stmt->bindParam(':marque', $marque);
        $stmt->execute();

        // Gestion de l'image associée à la voiture via VoitureImageManager
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            VoitureImageManager::ajouterImage($nom, $imageFile);
        }
    }

    public function supprimerVoitureComplet($nom) {
        // Supprime une voiture de la base de données et son image
        $this->deleteVoitureFromDB($nom); // Supprime les données de la voiture dans la base
        VoitureImageManager::supprimerImage($nom); // Supprime l'image associée
    }

    private function deleteVoitureFromDB($nom) {
        // Requête SQL pour supprimer une voiture spécifique de la base de données
        $sql = "DELETE FROM voitures WHERE nom = :nom";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateVoiture($nom, $histoire, $moteur, $puissance, $acceleration, $vitesse, $particularite, $surnom, $modele, $marque, $imageFile = null) {
        // Met à jour les informations d'une voiture dans la base de données
        $sql = "UPDATE voitures SET histoire = :histoire, moteur = :moteur, puissance = :puissance, acceleration = :acceleration,
                    vitesse = :vitesse, particularite = :particularite, surnom = :surnom, modele = :modele, marque = :marque WHERE nom = :nom";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':histoire', $histoire);
        $stmt->bindParam(':moteur', $moteur);
        $stmt->bindParam(':puissance', $puissance);
        $stmt->bindParam(':acceleration', $acceleration);
        $stmt->bindParam(':vitesse', $vitesse);
        $stmt->bindParam(':particularite', $particularite);
        $stmt->bindParam(':surnom', $surnom);
        $stmt->bindParam(':modele', $modele);
        $stmt->bindParam(':marque', $marque);
        $stmt->execute();

        // Si une nouvelle image est fournie, la mettre à jour via VoitureImageManager
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            VoitureImageManager::modifierImage($nom, $imageFile);
        }
    }

    public function getImageForCar($nom) {
        // Utilise ImageLoader pour obtenir les informations de l'image associée à une voiture
        return ImageLoader::getImageByName($nom);
    }

    public function getVoituresParMarque() {
        // Requête pour obtenir toutes les voitures, triées par marque
        $sql = "SELECT * FROM voitures ORDER BY marque, modele";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Organiser les voitures par marque dans un tableau associatif
        $voituresParMarque = [];
        foreach ($voitures as $voiture) {
            $marque = $voiture['marque'];
            if (!isset($voituresParMarque[$marque])) {
                $voituresParMarque[$marque] = []; // Initialiser le tableau pour la marque si elle n'existe pas encore
            }
            $voituresParMarque[$marque][] = $voiture; // Ajouter la voiture sous la marque correspondante
        }

        return $voituresParMarque; // Retourne le tableau des voitures organisées par marque
    }
}