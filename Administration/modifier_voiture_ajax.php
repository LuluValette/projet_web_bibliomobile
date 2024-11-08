<?php
// Démarrer la session pour l'utilisateur actuel
session_start();

// Inclusion des classes nécessaires pour la gestion des sessions, la base de données, et l'administration des voitures
include_once __DIR__ . '/../class/SessionManager.php';
include_once __DIR__ . '/../class/Database.php';
include_once __DIR__ . '/../class/AdminVoiture.php';

// Démarrer la session via SessionManager et vérifier si l'utilisateur est connecté
SessionManager::startSession();
if (!SessionManager::estConnecte()) {
    // Envoyer une réponse JSON si l'utilisateur n'est pas connecté et terminer le script
    echo json_encode(['message' => 'Vous devez être connecté.']);
    exit();
}

// Vérifier que la requête est de type POST et qu'une action est spécifiée dans les données POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    // Récupérer le nom de la voiture depuis les données POST
    $nom = $_POST['nom'];

    // Créer une instance de la classe AdminVoiture pour gérer les modifications
    $adminVoiture = new AdminVoiture();

    // Vérifier si l'action est une mise à jour
    if ($_POST['action'] == 'update') {
        // Créer un tableau associatif contenant les nouvelles données de la voiture
        $data = [
            'histoire' => $_POST['histoire'],
            'moteur' => $_POST['moteur'],
            'puissance' => $_POST['puissance'],
            'acceleration' => $_POST['acceleration'],
            'vitesse' => $_POST['vitesse'],
            'particularite' => $_POST['particularite'],
            'surnom' => $_POST['surnom'],
            'modele' => $_POST['modele'],
            'marque' => $_POST['marque'],
            'image' => $_FILES['image'] ?? null // Récupérer le fichier image si présent
        ];

        try {
            // Appeler la méthode updateVoiture pour mettre à jour les données de la voiture
            $adminVoiture->updateVoiture(
                $nom, $data['histoire'], $data['moteur'], $data['puissance'],
                $data['acceleration'], $data['vitesse'], $data['particularite'], $data['surnom'],
                $data['modele'], $data['marque'], $data['image']
            );

            // Envoyer un message JSON confirmant le succès de la mise à jour
            echo json_encode(['message' => "La voiture $nom a été mise à jour avec succès."]);
        } catch (Exception $e) {
            // En cas d'erreur, envoyer un message JSON avec le message d'erreur
            echo json_encode(['message' => "Erreur : " . $e->getMessage()]);
        }
    }
}
?>